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
        ['label' => 'Edit Ad', 'url' => null], // The current page has no URL
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

                <div class="card" style="padding-inline: 0; border-radius: 18px 18px 9px 9px;">
                    <form method="POST" action="{{ route('advertisements.update', $advertisement->id) }}"
                        enctype="multipart/form-data" class="card-body" style="padding: 0;">
                        @csrf

                        {{-- Title (Header) --}}

                        <div class="form-header flex w-full">
                            <h4 class="h5-reset-margin">Edit Advertisement Form</h4>
                            @can('view inf number')
                                <div class="form-header-content flex">
                                    <h6 class="h5-reset-margin">INF No.</h6>
                                    <input type="text" class="form-control inf-no" id="inf_number" name="inf_number"
                                        value="{{ $advertisement->inf_number }}" readonly>
                                    @can('view inf button')
                                        <button type="button" class="custom-secondary-buttom" id="assignInfButton">Assign
                                            INF</button>
                                    @endcan
                                </div>
                            @endcan
                        </div>

                        {{-- Advertisement Form --}}
                        <div class="form-body flex">
                            {{-- Memo No., Memo Date & Publication Date --}}
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label-x" for="memo-no">Memo No.</label>
                                    <input type="text" id="memo-no" class="form-control"
                                        value="{{ $advertisement->memo_number }}" readonly />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-x" for="memo-date">Memo Date</label>
                                    <input type="text" id="memo-date" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($advertisement->memo_date)->toFormattedDateString() }}"
                                        readonly />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-x" for="pub-date">Publish on or Before</label>
                                    <input type="text" id="pub-date" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($advertisement->publish_on_or_before)->toFormattedDateString() }}"
                                        readonly />
                                </div>
                            </div>

                            {{-- Department & Office --}}
                            <div class="row g-3">
                                {{-- Department --}}
                                <div class="col-md-6">
                                    <label class="form-label-x" for="department">Departments</label>
                                    <input type="text" id="department" class="form-control"
                                        value="{{ old('department_id', $advertisement->department->name) }}" readonly>
                                </div>

                                {{-- Office --}}
                                <div class="col-md-6">
                                    <label class="form-label-x" for="office">Office</label>
                                    <input type="text" id="office" class="form-control"
                                        value="{{ old('office_id', $advertisement->office->name) }}" readonly>

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
                                            <option value="{{ $ad_worth_parameter->id }}"
                                                {{ old('ad_worth_id') ?? $advertisement->ad_worth_id == $ad_worth_parameter->id ? 'selected' : '' }}>
                                                {{ $ad_worth_parameter->range }}
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
                                            <option value="{{ $ad_category->id }}"
                                                {{ old('ad_category_id') ?? $advertisement->ad_category_id == $ad_category->id ? 'selected' : '' }}>
                                                {{ $ad_category->title }}</option>
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
                                            value="{{ $advertisement->english_lines }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-x" for="eng-lines">English lines</label>
                                        <input type="number" id="urdu-lines" name="urdu_lines" class="form-control"
                                            value="{{ $advertisement->urdu_lines }}" />
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
                                            value="{{ $advertisement->urdu_size }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-x" for="english_size">English size</label>
                                        <input type="number" id="english_size" name="english_size" class="form-control"
                                            value="{{ $advertisement->english_size }}" />
                                    </div>
                                </div>
                            @endcan


                            {{-- Newspaper & Adv. Agency --}}
                            @can('add media')
                                <div class="row g-3">
                                    <h6 class="my-h6 fw-normal">Select
                                        Media &mdash; Newspaper&lpar;s&rpar; or Advertising Agency</h6>

                                    {{-- Newspapers and Advertising Agencies --}}
                                    <!-- Radio Buttons -->
                                    <div class="col-md-12 mb-2">
                                        <input type="radio" id="radioNewspapers" name="mediaType" value="newspapers"
                                            checked>
                                        <label for="radioNewspapers">Newspapers</label>

                                        <input type="radio" id="radioAgencies" name="mediaType" value="agencies"
                                            class="ms-3">
                                        <label for="radioAgencies">Advertising Agencies</label>
                                    </div>

                                    {{-- Newspapers Dropdown (Shown by Default)  --}}
                                    <div id="newspapersDropdown" class="col-md-6">
                                        <label class="form-label-x" for="newspapers">Choose Newspapers</label>
                                        <select id="newspapers" name="newspaper_id[]" class="select2 form-select"
                                            data-allow-clear="true" multiple>
                                            <option value="Select newspaper">Select Newspapers</option> <!-- Default option -->
                                            @foreach ($newspapers as $newspaper)
                                                <option value="{{ $newspaper->id }}"
                                                    {{ in_array($newspaper->id, old('newspaper_id', $advertisement->newspaper_id ?? [])) ? 'selected' : '' }}>
                                                    {{ $newspaper->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Advertising Agencies Dropdown (Hidden by Default) --}}
                                    <div id="agenciesDropdown" class="d-none col-md-6">
                                        <label class="form-label-x" for="adv_agency">Adv Agencies</label>
                                        <select id="adv_agency" name="adv_agency_id" class="select2 form-select"
                                            data-allow-clear="true">
                                            <option value="">Select adv.agency</option>
                                            @foreach ($adv_agencies as $adv_agency)
                                                <option value="{{ $adv_agency->id }}"
                                                    {{ old('adv_agency_id', $advertisement->adv_agency_id ?? '') == $adv_agency->id ? 'selected' : '' }}>
                                                    {{ $adv_agency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Position/Placement --}}
                                    <div class="col-md-6">
                                        <label class="form-label-x" for="placement_position">Placement</label>
                                        <select id="placement_position" name="news_pos_rate_id" class="select2 form-select"
                                            data-allow-clear="true">
                                            <option>Select Placement</option>
                                            @foreach ($news_pos_rates as $news_pos_rate)
                                                <option value="{{ $news_pos_rate->id }}"
                                                    {{ old('news_pos_rate_id', $advertisement->news_pos_rate_id ?? '') == $news_pos_rate->id ? 'selected' : '' }}>
                                                    {{ $news_pos_rate->position }}:
                                                    {{ $news_pos_rate->rates }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endcan

                            @php
                                $user = auth()->user();
                            @endphp
                            {{--  status --}}
                            @if ($user->hasRole('Deputy Director'))
                                <div class="row mb-3   ">
                                    <label class="form-label-x" for="name">Status</label>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="approved" name="status_id" value="approved"
                                                class="form-check-input ">
                                            <label class="form-check-label " for="approved">
                                                Approved
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="inprogress" name="status_id" value="inprogress"
                                                class="form-check-input " checked>
                                            <label class="form-check-label " for="inprogress">
                                                Inprogress / DG Approval
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- covering letters
                            <div class="col-sm-4">
                                <div id="app">
                                    <file-uploader
                                        :media="{{ json_encode($advertisement->getMediaResource('covering_letters')) }}"
                                        :unlimited="true" collection="covering_letters"
                                        :tokens="{{ json_encode(old('media.covering_letters', [])) }}"
                                        label="Covering Letter" notes="Supported types: jpeg, png,jpg,gif"
                                        accept="image/jpeg,image/png,image/jpg,image/gif"></file-uploader>
                                </div>
                            </div>


                            {{-- urdu Ads --}
                            <div class="col-sm-4">
                                <div id="app2">
                                    <file-uploader :media="{{ json_encode($advertisement->getMediaResource('urdu_ads')) }}"
                                        :unlimited="true" collection="urdu_ads"
                                        :tokens="{{ json_encode(old('media.urdu_ads', [])) }}" label="Urdu Ad"
                                        notes="Supported types: jpeg, png,jpg,gif"
                                        accept="image/jpeg,image/png,image/jpg,image/gif"></file-uploader>
                                </div>
                            </div>


                            {{--  English Ads --}
                            <div class="col-sm-4">
                                <div id="app3">
                                    <file-uploader
                                        :media="{{ json_encode($advertisement->getMediaResource('english_ads')) }}"
                                        :unlimited="true" collection="english_ads"
                                        :tokens="{{ json_encode(old('media.english_ads', [])) }}" label="Eglish Ad"
                                        notes="Supported types: jpeg, png,jpg,gif"
                                        accept="image/jpeg,image/png,image/jpg,image/gif"></file-uploader>
                                </div>
                            </div> --}}


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
                                {{-- @can('view submit button')
                                    <button type="submit" name="action" value="submit-ad"
                                        class="custom-primary-buttom">submit
                                        Ad</button>
                                @endcan --}}

                                {{-- Draft Ad --}}
                                @can('view draft button')
                                    <button type="submit" name="action" value="save-draft"
                                        class="custom-secondary-buttom">Save as Draft</button>
                                @endcan

                                {{-- Forward Ad --}}
                                @can('view forward button')
                                    <button type="submit" name="action" id="forward-btn" value="forward"
                                        class="custom-primary-buttom">Forward Ad</button>
                                @endcan

                                {{-- approve Ad --}}
                                @can('view approve button')
                                    <button type="submit" name="action" value="approve" id="approve-btn"
                                        class="custom-primary-buttom">Approve Ad</button>
                                @endcan


                                {{-- Reject Ad --}}
                                @can('view reject button')
                                    <button type="button" name="action" value="reject" class="custom-secondary-buttom"
                                        data-bs-toggle="modal" data-bs-target="#editUser">Reject</button>
                                @endcan

                            </div>
                    </form>

                </div>
                {{-- ! / Ad Form --}}
            </div>
        </div>
        {{-- ! / Page Content --}}
    </div>

    <!-- Edit ads rejection reason Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Ads Rejection Reason</h3>
                        <p>Select Ads rejection reason form below.</p>
                    </div>
                    <form action="{{ route('advertisements.rejectionReason', $advertisement->id) }}" class="row g-3"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            @foreach ($ad_rejection_reasons as $ad_rejection_reason)
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="ad_rejection_reasons_id[]" class="form-check-input"
                                        value="{{ $ad_rejection_reason->id }}"
                                        {{ in_array($ad_rejection_reason->id, old('ad_rejection_reasons_id', $selected_reasons ?? [])) ? 'checked' : '' }}>
                                    {{ $ad_rejection_reason->description }}
                                </div>
                            @endforeach
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="">Give remarks if any</label>
                            <textarea type="text" id="" name="remark" class="form-control" placeholder="Write Remarks"></textarea>
                        </div>


                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit rejection reason Modal -->


@endpush

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
    {{-- JavaScript for INF Number --}}
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

    {{-- JavaScript for radio button to change the submit functionality --}}

    <script>
        // Get the radio buttons and submits buttons
        const approvedRadio = document.getElementById('approved');
        const inprogressRadio = document.getElementById('inprogress');
        const approveBtn = document.getElementById('approve-btn');
        const forwardBtn = document.getElementById('forward-btn');

        // Functions to toggle submit buttons
        function toggleSubmitButtons() {
            if (approvedRadio.checked) {
                approveBtn.style.display = 'block';
                forwardBtn.style.display = 'none';
            } else {
                approveBtn.style.display = 'none';
                forwardBtn.style.display = 'block';

            }
        }
        // Add event listener to the radio button
        approvedRadio.addEventListener('change', toggleSubmitButtons);
        inprogressRadio.addEventListener('change', toggleSubmitButtons);
        // submit buttons initially
        toggleSubmitButtons();
    </script>


    {{-- Newspapers & Agencies JavaScript --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radioNewspapers = document.getElementById("radioNewspapers");
            const radioAgencies = document.getElementById("radioAgencies");
            const newspapersDropdown =
                document.getElementById("newspapersDropdown");
            const agenciesDropdown =
                document.getElementById("agenciesDropdown");

            function toggleDropdowns() {
                if (radioNewspapers.checked) {
                    newspapersDropdown.classList.remove("d-none");
                    agenciesDropdown.classList.add("d-none");
                } else {
                    newspapersDropdown.classList.add("d-none");
                    agenciesDropdown.classList.remove("d-none");
                }
            }

            // Listen for changes
            radioNewspapers.addEventListener("change", toggleDropdowns);
            radioAgencies.addEventListener("change", toggleDropdowns);
        });
    </script>
@endpush
