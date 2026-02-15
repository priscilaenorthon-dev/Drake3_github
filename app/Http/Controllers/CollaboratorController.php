<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Company;
use App\Models\Position;
use App\Models\Team;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function index()
    {
        $collaborators = Collaborator::with(['position', 'team', 'company'])
            ->paginate(15);
        return view('collaborators.index', compact('collaborators'));
    }

    public function create()
    {
        $companies = Company::where('active', true)->select('id', 'name')->get();
        $positions = Position::where('active', true)->select('id', 'name')->get();
        $teams = Team::where('active', true)->select('id', 'name')->get();
        return view('collaborators.create', compact('companies', 'positions', 'teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'position_id' => 'required|exists:positions,id',
            'team_id' => 'nullable|exists:teams,id',
            'employee_number' => 'nullable|string|max:50',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'hire_date' => 'nullable|date',
            'status' => 'required|in:active,inactive,on_leave',
        ]);

        Collaborator::create($validated);

        return redirect()->route('collaborators.index')
            ->with('success', 'Colaborador criado com sucesso.');
    }

    public function show(Collaborator $collaborator)
    {
        return view('collaborators.show', compact('collaborator'));
    }

    public function edit(Collaborator $collaborator)
    {
        $companies = Company::where('active', true)->select('id', 'name')->get();
        $positions = Position::where('active', true)->select('id', 'name')->get();
        $teams = Team::where('active', true)->select('id', 'name')->get();
        return view('collaborators.edit', compact('collaborator', 'companies', 'positions', 'teams'));
    }

    public function update(Request $request, Collaborator $collaborator)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'position_id' => 'required|exists:positions,id',
            'team_id' => 'nullable|exists:teams,id',
            'employee_number' => 'nullable|string|max:50',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'hire_date' => 'nullable|date',
            'status' => 'required|in:active,inactive,on_leave',
        ]);

        $collaborator->update($validated);

        return redirect()->route('collaborators.index')
            ->with('success', 'Colaborador atualizado com sucesso.');
    }

    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();
        return redirect()->route('collaborators.index')
            ->with('success', 'Colaborador excluído com sucesso.');
    }
}
