<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('frontend.pages.about');
    }

    public function team()
    {
        return view('frontend.pages.team');
    }

    public function clients()
    {
        return view('frontend.pages.clients');
    }

    public function branches()
    {
        return view('frontend.pages.branches');
    }

    public function mdMessage()
    {
        return view('frontend.pages.md_message');
    }

    public function services()
    {
        $services = \App\Models\Service::where('active', true)->orderBy('order')->get();
        return view('frontend.pages.services', compact('services'));
    }

    public function projects()
    {
        $projects = \App\Models\Project::where('active', true)->orderBy('order')->get();
        return view('frontend.pages.projects', compact('projects'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function contactPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Contact::create($validated);

        return back()->with('success', 'Thank you! We will get back to you soon.');
    }
}
