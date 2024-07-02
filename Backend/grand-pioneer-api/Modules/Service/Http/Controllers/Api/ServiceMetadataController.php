<?php

namespace Modules\Service\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Service\Http\Requests\ServiceMetadataStoreRequest;
use Modules\Service\Entities\Service;
use Modules\Service\Transformers\ServiceMetadataTransformer;

class ServiceMetadataController extends BaseApiController
{

    public function index($service_id, Request $request)
    {
        $service = Service::query()->find($service_id);

        if(!$service) {
            return $this->respondNotFound();
        }

        $service_metadata = $service->serviceMetadata;

        if (!$service_metadata) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($service_metadata, new ServiceMetadataTransformer(), 'service_metadatas'));
    }

    public function store($service_id, ServiceMetadataStoreRequest $request)
    {
        $service = Service::query()->find($service_id);

        if (!$service) {
            return $this->respondNotFound();
        }

        $service_metadata = $service->serviceMetadata()->create($request->all());

        return $this->respondSuccess($this->transform($service_metadata, new ServiceMetadataTransformer(), 'service_metadata'));
    }

    public function update($service_id, $service_metadata_id, ServiceMetadataUpdateRequest $request) {
        $service = Service::query()->find($service_id);

        if (!$service) {
            return $this->respondNotFound();
        }

        $service_metadata = $service->serviceMetadata->find($service_metadata_id);

        if (!$service_metadata) {
            return $this->respondNotFound();
        }

        $service_metadata->update($request->all());

        return $this->respondSuccess($this->transform($service_metadata, new ServiceMetadataTransformer(), 'service_metadata'));
    }

    public function destroy($service_id, $service_metadata_id)
    {
        $service = Service::query()->find($service_id);

        if (!$service) {
            return $this->respondNotFound();
        }

        $service_metadata = $service->serviceMetadata->find($service_metadata_id);

        if (!$service_metadata) {
            return $this->respondNotFound();
        }

        $service_metadata->delete();

        return $this->respondSuccess();
    }
}