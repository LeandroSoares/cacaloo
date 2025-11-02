<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\ReligiousCourse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReligiousCourseForm extends Component
{
    public $user;
    public $religiousCourses = [];
    public $availableCourses = [];
    public $newCourse = [
        'course_id' => '',
        'date' => '',
        'finished' => false,
        'has_initiation' => false,
        'initiation_date' => '',
        'observations' => '',
    ];
    public $editingCourse = null;
    public $isEditing = false;

    protected $rules = [
        'newCourse.course_id' => 'required',
        'newCourse.date' => 'required|date',
        'newCourse.finished' => 'boolean',
        'newCourse.has_initiation' => 'boolean',
        'newCourse.initiation_date' => 'nullable|date',
        'newCourse.observations' => 'nullable|string',
    ];

    protected $messages = [
        'newCourse.course_id.required' => 'O curso é obrigatório.',
        'newCourse.date.required' => 'A data do curso é obrigatória.',
        'newCourse.date.date' => 'A data do curso deve ser uma data válida.',
        'newCourse.initiation_date.date' => 'A data da iniciação deve ser uma data válida.',
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->loadReligiousCourses();
        $this->loadAvailableCourses();
    }

    public function render()
    {
        return view('livewire.religious-course-form');
    }

    public function loadReligiousCourses()
    {
        $this->religiousCourses = $this->user->religiousCourses()->with('course')->get()->toArray();
    }

    public function loadAvailableCourses()
    {
        $this->availableCourses = Course::orderBy('name')->get()->toArray();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'course_id' => $this->newCourse['course_id'],
            'date' => $this->newCourse['date'],
            'finished' => $this->newCourse['finished'],
            'has_initiation' => $this->newCourse['has_initiation'],
            'initiation_date' => $this->newCourse['has_initiation'] ? $this->newCourse['initiation_date'] : null,
            'observations' => $this->newCourse['observations'],
        ];

        if ($this->isEditing) {
            $this->editingCourse->update($data);
            session()->flash('message', 'Curso atualizado com sucesso!');
            $this->cancel();
        } else {
            $this->user->religiousCourses()->create($data);
            session()->flash('message', 'Curso adicionado com sucesso!');
        }

        $this->resetForm();
        $this->loadReligiousCourses();
        $this->dispatch('profile-updated');
    }

    public function edit($id)
    {
        $course = ReligiousCourse::find($id);
        if ($course && $course->user_id === $this->user->id) {
            $this->editingCourse = $course;
            $this->isEditing = true;
            $this->newCourse = [
                'course_id' => $course->course_id,
                'date' => $course->date?->format('Y-m-d') ?? '',
                'finished' => $course->finished,
                'has_initiation' => $course->has_initiation,
                'initiation_date' => $course->initiation_date?->format('Y-m-d') ?? '',
                'observations' => $course->observations ?? '',
            ];
        }
    }

    public function cancel()
    {
        $this->isEditing = false;
        $this->editingCourse = null;
        $this->resetForm();
    }

    public function delete($id)
    {
        $religiousCourse = ReligiousCourse::find($id);

        if ($religiousCourse && $religiousCourse->user_id === $this->user->id) {
            $religiousCourse->delete();
            $this->loadReligiousCourses();
            session()->flash('message', 'Curso removido com sucesso!');
            $this->dispatch('profile-updated');
        }
    }

    private function resetForm()
    {
        $this->newCourse = [
            'course_id' => '',
            'date' => '',
            'finished' => false,
            'has_initiation' => false,
            'initiation_date' => '',
            'observations' => '',
        ];
    }
}
