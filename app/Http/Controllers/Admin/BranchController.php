<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('order')->paginate(10);
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone'   => 'nullable|string|max:50',
            'email'   => 'nullable|email|max:255',
            'logo'    => 'nullable|image|max:2048',
            'order'   => 'nullable|integer',
            'active'  => 'nullable|boolean',
        ]);

        $data['active'] = $request->has('active');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('branches', 'public');
        }

        Branch::create($data);
        return redirect()->route('admin.branches.index')->with('success', 'Branch added successfully.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone'   => 'nullable|string|max:50',
            'email'   => 'nullable|email|max:255',
            'logo'    => 'nullable|image|max:2048',
            'order'   => 'nullable|integer',
            'active'  => 'nullable|boolean',
        ]);

        $data['active'] = $request->has('active');

        if ($request->hasFile('logo')) {
            if ($branch->logo) {
                Storage::disk('public')->delete($branch->logo);
            }
            $data['logo'] = $request->file('logo')->store('branches', 'public');
        }

        $branch->update($data);
        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->logo) {
            Storage::disk('public')->delete($branch->logo);
        }
        $branch->delete();
        return back()->with('success', 'Branch deleted successfully.');
    }
}
