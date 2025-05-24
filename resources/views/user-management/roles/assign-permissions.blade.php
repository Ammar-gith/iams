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
                    <a href="">User Management</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="">Roles</a>
                </li>

                <li class="breadcrumb-item active text-success">Assign Permissions</li>
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
                        <li class="fa fa-align-justify"></li> Role: {{ $role->name }}
                    </h5>
                </div>
                <hr>
                <form action="{{ route('role.assignPermission', $role->id) }}" method="POST" class="card-body"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Permission Name --}}
                    <div class="row mb-3 mx-5  ">
                        <label class="col-form-label text-sm-start fw-bold fs-5 mb-3" for="permission">Permissions</label>
                        @foreach ($permissions as $permission)
                            <div class="col-sm-4 mb-3">
                                <input class="form-check-input " type="checkbox" name="permissions[]"
                                    id="alignment-permission" value="{{ $permission->name }}"
                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                {{ $permission->name }}
                            </div>
                        @endforeach

                        @error('"permission')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Add Role button --}}
                    <div class="card-footer col-md-12 d-flex justify-content-end align-items-center g-5">
                        <a href="{{ route('role.index') }}" type="button" class="btn btn-secondary">Cancel</a>
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
