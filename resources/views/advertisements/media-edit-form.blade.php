@extends('layouts.masterVertical')

{{-- Custom css goes here --}}
@push('style')
    <style>
        :root {
            --blue: #1e90ff;
            --white: #ffffff;
        }

        .flex {
            display: flex;
        }

        .form-header {
            justify-content: space-between;
            align-items: center;
            background-color: #397F67;
            padding: .8rem 3.5rem;
            border-radius: 18px 18px 0 0;
        }

        .form-header-content {
            flex-direction: row;
            align-items: center;
            column-gap: .4rem;
            background-color: #2C6350;
            padding: .6rem .8rem;
            border-radius: .5rem;
        }

        .inf-no {
            /* width: 1ch; Initial size */
            width: 6rem !important;
            outline: 0;
            padding: .4rem .3rem;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: .25rem;
            /* background-color: #DDAE37; */
            color: #4a4a4a;
            transition: width 0.2s ease;
        }

        .h5-reset-margin {
            margin: 0 !important;
            color: #f5f5f5 !important;
        }

        .h5-reset-margin span {
            font-size: 1rem;
        }

        .form-body {
            flex-direction: column;
            row-gap: 1rem;
            padding: 2rem 3.5rem 1rem;
        }

        .form-body div {
            margin-top: 0 !important;
        }

        .form-label-x {
            font-size: 1rem;
            color: #5c5c5c;
            text-transform: capitalize;
            margin-bottom: .25rem;
        }

        .my-h6 {
            margin-bottom: .6rem !important;
        }

        .h6-design {
            padding: .5rem;
            border-radius: .25rem;
            background-color: #FFF0D8;
            width: calc(100% - 16px) !important;
            margin: 16px 8px .6rem 8px !important;
        }

        .h6-design span {
            font-weight: bold;
            padding-left: .25rem;
        }

        .custom-icon {
            background-color: #ffc362;
            padding: .4rem;
            border-radius: .125rem;
        }

        .buttons-div {
            flex-direction: row-reverse;
            column-gap: .6rem;
            padding: .8rem 3.5rem;
            border-radius: 0 0 9px 9px;
            background-color: #D1D6D4;
        }

        .custom-primary-buttom {
            background-color: #00845c;
            color: #f5f5f5;
            outline: none;
            border: none;
            border-radius: 2rem;
            padding: .6rem 1.4rem;
        }

        .custom-secondary-buttom {
            background-color: #fefefe;
            color: #313131;
            outline: none;
            border: .15rem solid #0FA577;
            border-radius: 1.6rem;
            padding: .6rem 1.4rem;
        }

        .custom-tertiary-buttom {
            background-color: #fefefe;
            color: #262626;
            outline: none;
            border: .15rem solid #DDAE37;
            border-radius: 1.6rem;
            padding: .6rem 1.4rem;
        }

        .custom-primary-buttom:hover {
            background-color: #0FA577;
            color: #fefefe;
        }

        .custom-secondary-buttom:hover {
            background-color: #00845c;
            color: #f5f5f5;
            border-color: #00845c;
        }

        .financials-div {
            background-color: #f1f1f1;
            padding: 1rem 3.5rem;
        }

        .custom-alignment input {
            border: none;
            border-radius: 6px;
            padding: .4rem 0;
        }

        .custom-alignment input:focus {
            outline: none;
            border: none;
            box-shadow: none;
        }

        .some {
            padding: 1rem;
            flex-direction: row;
            align-items: center;
            justify-content: space-evenly;
            border-radius: 10px;
        }

        .l-green {
            color: #246A44;
        }

        .l-red {
            color: #C44747;
        }

        .custom-alignment:nth-child(1) .some {
            background-color: #C7E6DB;
            border: 1px solid #3CAF70;
        }

        .custom-alignment:nth-child(2) .some {
            background-color: #EBC1C1;
            border: 1px solid #C44747;
        }

        .some label {
            font-weight: bold;
        }

        /* File upload CSS */
        .file-upload {
            padding: 30px;
            border: 2px dashed #d9d9d9;
            border-radius: 10px;
            background-color: #f6f6f6;
            text-align: center;
            position: relative;
            transition: border-color 0.3s;
        }

        .file-upload:hover {
            border-color: #007BFF;
        }

        .bx-cloud-upload {
            font-size: 2rem;
            color: #747474;
            margin-bottom: 1rem;
            border-radius: 6px;
            padding: 6px;
            background-color: #ffffff;
        }

        .file-upload h3 {
            font-size: 18px;
            font-weight: normal;
            color: #555555;
            margin: 0;
        }

        .file-upload p {
            font-size: 14px;
            color: #777777;
            margin: 10px 0 20px;
        }

        .file-upload .file-label {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #007BFF;
            background-color: #ffffff;
            border: 2px solid #007BFF;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload .file-label:hover {
            background-color: #007BFF;
            color: #ffffff;
        }

        .file-upload input[type="file"] {
            display: none;
        }
    </style>
@endpush

{{-- Breadcrumb items array --}}
@php
    $breadcrumbs = [
        ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
        ['label' => 'Media Edit Form', 'url' => null], // The current page has no URL
    ];
@endphp

@push('content')
    <div class="container">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="$breadcrumbs" />

        {{-- Page Content --}}
        <div class="flex-grow-1 mb-4">
            <div class="row">
                {{-- Media Edit Form --}}
                <div class="card" style="padding-inline: 0; border-radius: 18px 18px 9px 9px;">
                    <form method="POST" action="{{ route('advertisements.update', $advertisement->id) }}"
                        enctype="multipart/form-data" class="card-body" style="padding: 0;">
                        @csrf

                        {{-- Title (Header) --}}
                        <div class="form-header flex w-full">
                            <h4 class="h5-reset-margin">Media Edit Form</span></h4>
                        </div>

                        {{-- Advertisement Form --}}
                        <div class="form-body flex">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="row g-2">
                                        {{-- Invoice Number --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="invoice-no">Invoice Number</label>
                                            <input type="text" id="invoice-no" class="form-control" name="" />
                                        </div>

                                        {{-- Publication Status --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x">Select Publication Status</label>
                                            <br />

                                            <input type="radio" id="radio-published" name="mediaType" value="published">
                                            <label for="radio-published">Published</label>

                                            <input type="radio" id="radio-unpublished" name="mediaType"
                                                value="unpublished">
                                            <label for="radio-unpublished">Unpublished</label>
                                        </div>

                                        {{-- Original Size --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="original-size">Original Size</label>
                                            <input type="text" id="original-size" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Rate --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="rate">Rate</label>
                                            <input type="text" id="rate" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Original Insertions --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="original-insertions">Original
                                                Insertions</label>
                                            <input type="text" id="original-insertions" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Estimated Cost --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="estimated-cost">Estimated Cost</label>
                                            <input type="text" id="estimated-cost" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- KPRA Tax --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="kpra-tax">KPRA Tax</label>
                                            <input type="text" id="kpra-tax" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Press Cutting --}}
                                        <div class="col-md-12">
                                            <label class="form-label-x" for="kpra-tax">Press Cutting</label>
                                            <input type="file" id="kpra-tax" class="form-control"
                                                name="press_cutting_image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row g-1">
                                        {{-- Invoice Date --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="invoice-date">Invoice Date</label>
                                            <input type="date" id="invoice-date" class="form-control" />
                                        </div>

                                        {{-- Publication Date --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="publication-date">Publication Date</label>
                                            <input type="date" id="publication-date" class="form-control" />
                                        </div>

                                        {{-- Printed Size (cm) --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="printe-size">Printed Size
                                                &lpar;cm&rpar;</label>
                                            <input type="text" id="printe-size" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Printed Rate --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="printed-rate">Printed Rate</label>
                                            <input type="text" id="printed-rate" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Printed Insertions --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="printed-insertions">Printed
                                                Insertions</label>
                                            <input type="text" id="printed-insertions" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Bill Cost --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="bill-cost">Bill Cost</label>
                                            <input type="text" id="bill-cost" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Total Bill --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label-x" for="total-bill">Total Bill</label>
                                            <input type="text" id="total-bill" class="form-control"
                                                value="{{ $advertisement->memo_number }}" readonly />
                                        </div>

                                        {{-- Scanned bill --}}
                                        <div class="col-md-12">
                                            <label class="form-label-x" for="total-bill">Scanned bill</label>
                                            <input type="file" id="total-bill" class="form-control"
                                                name="scanned_bill_image" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="buttons-div flex">
                            {{-- Forward Ad --}}
                            <button type="submit" name="action" value="publish" class="custom-primary-buttom">Publish
                                Ad</button>

                            {{-- Reject Ad --}}
                            <button type="submit" name="action" value="un-publish"
                                class="custom-secondary-buttom">Unpublish</button>
                        </div>
                    </form>
                </div>
                {{-- ! / Ad Form --}}
            </div>
        </div>
        {{-- ! / Page Content --}}
    </div>

    {{-- Custom JavaScript --}}
    {{-- // write here... --}}
@endpush

@push('scripts')
@endpush
