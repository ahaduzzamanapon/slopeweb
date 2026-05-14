<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'completion_date' => 'nullable|date',
            'technologies' => 'nullable|string', // Comma separated
            'active' => 'boolean',
            'order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['active'] = $request->has('active');
        
        if ($request->technologies) {
            $data['technologies'] = array_map('trim', explode(',', $request->technologies));
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'completion_date' => 'nullable|date',
            'technologies' => 'nullable|string',
            'active' => 'boolean',
            'order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['active'] = $request->has('active');
        
        if ($request->technologies) {
            $data['technologies'] = array_map('trim', explode(',', $request->technologies));
        }

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
        $project->delete();
        return back()->with('success', 'Project deleted successfully.');
    }
}
