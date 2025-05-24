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
                    <a href="">Ad Worth Parameters</a>
                </li>

                <li class="breadcrumb-item active text-success">Edit Ad Worth Parameter</li>
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
                        <li class="fa fa-align-justify"></li> Edit Ad Worth Parameter
                    </h5>
                </div>
                <hr>
                <form action="{{ route('adWorthParameter.update', $ad_worth_parameter->id) }}" method="POST"
                    class="card-body" enctype="multipart/form-data">

                    @csrf
                    <div class="row mb-3 mx-5 ">
                        {{-- Ad Worth Parameter range --}}
                        <div class="col-sm-6">
                            <label class="col-form-label text-sm-end" for="range">Range</label>
                            <input type="text" name="range" id="alignment-range" class="form-control"
                                value="{{ $ad_worth_parameter->range }}" />
                        </div>
                        @error('range')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Ad Worth Parameter Formula --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-end" for="formula">Distribution Formula</label>
                            <input type="text" name="formula" id="alignment-formula" class="form-control"
                                value="{{ $ad_worth_parameter->formula }}" />
                        </div>
                        @error('formula')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr class="my-4 mx-1">
                    {{-- Ad Worth parameter button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="{{ route('adWorthParameter.index') }}" type="button" class="btn btn-secondary">Cancel</a>
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
