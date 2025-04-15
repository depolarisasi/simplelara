<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role; 
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{ 
    public function index(){ 
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions')); 
    } 
     
    // Store - Save new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name'
        ]);

        try { 
            $permission = Permission::create(['name' => $request->name]); 

        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success','Added Successfully');
        return redirect('administrator/permission');
    }

    // Edit - Show edit form
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    // Update - Update role
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id
        ]);
    
        try { 
            $permission->update(['name' => $request->name]);

        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return redirect()->back();
        }

        alert()->success('Success','Updated Successfully');
        return redirect('administrator/permission');
    }

    // Delete role
    public function destroy($id)
    {
        $permission = Permission::find($id);
          
        try { 
            $permission->delete(); 
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
