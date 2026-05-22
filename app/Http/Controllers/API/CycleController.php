<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cycles;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    public function index()
    {
        return response()->json(Cycles::all());
    }

    public function updatePhase(Request $request, $id)
    {
        $cycle = Cycles::findOrFail($id);
        $phase = $request->input('phase');

        if (!in_array($phase, ['germination', 'growth phase'])) {
            return response()->json(['error' => 'Invalid phase value'], 422);
        }

        $cycle->phase = $phase;
        $cycle->save();

        return response()->json([
            'success' => true,
            'id' => $cycle->id,
            'updated_phase' => $cycle->phase,
        ]);
    }

    public function latest()
    {
        $latestCycle = Cycles::latest('created_at')->first();

        if (!$latestCycle) {
            return response()->json([
                'message' => 'No cycles found.'
            ], 404);
        }

        return response()->json($latestCycle);
    }
}
