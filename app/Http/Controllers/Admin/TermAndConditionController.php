<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermAndCondition;
use Illuminate\Http\Request;

class TermAndConditionController extends Controller
{
    public function index()
    {
        $terms = TermAndCondition::latest()->get();
        return view('admin.term_and_conditions.index', compact('terms'));
    }

    public function create()
    {
        return view('admin.term_and_conditions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data['is_active'] = $request->has('is_active');
        TermAndCondition::create($data);

        return redirect()->route('admin.terms-and-conditions.index')->with('success', 'Terms & Conditions created successfully.');
    }

    public function edit(TermAndCondition $terms_and_condition)
    {
        // Using explicit binding variable name based on the route
        return view('admin.term_and_conditions.edit', compact('terms_and_condition'));
    }

    public function update(Request $request, TermAndCondition $terms_and_condition)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data['is_active'] = $request->has('is_active');
        $terms_and_condition->update($data);

        return redirect()->route('admin.terms-and-conditions.index')->with('success', 'Terms & Conditions updated successfully.');
    }

    public function destroy(TermAndCondition $terms_and_condition)
    {
        $terms_and_condition->delete();
        return redirect()->route('admin.terms-and-conditions.index')->with('success', 'Terms & Conditions deleted successfully.');
    }
}
