<?php

namespace App\Http\Controllers;

use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class WorkScheduleController extends Controller
{
    public function index()
    {
        $workSchedules = WorkSchedule::with(['collaborator', 'shift', 'location'])
            ->orderBy('schedule_date', 'desc')
            ->paginate(15);
        return view('work-schedules.index', compact('workSchedules'));
    }

    public function create()
    {
        return view('work-schedules.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(WorkSchedule $workSchedule)
    {
        return view('work-schedules.show', compact('workSchedule'));
    }

    public function edit(WorkSchedule $workSchedule)
    {
        return view('work-schedules.edit', compact('workSchedule'));
    }

    public function update(Request $request, WorkSchedule $workSchedule)
    {
        //
    }

    public function destroy(WorkSchedule $workSchedule)
    {
        $workSchedule->delete();
        return redirect()->route('work-schedules.index')
            ->with('success', 'Escala excluída com sucesso.');
    }
}
