<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocationCategoryController extends Controller
{
    /**
     * Display a listing of location categories
     */
    public function index()
    {
        $categories = LocationCategory::all();
        return view('admin.location-categories.index', compact('categories'));
    }

    /**
     * Store a newly created location category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $category = new LocationCategory();
            $category->name = $validated['name'];
            $category->slug = Str::slug($validated['name']);
            
            // Handle icon upload
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('location-categories/icons', 's3');
                $category->icon = $iconPath;
            }
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('location-categories/images', 's3');
                $category->image = $imagePath;
            }
            
            $category->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Location category added successfully');
        return redirect('administrator/location/category');
    }

    /**
     * Show the form for editing the location category
     */
    public function edit($id)
    {
        $category = LocationCategory::findOrFail($id);
        return view('admin.location-categories.edit', compact('category'));
    }

    /**
     * Update the location category
     */
    public function update(Request $request, $id)
    {
        $category = LocationCategory::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $category->name = $validated['name'];
            $category->slug = Str::slug($validated['name']);
            
            // Handle icon upload
            if ($request->hasFile('icon')) {
                // Delete old icon if exists
                if ($category->icon) {
                    Storage::disk('s3')->delete($category->icon);
                }
                
                $iconPath = $request->file('icon')->store('location-categories/icons', 's3');
                $category->icon = $iconPath;
            }
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($category->image) {
                    Storage::disk('s3')->delete($category->image);
                }
                
                $imagePath = $request->file('image')->store('location-categories/images', 's3');
                $category->image = $imagePath;
            }
            
            $category->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Location category updated successfully');
        return redirect('administrator/location/category');
    }

    /**
     * Remove the location category
     */
    public function destroy($id)
    {
        $category = LocationCategory::findOrFail($id);
        
        try {
            // Delete associated files if they exist
            if ($category->icon) {
                Storage::disk('s3')->delete($category->icon);
            }
            
            if ($category->image) {
                Storage::disk('s3')->delete($category->image);
            }
            
            $category->delete();
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