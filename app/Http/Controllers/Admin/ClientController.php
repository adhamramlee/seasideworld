<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'client');

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $clients = $query->withCount('documents', 'inquiries')
            ->latest()
            ->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(ClientRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'client';

        User::create($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(User $client)
    {
        if (!$client->isClient()) {
            abort(404);
        }

        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, User $client)
    {
        if (!$client->isClient()) {
            abort(404);
        }

        $data = $request->validated();
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(User $client)
    {
        if (!$client->isClient()) {
            abort(404);
        }

        try {
            $client->delete();

            return redirect()->route('admin.clients.index')
                ->with('success', 'Client deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Client deletion failed', ['client_id' => $client->id, 'error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Failed to delete client. Please try again.');
        }
    }

    public function toggleStatus(User $client)
    {
        if (!$client->isClient()) {
            abort(404);
        }

        $client->update(['is_active' => !$client->is_active]);

        return redirect()->back()
            ->with('success', 'Client status updated successfully.');
    }

    public function show(User $client)
    {
        if (!$client->isClient()) {
            abort(404);
        }

        $client->load(['documents', 'inquiries' => function ($query) {
            $query->latest()->limit(10);
        }]);

        return view('admin.clients.show', compact('client'));
    }
}