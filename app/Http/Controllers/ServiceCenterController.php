<?php

namespace App\Http\Controllers;

use App\Models\ServiceCenter;
use Illuminate\Http\JsonResponse;

class ServiceCenterController extends Controller
{
    public function index(): JsonResponse
    {
        $centers = ServiceCenter::all();
        return response()->json($centers);
    }
}
