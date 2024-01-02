<?php

namespace App\Http\Controllers;
use App\Models\Donor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            $donor = Donor::create([
                'name' => $request->input('name'),
                'contact_info' => $request->input('contact_info')
            ]);
        
            // Assuming you want to return the created donor as a JSON response
            return response()->json(['message' => 'Donor created successfully', 'donor' => $donor], 201);
        }
    }
 
    public function show(string $id)
    {
        $donor = Donor::find($id);
        if (!$donor) {
            return response()->json(['message' => 'Donor not found.'], 404);
        }
        return response()->json(['data' => $donor], 200);
    
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
        } 
        else {
            try {
                $donor = Donor::findOrFail($id);
                
                $donor->update([
                    'name' => $request->input('name'),
                    'contact_info' => $request->input('contact_info')
                ]);
    
                return response()->json(['message' => 'Donor updated successfully', 'data' => $food], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json(['message' => 'Donor does not exist'], 404);
            } catch (\Exception $exception) {
                return response()->json(['message' => 'An error occurred while updating the Donor'], 500);
            }
        }
   
    }
    public function destroy(string $id)
    {
        try {
            $donor = Donor::findOrFail($id);
            $donor->delete();

            return response()->json(['message' => 'Donor deleted successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to delete the Donor'], 500);
        }
    
    
    }
}
