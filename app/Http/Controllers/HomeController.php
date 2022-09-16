<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = Auth::guard('teacher')->user();
        $posts = Post::orderBy('created_at', 'desc')->get();
        $subjects = Subject::all();

        $param = [
            'user' => $user,
            'teacher' => $teacher,
            'posts' => $posts,
            'subjects' => $subjects,
        ];



        return view('home', $param);
    }
}
