<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 
use Illuminate\Validation\Rule;

class RoleController extends Controller
{ 
    public function index(){
        $roles = Role::with('permissions')->get();
        $permission_list = Permission::all();
        return view('admin.roles.index', compact('roles','permission_list')); 
    } 
     
    // Store - Save new role
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
        ]);

        if($validated){
            try { 
                $role = Role::create(['name' => $validated['name']]);
                $role->syncPermissions($validated['permissions'] ?? []);
    
            } catch (\Exception $e) {
                alert()->error('Error', $e->getMessage());
                return redirect()->back();
            }
            
        alert()->success('Success','Added Successfully');
        return redirect('administrator/role');
        } else {
            alert()->error('Error', 'Validation failed');
                return redirect()->back();
        }
        

    }

    // Edit - Show edit form
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::all();
        
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions','rolePermissions'));
    }

    // Update - Update role
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        try {  
            $role->update(['name' => $validated['name']]);
            $role->syncPermissions($validated['permissions'] ?? []);
        } catch (\Exception $e) {
            alert()->error('Error','Update Successfully');
            return redirect()->back();
        }
 
        alert()->success('Success','Update Successfully');
        return redirect('administrator/role');
    }

    // Delete role
    public function destroy($id)
    {
        $role = Role::find($id);
        try { 
            $role->delete(); 
        } catch (\Exception $e) {
           return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.'
                // 'errors' => $validator->errors() // Jika ingin mengirim detail error validasi
            ], 500); // Status 500 Internal Server Error atau 422 Unprocessable Entity jika validasi gagal di sini
        }
        
        return response()->json([
            'success' => true, // Flag penanda sukses (umum digunakan)
            'message' => 'Data berhasil dihapus.', 
        ], 200); // 200 OK adalah status default, bisa juga 201 Created jika membuat resource baru
    }
}
