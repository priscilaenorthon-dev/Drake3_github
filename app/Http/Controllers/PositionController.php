<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::withCount('collaborators')->paginate(15);
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'level' => 'nullable|string|max:50',
            'active' => 'boolean',
        ]);

        Position::create($validated);

        return redirect()->route('positions.index')
            ->with('success', 'Cargo criado com sucesso.');
    }

    public function show(Position $position)
    {
        $position->load('collaborators');
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'level' => 'nullable|string|max:50',
            'active' => 'boolean',
        ]);

        $position->update($validated);

        return redirect()->route('positions.index')
            ->with('success', 'Cargo atualizado com sucesso.');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index')
            ->with('success', 'Cargo excluído com sucesso.');
    }
}
