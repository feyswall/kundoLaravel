<?php

namespace App\Http\Controllers\Super\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($side)
    {
        $posts = Post::where('side', $side)->orderBy('id', 'desc')->paginate(10);
        return view('interface.super.nyadhifa.orodhaNyadhifa')
            ->with('posts', $posts)
            ->with('side', $side);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'post' => ['required', Rule::unique('posts', 'name')],
            'area' => 'required',
            'count' => 'required',
        ];
        $messages = [];
        $request->validate( $rules, $messages );
        $post = Post::create([
                'area' => $request->area,
                'name' => $request->post,
                'deep' => $request->post."_ps",
                'side' => $request->side,
                'numberCount' => $request->count,
        ]);
        if ( $post ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Wadhifa Umetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'post' => ['required', Rule::unique('posts', 'name')->ignore($post->id)],
        ];
        $messages = [];
        $request->validate( $rules, $messages );
        $post->update([
            'name' => $request->post,
        ]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kamati Imebadirishwa.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
