<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        //$posts = Post::all();
        if($request->search)
        {
            $posts = Post::join('users','author_id', '=', 'users.id')
                ->where('title', 'like', '%' .$request->search. '%')
                ->orWhere('description', 'like', '%' .$request->search. '%')
                ->orWhere('name', 'like', '%' .$request->search. '%')
                ->orderBy('posts.created_at', 'desc')
                ->get();
            return view('posts.index', compact('posts'));
        }
        $posts = Post::join('users','author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(4);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $post = new Post();
        $post->title = $request->title;
        $post->short_title = Str::length($request->title) > 25 ? Str::substr($request->title, 0, 25) . '...' : $request->title;
        $post->description = $request->description;
        $post->author_id = rand(1,4);
        if($request->file('img'))
        {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }
        $post->save();
        return redirect()->route('post.index')->with('success', 'Статья успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show(int $id)
    {
        $post = Post::join('users','author_id', '=', 'users.id')->find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function edit(int $id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->short_title = Str::length($request->title) > 25 ? Str::substr($request->title, 0, 25) . '...' : $request->title;
        $post->description = $request->description;
        $post->author_id = rand(1,4);
        if($request->file('img'))
        {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }
        $post->update();
        $id = $post->post_id;
        return redirect()->route('post.show', compact('id'))->with('success', 'Статья успешно отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Статья успешно удалена');
    }
}
