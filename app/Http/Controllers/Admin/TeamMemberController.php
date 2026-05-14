<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'order' => 'integer',
            'active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $data['active'] = $request->has('active');
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team Member added successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'order' => 'integer',
            'active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($team->image && !str_starts_with($team->image, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $data['active'] = $request->has('active');
        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team Member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->image && !str_starts_with($team->image, 'http')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($team->image);
        }
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team Member deleted successfully.');
    }
}
