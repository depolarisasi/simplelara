<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProvinceController extends Controller
{
    /**
     * Display a listing of provinces
     */
    public function index()
    {
        $provinces = Province::all();
        return view('admin.provinces.index', compact('provinces'));
    }

    /**
     * Store a newly created province
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $province = new Province();
            $province->name = $validated['name'];
            $province->slug = Str::slug($validated['name']);
            $province->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Province added successfully');
        return redirect('administrator/setting/provinces');
    }

    /**
     * Show the form for editing the province
     */
    public function edit($id)
    {
        $province = Province::findOrFail($id);
        return view('admin.provinces.edit', compact('province'));
    }

    /**
     * Update the province
     */
    public function update(Request $request, $id)
    {
        $province = Province::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $province->name = $validated['name'];
            $province->slug = Str::slug($validated['name']);
            $province->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Province updated successfully');
        return redirect('administrator/setting/provinces');
    }

    /**
     * Remove the province
     */
    public function destroy($id)
    {
        $province = Province::findOrFail($id);
        
        try {
            $province->delete();
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