<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function checkRole(Request $request) {
        $name = $request->query('name');  // Busca por query param 'name'
        $user = User::where('name', $name)->first();
        return response()->json(['role' => $user ? $user->role : 'student']);  // Retorna 'admin' ou 'student'
    }
}