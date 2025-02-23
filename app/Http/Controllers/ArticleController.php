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
            'file'  => 'required|string', // File path is passed as string
        ]);

        // Get the temporary file path
        $tempPath = $request->input('file');

        // Ensure file exists before moving
        if (!Storage::exists($tempPath)) {
            return back()->withErrors(['file' => 'Uploaded file not found.']);
        }

        try {
            // Define the final storage path
            $storedPath = 'attachments/' . basename($tempPath);

            // Move file to public storage
            Storage::move($tempPath, "public/{$storedPath}");

            // Create article record
            $article = Article::create([
                'title' => $request->title,
                'file'  => $storedPath, // Store clean path
            ]);

            return redirect('/')->with('success', 'File uploaded successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'File upload failed. Please try again.']);
        }
    }
}
