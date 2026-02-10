<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\HomeContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function __construct(
        protected HomeContentService $homeContentService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Event::orderBy('event_date', 'asc')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'event_date' => 'required|date',
            'event_end_date' => 'nullable|date|after:event_date',
            'location' => 'nullable|string|max:255',
            'visibility' => 'required|in:public,private',
            'is_visible' => 'boolean',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['status'] = 'published';

        Event::create($validated);
        $this->homeContentService->clearCache();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'event_date' => 'required|date',
            'event_end_date' => 'nullable|date|after:event_date',
            'location' => 'nullable|string|max:255',
            'visibility' => 'required|in:public,private',
            'is_visible' => 'boolean',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        $event->update($validated);
        $this->homeContentService->clearCache();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        $this->homeContentService->clearCache();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento removido com sucesso!');
    }
}
