<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('dashboard', compact('posts'));
    }

    /**
     * Show view create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-post');
    }

    /**
     * Update post
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'text' => 'required|min:5',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->back()->with('status', 'Изменения прошли успешно');
    }

    /**
     * Create post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'text' => 'required|min:5',
        ]);

        Post::create($request->all());
        return redirect()->back()->with('status', 'Статья добавлена');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('edit-post', compact('post'));
    }

    /**
     * Delete post
     *
     * @param  \App\Models\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('dashboard')->with('status', 'Удаление прошло успешно');
    }

}
