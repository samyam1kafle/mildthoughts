<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ThoughtsCategory;
use Illuminate\Http\Request;

class ThoughtsCategoryController extends Controller
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
        $categories = ThoughtsCategory::all();
        return response()->json(['categories' => $categories], 200);
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
            'category_name' => 'required|string|max:25|min:3',
            'description' => 'required|string|max:200|min:5'
        ]);
        return ThoughtsCategory::create([
            'category_name' => $request->category_name,
            'description' => $request->description
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
            'category_name' => 'required|string|max:25|min:3',
            'description' => 'required|string|max:200|min:5'
        ]);
        $category = ThoughtsCategory::findOrFail($id);

        $updated = $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description
        ]);
        if ($updated) {
            return response()->json(['message' => 'Successfully updated the category'], 200);
        } else {
            return response()->json(['error' => 'There was problem updating the data.'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ThoughtsCategory::findOrFail($id);
        $deleted = $category->delete();
        if($deleted){
            return response()->json(['message'=>'Category removed successfully'],200);
        }
    }
}
