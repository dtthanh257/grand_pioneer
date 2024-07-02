<?php

namespace Modules\Suite\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Suite\Http\Requests\SuiteTypeStoreRequest;
use Modules\Suite\Entities\Suite;
use Modules\Suite\Transformers\SuiteTypeTransformer;
use Modules\Suite\Repositories\SuiteTypeRepository;

class SuiteTypeController extends BaseApiController
{
    protected $suiteTypeRepository;

    public function __construct(SuiteTypeRepository $suiteTypeRepository) {
        $this->suiteTypeRepository = $suiteTypeRepository;
    }

    public function index(Request $request)
    {
        $query = $this->suiteTypeRepository;

        $suite_types = $request->get('pagination') == 'false'
            ? $query->get()
            : $query->paginate($request->get('size', 15));

        return $this->respondSuccess($this->transform($suite_types, new SuiteTypeTransformer(), 'suite_types'));
    }

    public function store(SuiteTypeStoreRequest $request)
    {
        $data = $request->only(['name']);

        $suite_type = $this->suiteTypeRepository->create($data);

        return $this->respondSuccess($this->transform($suite_type, new SuiteTypeTransformer(), 'suite_types'));
    }

    public function destroy($suite_type_id)
    {
        $suite_type = $this->suiteTypeRepository->find($suite_type_id);

        if (!$suite_type) {
            return $this->respondNotFound();
        }

        $suite_type->delete();

        return $this->respondSuccess();
    }
}