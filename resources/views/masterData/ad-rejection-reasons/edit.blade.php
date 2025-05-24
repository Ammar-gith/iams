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
                    <a href="">Ad Rejection Reasons</a>
                </li>

                <li class="breadcrumb-item active text-success">Edit Ad Rejection Reason</li>
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
                        <li class="fa fa-align-justify"></li> Edit Ad Rejection Reason
                    </h5>
                </div>
                <hr>
                <form action="{{ route('adRejectionReason.update', $ad_rejection_reason->id) }}" method="POST"
                    class="card-body" enctype="multipart/form-data">

                    @csrf

                    {{-- description  --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" class="form-control" id="collapsible-address" rows="2">{{ $ad_rejection_reason->description }}</textarea>
                        </div>
                        @error('description')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr class="my-4 mx-1">
                    {{-- Add rejection reason button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="{{ route('adRejectionReason.index') }}" type="button" class="btn btn-secondary">Cancel</a>
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
