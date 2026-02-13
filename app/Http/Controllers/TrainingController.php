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
        return view('trainings.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Training $training)
    {
        return view('trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        return view('trainings.edit', compact('training'));
    }

    public function update(Request $request, Training $training)
    {
        //
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('trainings.index')
            ->with('success', 'Treinamento excluído com sucesso.');
    }
}
