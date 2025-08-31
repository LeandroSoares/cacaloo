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
        'start_date' => '',
        'end_date' => '',
        'institution' => '',
        'certificate' => false,
    ];

    protected $rules = [
        'newCourse.course_id' => 'required',
        'newCourse.start_date' => 'required|date',
        'newCourse.end_date' => 'nullable|date|after_or_equal:newCourse.start_date',
        'newCourse.institution' => 'required|string|max:255',
        'newCourse.certificate' => 'boolean',
    ];

    protected $messages = [
        'newCourse.course_id.required' => 'O curso é obrigatório.',
        'newCourse.start_date.required' => 'A data de início é obrigatória.',
        'newCourse.start_date.date' => 'A data de início deve ser uma data válida.',
        'newCourse.end_date.date' => 'A data de conclusão deve ser uma data válida.',
        'newCourse.end_date.after_or_equal' => 'A data de conclusão deve ser posterior ou igual à data de início.',
        'newCourse.institution.required' => 'A instituição é obrigatória.',
        'newCourse.institution.max' => 'A instituição não pode ter mais de 255 caracteres.',
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

    public function addCourse()
    {
        $this->validate();

        $this->user->religiousCourses()->create([
            'course_id' => $this->newCourse['course_id'],
            'start_date' => $this->newCourse['start_date'],
            'end_date' => $this->newCourse['end_date'],
            'institution' => $this->newCourse['institution'],
            'certificate' => $this->newCourse['certificate'],
        ]);

        $this->resetNewCourse();
        $this->loadReligiousCourses();

        session()->flash('message', 'Curso adicionado com sucesso!');
        $this->dispatch('profile-updated');
    }

    public function deleteCourse($id)
    {
        $religiousCourse = ReligiousCourse::find($id);

        if ($religiousCourse && $religiousCourse->user_id === $this->user->id) {
            $religiousCourse->delete();
            $this->loadReligiousCourses();
            session()->flash('message', 'Curso removido com sucesso!');
        $this->dispatch('profile-updated');
        }
    }

    private function resetNewCourse()
    {
        $this->newCourse = [
            'course_id' => '',
            'start_date' => '',
            'end_date' => '',
            'institution' => '',
            'certificate' => false,
        ];
    }
}
