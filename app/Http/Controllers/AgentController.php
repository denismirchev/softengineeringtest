<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function createAgent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents,email',
        ]);

        $agent = new Agent;
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->save();

        return redirect()->route('getAgents');
    }

    public function getAgents()
    {
        return view('agents', ['agents' => Agent::all()]);
    }

    public function updateAgent(Request $request, $id)
    {
        $agent = Agent::find($id);

        if ($agent) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:agents,email,' . $id,
            ]);

            $agent->name = $request->name;
            $agent->email = $request->email;
            $agent->save();

            return redirect()->route('getAgents');
        } else {
            return response()->json([
                'message' => 'Agent not found'
            ], 404);
        }
    }

    public function deleteAgent($id)
    {
        $agent = Agent::find($id);

        if ($agent) {
            $agent->delete();

            return redirect()->route('getAgents');
        } else {
            return response()->json([
                'message' => 'Agent not found'
            ], 404);
        }
    }
}
