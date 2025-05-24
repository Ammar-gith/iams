<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdvAgencyController;
use App\Http\Controllers\NewspaperController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MasterData\OfficeController;
use App\Http\Controllers\masterData\StatusController;
use App\Http\Controllers\NewspaperCategoryController;
use App\Http\Controllers\MasterData\TaxTypeController;
use App\Http\Controllers\MasterData\DistrictController;
use App\Http\Controllers\masterData\LanguageController;
use App\Http\Controllers\MasterData\ProvinceController;
use App\Http\Controllers\MasterData\TaxPayeeController;
use App\Http\Controllers\NewspaperPeriodicityController;
use App\Http\Controllers\masterData\AdCategoryController;
use App\Http\Controllers\MasterData\DepartmentController;
use App\Http\Controllers\MasterData\NewsPosRateController;
use App\Http\Controllers\MasterData\PublisherTypeController;
use App\Http\Controllers\MasterData\OfficeCategoryController;
use App\Http\Controllers\MasterData\AdWorthParameterController;
use App\Http\Controllers\masterData\ClassifiedAdTypeController;
use App\Http\Controllers\MasterData\AdRejectionReasonController;
use App\Http\Controllers\MasterData\DepartmentCategoryController;
use App\Http\Controllers\AdvertisementController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/file', function () {
    return view('advertisements.file');
});

// Dashboard Routes
Route::get('/dashboard', function () {
    return view('dashboard', ['pageTitle' => 'Dashboard ~ IAMS-IPR']);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::group(['middleware' => ['isAdmin', 'auth']], function () {
    //User Routes
    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('update-user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('delete-user/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('show-user/{id}', [UserController::class, 'show'])->name('user.show');

    //Permission Routes
    Route::get('permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('create-permission', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('store-permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('edit-permission/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('update-permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('delete-permission/{id}', [PermissionController::class, 'destroy'])->name('permission.delete');

    //Roles Routes
    Route::get('roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('create-role', [RoleController::class, 'create'])->name('role.create');
    Route::post('store-role', [RoleController::class, 'store'])->name('role.store');
    Route::get('edit-role/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('update-role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('delete-role/{id}', [RoleController::class, 'destroy'])->name('role.delete');
    Route::get('show-role/{id}', [RoleController::class, 'show'])->name('role.show');
    Route::get('role/{id}', [RoleController::class, 'addPermission'])->name('role.addPermission');
    Route::post('role/{id}', [RoleController::class, 'assignPermission'])->name('role.assignPermission');
});

Route::group(['middleware' => ['auth']], function () {

    // Advertisement Routes
    Route::get('advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');
    Route::get('advertisements-show/{id}', [AdvertisementController::class, 'show'])->name('advertisements.show');
    // Route for show full file image when click on image
    Route::get('advertisements-file-show/{id}/{imageId}', [AdvertisementController::class, 'fileShow'])->name('advertisements.full-file-show');
    Route::get('/advertisement-get-offices', [AdvertisementController::class, 'getOffices'])->name('advertisements.getOffices');
    Route::get('/advertisement-inprogress', [AdvertisementController::class, 'inProgress'])->name('advertisements.inprogress');
    Route::get('/advertisement-approved', [AdvertisementController::class, 'approved'])->name('advertisements.approved');
    Route::get('/advertisement-rejected', [AdvertisementController::class, 'rejected'])->name('advertisements.rejected');
    Route::post('/advertisement-media/{id}', [AdvertisementController::class, 'media'])->name('advertisement.media');
    Route::get('advertisements-create', [AdvertisementController::class, 'create'])->name('advertisements.create');
    // Route::post('/upload', [AdvertisementController::class, 'upload'])->name('file_upload.route');
    Route::post('advertisements-store', [AdvertisementController::class, 'store'])->name('advertisements.store');
    Route::get('advertisements-edit/{id}', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
    Route::post('advertisements-update/{id}', [AdvertisementController::class, 'update'])->name('advertisements.update');
    Route::post('/advertisement-rejection-reason/{id}', [AdvertisementController::class, 'rejectionReason'])->name('advertisements.rejectionReason');

    Route::get('advertisements-drafts', [AdvertisementController::class, 'draft'])->name('advertisements.draft');
    // Route::post('/advertisements/save-draft', [AdvertisementController::class, 'saveDraft'])->name('advertisements.saveDraft');
    // Route::get('/advertisements/edit-draft/{id}', [AdvertisementController::class, 'editDraft'])->name('advertisements.editDraft');

    Route::get('/advertisements/media-edit-form/{id}', [AdvertisementController::class, 'mediaEditForm'])->name('advertisements.media-edit-form');
    Route::post('/advertisements/mediaForm-update/{id}', [AdvertisementController::class, 'mediaFormUpdate'])->name('advertisements.mediaForm-update');
    Route::get('/advertisements/track-ad/{id}', [AdvertisementController::class, 'trackAd'])->name('advertisements.track-ad');
    Route::get('generate-inf', [AdvertisementController::class, 'generateINF'])->name('advertisements.generateINF');
    Route::get('inf-series', [AdvertisementController::class, 'showSeries'])->name('inf_series.index');


    //PUblisher Types Routes
    Route::get('publisher-types', [PublisherTypeController::class, 'index'])->name('publisherType.index');
    Route::get('create-publisher-type', [PublisherTypeController::class, 'create'])->name('publisherType.create');
    Route::post('store-publisher-type', [PublisherTypeController::class, 'store'])->name('publisherType.store');
    Route::get('edit-publisher-type/{id}', [PublisherTypeController::class, 'edit'])->name('publisherType.edit');
    Route::post('update-publisher-type/{id}', [PublisherTypeController::class, 'update'])->name('publisherType.update');
    Route::delete('delete-publisher-type/{id}', [PublisherTypeController::class, 'destroy'])->name('publisherType.delete');

    //Tax Types Routes
    Route::get('tax-types', [TaxTypeController::class, 'index'])->name('taxType.index');
    Route::get('create-tax-type', [TaxTypeController::class, 'create'])->name('taxType.create');
    Route::post('store-tax-type', [TaxTypeController::class, 'store'])->name('taxType.store');
    Route::get('edit-tax-type/{id}', [TaxTypeController::class, 'edit'])->name('taxType.edit');
    Route::post('update-tax-type/{id}', [TaxTypeController::class, 'update'])->name('taxType.update');
    Route::delete('delete-tax-type/{id}', [TaxTypeController::class, 'destroy'])->name('taxType.delete');

    //Tax Payees Routes
    Route::get('tax-payees', [TaxPayeeController::class, 'index'])->name('taxPayee.index');
    Route::get('create-tax-Payee', [TaxPayeeController::class, 'create'])->name('taxPayee.create');
    Route::post('store-tax-Payee', [TaxPayeeController::class, 'store'])->name('taxPayee.store');
    Route::get('edit-tax-payee/{id}', [TaxPayeeController::class, 'edit'])->name('taxPayee.edit');
    Route::post('update-tax-payee/{id}', [TaxPayeeController::class, 'update'])->name('taxPayee.update');
    Route::delete('delete-tax-payee/{id}', [TaxPayeeController::class, 'destroy'])->name('taxPayee.delete');

    //Ad Worth Parameters Routes
    Route::get('ad-worth-parameters', [AdWorthParameterController::class, 'index'])->name('adWorthParameter.index');
    Route::get('create-ad-worth-parameter', [AdWorthParameterController::class, 'create'])->name('adWorthParameter.create');
    Route::post('store-ad-worth-parameter', [AdWorthParameterController::class, 'store'])->name('adWorthParameter.store');
    Route::get('edit-ad-worth-parameter/{id}', [AdWorthParameterController::class, 'edit'])->name('adWorthParameter.edit');
    Route::post('update-ad-worth-parameter/{id}', [AdWorthParameterController::class, 'update'])->name('adWorthParameter.update');
    Route::delete('delete-ad-worth-parameter/{id}', [AdWorthParameterController::class, 'destroy'])->name('adWorthParameter.delete');

    //Newspaper Routes
    Route::get('newspapers', [NewspaperController::class, 'index'])->name('newspaper.index');
    Route::get('create-newspaper', [NewspaperController::class, 'create'])->name('newspaper.create');
    Route::post('store-newspaper', [NewspaperController::class, 'store'])->name('newspaper.store');
    Route::get('edit-newspaper/{id}', [NewspaperController::class, 'edit'])->name('newspaper.edit');
    Route::post('update-newspapers/{id}', [NewspaperController::class, 'update'])->name('newspaper.update');
    Route::delete('delete-newspaper/{id}', [NewspaperController::class, 'destroy'])->name('newspaper.delete');

    //Newspaper Categories Route
    Route::get('newspaper-categories', [NewspaperCategoryController::class, 'index'])->name('newspaperCategory.index');
    Route::get('create-newspaper-category', [NewspaperCategoryController::class, 'create'])->name('newspaperCategory.create');
    Route::post('store-newspaper-category', [NewspaperCategoryController::class, 'store'])->name('newspaperCategory.store');
    Route::get('edit-newspaper-category/{id}', [NewspaperCategoryController::class, 'edit'])->name('newspaperCategory.edit');
    Route::post('update-newspaper-category/{id}', [NewspaperCategoryController::class, 'update'])->name('newspaperCategory.update');
    Route::delete('delete-newspaper-category/{id}', [NewspaperCategoryController::class, 'destroy'])->name('newspaperCategory.delete');

    //Newspaper Periodicity
    Route::get('newspaper-periodicity', [NewspaperPeriodicityController::class, 'index'])->name('newspaperPeriodicity.index');
    Route::get('create-newspaper-periodicity', [NewspaperPeriodicityController::class, 'create'])->name('newspaperPeriodicity.create');
    Route::post('store-newspaper-periodicity', [NewspaperPeriodicityController::class, 'store'])->name('newspaperPeriodicity.store');
    Route::get('edit-newspaper-periodicity/{id}', [NewspaperPeriodicityController::class, 'edit'])->name('newspaperPeriodicity.edit');
    Route::post('update-newspaper-periodicity/{id}', [NewspaperPeriodicityController::class, 'update'])->name('newspaperPeriodicity.update');
    Route::delete('delete-newspaper-periodicity/{id}', [NewspaperPeriodicityController::class, 'destroy'])->name('newspaperPeriodicity.delete');

    //Newspaper Positions & Rates Routes
    Route::get('news-pos-rates', [NewsPosRateController::class, 'index'])->name('newsPosRate.index');
    Route::get('create-news-pos-rate', [NewsPosRateController::class, 'create'])->name('newsPosRate.create');
    Route::post('store-news-pos-rate', [NewsPosRateController::class, 'store'])->name('newsPosRate.store');
    Route::get('edit-news-pos-rate/{id}', [NewsPosRateController::class, 'edit'])->name('newsPosRate.edit');
    Route::post('update-news-pos-rate/{id}', [NewsPosRateController::class, 'update'])->name('newsPosRate.update');
    Route::delete('delete-news-pos-rate/{id}', [NewsPosRateController::class, 'destroy'])->name('newsPosRate.delete');

    // Advertising Agencies Route
    Route::get('adv-agencies', [AdvAgencyController::class, 'index'])->name('advAgency.index');
    Route::get('create-adv-agency', [AdvAgencyController::class, 'create'])->name('advAgency.create');
    Route::post('store-adv-agency', [AdvAgencyController::class, 'store'])->name('advAgency.store');
    Route::get('edit-adv-agency/{id}', [AdvAgencyController::class, 'edit'])->name('advAgency.edit');
    Route::post('update-adv-agency/{id}', [AdvAgencyController::class, 'update'])->name('advAgency.update');
    Route::delete('delete-adv-agency/{id}', [AdvAgencyController::class, 'destroy'])->name('advAgency.delete');

    // Digital Agencies Route
    Route::get('digital-agencies', [AdvAgencyController::class, 'index'])->name('digitalAgency.index');

    //Provinces Routes
    Route::get('provinces', [ProvinceController::class, 'index'])->name('province.index');
    Route::get('create-province', [ProvinceController::class, 'create'])->name('province.create');
    Route::post('store-province', [ProvinceController::class, 'store'])->name('province.store');
    Route::get('edit-province/{id}', [ProvinceController::class, 'edit'])->name('province.edit');
    Route::post('update-province', [ProvinceController::class, 'update'])->name('province.update');
    Route::delete('delete-province/{id}', [ProvinceController::class, 'destroy'])->name('province.delete');

    //District Routes
    Route::get('districts', [DistrictController::class, 'index'])->name('district.index');
    Route::get('create-district', [DistrictController::class, 'create'])->name('district.create');
    Route::post('store-district', [DistrictController::class, 'store'])->name('district.store');
    Route::get('edit-district/{id}', [DistrictController::class, 'edit'])->name('district.edit');
    Route::post('update-district', [DistrictController::class, 'update'])->name('district.update');
    Route::delete('delete-district/{id}', [DistrictController::class, 'destroy'])->name('district.delete');

    //Language Routes
    Route::get('languages', [LanguageController::class, 'index'])->name('language.index');
    Route::get('create-language', [LanguageController::class, 'create'])->name('language.create');
    Route::post('store-language', [LanguageController::class, 'store'])->name('language.store');
    Route::get('edit-language/{id}', [LanguageController::class, 'edit'])->name('language.edit');
    Route::post('update-language/{id}', [LanguageController::class, 'update'])->name('language.update');
    Route::delete('delete-language/{id}', [LanguageController::class, 'destroy'])->name('language.delete');

    //Ad Categories Routes
    Route::get('ad-categories', [AdCategoryController::class, 'index'])->name('adCategory.index');
    Route::get('create-ad-category', [AdCategoryController::class, 'create'])->name('adCategory.create');
    Route::post('store-ad-category', [AdCategoryController::class, 'store'])->name('adCategory.store');
    Route::get('edit-ad-category/{id}', [AdCategoryController::class, 'edit'])->name('adCategory.edit');
    Route::post('update-ad-category/{id}', [AdCategoryController::class, 'update'])->name('adCategory.update');
    Route::delete('delete-ad-category/{id}', [AdCategoryController::class, 'destroy'])->name('adCategory.delete');

    //Status Routes
    Route::get('statuses', [StatusController::class, 'index'])->name('status.index');
    Route::get('create-status', [StatusController::class, 'create'])->name('status.create');
    Route::post('store-status', [StatusController::class, 'store'])->name('status.store');
    Route::get('edit-status/{id}', [StatusController::class, 'edit'])->name('status.edit');
    Route::post('update-status/{id}', [StatusController::class, 'update'])->name('status.update');
    Route::delete('delete-status/{id}', [StatusController::class, 'destroy'])->name('status.delete');

    //Classifieds ad routes
    Route::get('classified-ad-types', [ClassifiedAdTypeController::class, 'index'])->name('classifiedAdType.index');
    Route::get('create-classified-ad-type', [ClassifiedAdTypeController::class, 'create'])->name('classifiedAdType.create');
    Route::post('store-classified-ad-type', [ClassifiedAdTypeController::class, 'store'])->name('classifiedAdType.store');
    Route::get('edit-classified-ad-type/{id}', [ClassifiedAdTypeController::class, 'edit'])->name('classifiedAdType.edit');
    Route::post('update-classified-ad-type/{id}', [ClassifiedAdTypeController::class, 'update'])->name('classifiedAdType.update');
    Route::delete('delete-classified-ad-type/{id}', [ClassifiedAdTypeController::class, 'destroy'])->name('classifiedAdType.delete');

    //Department Routes
    Route::get('departments', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('create-department', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('store-department', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('edit-department/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('update-department/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('delete-department/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');

    //Department Categories Routes
    Route::get('department-categories', [DepartmentCategoryController::class, 'index'])->name('departmentCategory.index');
    Route::get('create-department-category', [DepartmentCategoryController::class, 'create'])->name('departmentCategory.create');
    Route::post('store-department-category', [DepartmentCategoryController::class, 'store'])->name('departmentCategory.store');
    Route::get('edit-department-category/{id}', [DepartmentCategoryController::class, 'edit'])->name('departmentCategory.edit');
    Route::post('update-department-category/{id}', [DepartmentCategoryController::class, 'update'])->name('departmentCategory.update');
    Route::delete('delete-department-category/{id}', [DepartmentCategoryController::class, 'destroy'])->name('departmentCategory.delete');

    //Office Routes
    Route::get('offices', [OfficeController::class, 'index'])->name('office.index');
    Route::get('create-office', [OfficeController::class, 'create'])->name('office.create');
    Route::post('store-office', [OfficeController::class, 'store'])->name('office.store');
    Route::get('edit-office/{id}', [OfficeController::class, 'edit'])->name('office.edit');
    Route::post('update-office/{id}', [OfficeController::class, 'update'])->name('office.update');
    Route::delete('delete-office/{id}', [OfficeController::class, 'destroy'])->name('office.delete');

    //Office Categories Routes
    Route::get('office-categories', [OfficeCategoryController::class, 'index'])->name('officeCategory.index');
    Route::get('create-office-category', [OfficeCategoryController::class, 'create'])->name('officeCategory.create');
    Route::post('store-office-category', [OfficeCategoryController::class, 'store'])->name('officeCategory.store');
    Route::get('edit-office-category/{id}', [OfficeCategoryController::class, 'edit'])->name('officeCategory.edit');
    Route::post('update-office-category/{id}', [OfficeCategoryController::class, 'update'])->name('officeCategory.update');
    Route::delete('delete-office-category/{id}', [OfficeCategoryController::class, 'destroy'])->name('officeCategory.delete');

    //Ad Rejection Reason Routes
    Route::get('ad-rejection-reasons', [AdRejectionReasonController::class, 'index'])->name('adRejectionReason.index');
    Route::get('create-ad-rejection-reason', [AdRejectionReasonController::class, 'create'])->name('adRejectionReason.create');
    Route::post('store-ad-rejection-reason', [AdRejectionReasonController::class, 'store'])->name('adRejectionReason.store');
    Route::get('edit-ad-rejection-reason/{id}', [AdRejectionReasonController::class, 'edit'])->name('adRejectionReason.edit');
    Route::post('update-ad-rejection-reason/{id}', [AdRejectionReasonController::class, 'update'])->name('adRejectionReason.update');
    Route::delete('delete-ad-rejection-reason/{id}', [AdRejectionReasonController::class, 'destroy'])->name('adRejectionReason.delete');
});


//Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
