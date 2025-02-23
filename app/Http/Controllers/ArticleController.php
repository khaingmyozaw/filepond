<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        // Validate required fields
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|array',
            'file.*' => 'required|string',
        ]);
        $storedPath = [];
        try {
            $files = $request->input('file');
            if (is_array($files)) {
                foreach ($files as $key => $file) {

                    // Ensure file exists before moving
                    if (! Storage::exists($file)) {
                        return back()->withErrors(['file' => 'Uploaded file not found.']);
                    }
                    // Define the final storage path
                    $storedPath[] = 'attachments/'.basename($file);
                    // Move file to public storage
                    Storage::move($file, "public/{$storedPath[$key]}");
                }
            }
            // Create article record
            $article = Article::create([
                'title' => $request->title,
                'file' => json_encode($storedPath), // Store clean path
            ]);

            return redirect('/')->with('success', 'File uploaded successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'File upload failed. Please try again.']);
        }
    }
}
