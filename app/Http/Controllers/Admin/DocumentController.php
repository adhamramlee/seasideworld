<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with('uploader');

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'like', "%{$search}%")
                  ->orWhere('title_jp', 'like', "%{$search}%");
            });
        }

        $documents = $query->latest()->paginate(10);

        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.documents.create', compact('clients'));
    }

    public function store(DocumentRequest $request)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use (&$data, $request) {
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $path = $file->store('private/documents', 'local');

                    $data['file_path'] = $path;
                    $data['file_size'] = $file->getSize();
                    $data['file_type'] = $file->getMimeType();
                    $data['user_id'] = auth()->id();
                }

                $document = Document::create($data);

                if ($request->has('client_ids')) {
                    $document->users()->sync($request->input('client_ids'));
                }
            });

            return redirect()->route('admin.documents.index')
                ->with('success', 'Document uploaded successfully.');
        } catch (\Exception $e) {
            Log::error('Document creation failed', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput()
                ->with('error', 'Failed to upload document. Please try again.');
        }
    }

    public function edit(Document $document)
    {
        $clients = User::where('role', 'client')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $assignedClients = $document->users->pluck('id')->toArray();

        return view('admin.documents.edit', compact('document', 'clients', 'assignedClients'));
    }

    public function update(DocumentRequest $request, Document $document)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use (&$data, $request, $document) {
                if ($request->hasFile('file')) {
                    Storage::disk('local')->delete($document->file_path);

                    $file = $request->file('file');
                    $path = $file->store('private/documents', 'local');

                    $data['file_path'] = $path;
                    $data['file_size'] = $file->getSize();
                    $data['file_type'] = $file->getMimeType();
                }

                $document->update($data);

                $document->users()->sync($request->input('client_ids', []));
            });

            return redirect()->route('admin.documents.index')
                ->with('success', 'Document updated successfully.');
        } catch (\Exception $e) {
            Log::error('Document update failed', ['document_id' => $document->id, 'error' => $e->getMessage()]);
            return redirect()->back()->withInput()
                ->with('error', 'Failed to update document. Please try again.');
        }
    }

    public function destroy(Document $document)
    {
        try {
            DB::transaction(function () use ($document) {
                $document->users()->detach();
                $document->delete();
            });

            Storage::disk('local')->delete($document->file_path);

            return redirect()->route('admin.documents.index')
                ->with('success', 'Document deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Document deletion failed', ['document_id' => $document->id, 'error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Failed to delete document. Please try again.');
        }
    }

    public function toggleStatus(Document $document)
    {
        $document->update(['status' => !$document->status]);

        return redirect()->back()
            ->with('success', 'Document status updated successfully.');
    }

    public function download(Document $document)
    {
        if (!Storage::disk('local')->exists($document->file_path)) {
            abort(404);
        }

        $document->incrementDownloads();

        return Storage::disk('local')->download($document->file_path);
    }

    public function assignToClient(Request $request, Document $document)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
        ]);

        $client = User::findOrFail($request->client_id);

        if (!$client->isClient()) {
            return response()->json(['error' => 'Invalid client'], 422);
        }

        $document->users()->syncWithoutDetaching([$client->id]);

        return response()->json(['success' => true]);
    }

    public function removeFromClient(Document $document, User $client)
    {
        if (!$client->isClient()) {
            abort(404);
        }

        $document->users()->detach($client->id);

        return redirect()->back()
            ->with('success', 'Client removed successfully.');
    }
}