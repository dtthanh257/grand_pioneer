<?php

namespace Modules\Vessel\Http\Controllers\Api;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Vessel\Entities\Vessel;
use Modules\Vessel\Transformers\VesselTransformer;
use Modules\Vessel\Repositories\VesselRepository;
use Modules\Vessel\Http\Requests\VesselStoreRequest;
use Modules\Vessel\Http\Requests\VesselUpdateRequest;
use Modules\Vessel\Services\VesselService;

class VesselController extends BaseApiController
{
    protected $vesselRepository;

    public function __construct(VesselRepository $vesselRepository)
    {
        $this->vesselRepository = $vesselRepository;
    }

    public function index(Request $request)
    {
        $query = $this->vesselRepository;

        $vessels = $request->get('pagination') == 'false'
            ? $query->get()
            : $query->paginate($request->get('size', 15));

        return $this->respondSuccess($this->transform($vessels, new VesselTransformer(), 'vessels'));
    }

    public function show($id) {
        $vessel = $this->vesselRepository->find($id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        return $this->transform($vessel, new VesselTransformer(), 'vessel');
    }

    public function store(VesselStoreRequest $request) {
        try {
            DB::beginTransaction();

            $service = new VesselService();

            $data = $request->all();

            $vessel = $service->setAttributes($data)->save();

            $vessel->refresh();

            DB::commit();

            return $this->respondSuccess($this->transform($vessel, new VesselTransformer(), 'vessel'));
        } catch(\InvalidArgumentException $e) {
            return $this->respondBadRequest($e->getMessage());
        } catch(\Throwable $e) {
            DB::rollback();

            return $this->respondInternalServerError($e->getMessage());
        }
    }
    
    public function update($id, VesselUpdateRequest $request) {
        $query = $this->vesselRepository;

        $data = $request->all();

        $vessel = $query->find($id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        $vessel = $query->update($data);

        $vessel->refresh();

        return $this->respondSuccess($this->transform($vessel, new VesselTransformer(), 'vessel'));
    }

    public function destroy($id) {
        $vessel = $this->vesselRepository->find($id);
        if (!$vessel) {
            return $this->respondNotFound();
        }

        $this->vesselRepository->delete($id);

        return $this->respondSuccess();
    }
}
