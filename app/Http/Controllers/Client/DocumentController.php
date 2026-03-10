<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->documents();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'like', "%{$search}%")
                  ->orWhere('title_jp', 'like', "%{$search}%")
                  ->orWhere('description_en', 'like', "%{$search}%")
                  ->orWhere('description_jp', 'like', "%{$search}%");
            });
        }

        $documents = $query->latest()->paginate(15);

        return view('client.documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        $user = Auth::user();
        
        // Check if document is assigned to user
        if (!$user->documents()->where('document_id', $document->id)->exists()) {
            abort(403);
        }

        return view('client.documents.show', compact('document'));
    }

    public function download(Document $document)
    {
        $user = Auth::user();
        
        // Check if document is assigned to user
        if (!$user->documents()->where('document_id', $document->id)->exists()) {
            abort(403);
        }

        if (!Storage::disk('local')->exists($document->file_path)) {
            abort(404);
        }

        $document->incrementDownloads();

        return Storage::disk('local')->download($document->file_path);
    }
}