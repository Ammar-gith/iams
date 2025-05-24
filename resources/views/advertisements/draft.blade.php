@extends('layouts.masterVertical')

{{-- Custom css goes here --}}
@push('style')
    <style>
        .flex {
            display: flex;
        }
        .form-header {
            justify-content: space-between;
            align-items: center;
            background-color: #397F67;
            padding: 1.4rem 3.5rem;
            border-radius: 18px 18px 0 0;
        }
        .h5-reset-margin {
            margin: 0 !important;
            color: #f5f5f5 !important;
        }
        table {
            background-color: #e3e3e3;
            /* border-radius: .5rem; */
            /* margin-inline: 13px; */
        }
        table tr th {
            text-transform: capitalize !important;
            font-size: .9rem !important;
            letter-spacing: 0 !important;
            font-weight: 600 !important;
            padding: .8rem 0 !important;
        }
        table tr td {
            padding: .4rem 0 !important;
            text-align: left !important;
        }
        table tr:first-child th,
        table tr td {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    </style>
@endpush

{{-- Breadcrumb items array --}}
@php
    // Inside View
    $breadcrumbs = [
        ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
        ['label' => 'Draft Ads', 'url' => null] // The current page has no URL
    ];
@endphp

@push('content')
    {{-- <div class="container"> --}}
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="$breadcrumbs" />

        {{-- Page Content --}}
        <div class="flex-grow-1 mb-4">
            <div class="row">
                {{-- INF Series --}}
                <div class="card custom-padding">
                    <div class="card-body">
                        <div class="row" style="margin-bottom: 2rem;">
                            <div class="row">
                                <h5 class="custom-heading-6">Draft Ads</h5>
                                @if($draftAds)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">S. No.</th>
                                                <th scrop="col">Department</th>
                                                <th scope="col">Office</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($draftAds as $key => $draftAd)
                                                <tr>
                                                    <td>{{ ++$key }}</td> <!-- Serial Number -->
                                                    <td>{{ $draftAd->user->name }}</td>
                                                    <td>{{ $draftAd->status->title}}</td>
                                                    <td><span class="badge rounded-pill bg-label-danger">{{ $draftAd->status->title }}</span></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="">
                                                                    <i class="bx bx-show-alt me-1"></i>
                                                                    View Ad
                                                                </a>
                                                                <a class="dropdown-item" href="">
                                                                    <i class="bx bx-edit-alt me-1"></i>
                                                                    Edit Ad
                                                                </a>
                                                                <a class="dropdown-item" href="">
                                                                    <i class='bx bx-cog me-1'></i>
                                                                    Process
                                                                </a>
                                                                <a class="dropdown-item" href="">
                                                                    <i class="bx bx-x me-1"></i>
                                                                    Cancell
                                                                </a>
                                                                <a class="dropdown-item" href="">
                                                                    <i class="bx bx-camera-off me-1"></i>
                                                                    Reject
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No draft ads found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{--! / INF Series --}}
            </div>
        </div>
        {{--! / Page Content --}}
    {{-- </div> --}}
@endpush
