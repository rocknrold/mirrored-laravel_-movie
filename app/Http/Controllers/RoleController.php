<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RoleController extends Controller
{
    protected $rules = [
        'name' => 'required|min:3|max:50'
    ];

    protected $messages = [
        'name.required' => 'Fill out name'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::orderBy('updated_at','DESC')->paginate(10);
        return view("role.index", compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,$this->rules,$this->messages);

        if ($validator->passes()) {
            $role = new Role(request(['name']));
            $role->save();
            return redirect('role')->with('success', 'Role Added Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function show(Role $role)
    {
        return view('role.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->all();

        $validator = Validator::make($data,$this->rules,$this->messages);

        if ($validator->passes()) {
            $role->update($data);
            return redirect('role')->with('success', 'Role Updated Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', 'role Deleted');
    }
}
