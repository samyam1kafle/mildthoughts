<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Thoughts;
use App\User;
use Illuminate\Http\Request;

class ThoughtsController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function user(Request $request)
    {
        $logged = auth()->check();
        if ($logged) {
            $userdetail = auth()->user();
            $followings = auth()->user()->followings;
            $user = auth()->user();

            /*Author you may know*/

            $author = Roles::where('role', '=', 'Author')->first()->users;

            $writters = $author->where('id', '!=', auth()->id());
            if (count($followings) > 0) {
                foreach ($writters as $author) {
                    if(!$user->isFollowing($author)){
                        $arr[] = $author;
                    }
                }

            }
            $arr = array_slice($arr,0,5);

            /*Author you may know*/
            return response()->json(['userdetail' => $userdetail, 'followings' => $followings, 'Author' => $arr], 200);
        }
        return response()->json(['userdetail' => 'null'], 200);

    }

    public function thoughts(Request $request)
    {

        $following = $request->query->all();
        $followingThoughts = [];
        $followingUserData = [];
        $latestThoughts = [];
        $thoughtData = [];
        foreach ($following as $thoughts) {
            foreach ($thoughts as $userThoughts) {
                $ind = User::with('thoughts', 'followers', 'followings', 'roles')->find($userThoughts);
                $followingThoughts[] = $ind->thoughts;
                $followingUserData[] = $ind;
            }
        }
        if (count($followingThoughts) > 0) {
            foreach ($followingThoughts as $sorting) {
                if (count($sorting) > 0) {
                    foreach ($sorting as $sort) {
                        $latestThoughts[] = $sort;
                    }
                }

            }
            if(count($latestThoughts) > 0){
                $collection = collect($latestThoughts);
                $latest_thought_sorting = $collection->sortByDesc('created_at');
                $latest_thought_sorting = $latest_thought_sorting->values()->all();
                foreach ($latest_thought_sorting as $withRelation) {
                    $thoughts = Thoughts::with('user', 'category')->find($withRelation->id);
                    $thoughtData[] = $thoughts;
                }
            }
        }

        return response()->json(['following' => $followingUserData, 'thoughts' => $thoughtData]);
    }

    public function loginSignup()
    {
        return view('Frontend/login-signup');
    }
}