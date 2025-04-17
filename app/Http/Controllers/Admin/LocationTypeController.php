<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocationTypeController extends Controller
{
    /**
     * Display a listing of the location types
     */
    public function index()
    {
        $locationTypes = LocationType::all();
        return view('admin.location-types.index', compact('locationTypes'));
    }

    /**
     * Store a newly created location type
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $locationType = new LocationType();
            $locationType->name = $validated['name'];
            $locationType->slug = Str::slug($validated['name']);
            
            // Handle icon upload
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('location-types/icons', 's3');
                $locationType->icon = $iconPath;
            }
            
            $locationType->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Location type added successfully');
        return redirect('administrator/location/type');
    }

    /**
     * Show the form for editing the location type
     */
    public function edit($id)
    {
        $locationType = LocationType::findOrFail($id);
        return view('admin.location-types.edit', compact('locationType'));
    }

    /**
     * Update the location type
     */
    public function update(Request $request, $id)
    {
        $locationType = LocationType::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $locationType->name = $validated['name'];
            $locationType->slug = Str::slug($validated['name']);
            
            // Handle icon upload
            if ($request->hasFile('icon')) {
                // Delete old icon if exists
                if ($locationType->icon) {
                    Storage::disk('s3')->delete($locationType->icon);
                }
                
                $iconPath = $request->file('icon')->store('location-types/icons', 's3');
                $locationType->icon = $iconPath;
            }
            
            $locationType->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Location type updated successfully');
        return redirect('administrator/location/type');
    }

    /**
     * Remove the location type
     */
    public function destroy($id)
    {
        $locationType = LocationType::findOrFail($id);
        
        try {
            // Delete associated files if they exist
            if ($locationType->icon) {
                Storage::disk('s3')->delete($locationType->icon);
            }
            
            $locationType->delete();
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