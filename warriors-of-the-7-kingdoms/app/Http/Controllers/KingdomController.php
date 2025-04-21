<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kingdom;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KingdomController extends Controller
{
    /**
     * Get list of kingdoms
     */
    public function index(): JsonResponse
    {
        $kingdoms = Kingdom::all();
        
        return response()->json([
            'success' => true,
            'data' => $kingdoms
        ]);
    }
    
    /**
     * Get a specific kingdom
     */
    public function show($id): JsonResponse
    {
        $kingdom = Kingdom::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $kingdom
        ]);
    }
    
    /**
     * Create a new kingdom
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ruler' => 'required|string|max:255',
            'capital' => 'required|string|max:255',
        ]);
        
        $kingdom = Kingdom::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Kingdom created successfully',
            'data' => $kingdom
        ], 201);
    }
    
    // Update and delete methods would follow a similar pattern
}