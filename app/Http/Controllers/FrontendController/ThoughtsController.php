<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Models\Thoughts;
use App\User;
use Illuminate\Http\Request;

class ThoughtsController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function user(Request $request){
        $logged = auth()->check();
        if($logged){
            $userdetail = auth()->user();
            $followings = auth()->user()->followings;
            return response()->json(['userdetail'=>$userdetail,'followings'=>$followings],200);
        }else{
            return response()->json(['userdetail'=>'null'],200);
        }

    }

    public function thoughts(Request $request)
    {
        $following = $request->query->all();
        $followingThoughts = [];
        $followingUserData = [];
        foreach ($following as $thoughts) {
            foreach ($thoughts as $userThoughts) {
                $ind = User::with('thoughts', 'followers', 'followings', 'roles')->find($userThoughts);
                $followingThoughts[] = $ind->thoughts;
                $followingUserData[] = $ind;
            }
        }

        foreach ($followingThoughts as $sorting) {
            foreach ($sorting as $sort) {
                $latestThoughts[] = $sort;
            }
        }
        $collection = collect($latestThoughts);
        $latest_thought_sorting = $collection->sortByDesc('created_at');
        $latest_thought_sorting = $latest_thought_sorting->values()->all();
        foreach ($latest_thought_sorting as $withRelation) {
            $thoughts = Thoughts::with('user', 'category')->find($withRelation->id);
            $thoughtData[] = $thoughts;
        }
        return response()->json(['following' => $followingUserData, 'thoughts' => $thoughtData]);
    }

    public function loginSignup(){
        return view('Frontend/login-signup');
    }
}
