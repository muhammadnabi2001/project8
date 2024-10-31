<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('post', ['posts' => $posts, 'categories' => $categories]);
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create($validatedData);

        return redirect('/post')->with('success', 'Post muvaffaqiyatli yaratildi!');
    }
    public function delete(int $id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect('/post')->with('delete',"Ma'lumot  o'chirildi");
    }
    public function update(Request $request, Post $post)
    {
        //dd($request->all(), $post);
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        $post->title=$request->title;
        $post->body=$request->body;
        $post->category_id=$request->category_id;
        $post->update($request->all());
        return redirect('/post');
    }
}
