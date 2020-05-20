<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

class Rolescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Roles::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|string|max:20|min:3',
            'access' => 'required|string|max:200|min:5'
        ]);

        return Roles::create([
            'role' => $request->role,
            'access' => $request->access
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required|string|max:20|min:3',
            'access' => 'required|string|max:200|min:5'
        ]);

        $role = Roles::findOrFail($id);

        $updated = $role->update([
            'role' => $request->role,
            'access' => $request->access
        ]);

        return response()->json(['success'=>200]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Roles::findOrFail($id);

        $deleted = $role->delete();

        if($deleted){
            return response()->json(['success'=>200]);
        }
    }
}
