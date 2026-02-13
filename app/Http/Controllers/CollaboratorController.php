<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
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
        return view('collaborators.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Collaborator $collaborator)
    {
        return view('collaborators.show', compact('collaborator'));
    }

    public function edit(Collaborator $collaborator)
    {
        return view('collaborators.edit', compact('collaborator'));
    }

    public function update(Request $request, Collaborator $collaborator)
    {
        //
    }

    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();
        return redirect()->route('collaborators.index')
            ->with('success', 'Colaborador excluído com sucesso.');
    }
}
