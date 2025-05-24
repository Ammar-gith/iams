@extends('layouts.masterVertical')
@push('style')
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
                    <a href="">Offices</a>
                </li>

                <li class="breadcrumb-item active text-success">Edit Office</li>
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
                        <li class="fa fa-align-justify"></li> Edit Office
                    </h5>
                </div>
                <hr>
                <form action="{{ route('office.update', $office->id) }}" method="POST" class="card-body"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Office Name --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-12">
                            <label class=" col-form-label text-sm-end" for="name">Name</label>
                            <input type="text" name="name" id="alignment-name" class="form-control" required
                                value="{{ $office->name }}" />
                        </div>
                        @error('name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Office category --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            <label class="col-form-label text-sm-start" for="name">Category</label>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label text-sm-start" for="name">Status</label>
                        </div>
                    </div>
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            @foreach ($office_categories as $office_category)
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="office_category_{{ $office_category->id }}"
                                        name="office_category_id" value="{{ $office_category->id }}"
                                        class="form-check-input "
                                        {{ $selected_category == $office_category->id ? 'checked' : '' }}>
                                    <label class="form-check-label " for="office_category_{{ $office_category->id }}">
                                        {{ $office_category->title }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('office_category_id')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        {{-- </div> --}}

                        {{-- Office status --}}
                        {{-- <div class="row mb-3 mx-5  "> --}}
                        <div class="col-sm-6">
                            @foreach ($statuses as $status)
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="status_{{ $status->id }}" name="status_id"
                                        value="{{ $status->id }}" class="form-check-input"
                                        {{ $selected_status == $status->id ? 'checked' : '' }}>
                                    <label class="form-check-label " for="status_{{ $status->id }}">
                                        {{ $status->title }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('status_id')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Departments --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-start" for="name">Departments</label>
                            <select id="department_id" name="department_id" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="">Select department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $selected_department == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('department_id')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        {{-- </div> --}}


                        {{-- Districts --}}
                        {{-- <div class="row mb-3 mx-5  "> --}}
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-start" for="name">Districts</label>
                            <select id="district_id" name="district_id" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select district</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $selected_district == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('district_id')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Opening dues --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-end" for="opening_dues">Opening Dues</label>
                            <input type="text" name="opening_dues" id="alignment-opening_dues" class="form-control"
                                required value="{{ $office->opening_dues }}" />
                        </div>
                        @error('opening_dues')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        {{-- </div> --}}


                        {{-- Date of deactivation --}}
                        {{-- <div class="row mb-3 mx-5  "> --}}
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-end" for="deactivation_date">Deactivation Date</label>
                            <input type="date" name="deactivation_date" id="alignment-deactivation_date"
                                class="form-control" value="{{ $office->deactivation_date }}" />
                        </div>
                        @error('deactivation_date')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Add category button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="{{ route('office.index') }}" type="button" class="btn btn-secondary">Cancel</a>
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
