<?php

namespace App\Http\Controllers;

use App\Models\StaffShift;
use App\Models\User;
use Illuminate\Http\Request;

class StaffShiftController extends Controller
{
    public function index()
    {
        $staffShifts = StaffShift::with('staffMember')
            ->orderByDesc('shift_date')
            ->orderBy('start_time')
            ->paginate(10);

        return view('staff-shifts.index', compact('staffShifts'));
    }

    public function create()
    {
        $staffMembers = User::orderBy('name')->get();

        return view('staff-shifts.create', compact('staffMembers'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateShift($request);

        StaffShift::create($validated);

        return redirect()->route('staff-shifts.index')->with('success', 'Staff shift scheduled successfully.');
    }

    public function edit(StaffShift $staff_shift)
    {
        $staffMembers = User::orderBy('name')->get();

        return view('staff-shifts.edit', ['staffShift' => $staff_shift, 'staffMembers' => $staffMembers]);
    }

    public function update(Request $request, StaffShift $staff_shift)
    {
        $validated = $this->validateShift($request);

        $staff_shift->update($validated);

        return redirect()->route('staff-shifts.index')->with('success', 'Staff shift updated successfully.');
    }

    public function destroy(StaffShift $staff_shift)
    {
        $staff_shift->delete();

        return redirect()->route('staff-shifts.index')->with('success', 'Staff shift deleted successfully.');
    }

    private function validateShift(Request $request): array
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'shift_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'section' => 'nullable|string|max:100',
            'status' => 'required|in:scheduled,in-progress,completed,off',
            'notes' => 'nullable|string|max:500',
        ]);
    }
}
