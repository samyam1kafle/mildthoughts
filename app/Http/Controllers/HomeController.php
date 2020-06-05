<?php

namespace App\Http\Controllers;

use App\Models\Thoughts;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function backend()
    {
        return view('backend/master');
    }

    public function profileInfo($id)
    {
        $userLogged = auth()->user();
        $data = User::with('thoughts', 'roles', 'followers', 'followings')->withCount(['followers', 'followings'])->find($id);
        $followingOrNot = $userLogged->isFollowing($data);

        $thoughts = $data->thoughts;
        $Thought_in_order = [];
        if (count($thoughts) > 0) {
            foreach ($thoughts as $thought) {
                $indThought[] = Thoughts::with('user', 'category')->find($thought->id);
            }
            $indThought = collect($indThought);
            $Thought_in_order = $indThought->sortByDesc('created_at');
            $Thought_in_order = $Thought_in_order->values()->all();
        }
        return response()->json(['user_data' => $data, 'thoughts' => $Thought_in_order,'isFollowing'=>$followingOrNot]);
    }

    public function authProfileInfo()
    {
        $user_id = auth()->id();
        $user = User::with('thoughts', 'roles', 'followers', 'followings')->withCount(['followers', 'followings'])->find($user_id);
        $thoughts = $user->thoughts;
        if (count($thoughts) > 0) {
            foreach ($thoughts as $thought) {
                $indThought[] = Thoughts::with('user', 'category')->find($thought->id);
            }
            $thoughts = collect($indThought);
            $thoughts_sorted = $thoughts->sortByDesc('created_at');
            $thoughts = $thoughts_sorted->values()->all();
        }

        return response()->json(['user_data' => $user, 'thoughts' => $thoughts], 200);
    }
}
