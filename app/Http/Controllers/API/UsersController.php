<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Notifications\follower;
use App\Notifications\unfollower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->where('id', '!=', auth('api')->id())
            ->with(['followings', 'followers'])->withCount(['followings', 'followers'])->orderBy('created_at', 'desc')->get();
        $roles = Roles::all();

        return response()->json(['users' => $users, 'roles' => $roles]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function followUser(Request $request, $id)
    {
        $follower = auth('api')->user();
        $following = User::findOrFail($id);
        $follow = $follower->isFollowing($following);
        if ($follow) {
            return response()->json(['message' => 'You already Follow this user'], 409);
        } else {
            $follower->follow($following);
            $following->notify(new follower($follower));
            return response()->json(['success'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function unfollowUser($id)
    {
        $follower = auth('api')->user();
        $unfollow = User::findOrFail($id);

        $unfollowed = $follower->isFollowing($unfollow);
        if ($unfollowed) {
            $follower->unfollow($unfollow);
            $unfollow->notify(new unfollower($follower));
            return response()->json(['success'], 200);
        } else {
            return response()->json(['error' => 'You don\'t follow this user'], 409);
        }
    }

    //    Profile Function
    public function profile()
    {
        $user_id = auth('api')->id();

        $user = User::with('roles', 'followings', 'followers')->withCount(['followings', 'followers'])->findOrFail($user_id);

        return $user;
    }

    // Update Profile info
    public function updateProfileInfo(Request $request)
    {
        $user = auth('api')->user();

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
        if ($request->password != '') {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());

        return response()->json(['message' => 'Updated Successfully'], 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function followedUser($id)
    {
        $follower = auth('api')->user();
        $following = User::findOrFail($id);
        $follow = $follower->isFollowing($following);
        return response()->json(['following' => $follow]);
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

        return response()->json(['success' => 'Updated successfully'], 200);
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
        return response()->json(['message' => 'successful'], 200);
    }
}
