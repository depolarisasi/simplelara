<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\LocationType;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    use HandlesImageUploads;
    
    /**
     * Display a listing of locations
     */
    public function index()
    {
        $locations = Location::with(['province', 'city', 'locationType'])->get();
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new location
     */
    public function create()
    {
        $locationTypes = LocationType::all();
        $provinces = Province::all();
        $users = User::all();
        
        return view('admin.locations.create', compact('locationTypes', 'provinces', 'users'));
    }

    /**
     * Store a newly created location
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'owner_id' => 'required|exists:users,id',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'operation_hours' => 'nullable|string',
                'location_type_id' => 'required|exists:location_types,id',
                'province_id' => 'required|exists:provinces,id',
                'city_id' => 'required|exists:cities,id',
                'district' => 'nullable|string|max:255',
                'subdistrict' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:20',
                'website' => 'nullable|url|max:255',
                'instagram' => 'nullable|string|max:255',
                'tiktok' => 'nullable|string|max:255',
                'youtube' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'hotel_star' => 'nullable|integer|min:1|max:5',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            // Debugging
            Log::debug('Validated data:', $validated);
            
            // Handle checkbox fields (convert to boolean)
            $validated['is_viral'] = $request->has('is_viral') ? 1 : 0;
            $validated['is_legend'] = $request->has('is_legend') ? 1 : 0;
            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
            
            // Handle thumbnail upload using trait
            if ($request->hasFile('thumbnail')) {
                $validated['thumbnail_url'] = $this->uploadImage($request->file('thumbnail'), 'locations/thumbnails');
            }
            
            // Create the location
            $location = Location::create($validated);
            
            // Logging
            Log::debug('Location created:', ['id' => $location->id]);
            
            // Update the coordinates for PostgreSQL PostGIS
            if (isset($validated['latitude']) && isset($validated['longitude'])) {
                try {
                    // PostGIS specific: set point using raw SQL query
                    DB::statement("UPDATE locations SET coordinate = ST_SetSRID(ST_MakePoint(?, ?), 4326) WHERE id = ?", [
                        $validated['longitude'],
                        $validated['latitude'],
                        $location->id
                    ]);
                    
                    Log::debug('Coordinates updated for location ' . $location->id);
                } catch (\Exception $e) {
                    Log::error('Error updating coordinates: ' . $e->getMessage());
                    alert()->error('Error', 'Gagal menyimpan koordinat lokasi: ' . $e->getMessage());
                    return redirect()->back()->withInput();
                }
            }
            
            alert()->success('Success', 'Location added successfully');
            return redirect()->route('administrator.location.index');
        } catch (\Exception $e) {
            Log::error('Error creating location: ' . $e->getMessage());
            Log::error($e->getTraceAsString()); // Track stacktrace
            alert()->error('Error', 'Gagal menyimpan data: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the location
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $locationTypes = LocationType::all();
        $provinces = Province::all();
        $cities = City::where('province_id', $location->province_id)->get();
        $users = User::all();
        
        return view('admin.locations.edit', compact('location', 'locationTypes', 'provinces', 'cities', 'users'));
    }

    /**
     * Update the location
     */
    public function update(Request $request, $id)
    {
        try {
            $location = Location::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'owner_id' => 'required|exists:users,id',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'operation_hours' => 'nullable|string',
                'location_type_id' => 'required|exists:location_types,id',
                'province_id' => 'required|exists:provinces,id',
                'city_id' => 'required|exists:cities,id',
                'district' => 'nullable|string|max:255',
                'subdistrict' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:20',
                'website' => 'nullable|url|max:255',
                'instagram' => 'nullable|string|max:255',
                'tiktok' => 'nullable|string|max:255',
                'youtube' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'hotel_star' => 'nullable|integer|min:1|max:5',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            // Debugging
            Log::debug('Update validated data:', $validated);
            
            // Handle checkbox fields (convert to boolean)
            $validated['is_viral'] = $request->has('is_viral') ? 1 : 0;
            $validated['is_legend'] = $request->has('is_legend') ? 1 : 0;
            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
            
            // Handle thumbnail upload using trait
            if ($request->hasFile('thumbnail')) {
                $validated['thumbnail_url'] = $this->uploadImage(
                    $request->file('thumbnail'), 
                    'locations/thumbnails',
                    $location->thumbnail_url
                );
            }
            
            // Update the location
            $location->update($validated);
            
            // Update the coordinates for PostgreSQL PostGIS
            if (isset($validated['latitude']) && isset($validated['longitude'])) {
                try {
                    // PostGIS specific: set point using raw SQL query
                    DB::statement("UPDATE locations SET coordinate = ST_SetSRID(ST_MakePoint(?, ?), 4326) WHERE id = ?", [
                        $validated['longitude'],
                        $validated['latitude'],
                        $location->id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error updating coordinates: ' . $e->getMessage());
                    alert()->error('Error', 'Gagal menyimpan koordinat lokasi: ' . $e->getMessage());
                    return redirect()->back()->withInput();
                }
            }
            
            alert()->success('Success', 'Location updated successfully');
            return redirect()->route('administrator.location.index');
        } catch (\Exception $e) {
            Log::error('Error updating location: ' . $e->getMessage());
            Log::error($e->getTraceAsString()); // Track stacktrace
            alert()->error('Error', 'Gagal memperbarui data: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the location
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        
        try {
            // Delete thumbnail using trait
            $this->deleteImage($location->thumbnail_url);
            
            $location->delete();
        } catch (\Exception $e) {
            Log::error('Error deleting location: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data lokasi berhasil dihapus.',
        ], 200);
    }
    
    /**
     * Get cities based on province
     */
    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();
        return response()->json($cities);
    }

    /**
     * Display all locations on a map
     */
    public function map()
    {
        $locations = Location::with(['locationType', 'province', 'city'])->get();
        return view('admin.locations.map', compact('locations'));
    }
} 