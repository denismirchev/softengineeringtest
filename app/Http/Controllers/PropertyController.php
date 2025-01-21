<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function createProperty(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'agent_id' => 'required|exists:agents,id',
        ]);

        $property = new Property;
        $property->address = $request->address;
        $property->price = $request->price;
        $property->agent_id = $request->agent_id;
        $property->save();

        return redirect()->route('getProperties');
    }

    public function getProperties()
    {
        return view('properties', ['properties' => Property::with('agent')->get(), 'agents' => Agent::all()]);
    }

    public function updateProperty(Request $request, $id)
    {
        $property = Property::find($id);

        if ($property) {
            $request->validate([
                'address' => 'required|string|max:255',
                'price' => 'required|numeric',
                'agent_id' => 'required|exists:agents,id',
            ]);

            $property->address = $request->address;
            $property->price = $request->price;
            $property->agent_id = $request->agent_id;
            $property->save();

            return redirect()->route('getProperties');
        } else {
            return response()->json([
                'message' => 'Property not found'
            ], 404);
        }
    }

    public function deleteProperty($id)
    {
        $property = Property::find($id);

        if ($property) {
            $property->delete();

            return redirect()->route('getProperties');
        } else {
            return response()->json([
                'message' => 'Property not found'
            ], 404);
        }
    }
}
