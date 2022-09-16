<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;



class PostController extends Controller
{
    public function create(PostRequest $request)
    {
        $input = $request->except('file');
        $post = new Post();
        $post->fill($input);
        $post->save();

        $postId = $post->id;

        if ($request->file != null) {
            $files = $request->file;

            foreach ($files as $file) {
                $file->store('public/images');
                Image::create([
                    'post_id' => $postId,
                    'name' => $file->hashName()
                ]);
            }
        }
        return redirect('/');
    }
}
