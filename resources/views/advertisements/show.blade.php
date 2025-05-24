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

{{-- Breadcrumb items array --}}
@php
    // Inside View
    $breadcrumbs = [
        ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
        ['label' => 'View Ads', 'url' => null], // The current page has no URL
    ];

    // Inside Controller
    // $breadcrumbs = [
    //     ['label' => 'Dashboard', 'url' => route('dashboard')],
    //     ['label' => 'Master Data', 'url' => route('master-data')],
    //     ['label' => 'Division', 'url' => route('master-data/division')],
    //     ['label' => 'District', 'url' => null], // The current page (no URL)
    // ];
    // return view('your-view', ['breadcrumb' => $breadcrumbs]);

@endphp

@push('content')
    {{-- <div class="container"> --}}
    {{-- Breadcrumb --}}
    <x-breadcrumb :items="$breadcrumbs" />

    {{-- Page Content --}}
    <div class="flex-grow-1 mb-4">
        <div class="row">
            {{-- Ads --}}
            {{-- <div class="container" style="padding: 0 !important;"> --}}
            <div class="form-header flex w-full">
                <h4 class="h5-reset-margin text-white">View Advertisement Details</h4>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        {{--  Covering letter files --}}
                        <div class="row mb-3   ">
                            <div class="col-sm-4">
                                <label class="form-label-x mb-3" for="covering-letters">Covering Letter File</label>
                                <br>
                                @if ($covering_letter_files->isNotEmpty())
                                    @foreach ($covering_letter_files as $covering_letter_file)
                                        <a
                                            href="{{ route('advertisements.full-file-show', [$advertisement->id, $covering_letter_file->id]) }}">
                                            <img src="{{ $covering_letter_file->getUrl('thumb') }}" alt="Covering Letter"
                                                class="img-fluid"></a>
                                    @endforeach
                                @else
                                    <p>No covering letter uploaded.</p>
                                @endif


                            </div>

                            {{-- Urdu Ad files --}}
                            <div class="col-sm-4">
                                <label class="form-label-x mb-3" for="covering-letters">Urdu Ad File</label>
                                <br>
                                @if ($urdu_ad_files->isNotEmpty())
                                    @foreach ($urdu_ad_files as $urdu_ad_file)
                                        <a
                                            href="{{ route('advertisements.full-file-show', [$advertisement->id, $urdu_ad_file->id]) }}">
                                            <img src="{{ $urdu_ad_file->getUrl('thumb') }}" alt="Urdu Ad"
                                                class="img-fluid">

                                        </a>
                                    @endforeach
                                @else
                                    <p>No urdu ad uploaded.</p>
                                @endif

                            </div>

                            {{-- English Ad files --}}
                            <div class="col-sm-4">
                                <label class="form-label-x mb-3" for="covering-letters">English Ad File</label>
                                <br>
                                @if ($english_ad_files->isNotEmpty())
                                    @foreach ($english_ad_files as $english_ad_file)
                                        <a
                                            href="{{ route('advertisements.full-file-show', [$advertisement->id, $english_ad_file->id]) }}">
                                            <img src="{{ $english_ad_file->getUrl('thumb') }}" alt="English Ad"
                                                class="img-fluid"></a>
                                    @endforeach
                                @else
                                    <p>No english ad uploaded.</p>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
