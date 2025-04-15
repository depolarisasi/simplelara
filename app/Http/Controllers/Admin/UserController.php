<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB; 
use App\Traits\HandlesImageUploads; // Import trait 
use Exception;

class UserController extends Controller
{ 
    use HandlesImageUploads; // Gunakan trait
    protected $imageFieldName = 'avatar_url'; // Sesuaikan dengan nama input di form Anda
    protected $imageDirectory = 'user_avatar'; // Folder tujuan di bucket S3 Anda
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::get();
        $roles = Role::all(); 
        return view('admin.users.index', compact('users', 'roles'));
    }
 

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate(array_merge([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 
            'password' => ['required', Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'], 
            'role' => ['nullable', 'string'],
        ], $this->imageValidationRules()));

        $imagePath = null;
        $roleName = Role::where('id', $request->role)->first()->name;
        
        if ($request->hasFile($this->imageFieldName)) {
            try {
                // Upload gambar baru ke S3 (folder 'user_avatar', visibilitas public)
                $imagePath = $this->processAndStoreImage(
                    $request->file($this->imageFieldName),
                    $this->imageDirectory, // Gunakan direktori dari properti
                    'public' // Atau 'private' jika perlu
                );
            } catch (Exception $e) {
                // Tangani error upload jika perlu
                alert()->error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
                return redirect('administrator/user');
            }
        }
        DB::beginTransaction();
        
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $roleName,
                'avatar_url' => $imagePath,
            ]);
            
            $user->syncRoles($request->roles);
            
            DB::commit();
             
            alert()->success('Success','Added Successfully');
            return redirect('administrator/user');
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect('administrator/user');
        }
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load('roles', 'permissions');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate(array_merge([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id], 
            'password' => ['nullable', Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'string'], 
        ], $this->imageValidationRules()));

        DB::beginTransaction();
        $roleName = Role::where('id', $request->role)->first()->name;
        
        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'role' => $roleName,
            ];
            
            // Jika ada upload gambar avatar baru
            if ($request->hasFile($this->imageFieldName)) {
                try {
                    // Hapus gambar lama jika ada
                    if ($user->avatar_url) {
                        $this->deleteOldImage($user->avatar_url);
                    }
                    
                    // Upload gambar baru
                    $imagePath = $this->processAndStoreImage(
                        $request->file($this->imageFieldName),
                        $this->imageDirectory,
                        'public'
                    );
                    
                    $userData['avatar_url'] = $imagePath;
                } catch (Exception $e) {
                    DB::rollBack();
                    alert()->error('Error', 'Error saat upload gambar: ' . $e->getMessage());
                    return back()->withInput();
                }
            } 
            // Jika ada request untuk menghapus gambar
            elseif ($request->has('avatar_url_remove') && $request->avatar_url_remove == '1') {
                // Hapus gambar dari storage
                if ($user->avatar_url) {
                    $this->deleteOldImage($user->avatar_url);
                }
                $userData['avatar_url'] = null;
            }
            
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            
            $user->update($userData);
            $user->syncRoles($request->roles);
            
            DB::commit();
            
            alert()->success('Success', 'Pengguna berhasil diperbarui!');
            return redirect()->route('administrator.user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->roles()->detach();
            $user->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
