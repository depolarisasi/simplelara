<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PremiumPlanController extends Controller
{
    /**
     * Display a listing of premium plans
     */
    public function index()
    {
        $premiumPlans = PremiumPlan::all();
        return view('admin.premium-plans.index', compact('premiumPlans'));
    }

    /**
     * Store a newly created premium plan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:premium_plans,name',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $premiumPlan = new PremiumPlan();
            $premiumPlan->name = $validated['name'];
            $premiumPlan->price = $validated['price'];
            $premiumPlan->duration_days = $validated['duration_days'];
            
            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('premium-plans/thumbnails', 's3');
                $premiumPlan->thumbnail = $thumbnailPath;
            }
            
            $premiumPlan->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Premium plan added successfully');
        return redirect('administrator/premium/plans');
    }

    /**
     * Show the form for editing the premium plan
     */
    public function edit($id)
    {
        $premiumPlan = PremiumPlan::findOrFail($id);
        return view('admin.premium-plans.edit', compact('premiumPlan'));
    }

    /**
     * Update the premium plan
     */
    public function update(Request $request, $id)
    {
        $premiumPlan = PremiumPlan::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:premium_plans,name,' . $premiumPlan->id,
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $premiumPlan->name = $validated['name'];
            $premiumPlan->price = $validated['price'];
            $premiumPlan->duration_days = $validated['duration_days'];
            
            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail if exists
                if ($premiumPlan->thumbnail) {
                    Storage::disk('s3')->delete($premiumPlan->thumbnail);
                }
                
                $thumbnailPath = $request->file('thumbnail')->store('premium-plans/thumbnails', 's3');
                $premiumPlan->thumbnail = $thumbnailPath;
            }
            
            $premiumPlan->save();
        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success', 'Premium plan updated successfully');
        return redirect('administrator/premium/plans');
    }

    /**
     * Remove the premium plan
     */
    public function destroy($id)
    {
        $premiumPlan = PremiumPlan::findOrFail($id);
        
        try {
            // Delete associated files if they exist
            if ($premiumPlan->thumbnail) {
                Storage::disk('s3')->delete($premiumPlan->thumbnail);
            }
            
            $premiumPlan->delete();
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