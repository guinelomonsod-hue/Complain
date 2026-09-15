<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Register
     public function register (Request $request) {
        $validator = Validator::make($request->all (), [
            'username' => 'required|unique:accounts',
            'email' => 'required|unique:accounts',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $account = Account::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'account_status' => 'active',
        ]);
        
        $roleName = $account->role->role_name;

        if ($roleName === 'citizen') {
            $account->citizen()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact_number' => $request->contact_number,
                'address' => $request->address,
            ]);
        
        } else {
            $account->staff()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department_id' => $request->department_id,
                'position' => $request->position,

            ]);
        }
        $token = auth('api')->login($account);

        return response()->json([
            'token' => $token,
            'user' => $account->fresh(['role', 'citizen', 'staff']),
        ], 201);
     }

     //Login

     public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $request->only('username', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        return response()->json([
            'token' => $token,
            'user' => auth('api')->user()->load(['role', 'citizen' , 'staff']),
        ]);
     }
     public function me () {
        return response()->json(
            auth('api')->user()->load(['role', 'citizen' , 'staff'])
        );
     }
    public function logout(){
        auth('api')->logout();

        return response()->json(['message'=> 'Logout ka sakinn']);
    }
    public function refresh () {
        return response()->json([
            'token' => auth('api')->refresh(),
        ]);
    }
}
