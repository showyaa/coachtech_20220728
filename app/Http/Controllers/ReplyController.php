<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function create(Request $request)
    {
        $form = $request->all();
        Reply::create($form);
        return redirect('/');
    }
}
