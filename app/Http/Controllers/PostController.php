<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    const PATH = 'uploaded';

    public function index()
    {
        $posts = auth()->user()->posts;

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = (object) $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'content' => 'required|max:3000',
        ]);

        $imageFilename = time() . '_' . Carbon::now()->format('Ymd') . '.' . $request->image->getClientOriginalExtension();
        $image = self::PATH . '/' . $imageFilename;

        try {
            DB::beginTransaction();
            $post = new Post();
            $post->title = $validated->title;
            $post->slug = Str::slug($validated->title) . '-' . time() . '-' . rand(1111, 9999);
            $post->image = $image;
            $post->content = $validated->content;
            $post->user_id = Auth::user()->id;
            $post->save();
            DB::commit();

            $request->image->move(public_path(self::PATH), $imageFilename);

            return redirect(route('post.index'))->with([
                'message' => 'A post has been created'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Something went wrong'
            ])->withInput();
        }
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        $validated = (object) $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'content' => 'required|max:3000',
        ]);

        $oldImage = null;
        $imageFilename = null;
        $image = null;

        if ($request->image) {
            $oldImage = $post->image;
            $imageFilename = time() . '_' . Carbon::now()->format('Ymd') . '.' . $request->image->getClientOriginalExtension();
            $image = self::PATH . '/' . $imageFilename;
        }

        try {
            DB::beginTransaction();
            $post->title = $validated->title;
            $post->slug = Str::slug($validated->title) . '-' . time() . '-' . rand(1111, 9999);
            if ($request->image) {
                $post->image = $image;
            }
            $post->content = $validated->content;
            $post->user_id = Auth::user()->id;
            $post->update();
            DB::commit();

            if ($request->image) {
                $request->image->move(public_path(self::PATH), $imageFilename);
                unlink(public_path($oldImage));
            }

            return redirect(route('post.index'))->with([
                'message' => 'A post has been updated'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Something went wrong'
            ])->withInput();
        }
    }

    public function destroy(Post $post)
    {
        $imagePath = public_path($post->image);
        try {
            DB::beginTransaction();
            $post->delete();
            DB::commit();
            unlink($imagePath);

            return redirect(route('post.index'))->with([
                'message' => 'A post has been deleted'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Something went wrong'
            ]);
        }
    }
}




