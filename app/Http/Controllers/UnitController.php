<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Company;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('company')->paginate(15);
        return view('units.index', compact('units'));
    }

    public function create()
    {
        $companies = Company::where('active', true)->get();
        return view('units.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        Unit::create($validated);

        return redirect()->route('units.index')
            ->with('success', 'Unidade criada com sucesso.');
    }

    public function show(Unit $unit)
    {
        $unit->load('company', 'locations', 'teams');
        return view('units.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        $companies = Company::where('active', true)->get();
        return view('units.edit', compact('unit', 'companies'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $unit->update($validated);

        return redirect()->route('units.index')
            ->with('success', 'Unidade atualizada com sucesso.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')
            ->with('success', 'Unidade excluída com sucesso.');
    }
}
