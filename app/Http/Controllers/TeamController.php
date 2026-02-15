<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with(['unit', 'leader'])->paginate(15);
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $units = Unit::where('active', true)->select('id', 'name')->get();
        $users = User::where('active', true)->select('id', 'name')->get();
        return view('teams.create', compact('units', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
            'active' => 'boolean',
        ]);

        Team::create($validated);

        return redirect()->route('teams.index')
            ->with('success', 'Equipe criada com sucesso.');
    }

    public function show(Team $team)
    {
        $team->load('unit', 'leader', 'collaborators');
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $units = Unit::where('active', true)->select('id', 'name')->get();
        $users = User::where('active', true)->select('id', 'name')->get();
        return view('teams.edit', compact('team', 'units', 'users'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
            'active' => 'boolean',
        ]);

        $team->update($validated);

        return redirect()->route('teams.index')
            ->with('success', 'Equipe atualizada com sucesso.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')
            ->with('success', 'Equipe excluída com sucesso.');
    }
}
