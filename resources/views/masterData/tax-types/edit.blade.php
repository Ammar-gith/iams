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
                    <a href="">Tax Types</a>
                </li>

                <li class="breadcrumb-item active text-success">Edit Tax Type</li>
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
                        <li class="fa fa-align-justify"></li> Edit Tax Type
                    </h5>
                </div>
                <hr>
                <form action="{{ route('taxType.update', $taxType->id) }}" method="POST" class="card-body"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Tax Type Description --}}
                    <div class="row mb-3 mx-5 ">
                        <div class="col-sm-6">
                            <label class="col-form-label text-sm-end" for="description">Description</label>
                            <input type="text" name="description" id="alignment-username" class="form-control"
                                value="{{ $taxType->description }}" />
                        </div>
                        @error('description')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tax Type Ratio --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-end" for="ratio">Ratio ( % )</label>
                            <input type="text" name="ratio" id="alignment-username" class="form-control"
                                value="{{ $taxType->ratio }}" />
                        </div>
                        @error('ratio')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr class="my-4 mx-1">
                    {{-- Add Tax Type button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="" type="button" class="btn btn-secondary">Cancel</a>
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
