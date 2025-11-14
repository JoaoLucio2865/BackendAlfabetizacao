<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function login(Request $request) {
        $name = $request->input('name');
        $user = User::where('name', $name)->first();
    
        if (!$user) {
            $user = User::firstOrCreate(['name' => $name], ['role' => 'student']);
        }
    
        if ($user->role === 'admin' && !$request->has('password')) {
            return response()->json(['error' => 'Senha necessária para admin'], 401);
        }
        if ($user->role === 'admin' && !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
    
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken
        ]);
    }
}