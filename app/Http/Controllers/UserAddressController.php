<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index()
    {
        return response()->json(
            Auth::user()->addresses
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'detail_address' => 'required',
            'full_address' => 'required',
        ]);

        $data['user_id'] = Auth::id();

        $address = UserAddress::create($data);

        return response()->json($address);
    }

    public function update(Request $request, $id)
    {
        $address = UserAddress::where('user_id', Auth::id())
            ->findOrFail($id);

        $address->update($request->all());

        return response()->json($address);
    }

    public function destroy($id)
    {
        $address = UserAddress::where('user_id', Auth::id())
            ->findOrFail($id);

        $address->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
