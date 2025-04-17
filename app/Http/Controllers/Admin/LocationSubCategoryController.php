<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationCategory;
use App\Models\LocationSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocationSubCategoryController extends Controller
{
    /**
     * Display a listing of location subcategories
     */
    public function index()
    {
        $subcategories = LocationSubCategory::with('category')->get();
        $categories = LocationCategory::all();
        return view('admin.location-subcategories.index', compact('subcategories', 'categories'));
    }

    /**
     * Store a newly created location subcategory
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:location_categories,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $subcategory = new LocationSubCategory();
            $subcategory->name = $validated['name'];
            $subcategory->slug = Str::slug($validated['name']);
            $subcategory->category_id = $validated['category_id'];
            
            // Handle icon upload
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('location-subcategories/icons', 's3');
                $subcategory->icon = $iconPath;
            }
            
            $subcategory->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Location subcategory added successfully');
        return redirect('administrator/location/sub-category');
    }

    /**
     * Show the form for editing the location subcategory
     */
    public function edit($id)
    {
        $subcategory = LocationSubCategory::findOrFail($id);
        $categories = LocationCategory::all();
        return view('admin.location-subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the location subcategory
     */
    public function update(Request $request, $id)
    {
        $subcategory = LocationSubCategory::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:location_categories,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $subcategory->name = $validated['name'];
            $subcategory->slug = Str::slug($validated['name']);
            $subcategory->category_id = $validated['category_id'];
            
            // Handle icon upload
            if ($request->hasFile('icon')) {
                // Delete old icon if exists
                if ($subcategory->icon) {
                    Storage::disk('s3')->delete($subcategory->icon);
                }
                
                $iconPath = $request->file('icon')->store('location-subcategories/icons', 's3');
                $subcategory->icon = $iconPath;
            }
            
            $subcategory->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Location subcategory updated successfully');
        return redirect('administrator/location/sub-category');
    }

    /**
     * Remove the location subcategory
     */
    public function destroy($id)
    {
        $subcategory = LocationSubCategory::findOrFail($id);
        
        try {
            // Delete associated files if they exist
            if ($subcategory->icon) {
                Storage::disk('s3')->delete($subcategory->icon);
            }
            
            $subcategory->delete();
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