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
            @php
                $user = Auth::user();
            @endphp
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>INF Number</th>
                        <th>Memo No</th>
                        <th>Memo Date</th>
                        <th>Office</th>
                        <th>Publication Date</th>
                        <th>Category</th>
                        @if (!$user->hasRole('Client Office'))
                            <th>No. of Lines</th>
                        @endif
                        <th>Ad Created by</th>
                        <th>Status</th>
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
                            <td>{{ $advertisement->inf_number }}</td>
                            <td>{{ $advertisement->memo_number }}</td>
                            <td>{{ Carbon::parse($advertisement->memo_date)->toFormattedDateString() }}</td>
                            <td>{{ $advertisement->office->name }}</td>
                            <!-- Directly use the Carbon instance -->
                            <td>{{ Carbon::parse($advertisement->publish_on_or_before)->toFormattedDateString() }}</td>
                            <td>{{ $advertisement->category->title }}</td>
                            @if (!$user->hasRole('Client Office'))
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
                                    'Pending' => 'bg-info',
                                    'Rejected' => 'bg-danger',
                                    'Draft' => 'bg-secondary',
                                    'In progress' => 'bg-warning',
                                ];
                                $class = $statusClasses[$advertisement->status->title] ?? 'bg-secondary'; // Default class
                            @endphp
                            @if (
                                $user->hasAnyRole(['Diary Dispatch', 'Superintendent', 'Deputy Director', 'Director General']) &&
                                    ($advertisement->forwarded_by_role_id == 9 && $advertisement->forwarded_to_role_id == 4))
                                <td> <span class="badge rounded-pill bg-info">Sent to media
                                    </span>
                                </td>
                            @else
                                <td> <span
                                        class="badge rounded-pill {{ $class }}">{{ $advertisement->status->title }}
                                    </span>
                                </td>
                            @endif
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
                                        {{-- @if ($user->hasAnyRole('Deputy Director', 'Superintendent'))
                                            <a class="dropdown-item"
                                                href="{{ route('advertisements.edit', $advertisement->id) }}">
                                                <i class='bx bx-cog me-1'></i>
                                                Process Ad
                                            </a>
                                        @endif --}}


                                        @if (
                                            $user->hasRole('Diary Dispatch') &&
                                                (($advertisement->forwarded_by_role_id == 10 && $advertisement->forwarded_to_role_id == 9) ||
                                                    ($advertisement->forwarded_by_role_id == 11 && $advertisement->forwarded_to_role_id == 9)))
                                            <form action="{{ route('advertisement.media', $advertisement->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class='bx bx-cog me-1'></i> Forward to Media
                                                </button>
                                            </form>
                                        @endif
                                        <a class="dropdown-item" href="">
                                            <i class="bx bx-show-alt me-1"></i>
                                            Tracking Ad
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
