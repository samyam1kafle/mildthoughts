<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Thoughts;
use App\Models\ThoughtsCategory;
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
            $arr = [];
            $author = Roles::where('role', '=', 'Author')->first()->users;
            $writters = $author->where('id', '!=', auth()->id());
            if (count($followings) > 0 && count($writters) > 0) {
                foreach ($writters as $author) {
                    if (!$user->isFollowing($author)) {
                        $arr[] = $author;
                    }
                }
                $arr = array_slice($arr, 0, 5);
            } else {
                if (count($writters) > 0) {
                    foreach ($writters as $authors) {
                        $arr[] = $authors;
                    }
                    $arr = array_slice($arr, 0, 5);
                }
            }

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
        $tags = ThoughtsCategory::all();

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
            if (count($latestThoughts) > 0) {
                $collection = collect($latestThoughts);
                $latest_thought_sorting = $collection->sortByDesc('created_at');
                $latest_thought_sorting = $latest_thought_sorting->values()->all();
                foreach ($latest_thought_sorting as $withRelation) {
                    $thoughts = Thoughts::with('user', 'category', 'voters','comment')->withCount(['voters','comment'])->find($withRelation->id);
                    $thoughtData[] = $thoughts;
                }
            }
        }
        return response()->json(['following' => $followingUserData, 'thoughts' => $thoughtData, 'tags' => $tags]);
    }

    public function loginSignup()
    {
        return view('Frontend/login-signup');
    }

    public function DataByTags($id)
    {
        $thoughtCat = ThoughtsCategory::find($id);
        $thoughtsByTags = ThoughtsCategory::find($id)->thoughts;
        $ThoughtsInOrder = [];
        $tags = ThoughtsCategory::all();
        $arr = [];

        if (count($thoughtsByTags) > 0) {
            foreach ($thoughtsByTags as $WithRelation) {
                $thoughts = Thoughts::with('user')->find($WithRelation->id);
                $thoughtswithRelation[] = $thoughts;
            }
            $inSingleArr = collect($thoughtswithRelation);
            $inOrderSort = $inSingleArr->sortByDesc('created_at');
            $ThoughtsInOrder = $inOrderSort->values()->all();
        }
        /*Author you may know*/
        $followings = auth()->user()->followings;

        $user = auth()->user();

        $author = Roles::where('role', '=', 'Author')->first()->users;

        $writters = $author->where('id', '!=', auth()->id());
        if (count($followings) > 0 && count($writters) > 0) {
            foreach ($writters as $author) {
                if (!$user->isFollowing($author)) {
                    $arr[] = $author;
                }
            }
            $arr = array_slice($arr, 0, 5);
        } else {
            if (count($writters) > 0) {
                foreach ($writters as $authors) {
                    $arr[] = $authors;
                }
                $arr = array_slice($arr, 0, 5);
            }
        }

        /*Author you may know*/

        return response()->json(['thoughts' => $ThoughtsInOrder, 'tags' => $tags, 'authorYouMayKnow' => $arr, 'tagscategory' => $thoughtCat]);

    }

    public function individualThought($id)
    {
        $thought = Thoughts::with('category', 'user', 'voters')->withCount(['voters'])->find($id);
        $user = auth()->user();
        $tags = ThoughtsCategory::all();
        $liked = $user->hasVoted($thought);
        return response()->json(['thought' => $thought, 'liked' => $liked, 'tags' => $tags]);
    }
}
