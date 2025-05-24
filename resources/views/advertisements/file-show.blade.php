@extends('layouts.masterVertical')

{{-- Custom css goes here --}}
@push('style')
    <style>
        .form-header {
            justify-content: space-between;
            align-items: center;
            background-color: #397F67;
            padding: 1rem 2rem;

            border-radius: 18px 18px 0 0;
        }
    </style>
@endpush



@push('content')
    {{-- Breadcrumb items array --}}
    @php
        // Inside View
        $breadcrumbs = [
            ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
            ['label' => 'View Ads', 'url' => null], // The current page has no URL
        ];

    @endphp
    {{-- <div class="container"> --}}
    {{-- Breadcrumb --}}
    <x-breadcrumb :items="$breadcrumbs" />

    {{-- Page Content --}}
    <div class="flex-grow-1 mb-4">
        <div class="row">
            {{-- Ads --}}
            {{-- <div class="container" style="padding: 0 !important;"> --}}
            <div class="form-header flex w-full">
                <h4 class="h5-reset-margin text-white">View File</h4>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        {{--  View file  --}}
                        <div class="row mb-3  ">
                            <div class="col-sm-6">
                                <img src="{{ $file_image->getUrl() }}" alt="file-image" class="img-fluid">
                            </div>
                            <div class="col-sm-6">
                                <label style="font-weight: 700;" class="form-label m-3 text-danger" for="">File
                                    Details</label>
                                <ol>
                                    <li>Collection Name: {{ $file_image->collection_name }}</li>
                                    <li>Name: {{ $file_image->name }}</li>
                                    <li>Mime Type: {{ $file_image->mime_type }}</li>
                                    <li>Size: {{ $file_image->human_readable_size }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
