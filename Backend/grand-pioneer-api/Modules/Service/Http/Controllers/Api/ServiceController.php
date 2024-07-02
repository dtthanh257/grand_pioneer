<?php

namespace Modules\Service\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Service\Transformers\ServiceTransformer;
use Modules\Service\Http\Requests\ServiceStoreRequest;
use Modules\Service\Http\Requests\ServiceUpdateRequest;
use Modules\Vessel\Entities\Vessel;

class ServiceController extends BaseApiController
{
    public function index($vessel_id, Request $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if(!$vessel) {
            return $this->respondNotFound();
        }

        $service = $vessel->service;

        if (!$service) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($service, new ServiceTransformer(), 'services'));
    }

    public function show($vessel_id, $service_id) {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $service = $vessel->service()->find($service_id);

        if(!$service) {
            return $this->respondNotFound();
        }

        return $this->respondSuccess($this->transform($service, new ServiceTransformer(), 'service'));
    }

    public function store($vessel_id, ServiceStoreRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $service = $vessel->service()->create($request->all());

        return $this->respondSuccess($this->transform($service, new ServiceTransformer(), 'service'));
    }

    public function update($vessel_id, $service_id, ServiceUpdateRequest $request)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $service = $vessel->service()->find($service_id);

        if(!$service) {
            return $this->respondNotFound();
        }

        $service->update($request->all());

        return $this->respondSuccess($this->transform($service, new ServiceTransformer(), 'service'));
    }

    public function destroy($vessel_id, $service_id)
    {
        $vessel = Vessel::query()->find($vessel_id);

        if (!$vessel) {
            return $this->respondNotFound();
        }

        $service = $vessel->service()->find($service_id);

        if (!$service) {
            return $this->respondNotFound();
        }

        $service->delete();

        return $this->respondSuccess();
    }
}