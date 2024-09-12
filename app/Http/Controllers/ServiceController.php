<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Services::all();
        return response()->json($services);
    }
}
