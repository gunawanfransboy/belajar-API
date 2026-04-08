<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return \App\Helpers\ResponseHelper::success(Role::select('id', 'name')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles'
        ]);

        $role = Role::create(['name' => $request->name]);

        return \App\Helpers\ResponseHelper::success($role, 'Role created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::select('id', 'name')->findOrFail($id);

        return \App\Helpers\ResponseHelper::success($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id
        ]);

        $role->update(['name' => $request->name]);

        return \App\Helpers\ResponseHelper::success($role, 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return \App\Helpers\ResponseHelper::success(null, 'Role deleted successfully');
    }
}
