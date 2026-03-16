<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffMemberController extends Controller
{
    public function index()
    {
        $staffMembers = User::withCount([
                'assignedOrders',
                'staffShifts',
                'staffShifts as upcoming_shifts_count' => fn ($query) => $query->whereDate('shift_date', '>=', today()),
            ])
            ->orderBy('name')
            ->paginate(10);

        return view('staff-members.index', compact('staffMembers'));
    }

    public function create()
    {
        return view('staff-members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|string|max:100',
            'wage' => 'nullable|numeric|min:0|max:99999.99',
            'hire_date' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create($validated);

        return redirect()->route('staff-members.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(User $staff_member)
    {
        return view('staff-members.edit', ['staffMember' => $staff_member]);
    }

    public function update(Request $request, User $staff_member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $staff_member->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|string|max:100',
            'wage' => 'nullable|numeric|min:0|max:99999.99',
            'hire_date' => 'nullable|date',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $staff_member->update($validated);

        return redirect()->route('staff-members.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(User $staff_member)
    {
        $staff_member->delete();

        return redirect()->route('staff-members.index')->with('success', 'Staff member deleted successfully.');
    }
}
