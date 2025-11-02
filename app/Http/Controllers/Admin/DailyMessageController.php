<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DailyMessageRequest;
use App\Models\DailyMessage;
use Illuminate\Http\Request;

class DailyMessageController extends Controller
{
    /**
     * Display a listing of the daily messages.
     */
    public function index(Request $request)
    {
        $query = DailyMessage::query();

        // Filtro por busca
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filtro por status
        if ($request->filled('active')) {
            $query->where('active', $request->boolean('active'));
        }

        // Ordenação
        $messages = $query->latest()->paginate(10)->withQueryString();

        return view('admin.daily-messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new daily message.
     */
    public function create()
    {
        return view('admin.daily-messages.create');
    }

    /**
     * Store a newly created daily message in storage.
     */
    public function store(DailyMessageRequest $request)
    {
        DailyMessage::create($request->validated());

        return redirect()
            ->route('admin.daily-messages.index')
            ->with('success', 'Mensagem do dia criada com sucesso!');
    }

    /**
     * Display the specified daily message.
     */
    public function show(DailyMessage $dailyMessage)
    {
        return view('admin.daily-messages.show', compact('dailyMessage'));
    }

    /**
     * Show the form for editing the specified daily message.
     */
    public function edit(DailyMessage $dailyMessage)
    {
        return view('admin.daily-messages.edit', compact('dailyMessage'));
    }

    /**
     * Update the specified daily message in storage.
     */
    public function update(DailyMessageRequest $request, DailyMessage $dailyMessage)
    {
        $dailyMessage->update($request->validated());

        return redirect()
            ->route('admin.daily-messages.show', $dailyMessage)
            ->with('success', 'Mensagem do dia atualizada com sucesso!');
    }

    /**
     * Remove the specified daily message from storage.
     */
    public function destroy(DailyMessage $dailyMessage)
    {
        $dailyMessage->delete();

        return redirect()
            ->route('admin.daily-messages.index')
            ->with('success', 'Mensagem do dia excluída com sucesso!');
    }

    /**
     * Toggle the active status of a daily message.
     */
    public function toggleActive(DailyMessage $dailyMessage)
    {
        $dailyMessage->update([
            'active' => !$dailyMessage->active
        ]);

        $status = $dailyMessage->active ? 'ativada' : 'desativada';

        return back()->with('success', "Mensagem {$status} com sucesso!");
    }

    /**
     * Clear today's message cache.
     */
    public function clearCache()
    {
        $cacheKey = 'daily_message_' . now()->toDateString();
        cache()->forget($cacheKey);

        return back()->with('success', 'Cache da mensagem do dia limpo com sucesso!');
    }
}
