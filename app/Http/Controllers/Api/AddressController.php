<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $addresses = Address::where('user_id', $request->user()->id)->paginate(5);

        return response()->json([
            'status' => 'Success',
            'data' => $addresses
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'full_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'prov_id' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
            'district_id' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'is_default' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->errors()->first()
            ], 400);
        }

        $address = new Address();
        $address->fill($request->all());
        $address->user_id = $request->user()->id;
        $address->save();

        return response()->json([
            'status' => 'Success',
            'data' => $address
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Address not found'
            ], 404);
        }

        return response()->json([
            'status' => 'Success',
            'data' => $address
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Address not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'full_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'prov_id' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
            'district_id' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'is_default' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->errors()->first()
            ], 400);
        }

        $address->fill($request->all());
        $address->save();

        return response()->json([
            'status' => 'Success',
            'data' => $address
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Address not found'
            ], 404);
        }

        $address->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Address deleted successfully'
        ], 200);
    }
}
