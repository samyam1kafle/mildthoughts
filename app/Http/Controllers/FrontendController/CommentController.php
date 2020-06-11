<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Thoughts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function addComment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|string|min:2|max:500',
        ]);
        $post = Thoughts::with('comment')->find($id);
        $inOrder = [];
        $user = auth()->id();
        if ($post != null) {
            $comment = Comment::create([
                'user_id' => $user,
                'post_id' => $post->id,
                'comment' => $request->comment
            ]);
            if ($comment) {
                if (count($post->comment) > 0) {
                    $comment = $post->comment;
                    foreach ($comment as $value) {
                        $commentWithReation = Comment::with('user')->find($value->id);
                        $CommentsWithRel [] = $commentWithReation;
                    }
                    $CommentsWithRel = array_slice($CommentsWithRel,0,3);
                    $Shorting = collect($CommentsWithRel);
                    $shorted = $Shorting->sortByDesc('created_at');
                    $inOrder = $shorted->values()->all();
                }
                return response()->json(['comments'=>$inOrder], 200);
            }
        }
    }
}
