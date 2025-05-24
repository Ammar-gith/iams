@extends('layouts.masterVertical')
@push('style')
    {{-- <style>
        input[type="radio"]:checked+label {
            background-color: #14A44D;
            /* Change this to your primary color */
            color: #fff;
            border-color: #14A44D;
        }

        input[type="radio"]+label {
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }
    </style> --}}
@endpush
@push('content')
    <!-- Dynamic Breadcrumb -->
    <div class="row">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="">Districts</a>
                </li>

                <li class="breadcrumb-item active text-success">New District</li>
            </ol>
        </nav>
    </div>
    <!--/ Dynamic Breadcrumb -->

    <!--Form -->
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header col-md-12 d-flex justify-content-between align-items-center">
                    <h5 class=" card-header  text-success">
                        <li class="fa fa-align-justify"></li> New District
                    </h5>
                </div>
                <hr>
                <form action="{{ route('district.store') }}" method="POST" class="card-body" enctype="multipart/form-data">
                    @csrf

                    {{-- District Name --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-end" for="name">Name</label>
                            <input type="text" name="name" id="alignment-name" class="form-control" required
                                placeholder="Enter district name..." />
                        </div>
                        @error('name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Province --}}
                    <div class="row mb-3 mx-5  ">
                        <label class=" col-form-label text-sm-start" for="name">Provinces</label>
                        <div class="col-sm-12">

                            {{-- <select id="province_id" name="province_id" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select> --}}
                            @foreach ($provinces as $province)
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="province_{{ $province->id }}" name="province_id"
                                        value="{{ $province->id }}" class="form-check-input ">
                                    <label class="form-check-label " for="province_{{ $province->id }}">
                                        {{ $province->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('province_id')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Add District button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="{{ route('district.index') }}" type="button" class="btn btn-secondary">Cancel</a>
                        &nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
@endpush
