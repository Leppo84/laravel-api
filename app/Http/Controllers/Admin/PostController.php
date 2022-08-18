<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;  
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $validation_rules = [
        'title'         => 'required|string|max:100',
        'slug'          => [
                            'required',
                            'string',
                            'max:100',
                        ],
        'category_id'   => 'required|integer|exists:categories,id',
        'tags'          => 'nullable|array',
        'tags.*'        => 'integer|exists:tags,id',
        'image'         => 'required_without:content|nullable|url',
        'content'       => 'required_without:image|nullable|string|max:5000',
        'excerpt'       => 'nullable|string|max:200',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $posts = Post::paginate($perPage);

        return view('admin.posts.index', compact('posts'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    // Show the form for editing the specified resource.
    public function edit(Post $post)
    {
        if (Auth::id() != $post->user_id) abort(401);
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            'post'          => $post,
            'categories'    => $categories,
            'tags'          => $tags,
        ]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, Post $post)
    {
        if (Auth::id() != $post->user_id) abort(401);

        // validation
        $this->validation_rules['slug'][] = Rule::unique('posts')->ignore($post->id);
        $request->validate($this->validation_rules);
        $data = $request->all();

        // aggiornare nel database
        $post->update($data);
        $post->tags()->sync($data['tags']);

        // redirect
        return redirect()->route('admin.posts.show', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function destroy(Post $post)
    {
        //
    }
}