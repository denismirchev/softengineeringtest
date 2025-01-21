<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function createInquiry(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $inquiry = new Inquiry;
        $inquiry->property_id = $request->property_id;
        $inquiry->user_id = $request->user_id;
        $inquiry->message = $request->message;
        $inquiry->save();

        return redirect()->route('getInquiries');
    }

    public function getInquiries()
    {
        return view('inquiries', [
            'inquiries' => Inquiry::with('property', 'user')->get(),
            'properties' => Property::all(),
            'users' => User::all()
        ]);
    }

    public function updateInquiry(Request $request, $id)
    {
        $inquiry = Inquiry::find($id);

        if ($inquiry) {
            $request->validate([
                'property_id' => 'required|exists:properties,id',
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string',
            ]);

            $inquiry->property_id = $request->property_id;
            $inquiry->user_id = $request->user_id;
            $inquiry->message = $request->message;
            $inquiry->save();

            return redirect()->route('getInquiries');
        } else {
            return response()->json([
                'message' => 'Inquiry not found'
            ], 404);
        }
    }

    public function deleteInquiry($id)
    {
        $inquiry = Inquiry::find($id);

        if ($inquiry) {
            $inquiry->delete();
            return redirect()->route('getInquiries');
        } else {
            return response()->json([
                'message' => 'Inquiry not found'
            ], 404);
        }
    }
}
