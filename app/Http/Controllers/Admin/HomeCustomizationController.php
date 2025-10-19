<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HomeContentService;
use App\Models\HomeSection;
use App\Models\HomeSectionCard;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeCustomizationController extends Controller
{
    public function __construct(
        private readonly HomeContentService $homeContentService
    ) {}

    /**
     * Exibe a tela de customização da homepage
     */
    public function index(): View
    {
        $homeData = $this->homeContentService->getHomeContent();

        return view('admin.home-customization.index', compact('homeData'));
    }

    /**
     * Salva as alterações da homepage
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Hero section
            'hero_title_line1' => 'nullable|string|max:255',
            'hero_title_line2' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'hero_background_color' => 'nullable|string|max:7',
            'hero_background_image' => 'nullable|image|max:2048',
            'hero_visible' => 'boolean',

            // About section
            'about_title' => 'required|string|max:255',
            'about_subtitle' => 'nullable|string|max:500',
            'about_visible' => 'boolean',
            'about_cards' => 'nullable|array',
            'about_cards.*.title' => 'required|string|max:255',
            'about_cards.*.content' => 'nullable|string',
            'about_cards.*.icon' => 'nullable|string|max:100',

            // Events section
            'events_title' => 'required|string|max:255',
            'events_subtitle' => 'nullable|string|max:500',
            'events_visible' => 'boolean',

            // Contact section
            'contact_title' => 'required|string|max:255',
            'contact_subtitle' => 'nullable|string|max:500',
            'contact_content' => 'nullable|string',
            'contact_visible' => 'boolean',
        ]);

        // Update Hero Section
        $this->homeContentService->updateSection('hero', [
            'title_line1' => $request->hero_title_line1,
            'title_line2' => $request->hero_title_line2,
            'subtitle' => $request->hero_subtitle,
            'background_color' => $request->hero_background_color,
            'is_visible' => $request->hero_visible == '1',
        ]);

        // Update About Section
        $aboutSection = $this->homeContentService->updateSection('about', [
            'title' => $request->about_title,
            'subtitle' => $request->about_subtitle,
            'is_visible' => $request->about_visible == '1',
        ]);

        // Update About Cards
        if ($request->has('about_cards')) {
            // Remove existing cards
            $aboutSection->cards()->delete();

            // Add new cards
            foreach ($request->about_cards as $index => $cardData) {
                if (!empty($cardData['title'])) {
                    HomeSectionCard::create([
                        'home_section_id' => $aboutSection->id,
                        'title' => $cardData['title'],
                        'content' => $cardData['content'] ?? null,
                        'icon' => $cardData['icon'] ?? null,
                        'sort_order' => $index,
                        'is_visible' => true,
                    ]);
                }
            }
        }

        // Update Events Section
        $this->homeContentService->updateSection('events', [
            'title' => $request->events_title,
            'subtitle' => $request->events_subtitle,
            'is_visible' => $request->events_visible == '1',
        ]);

        // Update Contact Section
        $this->homeContentService->updateSection('contact', [
            'title' => $request->contact_title,
            'subtitle' => $request->contact_subtitle,
            'content' => $request->contact_content,
            'is_visible' => $request->contact_visible == '1',
        ]);

        return redirect()
            ->route('admin.home-customization.index')
            ->with('success', 'Homepage atualizada com sucesso!');
    }
}
