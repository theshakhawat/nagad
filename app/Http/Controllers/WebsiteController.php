<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    /**
     * Display a listing of all websites.
     */
    public function index(Request $request): View
    {
        $query = Website::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('domain', 'like', "%{$search}%")
                    ->orWhere('api_key', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $websites = $query->latest()->paginate(10)->withQueryString();

        return view('admin.websites.index', compact('websites'));
    }

    /**
     * Show the form for creating a new website.
     */
    public function create(): View
    {
        $defaultApiKey = Website::generateApiKey();
        $defaultWebhookSecret = Website::generateWebhookSecret();

        return view('admin.websites.create', compact('defaultApiKey', 'defaultWebhookSecret'));
    }

    /**
     * Store a newly created website in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', 'max:255', 'unique:websites,domain'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'api_key' => ['required', 'string', 'max:255', 'unique:websites,api_key'],
            'status' => ['required', 'in:active,inactive'],
            'webhook_secret' => ['nullable', 'string', 'max:255'],
            'callback_url' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('websites/logos', 'public');
            $validated['logo'] = $path;
        }

        Website::create($validated);

        return redirect()->route('admin.websites.index')->with('success', 'Website added successfully.');
    }

    /**
     * Show the form for editing the specified website.
     */
    public function edit(Website $website): View
    {
        return view('admin.websites.edit', compact('website'));
    }

    /**
     * Update the specified website in storage.
     */
    public function update(Request $request, Website $website): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', 'max:255', 'unique:websites,domain,'.$website->id],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'api_key' => ['required', 'string', 'max:255', 'unique:websites,api_key,'.$website->id],
            'status' => ['required', 'in:active,inactive'],
            'webhook_secret' => ['nullable', 'string', 'max:255'],
            'callback_url' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->hasFile('logo')) {
            if ($website->logo && Storage::disk('public')->exists($website->logo)) {
                Storage::disk('public')->delete($website->logo);
            }
            $path = $request->file('logo')->store('websites/logos', 'public');
            $validated['logo'] = $path;
        }

        $website->update($validated);

        return redirect()->route('admin.websites.index')->with('success', 'Website updated successfully.');
    }

    /**
     * Toggle status of the specified website.
     */
    public function toggleStatus(Request $request, Website $website): JsonResponse|RedirectResponse
    {
        $newStatus = $website->status === 'active' ? 'inactive' : 'active';
        $website->update(['status' => $newStatus]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => $newStatus,
                'message' => "Website '{$website->name}' status changed to ".ucfirst($newStatus).'.',
            ]);
        }

        return back()->with('success', "Website '{$website->name}' status changed to ".ucfirst($newStatus).'.');
    }

    /**
     * Remove the specified website from storage.
     */
    public function destroy(Website $website): RedirectResponse
    {
        if ($website->logo && Storage::disk('public')->exists($website->logo)) {
            Storage::disk('public')->delete($website->logo);
        }

        $website->delete();

        return redirect()->route('admin.websites.index')->with('success', 'Website deleted successfully.');
    }
}
