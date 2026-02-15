<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::withCount('workSchedules')->paginate(15);
        return view('shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('shifts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'duration_hours' => 'required|numeric|min:0',
            'type' => 'nullable|string|max:50',
            'active' => 'boolean',
        ]);

        Shift::create($validated);

        return redirect()->route('shifts.index')
            ->with('success', 'Turno criado com sucesso.');
    }

    public function show(Shift $shift)
    {
        $shift->load('workSchedules');
        return view('shifts.show', compact('shift'));
    }

    public function edit(Shift $shift)
    {
        return view('shifts.edit', compact('shift'));
    }

    public function update(Request $request, Shift $shift)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'duration_hours' => 'required|numeric|min:0',
            'type' => 'nullable|string|max:50',
            'active' => 'boolean',
        ]);

        $shift->update($validated);

        return redirect()->route('shifts.index')
            ->with('success', 'Turno atualizado com sucesso.');
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->route('shifts.index')
            ->with('success', 'Turno excluído com sucesso.');
    }
}
