<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleRequest;
use App\Models\Category;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::with(['category', 'primaryImage']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        $vehicles = $query->latest()->paginate(10);
        $categories = Category::active()->get();

        return view('admin.vehicles.index', compact('vehicles', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.vehicles.create', compact('categories'));
    }

    public function store(VehicleRequest $request)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data, $request) {
                $vehicle = Vehicle::create($data);

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $index => $image) {
                        $path = $image->store('vehicles', 'public');

                        VehicleImage::create([
                            'vehicle_id' => $vehicle->id,
                            'image_path' => $path,
                            'is_primary' => $index === 0,
                        ]);
                    }
                }
            });

            return redirect()->route('admin.vehicles.index')
                ->with('success', 'Vehicle created successfully.');
        } catch (\Exception $e) {
            Log::error('Vehicle creation failed', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput()
                ->with('error', 'Failed to create vehicle. Please try again.');
        }
    }

    public function edit(Vehicle $vehicle)
    {
        $categories = Category::active()->get();
        $vehicle->load('images');

        return view('admin.vehicles.edit', compact('vehicle', 'categories'));
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data, $request, $vehicle) {
                $vehicle->update($data);

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('vehicles', 'public');

                        VehicleImage::create([
                            'vehicle_id' => $vehicle->id,
                            'image_path' => $path,
                            'is_primary' => !$vehicle->images()->exists(),
                        ]);
                    }
                }
            });

            return redirect()->route('admin.vehicles.index')
                ->with('success', 'Vehicle updated successfully.');
        } catch (\Exception $e) {
            Log::error('Vehicle update failed', ['vehicle_id' => $vehicle->id, 'error' => $e->getMessage()]);
            return redirect()->back()->withInput()
                ->with('error', 'Failed to update vehicle. Please try again.');
        }
    }

    public function destroy(Vehicle $vehicle)
    {
        try {
            DB::transaction(function () use ($vehicle) {
                foreach ($vehicle->images as $image) {
                    Storage::disk('public')->delete($image->image_path);
                }
                $vehicle->images()->delete();
                $vehicle->delete();
            });

            return redirect()->route('admin.vehicles.index')
                ->with('success', 'Vehicle deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Vehicle deletion failed', ['vehicle_id' => $vehicle->id, 'error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Failed to delete vehicle. Please try again.');
        }
    }

    public function setPrimaryImage(Vehicle $vehicle, VehicleImage $image)
    {
        if ($image->vehicle_id !== $vehicle->id) {
            abort(403);
        }

        DB::transaction(function () use ($vehicle, $image) {
            $vehicle->images()->update(['is_primary' => false]);
            $image->update(['is_primary' => true]);
        });

        return redirect()->back()
            ->with('success', 'Primary image updated successfully.');
    }

    public function deleteImage(VehicleImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->back()
            ->with('success', 'Image deleted successfully.');
    }

    public function toggleStatus(Vehicle $vehicle)
    {
        $vehicle->update(['status' => !$vehicle->status]);

        return redirect()->back()
            ->with('success', 'Vehicle status updated successfully.');
    }
}