<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index() {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index',compact('vehicles'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'brand'=>'required|string|max:255',
            'model'=>'required|string|max:255',
            'plate'=>'required|string|max:255',
            'year'=>'required|integer',
            'price'=>'required|integer',
            'loan_price'=>'required|integer',
            'image'=>'required|image',
            'status'=>'required|integer',
        ]);

        if($request->hasFile('image')){
            $path = $request->file('image')->store('vehicles','public');
            $data['image'] = $path;
        }

        Vehicle::create($data);
        return back()->with('success','Véhicule ajouté');
    }

    public function update(Request $request, Vehicle $vehicle) {
        $data = $request->validate([
            'brand'=>'required|string|max:255',
            'model'=>'required|string|max:255',
            'plate'=>'required|string|max:255',
            'year'=>'required|integer',
            'price'=>'required|integer',
            'loan_price'=>'required|integer',
            'image'=>'nullable|image',
            'status'=>'required|integer',
        ]);

        if($request->hasFile('image')){
            if($vehicle->image){
                Storage::disk('public')->delete($vehicle->image);
            }
            $path = $request->file('image')->store('vehicles','public');
            $data['image'] = $path;
        }

        $vehicle->update($data);
        return back()->with('success','Véhicule modifié');
    }

    public function destroy(Vehicle $vehicle) {
        if($vehicle->image){
            Storage::disk('public')->delete($vehicle->image);
        }
        $vehicle->delete();
        return back()->with('success','Véhicule supprimé');
    }
}
