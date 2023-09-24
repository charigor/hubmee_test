<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('dashboard.postIndex',compact('posts'));
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $users = User::get(['id','name'])->map(fn($item) =>  ['key' => $item->id,'value' =>  $item->name])->prepend(['key' => null,'value' => 'Please Select'])->toArray();
        return view('dashboard.postCreate',compact('users'));
    }

    /**
     * @param PostStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PostStoreRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('dashboard.index')->with(['message' => 'Post was created successfully']);
    }

    /**
     * @param string $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $users = User::get(['id','name'])->map(fn($item) =>  ['key' => $item->id,'value' =>  $item->name])->prepend(['key' => null,'value' => 'Please Select'])->toArray();
        return view('dashboard.postEdit',compact('post','users'));
    }

    /**
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostUpdateRequest $request, Post $post)
    {

        $post->update($request->validated());
        return redirect()->route('dashboard.index')->with(['message' => 'Post was updated successfully']);

    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('dashboard.index')->with(['message' => 'Post was deleted successfully']);
    }
}
