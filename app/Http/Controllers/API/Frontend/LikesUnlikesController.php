<?php

namespace App\Http\Controllers\API\Frontend;

use App\Events\likeUnlike;
use App\Http\Controllers\Controller;
use App\Models\Thoughts;
use App\Notifications\postLiked;
use App\User;
use Illuminate\Http\Request;

class LikesUnlikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function likeUnlike($id)
    {
        $user_id = auth()->id();
        $user = User::find($user_id);
        $thought = Thoughts::find($id);
        $liked = $user->hasVoted($thought);
        $author_id = $thought->user_id;
        $author = User::find($author_id);
        if (!$liked) {
            $user->upVote($thought);
            if($user_id != $author_id){
                $author->notify(new postLiked($user,$thought));
            }
            $liked = true;
        } else {
            $user->cancelVote($thought);
            $liked = false;
        }
        $voters_count = $thought->countVoters();
        $voters = $thought->voters;
        broadcast(new likeUnlike($voters, $voters_count));
        broadcast(new likeUnlike($voters, $voters_count))->toOthers();

        return response()->json(['liked' => $liked], 200);

    }

    public function likeUnlikeCount($id)
    {
        $user = auth()->user();
        $thought = Thoughts::with('voters')->withCount(['voters'])->find($id);
        $liked = $user->hasVoted($thought);
        return response()->json(['liked' => $liked, 'voters' => $thought->voters, 'count' => $thought->countVoters()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
