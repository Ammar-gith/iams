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
    // Inside View
    $breadcrumbs = [
        ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
        ['label' => 'Create Ad', 'url' => null], // The current page has no URL
    ];

    // Inside Controller
    // $breadcrumbs = [
    //     ['label' => 'Dashboard', 'url' => route('dashboard')],
    //     ['label' => 'Master Data', 'url' => route('master-data')],
    //     ['label' => 'Division', 'url' => route('master-data/division')],
    //     ['label' => 'District', 'url' => null], // The current page (no URL)
    // ];
    // return view('your-view', ['breadcrumb' => $breadcrumbs]);

@endphp

@push('content')
    <div class="container">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="$breadcrumbs" />

        {{-- Page Content --}}
        <div class="flex-grow-1 mb-4">
            <div class="row">
                {{-- Ad Form --}}
                @php
                    $user = Auth::user();
                @endphp
                <div class="card" style="padding-inline: 0; border-radius: 18px 18px 9px 9px;">
                    <form method="POST" action="{{ route('advertisements.store') }}" enctype="multipart/form-data"
                        class="card-body" style="padding: 0;">
                        @csrf

                        {{-- Title (Header) --}}
                        <div class="form-header flex w-full">
                            <h4 class="h5-reset-margin">New Advertisement Form @if ($user->hasRole('Diary Dispatch'))
                                    <span>&lpar;Manual Receipt&rpar;</span>
                                @endif
                            </h4>
                            @can('view inf number')
                                <div class="form-header-content flex">
                                    <h6 class="h5-reset-margin">INF No.</h6>
                                    <input type="text" class="form-control inf-no" id="inf_number" name="inf_number"
                                        readonly>
                                    @can('view inf button')
                                        <button type="button" class="custom-secondary-buttom" id="assignInfButton">Assign
                                            INF</button>
                                    @endcan

                                </div>
                            @endcan
                        </div>

                        {{-- Hidden fields --}}
                        <input type="hidden" name="new_status" value="{{ $new_status }}">
                        <input type="hidden" name="inprogress_status" value="{{ $inprogress_status }}">
                        <input type="hidden" name="draft_status" value="{{ $draft_status }}">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        {{-- Advertisement Form --}}
                        <div class="form-body flex">
                            {{-- Memo No., Memo Date & Publication Date --}}
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label-x" for="memo-no">Memo No.</label>
                                    <input type="text" name="memo_number" id="memo-no" class="form-control"
                                        placeholder="1234" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-x" for="memo-date">Memo Date</label>
                                    <input type="date" name="memo_date" id="memo-date" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-x" for="pub-date">Publish on or Before</label>
                                    <input type="date" name="publish_on_or_before" id="pub-date" class="form-control" />
                                </div>
                            </div>

                            {{-- Department & Office --}}
                            <div class="row g-3">
                                {{-- Department --}}
                                <div class="col-md-6">
                                    <label class="form-label-x" for="department">Departments</label>
                                    <select id="department" name="department_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option>Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control inf-no" id="department" value="{{ $user->department }}" readonly> --}}
                                </div>

                                {{-- Office --}}
                                <div class="col-md-6">
                                    <label class="form-label-x" for="office">Office</label>
                                    <select id="office" name="office_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">Select Office</option>
                                    </select>
                                    {{-- <input type="text" class="form-control inf-no" id="office" value="{{ $user->office }}" readonly> --}}
                                </div>
                            </div>

                            {{-- Estimated Cost & Ad Category --}}
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label-x" for="estimated-cost">Estimated Cost</label>
                                    <select id="estimated-cost" name="ad_worth_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option>Select Estimated Cost</option>
                                        @foreach ($ad_worth_parameters as $ad_worth_parameter)
                                            <option value="{{ $ad_worth_parameter->id }}">{{ $ad_worth_parameter->range }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-x" for="category">Ad Category</label>
                                    <select id="category" name="ad_category_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option>Select Category</option>
                                        @foreach ($ad_categories as $ad_category)
                                            <option value="{{ $ad_category->id }}">{{ $ad_category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Number of lines (Urdu & English) --}}
                            @can('view lines')
                                <div class="row g-3">
                                    <h6 class="my-h6 fw-normal">Number of Lines in Advertisement &lpar;Urdu &amp; English&rpar;
                                    </h6>
                                    <div class="col-md-6">
                                        <label class="form-label-x" for="urdu-lines">Urdu lines</label>
                                        <input type="number" id="urdu-lines" name="english_lines" class="form-control"
                                            placeholder="12" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-x" for="eng-lines">English lines</label>
                                        <input type="number" id="eng-lines" name="urdu_lines" class="form-control"
                                            placeholder="12" />
                                    </div>
                                </div>
                            @endcan

                            {{-- Ad Size (Urdu & English) --}}
                            @can('view sizes')
                                <div class="row g-3">
                                    <h6 class="my-h6 fw-normal">Advertisement Size &lpar;Urdu &amp; English &rpar;</h6>
                                    <div class="col-md-6">
                                        <label class="form-label-x" for="urdu-size">Urdu size</label>
                                        <input type="number" id="urdu-size" name="urdu_size" class="form-control"
                                            placeholder="12" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-x" for="english_size">English size</label>
                                        <input type="number" id="english_size" name="english_size" class="form-control"
                                            placeholder="12" />
                                    </div>
                                </div>
                            @endcan


                            {{-- PDF Attachements --}}
                            <div class="row g-3">
                                <h6 class="my-h6 h6-design fw-normal"><i class="bx bx-bell custom-icon"></i>
                                    <span>Note:</span> Please upload Covering Letter and actual Advertisement in separate
                                    PDF files.
                                </h6>

                                {{-- File upload covering letter --}}
                                {{-- <div class="files-container col-sm-4">
                                    <label class=" col-form-label text-sm-end" for="covering_letter">Covering
                                        letter</label>
                                    <input type="file" name="covering_letter" id="alignment-covering_letter"
                                        class="form-control" />
                                </div> --}}
                                <div class="col-sm-4">
                                    <div id="app">
                                        <file-uploader :unlimited="true" collection="covering_letters"
                                            :tokens="{{ json_encode(old('covering_letters', [])) }}"
                                            label="Upload Covering Letter" notes="Supported types: jpeg, png,jpg,gif"
                                            accept="image/jpeg,image/png,image/jpg,image/gif"></file-uploader>
                                    </div>
                                </div>




                                {{-- File upload urdu ads --}}
                                {{-- <div class="files-container col-sm-4">
                                    <label class=" col-form-label text-sm-end" for="urdu_ad">Urdu pdf
                                    </label>
                                    <input type="file" name="urdu_ad" id="alignment-urdu_ad" class="form-control" />
                                </div> --}}
                                <div class="col-sm-4">
                                    <div id="app2">
                                        <file-uploader :unlimited="true" collection="urdu_ads"
                                            :tokens="{{ json_encode(old('urdu_ads', [])) }}" label="Upload Urdu Ads"
                                            notes="Supported types: jpeg, png,jpg,gif"
                                            accept="image/jpeg,image/png,image/jpg,image/gif"></file-uploader>
                                    </div>
                                </div>


                                {{-- File upload english ads --}}
                                {{-- <div class="files-container col-sm-4">
                                    <label class=" col-form-label text-sm-end" for="english_ad">English pdf
                                    </label>
                                    <input type="file" name="english_ad" id="alignment-english_ad"
                                        class="form-control" />
                                </div> --}}
                                <div class="col-sm-4">
                                    <div id="app3">
                                        <file-uploader :unlimited="true" collection="english_ads"
                                            :tokens="{{ json_encode(old('english_ads', [])) }}" label="Upload English Ads"
                                            notes="Supported types: jpeg, png,jpg,gif"
                                            accept="image/jpeg,image/png,image/jpg,image/gif"></file-uploader>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{--  billings and dues --}}
                        @can('view billings and dues')
                            <div class="financials-div">
                                <div class="row g-3">
                                    <div class="col-md-6 custom-alignment">
                                        <div class="some flex">
                                            <label class="form-label-x l-green" for="current-bill">Current Bill</label>
                                            <input type="text" id="current-bill" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6 custom-alignment">
                                        <div class="some flex">
                                            <label class="form-label-x l-red" for="previous-dues">Previous Dues</label>
                                            <input type="text" id="previous-dues" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        {{-- Buttons --}}
                        <div class="buttons-div flex">

                            {{-- Submit Ad --}}
                            <button type="submit" name="action" value="submit-ad" class="custom-primary-buttom">Submit
                                Ad</button>

                            {{-- Draft Ad --}}
                            <button type="submit" name="action" value="save-draft"
                                class="custom-secondary-buttom">Save as Draft</button>
                        </div>
                    </form>

                </div>
                {{-- ! / Ad Form --}}
            </div>
        </div>
        {{-- ! / Page Content --}}
    </div>

    {{-- Custom JavaScript --}}





@endpush
{{-- auto populate the offices data on the basis of selected department --}}


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-file-uploader"></script>
    <script>
        new Vue({
            el: '#app'
        })

        new Vue({
            el: '#app2'
        })

        new Vue({
            el: '#app3'
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#department').change(function() {
                var departmentId = $(this).val();
                // console.log('The department ID is :', departmentId);
                if (departmentId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('advertisements.getOffices') }}",
                        data: {
                            department_id: departmentId
                        },
                        success: function(response) {
                            console.log('The response is :', response);
                            $('#office').empty();
                            $('#office').append('<option>Select Office</option>');
                            $.each(response, function(key, value) {
                                $('#office').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>


    {{-- </script>-- JavaScript for INF Number --}}
    <script>
        document.getElementById('assignInfButton').addEventListener('click', async () => {
            try {
                const response = await fetch('{{ route('advertisements.generateINF') }}');
                if (response.ok) {
                    const data = await response.json();
                    document.getElementById('inf_number').value = data.inf_number;
                } else {
                    console.error('Failed to fetch INF number');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
@endpush
