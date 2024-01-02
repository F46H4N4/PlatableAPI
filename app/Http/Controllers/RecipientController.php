<?php

namespace App\Http\Controllers;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RecipientController extends Controller
{
   
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'contact_info' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $recipient = Recipient::create([
                'name' => $request->input('name'),
                'contact_info' => $request->input('contact_info')
            ]);
        
            return response()->json(['message' => 'Recipient created successfully', 'recipient' => $recipient], 201);
        }  
    }

   
    public function show(string $id)
    {
        $recipient = Recipient::find($id);
        if (!$recipient) {
            return response()->json(['message' => 'Recipient not found.'], 404);
        }
        return response()->json(['data' => $recipient], 200);
    
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required',
            'contact_info' => 'required'
           
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try {
                $recipient = Recipient::findOrFail($id);
                
                $recipient->update([
                    'name' => $request->input('name'),
                    'contact_info' => $request->input('contact_info')
                ]);
    
                return response()->json(['message' => 'Recipient updated successfully', 'data' => $food], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json(['message' => 'Recipient does not exist'], 404);
            } catch (\Exception $exception) {
                return response()->json(['message' => 'An error occurred while updating the Recipient'], 500);
            }
        }
   
    }

    public function destroy(string $id)
    {
        try {
            $recipient = Recipient::findOrFail($id);
            $recipient->delete();

            return response()->json(['message' => 'Recipient deleted successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to delete the Recipient'], 500);
        }
    }
}
