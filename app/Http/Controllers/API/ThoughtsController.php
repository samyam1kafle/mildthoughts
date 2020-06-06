<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Thoughts;
use App\Models\ThoughtsCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Null_;

class ThoughtsController extends Controller
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
        $userThought = auth('api')->user()->thoughts;
        $arr = [];
        if(count($userThought) > 0){
            foreach ($userThought as $user) {
                $thoughtModel = Thoughts::with('category')->orderBy('id', 'desc')
                    ->find($user->id);
                $arr[] = $thoughtModel;
            }
        }
        $thoughtCategory = ThoughtsCategory::all();

        return response()->json(['userThought' => $arr, 'thoughtCategories' => $thoughtCategory]);
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
            'title' => 'required|string|min:1|max:30',
            'thought' => 'required|string|max:500|min:10',
            'thoughtCategory_id' => 'required',
        ]);

        if ($request->image) {
            $name = time() . '.' . explode('/', mime_content_type($request->image))[1];

            Image::make($request->image)->resize('400', '400')->save(public_path('Backend/ThoughtsImages/') . $name);
        }
        $thoughts = new Thoughts([
            'title' => $request->title,
            'thought' => $request->thought,
            'thoughtCategory_id' => $request->thoughtCategory_id,
            'image' => $request->image ? $name : null,
            'user_id' => auth('api')->id()
        ]);
        $thoughts->save();

        return response()->json(['msg' => 'Thought Published Successfully'], 200);
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
            'title' => 'required|string|min:1|max:30',
            'thought' => 'required|string|max:500|min:10',
            'thoughtCategory_id' => 'required',
        ]);

        $thought = Thoughts::findOrFail($id);

        $old_img = $thought->image;

        if ($request->image != $old_img) {
            if ($old_img != null) {
                unlink(public_path('Backend/ThoughtsImages/') . $old_img);
            }
            $name = time() . '.' . explode('/', mime_content_type($request->image))[1];

            Image::make($request->image)->resize('400', '400')->save(public_path('Backend/ThoughtsImages/') . $name);
            $request->merge(['image' => $name]);
        }
        $request->merge(['user_id' => auth('api')->id()]);
        $thought->update($request->all());


        return response()->json(['msg' => 'Thought Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thought = Thoughts::findOrFail($id);
        if ($thought->image != null) {
            unlink(public_path('Backend/ThoughtsImages/') . $thought->image);
        }
        $deleted = $thought->delete();
        if ($deleted) {
            return response()->json(['message' => 'Your thought has been deleted successfully.'], 200);
        }
    }
}
