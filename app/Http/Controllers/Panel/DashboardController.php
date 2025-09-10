<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;    

class dashboardController extends Controller
{
    public function show()
    {
        $data['usuarios'] = User::where('status', 1)->get();
        return view('panel.dashboard', $data); 
    }

    public function usuariosActivos()
    {
        $usuarios = User::where('status', 1)->get();
        return response()->json($usuarios);
    }

    public function storeUser(Request $request)
    {
        $userId = $request->input('user_edit');
        if ($userId) {
            // Edición
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $userId,
                'documento' => 'required',
                'telefono' => 'required',
            ]);

            $user = User::find($userId);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Usuario no encontrado']);
            }

            $user->update([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'documento' => $validated['documento'],
                'telefono' => $validated['telefono'],
            ]);

            return response()->json(['success' => true, 'edit' => true]);
        } else {
            // Registro nuevo
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'documento' => 'required',
                'telefono' => 'required',
            ]);

            $userData = [
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'documento' => $validated['documento'],
                'telefono' => $validated['telefono'],
                'password' => Hash::make(123456), // Contraseña por defecto
            ];

            User::create($userData);

            return response()->json(['success' => true, 'edit' => false]);
        }
    }

    public function editUser($id){
        $user = User::where('id', $id)->first();
        return response()->json([
            'usuario' => $user,
        ]);
    }

    public function listUsers(){
        $users = User::where('status', 1)->get();
        return ['data' => $users];
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->status = 0;
            $user->save();
        }
        return response()->json([
            'success' => true,
            'usuario' => $user,
        ]);
    }
}