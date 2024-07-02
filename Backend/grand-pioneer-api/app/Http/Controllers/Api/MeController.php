<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Transformers\UserTransformer;

class MeController extends BaseApiController
{
    public function index()
    {
        try {
            $user = Auth::user();
            $user = $this->transform($user, UserTransformer::class, 'user');

            return $this->respondSuccess($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return $this->respondInternalServerError($e->getMessage());
        }
    }
}
