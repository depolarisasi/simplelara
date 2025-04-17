<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of cities
     */
    public function index()
    {
        $cities = City::with('province')->get();
        $provinces = Province::all();
        return view('admin.cities.index', compact('cities', 'provinces'));
    }

    /**
     * Store a newly created city
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        try {
            $city = new City();
            $city->name = $validated['name'];
            $city->slug = Str::slug($validated['name']);
            $city->province_id = $validated['province_id'];
            $city->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'City added successfully');
        return redirect('administrator/setting/cities');
    }

    /**
     * Show the form for editing the city
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        $provinces = Province::all();
        return view('admin.cities.edit', compact('city', 'provinces'));
    }

    /**
     * Update the city
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        try {
            $city->name = $validated['name'];
            $city->slug = Str::slug($validated['name']);
            $city->province_id = $validated['province_id'];
            $city->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'City updated successfully');
        return redirect('administrator/setting/cities');
    }

    /**
     * Remove the city
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        
        try {
            $city->delete();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
        ], 200);
    }
} 