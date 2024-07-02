<?php

namespace Modules\SuiteMetadata\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\SuiteMetadata\Http\Requests\SuiteMetadataStoreRequest;
use Modules\SuiteMetadata\Http\Requests\SuiteMetadataUpdateRequest;
use Modules\Suite\Entities\Suite;
use Modules\SuiteMetadata\Transformers\SuiteMetadataTransformer;

class SuiteMetadataController extends BaseApiController
{
    public function index($suite_id, Request $request)
    {
        $suite = Suite::query()->find($suite_id);

        if(!$suite) {
            return $this->respondNotFound();
        }

        $suite_metadata = $suite->suiteMetadata;

        if (!$suite_metadata) {
            return $this->respondNotFound();
        }

        return $this->respondSuccess($this->transform($suite_metadata, new SuiteMetadataTransformer(), 'suite_metadata'));
    }

    public function store($suite_id, SuiteMetadataStoreRequest $request)
    {
        $suite = Suite::query()->find($suite_id);

        if (!$suite) {
            return $this->respondNotFound();
        }

        $suite_metadata = $suite->suiteMetadata()->create($request->all());

        return $this->respondSuccess($this->transform($suite_metadata, new SuiteMetadataTransformer(), 'suite_metadata'));
    }

    public function update($suite_id, $suite_metadata_id, SuiteMetadataUpdateRequest $request)
    {
        $suite = Suite::query()->find($suite_id);

        if (!$suite) {
            return $this->respondNotFound();
        }

        $suite_metadata = $suite->suiteMetadata()->find($suite_metadata_id);

        if(!$suite_metadata) {
            return $this->respondNotFound();
        }

        $suite_metadata->update($request->all());

        return $this->respondSuccess($this->transform($suite_metadata, new SuiteMetadataTransformer(), 'suite_metadata'));
    }

    public function destroy($suite_id, $suite_metadata_id)
    {
        $suite = Suite::query()->find($suite_id);

        if (!$suite) {
            return $this->respondNotFound();
        }

        $suite_metadata = $suite->suiteMetadata()->find($suite_metadata_id);

        if (!$suite_metadata) {
            return $this->respondNotFound();
        }

        $suite_metadata->delete();

        return $this->respondSuccess();
    }
}