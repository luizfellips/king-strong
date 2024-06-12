<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompoundResource;
use App\Models\Compound;
use Illuminate\Http\Request;

class CompoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Compound $compound)
    {
        $compound->load('muscles'); // Eager load the muscles relationship
        return new CompoundResource($compound);
    }
}
