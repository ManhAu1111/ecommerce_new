<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    // Lấy địa chỉ duy nhất của user
    public function index()
    {
        return response()->json(
            UserAddress::where('user_id', Auth::id())->first()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_name'  => ['required', 'string', 'max:255'],
            'receiver_phone' => [
                'required',
                'regex:/^(03|05|07|08|09)[0-9]{8}$/'
            ],
            'province'       => ['required'],
            'district'       => ['required'],
            'ward'           => ['required'],
            'detail'         => ['required', 'max:255'],
            'full_address'   => ['required', 'string'],
        ]);

        $address = UserAddress::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return back()->with('success', 'Address saved');
    }

    // Vì bạn chỉ có 1 address, update riêng gần như không cần
    public function update(Request $request, $id)
    {
        abort(404);
    }

    // Nếu hệ thống chỉ cho 1 address thì destroy cũng không cần
    public function destroy($id)
    {
        abort(404);
    }
}
