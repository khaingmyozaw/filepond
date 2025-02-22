<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('attachments', 'public');
        }
        $article = Article::create([
            'title' => $request->title,
            'file'  => $filePath,
        ]);

        return redirect('/')->with('success', 'File uploaded successfully.');
    }
}
