<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DailySensorData;
use App\Models\SensorDatas;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    // public function storeSensorData(Request $request)
    // {
    //     try {
    //         // Validate the request
    //         $validatedData = $request->validate([
    //             'cycle_id' => 'required',
    //             'ph_level' => 'required',
    //             'dissolved_oxygen' => 'required',
    //             'alkalinity_level' => 'required',
    //             'water_temperature' => 'required',
    //             'reading_date' => 'required|date',
    //         ]);
    
    //         // Create reading
    //         $reading = SensorDatas::create($validatedData);
    
    //         // Return success response
    //         return response()->json([
    //             'message' => 'Reading created successfully',
    //             'data' => $reading
    //         ], 201);
            
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'An error occurred',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function storeDailySensorData(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cycle_id' => 'required|exists:cycles,id',

                'temperature' => 'required|numeric',
                'humidity' => 'required|numeric',

                'soil_moisture' => 'required|numeric',
                'soil_moisture2' => 'required|numeric',

                'water_level' => 'required|numeric',

                'ec_level' => 'required|numeric',
                'ph_level' => 'required|numeric',

                'nitrogen' => 'nullable|numeric',
                'phosphorus' => 'nullable|numeric',
                'potassium' => 'nullable|numeric',

                'nitrogen2' => 'nullable|numeric',
                'phosphorus2' => 'nullable|numeric',
                'potassium2' => 'nullable|numeric',

                'reading_date' => 'required|date',
            ]);

            $reading = DailySensorData::create($validatedData);

            return response()->json([
                'message' => 'Daily sensor reading created successfully',
                'data' => $reading,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
