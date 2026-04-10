@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">General Settings</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('admin.settings.general.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <h5 class="mb-3">Site Information</h5>
                            <div class="mb-3">
                                <label class="form-label">Site Title</label>
                                <input type="text" name="site_title" class="form-control"
                                    value="{{ $settings->site_title }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Site Description</label>
                                <textarea name="site_description" class="form-control"
                                    rows="2">{{ $settings->site_description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                @if($settings->logo)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings->logo) }}" height="50">
                                    </div>
                                @endif
                                <input type="file" name="logo" class="form-control">
                            </div>

                            <hr>
                            <h5 class="mb-3">Hero Section</h5>
                            <div class="mb-3">
                                <label class="form-label">Hero Title</label>
                                <input type="text" name="hero_title" class="form-control"
                                    value="{{ $settings->hero_title }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hero Description</label>
                                <textarea name="hero_description" class="form-control"
                                    rows="3">{{ $settings->hero_description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hero Image</label>
                                @if($settings->hero_image)
                                    <div class="mb-2">
                                        <img src="{{ Str::startsWith($settings->hero_image, 'http') ? $settings->hero_image : Storage::url($settings->hero_image) }}"
                                            height="100" class="rounded">
                                    </div>
                                @endif
                                <input type="file" name="hero_image" class="form-control">
                            </div>

                            <hr>
                            <h5 class="mb-3">Contact Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $settings->email }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $settings->phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ $settings->address }}</textarea>
                            </div>

                            <hr>
                            <h5 class="mb-3">MD Message Page Settings</h5>
                            <div class="mb-3">
                                <label class="form-label">MD Name</label>
                                <input type="text" name="md_name" class="form-control" value="{{ $settings->md_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message from MD</label>
                                <textarea name="md_message" class="form-control" rows="5">{{ $settings->md_message }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">MD Signature Image</label>
                                @if($settings->signature)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings->signature) }}" height="50">
                                    </div>
                                @endif
                                <input type="file" name="signature" class="form-control">
                            </div>

                            <hr>
                            <h5 class="mb-3">Footer Text</h5>
                            <div class="mb-3">
                                <input type="text" name="footer_text" class="form-control"
                                    value="{{ $settings->footer_text }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection