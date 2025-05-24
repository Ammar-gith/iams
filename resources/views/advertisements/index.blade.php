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
        ['label' => 'New Ads', 'url' => null], // The current page has no URL
    ];

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
                <h4 class="h5-reset-margin">Advertisements List</h4>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Get the authenticated logged in user --}}
            @php
                $user = Auth::User();
            @endphp
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S. No.</th>
                        @if (!$user->hasRole('Diary Dispatch'))
                            @can('view inf number')
                                <th>INF Number</th>
                            @endcan
                        @endif
                        <th>Office</th>
                        @if ($user->hasAnyRole(['Diary Dispatch', 'Client Office', 'Media']))
                            <th>Memo No</th>
                            <th>Memo Date</th>
                        @endif

                        <th>Category</th>
                        <th>Publication Date</th>
                        @if (!$user->hasRole('Diary Dispatch') && !$user->hasRole('Client Office'))
                            <th>No. of Lines</th>
                        @endif
                        <th>Ad created by</th>
                        @if (!$user->hasRole('Media'))
                            <th>Status</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        use Carbon\Carbon; // Move this import outside of the loop
                    @endphp
                    @foreach ($advertisements as $key => $advertisement)
                        <tr>
                            <td>{{ ++$key }}</td> <!-- Serial Number -->
                            @if (!$user->hasRole('Diary Dispatch'))
                                @can('view inf number')
                                    <td>{{ $advertisement->inf_number }}</td>
                                @endcan
                            @endif
                            <td>{{ $advertisement->office->name }}</td>
                            @if ($user->hasAnyRole(['Diary Dispatch', 'Client Office', 'Media']))
                                <td>{{ $advertisement->memo_number }}</td>
                                <td>{{ Carbon::parse($advertisement->memo_date)->toFormattedDateString() }}</td>
                            @endif

                            <td>{{ $advertisement->category->title }}</td>
                            <!-- Directly use the Carbon instance -->
                            <td>{{ Carbon::parse($advertisement->publish_on_or_before)->toFormattedDateString() }}</td>
                            @if (!$user->hasRole('Diary Dispatch') && !$user->hasRole('Client Office'))
                                <td class="text-center">
                                    <span class="d-block">Eng. = {{ $advertisement->english_lines }}</span>
                                    <span class="d-block">Urdu = {{ $advertisement->urdu_lines }}</span>
                                </td>
                            @endif
                            <td>{{ $advertisement->user->name }}</td>
                            @php
                                $statusClasses = [
                                    'New' => 'bg-success',
                                    'Approved' => 'bg-primary',
                                    'forwarded by DD' => 'bg-warning',
                                    'Rejected' => 'bg-danger',
                                    'Draft' => 'bg-label-secondary',
                                    'In progress' => 'bg-info',
                                ];
                                $class = $statusClasses[$advertisement->status->title] ?? 'bg-secondary'; // Default class
                            @endphp
                            <td>
                                @if ($user->hasRole('Superintendent'))
                                    <span class="badge rounded-pill {{ $class }}">Forwarded by diary</span>
                                @elseif ($user->hasRole('Deputy Director') && $advertisement->status->title == 'In progress')
                                    <span class="badge rounded-pill bg-info">In progress / DG Approval</span>
                                @elseif ($user->hasRole('Director General') && $advertisement->status->title == 'In progress')
                                    <span class="badge rounded-pill bg-info">forwarded by DD</span>
                                @else
                                    @if (!$user->hasRole('Media'))
                                        <span
                                            class="badge rounded-pill {{ $class }}">{{ $advertisement->status->title ?? '' }}</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>


                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('advertisements.show', $advertisement->id) }}">
                                            <i class="bx bx-show-alt me-1"></i>
                                            View Ad
                                        </a>

                                        @can('view process action')
                                            <a class="dropdown-item"
                                                href="{{ route('advertisements.edit', $advertisement->id) }}">
                                                <i class='bx bx-cog me-1'></i>
                                                Edit Ad
                                            </a>
                                        @endcan

                                        @can('view media form edit action')
                                            <a class="dropdown-item"
                                                href="{{ route('advertisements.media-edit-form', $advertisement->id) }}">
                                                <i class='bx bx-cog me-1'></i>
                                                Edit Ad
                                            </a>
                                        @endcan

                                        <a class="dropdown-item"
                                            href="{{ route('advertisements.track-ad', $advertisement->id) }}">
                                            <i class='bx bx-trip'></i>
                                            Track Ad
                                        </a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $advertisements->links() }}
            {{-- </div> --}}
            {{-- ! / Ads --}}
        </div>
    </div>
    {{-- ! / Page Content --}}
    {{-- </div> --}}
@endpush
