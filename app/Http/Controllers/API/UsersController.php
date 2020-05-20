<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->get();
        $roles = Roles::all();

        return response()->json(['users' => $users, 'roles' => $roles]);
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
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'confirmed|required|string|min:6',
            'display_image' => 'required'
        ]);

        if ($request->display_image) {
            $name = time() . '.' . explode('/', mime_content_type($request->display_image))[1];

            Image::make($request->display_image)->resize('400', '400')->save(public_path('Backend/ProfileImages/') . $name);
        }
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'display_image' => $name
        ]);
        $user->save();

        return response()->json(['message' => 200]);
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:6',
        ]);
        $old_img = $user->display_image;

        if ($request->display_image != $old_img) {
            if ($old_img != null) {
                unlink(public_path('Backend/ProfileImages/') . $old_img);
            }
            $name = time() . '.' . explode('/', mime_content_type($request->display_image))[1];

            Image::make($request->display_image)->resize('400', '400')->save(public_path('Backend/ProfileImages/') . $name);
            $request->merge(['display_image' => $name]);
        }

        $user->update($request->all());

        return response()->json(['success' => 'Updated successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $image = $user->display_image;
        if ($image != null) {
            unlink(public_path('Backend/ProfileImages/') . $image);
        }
        $user->delete();
        return response()->json(['message' => 'successful'],200);
    }
}
