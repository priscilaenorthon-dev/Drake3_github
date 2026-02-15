<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with(['qualification'])
            ->paginate(15);
        return view('trainings.index', compact('trainings'));
    }

    public function create()
    {
        $qualifications = \App\Models\Qualification::where('active', true)->get();
        return view('trainings.create', compact('qualifications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'qualification_id' => 'nullable|exists:qualifications,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'type' => 'required|in:online,in_person',
            'duration_hours' => 'required|numeric|min:0',
            'passing_score' => 'nullable|numeric|min:0|max:100',
            'active' => 'boolean',
        ]);

        Training::create($validated);

        return redirect()->route('trainings.index')
            ->with('success', 'Treinamento criado com sucesso.');
    }

    public function show(Training $training)
    {
        return view('trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        $qualifications = \App\Models\Qualification::where('active', true)->get();
        return view('trainings.edit', compact('training', 'qualifications'));
    }

    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'qualification_id' => 'nullable|exists:qualifications,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'type' => 'required|in:online,in_person',
            'duration_hours' => 'required|numeric|min:0',
            'passing_score' => 'nullable|numeric|min:0|max:100',
            'active' => 'boolean',
        ]);

        $training->update($validated);

        return redirect()->route('trainings.index')
            ->with('success', 'Treinamento atualizado com sucesso.');
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('trainings.index')
            ->with('success', 'Treinamento excluído com sucesso.');
    }
}
