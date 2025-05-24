<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Status;
use App\Models\AdvAgency;
use App\Models\INFSeries;
use App\Models\Newspaper;
use App\Models\AdCategory;
use App\Models\Department;
use App\Models\NewsPosRate;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\AdWorthParameter;
use App\Models\AdRejectionReason;
use Illuminate\Support\Facades\DB;
use App\Events\AdvertisementCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRole;
use App\Events\AdvertisementSubmitted;
use App\Notifications\AdvertisementNotification;

class AdvertisementController extends Controller
{

    // Display All Advertisements
    public function index()
    {
        // Page title
        $pageTitle = 'New Ads &#x2053; IAMS-IPR';

        $user = auth()->user();

        $advertisements = Advertisement::query();

        if ($user->hasRole('Client Office')) {
            $advertisements->where('status_id', 3)
                ->where('forwarded_to_role_id', 9)
                ->where('forwarded_by_role_id', 2);;
        } elseif ($user->hasRole('Diary Dispatch')) {
            //diary dispatch sees those record entered by him and sent by director general
            $advertisements->where('status_id', 3)
                ->where('forwarded_by_role_id', 2)
                ->where('forwarded_to_role_id', 9);
            // ->orWhere(function ($query) {
            //     $query->where('status_id', 10)
            //         ->where('forwarded_by_role_id', 10)
            //         ->where('forwarded_to_role_id', 9);
            // });
        }

        // Role-based filtering
        elseif ($user->hasRole('Superintendent')) {
            //superintendent sees the record updated by the diary dispatch
            $advertisements->where('status_id', 4)
                ->where('forwarded_by_role_id', 9)
                ->where('forwarded_to_role_id', 3);

            // Role-based filtering
        } elseif ($user->hasRole('Deputy Director')) {
            // Deputy Director sees records updated by the superintendent
            $advertisements->where('status_id', 4)
                ->where('forwarded_by_role_id', 3)
                ->where('forwarded_to_role_id', 11);

            // Role-based filtering
        } elseif ($user->hasRole('Director General')) {
            //Director General sees records updated by the deputy director
            $advertisements->where('status_id', 4)
                ->where('forwarded_by_role_id', 11)
                ->where('forwarded_to_role_id', 10);

            // Role-based filtering
        } elseif ($user->hasRole('Media')) {
            $advertisements->where('status_id', 10)
                ->where('forwarded_by_role_id', 9)
                ->where('forwarded_to_role_id', 4);
        }
        $advertisements = $advertisements->paginate(10);
        // dd($advertisements);

        return view('advertisements.index', [
            'advertisements' => $advertisements,
            'pageTitle' => $pageTitle
        ]);
    }




    // Display Inprogress Advertisements
    public function inprogress()
    {
        // Page title
        $pageTitle = 'Inprogress Ads &#x2053; IAMS-IPR';

        // breadcrumbs
        $breadcrumbs = [
            ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
            ['label' => 'Inprogress Ads', 'url' => null], // The current page (no URL)
        ];

        //Get logged in user
        $user = auth()->user();

        $advertisements = Advertisement::query();

        // Role-based filtering
        if ($user->hasRole('Client Office')) {
            $advertisements->where('status_id', 4);
            // ->where('forwarded_by_role_id', 9)
            // ->where('forwarded_to_role_id', 3);
        } elseif ($user->hasRole('Diary Dispatch')) {
            $advertisements->where('status_id', 4)
                ->orWhere(function ($query) {
                    $query->where('forwarded_by_role_id', 9)
                        ->where('forwarded_to_role_id', 3);
                });
        } elseif ($user->hasRole('Superintendent')) {
            // Superintendent sees records with 'inprogress' status and a record sent by director general
            $advertisements->where('status_id', 4)
                ->where('forwarded_by_role_id', 3)
                ->where('forwarded_to_role_id', 11)
                ->orWhere(function ($query) {
                    $query->where('status_id', 4)
                        ->where('forwarded_by_role_id', 11)
                        ->where('forwarded_to_role_id', 10);
                });
        } elseif ($user->hasRole('Deputy Director')) {
            // Deputy Director sees records updated by the deputy director
            $advertisements->where('status_id', 4)
                ->where('forwarded_by_role_id', 11)
                ->where('forwarded_to_role_id', 10);
        } elseif ($user->hasRole('Director General')) {
            //Director General sees records updated by the director general
            $advertisements->where('status_id', 10)
                ->where('forwarded_by_role_id', 9)
                ->where('forwarded_to_role_id', 4);
        }
        $advertisements = $advertisements->paginate(10);
        return view('advertisements.inprogress', [
            'advertisements' => $advertisements,
            'pageTitle' => $pageTitle,
            'breadcrumbs' =>  $breadcrumbs
        ]);
    }

    // Display Approved Advertisements
    public function approved()
    {
        // Page title
        $pageTitle = 'Approved Ads &#x2053; IAMS-IPR';

        // breadcrumbs
        $breadcrumbs = [
            ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
            ['label' => 'Approved Ads', 'url' => null], // The current page (no URL)
        ];

        //Get logged in user
        $user = auth()->user();
        $user_role = $user->roles->pluck('id');
        $user_role_id = $user_role->first();
        // dd($user_role_id);

        $advertisements = Advertisement::query();

        $advertisements->where('status_id', 10)
            ->where('forwarded_by_role_id', 10)
            ->where('forwarded_to_role_id', 9)
            ->orWhere(function ($query) {
                $query->where('status_id', 10)
                    ->where('forwarded_by_role_id', 11)
                    ->where('forwarded_to_role_id', 9)
                    ->orWhere(function ($subquery) {
                        $subquery->where('status_id', 10)
                            ->where('forwarded_by_role_id', 9)
                            ->where('forwarded_to_role_id', 4);
                    });
            });

        $advertisements = $advertisements->paginate(10);
        return view('advertisements.inprogress', [
            'advertisements' => $advertisements,
            'pageTitle' => $pageTitle,
            'breadcrumbs' =>  $breadcrumbs
        ]);
    }


    // Display Rejected Advertisements
    public function rejected()
    {
        //Page title
        $pageTitle = 'Rejected Ads &#x2053; IAMS-IPR';

        // breadcrumbs
        $breadcrumbs = [
            ['label' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>', 'url' => route('dashboard')],
            ['label' => 'Rejected Ads', 'url' => null], // The current page (no URL)
        ];


        //Get logged in user
        $user = auth()->user();
        $user_role = $user->roles->pluck('id');
        $user_role_id = $user_role->first();
        // dd($user_role_id);

        $advertisements = Advertisement::query();
        if ($user->hasRole('Deputy Director')) {
            $advertisements->where('status_id', 7)
                ->where('forwarded_by_role_id', 10)
                ->where('forwarded_to_role_id', 11);
        } else {
            $advertisements->where('status_id', 7);
        }
        $advertisements = $advertisements->paginate(10);

        $ad_rejection_reasons = AdRejectionReason::all();
        return view('advertisements.inprogress', [
            'advertisements' => $advertisements,
            'pageTitle' => $pageTitle,
            'breadcrumbs' => $breadcrumbs,
            'ad_rejection_reasons' => $ad_rejection_reasons
        ]);
    }
    // Display the Advertisement Form
    public function create()
    {
        // Page title
        $pageTitle = 'Create Ad &#x2053; IAMS-IPR';

        // Ad categories
        $ad_categories = AdCategory::all();

        // Departments
        $departments = Department::all();

        // Offices
        $offices = Office::all();

        // Ad worth parameters
        $ad_worth_parameters = AdWorthParameter::all();

        // Newspapers
        // $newspapers = Newspaper::all();

        // Advertising Agencies
        // $advertising_agencies = AdvAgency::all();

        // User
        $user = Auth::id(); // Get the logged-in user's ID
        // dd($user);

        // Status
        $new_status = Status::where('title', 'New')->value('id');
        $inprogress_status = Status::where('title', 'In progress')->value('id');
        $draft_status = Status::where('title', 'Draft')->value('id');

        return view('advertisements.create', [
            'pageTitle' => $pageTitle,
            'ad_categories' => $ad_categories,
            'departments' => $departments,
            'offices' => $offices,
            'new_status' => $new_status, // Pass the new status ID
            'inprogress_status' => $inprogress_status,
            'draft_status' => $draft_status, // Pass the draft status ID
            'ad_worth_parameters' => $ad_worth_parameters,
            // 'newspapers' => $newspapers,
            // 'advertising_agencies' => $advertising_agencies,
            'user_id' => $user,

        ]);
    }

    // function for fetching offices on the basis of department
    public function getOffices(Request $request)
    {
        $offices = Office::where('department_id', $request->department_id)->get();
        return response()->json($offices);
    }


    // cover letter file upload
    // public function upload(Request $request)
    // {
    //     dd($request);
    //     $request->validate([
    //         'covering_letter' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
    //     ]);

    //     if ($request->hasFile('covering_letter')) {
    //         $file = $request->file('covering_letter');
    //         $covering_letter_path = $file->store('covering_letters', 'public'); // Save to public storage

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'File uploaded successfully',
    //             'covering_letter' => $covering_letter_path,
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'No file uploaded',
    //     ], 400);
    // }



    // Store the Advertisement
    public function store(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $userRole = $user->roles->pluck('id');
        $current_user_role = $userRole->first();
        // dd($userRole, $user_role_id);
        // Validate incoming request data
        if ($user->hasRole('Diary Dispatch')) {
            $request->validate([
                'inf_number' => 'required|string|unique:advertisements,inf_number|max:20',
                'inf_series_id' => 'nullable|exists:inf_series,id', // Ensure the INF series exists
                'memo_number' => 'nullable|string|max:255',
                'memo_date' => 'nullable|date',
                'publish_on_or_before' => 'nullable|date',
                'urdu_size' => 'nullable|integer|min:0',
                'english_size' => 'nullable|integer|min:0',
                'urdu_lines' => 'nullable|integer|min:0',
                'english_lines' => 'nullable|integer|min:0',
                // 'covering_letter' => 'nullable|string|mimes:jpeg,png,jpg,gif|max:2048',
                // 'urdu_ad' => 'nullable|string|mimes:jpeg,png,jpg,gif|max:2048',
                // 'english_ad' => 'nullable|string|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } else {
            $request->validate([
                'inf_number' => 'nullable|string|max:20',
                'inf_series_id' => 'nullable|exists:inf_series,id', // Ensure the INF series exists
                'memo_number' => 'nullable|string|max:255',
                'memo_date' => 'nullable|date',
                'publish_on_or_before' => 'nullable|date',
                'urdu_size' => 'nullable|integer|min:0',
                'english_size' => 'nullable|integer|min:0',
                'urdu_lines' => 'nullable|integer|min:0',
                'english_lines' => 'nullable|integer|min:0',
                // 'covering_letter' => 'nullable|string|mimes:jpeg,png,jpg,gif|max:2048',
                // 'urdu_ad' => 'nullable|string|mimes:jpeg,png,jpg,gif|max:2048',
                // 'english_ad' => 'nullable|string|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }


        // Get the current year
        $currentYear = now()->format('y'); // Example: '25' for the year 2025

        // Retrieve the INF series for the current year
        $currentSeries = INFSeries::where('series', 'like', "%-$currentYear")->first();

        if (!$currentSeries) {
            // If INF series for the current year doesn't exist, create one
            $currentSeries = INFSeries::create([
                'series' => sprintf('%05d-%s', 1, $currentYear), // Create initial series
                'start_number' => 1,
                'issued_numbers' => 0,
            ]);
        }
        $advertisement = new Advertisement();


        // specified collection name
        // Add media to the advertisement
        // if ($request->has('media')) {
        //     $advertisement->addAllMediaFromTokens();
        // }

        // if ($request->hasFile('urdu_ad')) {
        //     $advertisement->addMedia($request->file('urdu_ad'))->toMediaCollection('urdu_ads');
        // }

        // if ($request->hasFile('english_ad')) {
        //     $advertisement->addMedia($request->file('english_ad'))->toMediaCollection('english_ads');
        // }

        // Determine which button was clicked
        $action = $request->input('action');

        // Logic for both actions
        if ($action === 'save-draft') {
            // Save as draft
            $advertisement = Advertisement::create([
                'inf_number' => $request->inf_number,
                'inf_series_id' => $currentSeries->id, // Use the ID of the INF series
                'memo_number' => $request->memo_number,
                'memo_date' => $request->memo_date,
                'publish_on_or_before' => $request->publish_on_or_before,
                'urdu_size' => $request->urdu_size,
                'english_size' => $request->english_size,
                'urdu_lines' => $request->urdu_lines,
                'english_lines' => $request->english_lines,
                'user_id' => $request->user_id,
                'ad_category_id' => $request->ad_category_id,
                'ad_worth_id' => $request->ad_worth_id,
                'newspaper_id' => $request->newspaper_id,
                'department_id' => $request->department_id,
                'office_id' => $request->office_id,
                // 'agency_id' => $request->agency_id,
                // 'position_id' => $request->position_id,
                'status_id' => $request->draft_status, // Set the status to draft

            ]);





            return redirect()
                ->route('advertisements.draft') // Adjust this route to your draft view
                ->with('success', 'Advertisement saved as draft.');
        }



        if ($current_user_role == 2) {

            $advertisement->fill($request->all()); // Fill other fields from the request
            $advertisement->inf_series_id = $currentSeries->id; // Use the ID of the INF series
            $advertisement->status_id = $request->new_status; // Set the status to new
            $advertisement->forwarded_by_role_id = $current_user_role;
            $advertisement->forwarded_to_role_id = 9; //Forwarded to diary dispatch
            // $advertisement->user_id = $user->id;
        } else {
            // Save as submitted

            $advertisement->fill($request->all()); // Fill other fields from the request
            $advertisement->inf_series_id = $currentSeries->id; // Use the ID of the INF series
            $advertisement->status_id = $request->inprogress_status; // Set the status to inprogress
            $advertisement->forwarded_by_role_id = $current_user_role;
            $advertisement->forwarded_to_role_id = 3;
            // $advertisement->user_id = $user->id;
        }



        // Ensure model is saved BEFORE adding media
        $advertisement->save();

        // Attach Media Files (Permanent)
        $advertisement->addAllMediaFromTokens();


        // Determine the receiver based on status
        $receiverRole = match ($request->status) {
            'submitted' => 'dairy',
            'forwarded_to_superintendent' => 'superintendent',
            'forwarded_to_deputy_director' => 'deputy_director',
            'forwarded_to_director_general' => 'director_general',
            'approved' => 'dairy',
            default => null,
        };

        if ($receiverRole) {
            event(new AdvertisementSubmitted($advertisement, $receiverRole));
        }

        return redirect()
            ->route('advertisements.index')
            ->with('success', 'Advertisement created successfully.');
    }





    //Edit Advertisements
    public function edit($id)
    {

        $advertisement = Advertisement::with('media')->findOrFail($id);
        // dd($advertisement);
        $new_status = Status::where('title', 'New')->value('id');
        $draft_status = Status::where('title', 'Draft')->value('id');
        $user = Auth::id(); // Get the logged-in user's ID
        // Ad categories
        $ad_categories = AdCategory::all();

        // Ad worth parameters
        $ad_worth_parameters = AdWorthParameter::all();

        //Placement/Position
        $news_pos_rates = NewsPosRate::all();

        //Newspapers
        $newspapers = Newspaper::all();

        //Adv Agencies
        $adv_agencies = AdvAgency::all();

        $statuses = Status::all();
        $ad_rejection_reasons = AdRejectionReason::all();
        $selected_reasons = $advertisement->ad_rejection_reasons_id ?? [];

        // Retrieve media files
        $covering_letter_files = $advertisement->getMedia('covering_letters');



        // dd($covering_letter_images);
        return view('advertisements.edit', [
            'advertisement' => $advertisement,
            'new_status' =>  $new_status,
            'draft_status' => $draft_status,
            'user_id' =>  $user,
            'ad_categories' => $ad_categories,
            'ad_worth_parameters' => $ad_worth_parameters,
            'news_pos_rates' => $news_pos_rates,
            'newspapers' => $newspapers,
            'adv_agencies' => $adv_agencies,
            'statuses' => $statuses,
            'ad_rejection_reasons' => $ad_rejection_reasons,
            'selected_reasons' => $selected_reasons,
            'covering_letter_files' => $covering_letter_files

        ]);
    }


    //Advertisement update
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = auth()->user();
        // dd($user);
        $roleId = $user->roles->pluck('id'); // Returns a collection of role IDs
        $current_role  =  $roleId->first();
        // dd($roleId,  $singleRole);

        $advertisement = Advertisement::findOrFail($id);
        // Determine which button was clicked
        $action = $request->input('action');

        if ($user->hasRole('Diary Dispatch')) {
            // Get the current year
            $currentYear = now()->format('y'); // Example: '25' for the year 2025

            // Retrieve the INF series for the current year
            $currentSeries = INFSeries::where('series', 'like', "%-$currentYear")->first();

            if (!$currentSeries) {
                // If INF series for the current year doesn't exist, create one
                $currentSeries = INFSeries::create([
                    'series' => sprintf('%05d-%s', 1, $currentYear), // Create initial series
                    'start_number' => 1,
                    'issued_numbers' => 0,
                ]);
            }
            $advertisement->inf_series_id = $currentSeries->id; // Use the ID of the INF series
            $advertisement->inf_number = $request->inf_number;
            if ($advertisement->status_id == 3) {
                $advertisement->status_id = 4;
                $advertisement->forwarded_to_role_id = 3;
            } elseif ($advertisement->status_id == 10 && $advertisement->forwarded_by_role_id == 10) {
                $advertisement->forwarded_to_role_id = 9;
            }
        } elseif ($user->hasRole('Superintendent')) {
            if ($advertisement->status_id == 4) {
                $advertisement->forwarded_to_role_id = 11;
            } elseif ($advertisement->status_id == 10 && $advertisement->forwarded_by_role_id == 10) {
                $advertisement->forwarded_to_role_id = 9;
            }
        } elseif ($user->hasRole('Deputy Director')) {
            if ($action == 'forward' && $advertisement->forwarded_by_role_id == 3 && $advertisement->status_id == 4) {
                $advertisement->forwarded_to_role_id = 10;
            } elseif ($action == 'approve' && $advertisement->forwarded_by_role_id == 3 && $advertisement->status_id == 4) {
                $advertisement->status_id = 10;
                $advertisement->forwarded_to_role_id = 9;
            }
        } elseif ($user->hasRole('Director General')) {
            if ($advertisement->forwarded_by_role_id == 11 && $advertisement->status_id == 4) {
                $advertisement->status_id = 10;
                $advertisement->forwarded_to_role_id = 9;
            }
        }

        $advertisement->urdu_size = $request->urdu_size;
        $advertisement->english_size = $request->english_size;
        $advertisement->urdu_lines = $request->urdu_lines;
        $advertisement->english_lines = $request->english_lines;
        $advertisement->ad_category_id = $request->ad_category_id;
        $advertisement->ad_worth_id = $request->ad_worth_id;
        $advertisement->newspaper_id = $request->newspaper_id;
        $advertisement->adv_agency_id = $request->adv_agency_id;
        $advertisement->news_pos_rate_id = $request->news_pos_rate_id;
        $advertisement->forwarded_by_role_id = $current_role;

        $advertisement->save();

        return redirect()->route('advertisements.index')->with('success', 'Advertisement forwarded successfully.');
    }


    // Show Advertisement Details
    public function show($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $covering_letter_files = $advertisement->getMedia('covering_letters');
        $urdu_ad_files = $advertisement->getMedia('urdu_ads');
        $english_ad_files = $advertisement->getMedia('english_ads');

        return view('advertisements.show', [
            'advertisement' => $advertisement,
            'covering_letter_files' => $covering_letter_files,
            'urdu_ad_files' => $urdu_ad_files,
            'english_ad_files' => $english_ad_files
        ]);
    }

    // When click on any image its show details of each file with human readable form
    public function fileShow($id, $imageId)
    {
        $advertisement = Advertisement::findOrFail($id);
        $file_image = $advertisement->getMedia('*')->where('id', $imageId)->first();

        if (!$file_image) {
            abort(404, 'Image not found.');
        }

        return view('advertisements.file-show', [
            'advertisement' => $advertisement,
            'file_image' => $file_image
        ]);
    }


    // Advertisement rejection reason function
    public function rejectionReason(Request $request, $id)
    {
        $user = auth()->user();
        $user_role = $user->roles->pluck('id');
        $current_role = $user_role->first();
        $request->validate([
            'ad_rejection_reasons_id' => 'required|exists:ad_rejection_reasons,id',
            'remarks' => 'string|nullable'
        ]);

        $advertisement = Advertisement::findOrFail($id);
        if ($user->hasRole('Director General')) {
            // Update the advertisement record with rejection details
            $advertisement->ad_rejection_reasons_id = $request->ad_rejection_reasons_id;
            $advertisement->remarks = $request->rejection_remarks;
            $advertisement->status_id = 7;
            $advertisement->forwarded_to_role_id = 11;
            $advertisement->forwarded_by_role_id = $current_role;
        } elseif ($user->hasRole('Deputy Director')) {
            // Update the advertisement record with rejection details
            $advertisement->ad_rejection_reasons_id = $request->ad_rejection_reasons_id;
            $advertisement->remarks = $request->rejection_remarks;
            $advertisement->status_id = 7;
            $advertisement->forwarded_to_role_id = 3;
            $advertisement->forwarded_by_role_id = $current_role;
        }

        $advertisement->save();
        return redirect()->route('advertisements.index')
            ->with('success', 'Advertisement rejected successfully.');
    }



    public function media($id)
    {

        // dd($request->all());
        $user = auth()->user();
        // dd($user);
        $roleId = $user->roles->pluck('id'); // Returns a collection of role IDs
        $current_role  =  $roleId->first();
        // dd($roleId,  $singleRole);

        $advertisement = Advertisement::findOrFail($id);

        if ($user->hasRole('Diary Dispatch')) {
            if (
                ($advertisement->status_id == 10
                    && $advertisement->forwarded_by_role_id == 10)
                && $advertisement->forwarded_to_role_id == 9 || ($advertisement->status_id == 10
                    && $advertisement->forwarded_by_role_id == 11
                    && $advertisement->forwarded_to_role_id == 9)
            ) {
                $advertisement->forwarded_to_role_id = 4;
            }
        }
        $advertisement->forwarded_by_role_id = $current_role;
        // dd($advertisement);
        $advertisement->save();
        return redirect()->route('advertisements.approved')->with('success', 'Advertisement forwarded successfully.');
    }


    // Media Edit Form
    public function mediaEditForm($id)
    {
        // Page title
        $pageTitle = 'Media Edit Form &#x2053; IAMS-IPR';

        // Get the Advertisement
        $advertisement = Advertisement::findOrFail($id);

        // Get the logged-in user's ID
        $user = Auth::id();

        // Ad categories
        $ad_categories = AdCategory::all();

        // Ad worth parameters
        $ad_worth_parameters = AdWorthParameter::all();

        //Placement/Position
        $news_pos_rates = NewsPosRate::all();

        //Newspapers
        $newspapers = Newspaper::all();

        //Adv Agencies
        $adv_agencies = AdvAgency::all();

        $statuses = Status::all();

        return view('advertisements.media-edit-form', [
            'pageTitle' => $pageTitle,
            'advertisement' => $advertisement,
            'user_id' =>  $user,
            'ad_categories' => $ad_categories,
            'ad_worth_parameters' => $ad_worth_parameters,
            'news_pos_rates' => $news_pos_rates,
            'newspapers' => $newspapers,
            'adv_agencies' => $adv_agencies,
            'statuses' => $statuses
        ]);
    }

    // Media Form Update
    public function mediaFormUpdate(Request $request, $id)
    {
        // dd($request->all());
        $user = auth()->user();
        // dd($user);
        $roleId = $user->roles->pluck('id'); // Returns a collection of role IDs
        $current_role  =  $roleId->first();
        // dd($roleId,  $singleRole);

        $advertisement = Advertisement::findOrFail($id);
        // Determine which button was clicked
        $action = $request->input('action');

        if ($user->hasRole('Media')) {

            if ($advertisement->status_id == 10 && $advertisement->forwarded_by_role_id == 9) {
                $advertisement->status_id = 4;
                $advertisement->forwarded_to_role_id = 3;
            } elseif ($advertisement->status_id == 10 && $advertisement->forwarded_by_role_id == 11) {
                $advertisement->forwarded_to_role_id = 9;
            }
        }

        $advertisement->urdu_size = $request->urdu_size;
        $advertisement->english_size = $request->english_size;
        $advertisement->urdu_lines = $request->urdu_lines;
        $advertisement->english_lines = $request->english_lines;
        $advertisement->ad_category_id = $request->ad_category_id;
        $advertisement->ad_worth_id = $request->ad_worth_id;
        $advertisement->newspaper_id = $request->newspaper_id;
        $advertisement->adv_agency;

        $advertisement->save();
        return redirect()->route('advertisements.index')->with('success', 'Advertisement forwarded successfully.');
    }


    // Display Draft Advertisements
    public function draft()
    {
        // Page title
        $pageTitle = 'Draft Ads &#x2053; IAMS-IPR';

        // Fetch Draft status
        $draftStatus = Status::where('title', 'Draft')->value('id');

        // Fetch advertisements with the "Draft" status
        $draftAds = Advertisement::where('status_id', $draftStatus)->get();

        return view('advertisements.draft', [
            'draftAds' => $draftAds,
            'pageTitle' => $pageTitle
        ]);
    }

    // Edit the Draft (Advertisement)
    public function editDraft($id)
    {
        $advertisement = Advertisement::findOrFail($id);

        if ($advertisement->status !== 'draft') {
            return redirect()->back()->with('error', 'This advertisement is not a draft.');
        }

        return view('advertisements.edit', compact('advertisement'));
    }

    // Submit the Draft (Advertisement)
    public function submitDraft(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->update(['status' => 'new']);

        return redirect()->route('advertisements.index')->with('success', 'Advertisement submitted successfully!');
    }

    // Generate INF Number
    public function generateINF()
    {
        DB::beginTransaction();

        try {
            $currentYear = now()->format('y'); // Current year in 'yy' format

            // Lock the INF series table for the current year
            $currentSeries = INFSeries::where('series', 'like', "%-$currentYear")->lockForUpdate()->first();

            if (!$currentSeries) {
                // If INF series for the current year doesn't exist, create one
                $currentSeries = INFSeries::create([
                    //  'series' => sprintf('%05d-%s', 1, $currentYear), // Create series in XXXXX-25 format (5 0's)
                    'series' => sprintf('%05s-%s', 'XXXXX', $currentYear), // Create series in XXXXX-25 format (5 X's)
                    'start_number' => 1,
                    'issued_numbers' => 0,
                ]);
            }

            // Check the advertisements table for the last issued INF number
            $lastAdvertisement = Advertisement::where('inf_number', 'like', "%-$currentYear")
                ->orderBy('id', 'desc')
                ->first();

            if ($lastAdvertisement) {
                [$lastNumber, $year] = explode('-', $lastAdvertisement->inf_number);
                $nextNumber = (int) $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            $nextINF = sprintf('%05d-%s', $nextNumber, $currentYear);

            // Update the issued_numbers in the INF series table
            $currentSeries->update(['issued_numbers' => $nextNumber]);

            DB::commit();

            return response()->json([
                'inf_number' => $nextINF,
                'inf_series_id' => $currentSeries->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to generate INF number'], 500);
        }
    }

    // Display All INF Series
    public function showSeries()
    {
        $advertisements = Advertisement::all();

        $currentYear = now()->format('y');
        $currentSeries = INFSeries::where('series', 'like', "%-$currentYear")->first();
        $previousSeries = INFSeries::where('series', 'not like', "%-$currentYear")->get();

        return view('inf_series.index', compact('currentSeries', 'previousSeries', 'advertisements'));
    }
}
