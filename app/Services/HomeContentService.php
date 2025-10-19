<?php

namespace App\Services;

use App\Models\HomeSection;
use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class HomeContentService
{
    public function getHomeContent(): array
    {
        return Cache::remember('home_content', 3600, function () {
            return [
                'hero' => $this->getHeroSection(),
                'about' => $this->getAboutSection(),
                'events' => $this->getEventsSection(),
                'contact' => $this->getContactSection(),
            ];
        });
    }

    public function getHeroSection(): array
    {
        $section = HomeSection::getByKey('hero');

        return [
            'title_line1' => $section?->title_line1 ?? 'Casa de Caridade',
            'title_line2' => $section?->title_line2 ?? 'Legião de Oxóssi e Ogum',
            'subtitle' => $section?->subtitle ?? 'Centro espírita de umbanda e candomblé',
            'background_image' => $section?->background_image,
            'background_color' => $section?->background_color ?? '#2E7D32',
            'is_visible' => $section?->is_visible ?? true,
        ];
    }

    public function getAboutSection(): array
    {
        $section = HomeSection::getByKey('about');
        $cards = $section?->cards()->visible()->ordered()->get() ?? collect();

        return [
            'title' => $section?->title ?? 'Sobre Nossa Casa',
            'subtitle' => $section?->subtitle ?? 'Conheça nossa missão e história',
            'cards' => $cards->map(fn($card) => [
                'title' => $card->title,
                'content' => $card->content,
                'image' => $card->image,
                'icon' => $card->icon,
                'link_url' => $card->link_url,
                'link_text' => $card->link_text,
            ])->toArray(),
            'is_visible' => $section?->is_visible ?? true,
        ];
    }

    public function getEventsSection(): array
    {
        $section = HomeSection::getByKey('events');
        $events = Event::visible()
            ->published()
            ->upcoming()
            ->ordered()
            ->limit(3)
            ->get();

        return [
            'title' => $section?->title ?? 'Próximos Eventos',
            'subtitle' => $section?->subtitle ?? 'Participe de nossas atividades',
            'events' => $events->map(fn($event) => [
                'title' => $event->title,
                'description' => $event->description,
                'image' => $event->image,
                'location' => $event->location,
                'event_date' => $event->formatted_date,
                'is_featured' => $event->is_featured,
            ])->toArray(),
            'is_visible' => $section?->is_visible ?? true,
        ];
    }

    public function getContactSection(): array
    {
        $section = HomeSection::getByKey('contact');

        return [
            'title' => $section?->title ?? 'Entre em Contato',
            'subtitle' => $section?->subtitle ?? 'Estamos aqui para ajudar',
            'content' => $section?->content,
            'is_visible' => $section?->is_visible ?? true,
        ];
    }

    public function updateSection(string $sectionKey, array $data): HomeSection
    {
        $section = HomeSection::updateOrCreate(
            ['section_key' => $sectionKey],
            $data
        );

        $this->clearCache();

        return $section;
    }

    public function clearCache(): void
    {
        Cache::forget('home_content');
    }
}
