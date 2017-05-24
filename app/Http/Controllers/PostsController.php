<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Posts\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreateRequest;

class PostsController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function postNew(CreateRequest $request)
    {
        return response()->json(
            $this->post->createFromArray(
                $request->input(),
                Auth::user()->id
            )
        );
    }

    public function postEdit(CreateRequest $request, $slug)
    {
        return response()->json(
            $this->post->bySlug($slug)->byUserId(
                Auth::user()->id
            )->update(
                $request->except(['id', 'user_id'])
            )
        );
    }

    public function getAllPublished(Request $request)
    {
        return response()->json($this->post->active()->get());
    }

    public function getByUser(Request $request)
    {
        return response()->json($this->post->byUserId(Auth::user()->id)->get());
    }

    public function getBySlug(Request $request, $slug)
    {
        return response()->json(
            $this->post->bySlug($slug)->byUserOrActive(
                Auth::check() ? Auth::user()->id : null
            )->firstOrFail()
        );
    }
}
