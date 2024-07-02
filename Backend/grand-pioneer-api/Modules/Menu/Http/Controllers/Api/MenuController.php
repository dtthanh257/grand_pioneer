<?php

namespace Modules\Menu\Http\Controllers\Api;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Transformers\MenuTransformer;
use Modules\Menu\Repositories\MenuRepository;
use Modules\Menu\Http\Requests\MenuStoreRequest;
use Modules\Menu\Http\Requests\MenuUpdateRequest;
use Modules\Menu\Services\MenuService;

class MenuController extends BaseApiController
{
    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index(Request $request)
    {
        $query = $this->menuRepository;

        $menu = $request->get('pagination') == 'false'
            ? $query->get()
            : $query->paginate($request->get('size', 15));

        return $this->respondSuccess($this->transform($menu, new MenuTransformer(), 'menu'));
    }

    public function store(MenuStoreRequest $request) {
        try {
            DB::beginTransaction();

            $service = new MenuService();

            $data = $request->all();

            $menu = $service->setAttributes($data)->save();

            $menu->refresh();

            DB::commit();

            return $this->respondSuccess($this->transform($menu, new MenuTransformer(), 'menu'));
        } catch(\InvalidArgumentException $e) {
            return $this->respondBadRequest($e->getMessage());
        } catch(\Throwable $e) {
            DB::rollback();

            return $this->respondInternalServerError($e->getMessage());
        }
    }

    public function update($menu_id, MenuUpdateRequest $request) {
        try {
            DB::beginTransaction();

            $service = new MenuService();

            $menu = $this->menuRepository->find($menu_id); // Giả sử đây là phương thức để tìm kiếm menu bằng ID

            if (!$menu) {
                return $this->respondNotFound();
            }

            $data = $request->all();

            $menu->update($data);;

            $menu->refresh();

            DB::commit();

            return $this->respondSuccess($this->transform($menu, new MenuTransformer(), 'menu'));
        } catch(\InvalidArgumentException $e) {
            return $this->respondBadRequest($e->getMessage());
        } catch(\Throwable $e) {
            DB::rollback();

            return $this->respondInternalServerError($e->getMessage());
        }
    }

    public function destroy($menu_id) {
        $query = $this->menuRepository;

        $menu = $query->find($menu_id);

        if(!$menu) {
            return $this->respondNotFound();
        }

        $menu->delete();
        return $this->respondSuccess();
    }
}
