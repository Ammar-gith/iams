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
                    <a href="">Newspaper Position & Rate</a>
                </li>

                <li class="breadcrumb-item active text-success">New Position & Rate</li>
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
                        <li class="fa fa-align-justify"></li> New Position & Rate
                    </h5>
                </div>
                <hr>
                <form action="{{ route('newsPosRate.store') }}" method="POST" class="card-body"
                    enctype="multipart/form-data">
                    @csrf


                    {{-- Newspaper position --}}
                    <div class="row mb-3 mx-5 ">
                        <div class="col-sm-6">
                            <label class="col-form-label text-sm-end" for="position">Positions</label>
                            <input type="text" name="position" id="alignment-position" class="form-control" required
                                placeholder="Enter position..." />
                        </div>
                        @error('position')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Newspaper rate --}}
                    <div class="row mb-3 mx-5  ">
                        <div class="col-sm-6">
                            <label class=" col-form-label text-sm-end" for="rates">Rate</label>
                            <input type="text" name="rates" id="alignment-rates" class="form-control" required
                                placeholder="Enter newspaper rates..." />
                        </div>
                        @error('rates')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Add newspaper position and rate button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="{{ route('newsPosRate.index') }}" type="button" class="btn btn-secondary">Cancel</a>
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
