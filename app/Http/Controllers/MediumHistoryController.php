<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MediumHistoryController extends Controller
{
    /**
     * Exibe o histórico mediúnico completo do usuário
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        // Carrega todos os relacionamentos necessários para a visualização do histórico
        $user->load([
            'personalData',
            'religiousInfo',
            'priestlyFormation',
            'crowning',
            'headOrisha',
            'forceCross',
            'crossings',
            'workGuide',
            'amacis',
            'lastTemple',
            'entityConsecrations',
            'religiousCourses.course',
            'initiatedMysteries.mystery',
            'initiatedOrishas.orisha',
            'divineMagics.magicType'
        ]);

        // Calcula o progresso do preenchimento do histórico
        $totalSections = 13; // Número de seções que o usuário deve preencher
        $completedSections = 0;

        // Verifica cada seção se está preenchida
        if ($user->personalData) {
            $completedSections++;
        }
        if ($user->religiousInfo) {
            $completedSections++;
        }
        if ($user->priestlyFormation) {
            $completedSections++;
        }
        if ($user->crowning) {
            $completedSections++;
        }
        if ($user->headOrisha) {
            $completedSections++;
        }
        if ($user->forceCross) {
            $completedSections++;
        }
        if ($user->workGuide) {
            $completedSections++;
        }
        if ($user->lastTemple) {
            $completedSections++;
        }
        if ($user->crossings->count() > 0) {
            $completedSections++;
        }
        if ($user->religiousCourses->count() > 0) {
            $completedSections++;
        }
        if ($user->initiatedMysteries->count() > 0) {
            $completedSections++;
        }
        if ($user->initiatedOrishas->count() > 0) {
            $completedSections++;
        }
        if ($user->divineMagics->count() > 0) {
            $completedSections++;
        }

        $progressPercentage = ($completedSections / $totalSections) * 100;

        return view('user.medium-history', compact('user', 'progressPercentage'));
    }
}
