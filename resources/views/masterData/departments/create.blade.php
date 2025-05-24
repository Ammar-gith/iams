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
                    <a href="">Departments</a>
                </li>

                <li class="breadcrumb-item active text-success">New Department</li>
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
                        <li class="fa fa-align-justify"></li> New Department
                    </h5>
                </div>
                <hr>
                <form action="{{ route('department.store') }}" method="POST" class="card-body"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- department Name --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-12">
                            <label class=" col-form-label text-sm-end" for="name">Name</label>
                            <input type="text" name="name" id="alignment-name" class="form-control" required
                                placeholder="Enter language name..." />
                        </div>
                        @error('name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Department category --}}
                    <div class="row mb-3 mx-5  ">
                        <label class="col-form-label text-sm-start" for="category_id">Category</label>
                        <div class="col-sm-12">
                            @foreach ($department_categories as $department_category)
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="department_category_{{ $department_category->id }}"
                                        name="category_id" value="{{ $department_category->id }}" class="form-check-input ">
                                    <label class="form-check-label "
                                        for="department_category_{{ $department_category->id }}">
                                        {{ $department_category->title }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('department_category_id')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{--  status --}}
                    <div class="row mb-3 mx-5  ">
                        <label class="col-form-label text-sm-start" for="name">Status</label>
                        <div class="col-sm-12">
                            @foreach ($department_statuses as $key => $value)
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="department_statuses{{ $key }}" name="status_id"
                                        value="{{ $key }}" class="form-check-input ">
                                    <label class="form-check-label " for="department_statuses{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('status_id')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Add category button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="{{ route('department.index') }}" type="button" class="btn btn-secondary">Cancel</a>
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
