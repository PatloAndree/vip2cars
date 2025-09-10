<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;    

class VehicleController extends Controller
{

    public function storeVehicle(Request $request){
        
        $vehicleId = $request->input('vehicle_id');
        if ($vehicleId) {
            // Edición
            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'placa' => 'required|string|unique:vehicles,placa,' . $vehicleId,
                'marca' => 'required|string|max:255',
                'modelo' => 'required|string|max:255',
                'añofabricacion' => 'required|date',
                'telefonoOpcional'=> 'required',
            ]);

            $vehicle = Vehicle::find($vehicleId);
            if (!$vehicle) {
                return response()->json(['success' => false, 'message' => 'Vehículo no encontrado']);
            }

            $vehicle->update([
                'user_id'        => $validated['user_id'],
                'placa'          => $validated['placa'],
                'marca'          => $validated['marca'],
                'modelo'         => $validated['modelo'],
                'añofabricacion' => $validated['añofabricacion'],
                'telefono'       => $validated['telefonoOpcional'],
            ]);

            return response()->json(['success' => true, 'edit' => true]);
        } else {
            // Registro nuevo
            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'placa' => 'required|string|unique:vehicles,placa',
                'marca' => 'required|string|max:255',
                'modelo' => 'required|string|max:255',
                'añofabricacion' => 'required|date',
                'telefonoOpcional'=> 'required',
            ]);

            $data = [
                'user_id'        => $validated['user_id'],
                'placa'          => $validated['placa'],
                'marca'          => $validated['marca'],
                'modelo'         => $validated['modelo'],
                'añofabricacion' => $validated['añofabricacion'],
                'telefono'       => $validated['telefonoOpcional'],
            ];

            Vehicle::create($data);

            return response()->json(['success' => true, 'edit' => false]);
    
        }
    }
    
    public function editVehicle($id){
        $vehicle = Vehicle::where('id', $id)->first();
        return response()->json([
            'vehiculo' => $vehicle,
        ]);
    }

    public function listVehicles(){
       $vehicles = Vehicle::with(['usuario'])->where('status', 1)->get();
        return ['data' => $vehicles];
    }

    
    public function deleteVehicle($id){
        $vehicle = Vehicle::where('id', $id)->first();
        if ($vehicle) {
            $vehicle->status = 0;
            $vehicle->save();
        }
        return response()->json([
            'success' => true,
            'vehiculo' => $vehicle,
        ]);
    }


}
