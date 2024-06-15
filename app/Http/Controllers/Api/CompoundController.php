<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\OneRepMax\Compound;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompoundResource;

class CompoundController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Compound $compound)
    {
        $compound->load('muscles'); // Eager load the muscles relationship
        return new CompoundResource($compound);
    }
}
