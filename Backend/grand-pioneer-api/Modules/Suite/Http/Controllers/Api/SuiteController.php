<?php

namespace Modules\Suite\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Suite\Transformers\SuiteTransformer;
use Modules\Suite\Http\Requests\SuiteStoreRequest;
use Modules\Suite\Http\Requests\SuiteUpdateRequest;
use Modules\Vessel\Entities\Vessel;
use Modules\Suite\Repositories\SuiteRepository;

class SuiteController extends BaseApiController
{
    protected $suiteRepository;

    public function __construct(SuiteRepository $suiteRepository) {
        $this->suiteRepository = $suiteRepository;
    }

    public function index(Request $request) {
        $query = $this->suiteRepository;

        $suite = $query->get();

        return $this->respondSuccess($this->transform($suite, new SuiteTransformer(), 'suites'));
    }

    public function getSuiteByVessel($vessel_id, Request $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        $suite = $vessel->suite;

        if (!$suite) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($suite, new SuiteTransformer(), 'suites'));
    }

    public function show($vessel_id, $suite_id) {
        $vessel = Vessel::query()->find($vessel_id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        $suite = $vessel->suite()->find($suite_id);

        if (!$suite) {
            return $this->respondNotFound();
        }

        return $this->respondSuccess($this->transform($suite, new SuiteTransformer(), 'suite'));
    }

    public function store($vessel_id, SuiteStoreRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $suite = $vessel->suite()->create($request->all());

        return $this->respondSuccess($this->transform($suite, new SuiteTransformer(), 'suite'));
    }

    public function update($vessel_id, $suite_id, SuiteUpdateRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $suite = $vessel->suite()->find($suite_id);

        if(!$suite) {
            return $this->respondNotFound();
        }

        $suite->update($request->all());

        return $this->respondSuccess($this->transform($suite, new SuiteTransformer(), 'suite'));
    }

    public function destroy($vessel_id, $suite_id)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $suite = $vessel->suite()->find($suite_id);

        if (!$suite) {
            return $this->respondNotFound();
        }

        $suite->delete();

        return $this->respondSuccess();
    }
}