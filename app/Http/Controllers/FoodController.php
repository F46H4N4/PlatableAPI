<?php

namespace App\Http\Controllers;
use App\Models\FoodItem;
use App\Models\Donor;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FoodController extends Controller
{
//  protected $table=food_items;
    public function index()
    {
        $donors=Donor::all();
        $recipients=Recipient::all();
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'       => 'required',
            'description'      => 'required',
            'expiryDate' => 'required',
            'quantity' => 'required',
            'donorId' => 'required|exists:donors,id',
            'recipientId' => 'required|exists:recipients,id',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } 
        else {
            // if (!$food) {
        $food = FoodItem::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'expiryDate' => $request->input('expiryDate'),
            'quantity' => $request->input('quantity'),
             ]);
   
    $food->donor()->associate($request->input('donorId'));
    $food->recipient()->associate($request->input('recipientId'));
    $food->save();
    return response()->json(['message' => 'Food item created successfully',
     'data' => $food], 201);
    }
       
    }

    
    public function show(string $id)
    {
        $food = FoodItem::find($id);
        if (!$food) {
            return response()->json(['message' => 'Food not found.'], 404);
        }
        return response()->json(['data' => $food], 200);
    
    }
    public function getDonatedFoodsByDonor($donor_id)
    {
        try {
            $donatedFoods = FoodItem::where('donorId', $donor_id)->get();

            return response()->json(['data' => $donatedFoods], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to retrieve donated foods'], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'expiryDate' => 'required',
            'quantity' =>'required',
            'donorId' => 'required|exists:donors,id',
            'recipientId' => 'required|exists:recipients,id'
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try {
                $food = FoodItem::findOrFail($id);
                
                $food->update([
                    'donorId' => $request->input('donorId'),
                    'recipientId' => $request->input('recipientId'),
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'expiryDate' => $request->input('expiryDate'),
                    'quantity' => $request->input('quantity')
                ]);
    
                return response()->json(['message' => 'Food updated successfully', 'data' => $food], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json(['message' => 'Food does not exist'], 404);
            } catch (\Exception $exception) {
                return response()->json(['message' => 'An error occurred while updating the food item'], 500);
            }
        }
    }

    public function destroy(string $id)
    {
        try {
            $food = FoodItem::findOrFail($id);
            $food->delete();

            return response()->json(['message' => 'Food deleted successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to delete the food item'], 500);
        }
    
    }
}
