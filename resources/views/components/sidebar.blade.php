<!-- Sidebar Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/branding/logo1.png') }}" alt="logo" width="50">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">IAMS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item {{ Request::routeIs('dashboard') ? 'open active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Adds -->
        @can('View advertisements')
            <li class="menu-item {{ Request::routeIs('advertisements.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-book-add"></i>
                    <div data-i18n="Advertisements">Advertisements</div>
                </a>
                <ul class="menu-sub">
                    {{-- create Ad --}}
                    @can('Create advertisement')
                        <li class="menu-item {{ Request::routeIs('advertisements.create') ? 'open active' : '' }}">
                            <a href="{{ route('advertisements.create') }}" class="menu-link">
                                <div data-i18n="Create">Create</div>
                            </a>
                        </li>
                    @endcan

                    {{-- New Ads --}}
                    <li class="menu-item {{ Request::routeIs('advertisements.index') ? 'open active' : '' }}">
                        <a href="{{ route('advertisements.index') }}" class="menu-link">
                            <div data-i18n="New Ads">New Ads</div>
                        </a>
                    </li>

                    {{-- Pending --}}
                    @can('view inprogress ads')
                        <li class="menu-item {{ Request::routeIs('advertisements.inprogress') ? 'open active' : '' }}">
                            <a href="{{ route('advertisements.inprogress') }}" class="menu-link">
                                <div data-i18n="In Progress">In Progress</div>
                            </a>
                        </li>
                    @endcan

                    {{-- Draft --}}
                    @can('view draft')
                        <li class="menu-item {{ Request::routeIs('advertisements.draft') ? 'open active' : '' }}">
                            <a href="{{ route('advertisements.draft') }}" class="menu-link">
                                <div data-i18n="Drafts">Drafts</div>
                            </a>
                        </li>
                    @endcan

                    {{-- Cancelled --}}
                    @can('View cancelled adv')
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Cancelled">Cancelled</div>
                            </a>
                        </li>
                    @endcan

                    {{-- Approved --}}
                    @can('view approved adv')
                        <li class="menu-item {{ Request::routeIs('advertisements.approved') ? 'open active' : '' }}">
                            <a href="{{ route('advertisements.approved') }}" class="menu-link">
                                <div data-i18n="Approved">Approved</div>
                            </a>
                        </li>
                    @endcan

                    {{-- Rejected --}}
                    @can('view rejected adv')
                        <li class="menu-item {{ Request::routeIs('advertisements.rejected') ? 'open active' : '' }}">
                            <a href="{{ route('advertisements.rejected') }}" class="menu-link">
                                <div data-i18n="Rejected">Rejected</div>
                            </a>
                        </li>
                    @endcan


                    {{-- Published --}}
                    @can('view published adv')
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Published">Published</div>
                            </a>
                        </li>
                    @endcan

                    {{-- Not Published --}}
                    @can('view not published adv')
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Not Published">Not Published</div>
                            </a>
                        </li>
                    @endcan


                    {{-- Archive --}}
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div data-i18n="Archive">Archive</div>
                        </a>
                    </li>

                    {{-- INF Series --}}
                    @can('view inf series')
                        <li class="menu-item">
                            <a href=" {{ route('inf_series.index') }}" class="menu-link">
                                <div data-i18n="INF Series">INF Series</div>
                            </a>
                        </li>
                    @endcan

                    {{-- Classified Ads - Agencies --}}
                    @can('view classified ads')
                        <li class="menu-item">
                            <a href="" class="menu-link">
                                <div data-i18n="Classified Ads - Agencies">Classified Ads - Agencies</div>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan

        <!-- Financials  -->
        @can('view financials')
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Payments &amp; Billings</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-credit-card"></i>
                    <div data-i18n="Financials">Financials</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Payments">Payments</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Billings">Billings</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


        {{--  Newspapers --}}
        @can('view newspapers')
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Apps &amp; Pages</span>
            </li>
            <li class="menu-item {{ Request::routeIs('master.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="Newspapers">Newspapers</div>
                </a>
                {{-- {{ Request::routeIs('master.province') ? 'active' : '' }} --}}
                <ul class="menu-sub">

                    {{-- All newspaper --}}
                    <li class="menu-item">
                        <a href="{{ route('newspaper.index') }}" class="menu-link">

                            <div data-i18n="All"> All</div>
                        </a>
                    </li>
                    {{-- Newspaper category --}}
                    <li class="menu-item">
                        <a href="{{ route('newspaperCategory.index') }}" class="menu-link">
                            <div data-i18n="Category">Category</div>
                        </a>
                    </li>
                    {{-- Newspaper Periodicity --}}
                    <li class="menu-item">
                        <a href="{{ route('newspaperPeriodicity.index') }}" class="menu-link">
                            <div data-i18n="Periodicity">Periodicity</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


        {{--  Advertising Agencies --}}
        @can('view advertising Agencies')
            <li class="menu-item {{ Request::routeIs('master.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-briefcase"></i>
                    <div data-i18n="Advertising Agencies">Advertising Agencies</div>
                </a>
                {{-- {{ Request::routeIs('master.province') ? 'active' : '' }} --}}
                <ul class="menu-sub">

                    {{-- Adv. Agencies --}}
                    <li class="menu-item">
                        <a href="{{ route('advAgency.index') }}" class="menu-link">
                            <div data-i18n="Adv. Agencies"> Adv. Agencies</div>
                        </a>
                    </li>
                    {{-- Digital Agencies --}}
                    <li class="menu-item">
                        <a href="{{ route('digitalAgency.index') }}" class="menu-link">
                            <div data-i18n="Digital Agencies">Digital Agencies</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


        {{--  TV Channels --}}
        {{-- <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tv"></i>
                <div data-i18n=" TV Channels"> TV Channels</div>
            </a>
        </li> --}}

        {{--  Radio Stations --}}
        {{-- <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-radio"></i>
                <div data-i18n=" Radio Stations"> Radio Stations</div>
            </a>
        </li> --}}

        {{--  Telecom Operators --}}
        {{-- <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wifi"></i>
                <div data-i18n=" Telecom Operators"> Telecom Operators</div>
            </a>
        </li> --}}

        {{--  Campaigns --}}
        {{-- <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-flag"></i>
                <div data-i18n=" Campaigns"> Campaigns</div>
            </a>
        </li> --}}


        {{--  Reports --}}
        @can('view reports')
            <li class="menu-item">
                <a href="" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n=" Reports"> Reports</div>
                </a>
            </li>
        @endcan


        {{-- Settings/Admin Panel
        <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n=" Settings/Admin Panel"> Settings/Admin Panel</div>
            </a>
        </li> --}}


        {{--  Diary Dispatch --}}
        @can('View dairy dispatch')
            <li class="menu-item">
                <a href="" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-notepad"></i>
                    <div data-i18n=" Diary Dispatch"> Diary Dispatch</div>
                </a>
            </li>
        @endcan


        <!-- Master Data -->
        @role('Super Admin')
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Master Data</span></li>
            <li class="menu-item {{ Request::routeIs('master.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div data-i18n="Master Data">Master Data</div>
                </a>
                {{-- {{ Request::routeIs('master.province') ? 'active' : '' }} --}}
                <ul class="menu-sub">

                    {{-- Publisher Types --}}
                    <li class="menu-item">
                        <a href="{{ route('publisherType.index') }}" class="menu-link">
                            <div data-i18n="Publisher types">Publisher types</div>
                        </a>
                    </li>

                    {{-- Tax Types --}}
                    <li class="menu-item">
                        <a href="{{ route('taxType.index') }}" class="menu-link">
                            <div data-i18n="Tax Types">Tax Types</div>
                        </a>
                    </li>

                    {{-- Tax Payees --}}
                    <li class="menu-item">
                        <a href="{{ route('taxPayee.index') }}" class="menu-link">
                            <div data-i18n="Tax Payees">Tax Payees</div>
                        </a>
                    </li>

                    {{-- Cancel --}}
                    <li class="menu-item">
                        <a href="{{ route('newsPosRate.index') }}" class="menu-link">
                            <div data-i18n="Newspapers Positions & Rates">Newspapers Positions & Rates</div>
                        </a>
                    </li>

                    {{-- Ad Worth Parameters --}}
                    <li class="menu-item">
                        <a href="{{ route('adWorthParameter.index') }}" class="menu-link">
                            <div data-i18n="Ad Worth Parameters">Ad Worth Parameters</div>
                        </a>
                    </li>

                    {{-- Classified Ad Types --}}
                    <li class="menu-item">
                        <a href="{{ route('classifiedAdType.index') }}" class="menu-link">
                            <div data-i18n="Classified Ad Types">Classified Ad Types</div>
                        </a>
                    </li>

                    {{-- Ad Categories --}}
                    <li class="menu-item">
                        <a href="{{ route('adCategory.index') }}" class="menu-link">
                            <div data-i18n="Ad Categories">Ad Categories</div>
                        </a>
                    </li>

                    {{-- Ad Submission Threshold --}}
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div data-i18n="Ad Submission Threshold">Ad Submission Threshold</div>
                        </a>
                    </li>

                    {{-- Ad Rejection Reasons --}}
                    <li class="menu-item">
                        <a href="{{ route('adRejectionReason.index') }}" class="menu-link">
                            <div data-i18n="Ad Rejection Reasons">Ad Rejection Reasons</div>
                        </a>
                    </li>

                    {{-- Departments --}}
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <div data-i18n="Departments">Departments</div>
                        </a>
                        <ul class="menu-sub">

                            {{-- All Department --}}
                            <li class="menu-item">
                                <a href="{{ route('department.index') }}" class="menu-link">
                                    <div data-i18n="All">All</div>
                                </a>
                            </li>

                            {{-- Department Categories --}}
                            <li class="menu-item">
                                <a href="{{ route('departmentCategory.index') }}" class="menu-link">
                                    <div data-i18n="Categories">Categories</div>
                                </a>
                            </li>

                            {{-- Department Status --}}
                            <li class="menu-item">
                                <a href="{{ route('status.index') }}" class="menu-link">
                                    <div data-i18n="Status">Status</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Offices --}}
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <div data-i18n="Offices">Offices</div>
                        </a>
                        <ul class="menu-sub">

                            {{-- All Offices --}}
                            <li class="menu-item">
                                <a href="{{ route('office.index') }}" class="menu-link">
                                    <div data-i18n="All">All</div>
                                </a>
                            </li>

                            {{-- Office Categories --}}
                            <li class="menu-item">
                                <a href="{{ route('officeCategory.index') }}" class="menu-link">
                                    <div data-i18n="Categories">Categories</div>
                                </a>
                            </li>

                            {{-- Office Status --}}
                            <li class="menu-item">
                                <a href="pages-profile-teams.html" class="menu-link">
                                    <div data-i18n="Status">Status</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Provinces --}}
                    <li class="menu-item">
                        <a href="{{ route('province.index') }}" class="menu-link">
                            <div data-i18n="Provinces">Provinces</div>
                        </a>
                    </li>

                    {{-- Divisions --}}
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div data-i18n="Divisions">Divisions</div>
                        </a>
                    </li>

                    {{-- Districts --}}
                    <li class="menu-item">
                        <a href="{{ route('district.index') }}" class="menu-link">
                            <div data-i18n="Districts">Districts</div>
                        </a>
                    </li>

                    {{-- Tehsils --}}
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div data-i18n="Tehsils">Tehsils</div>
                        </a>
                    </li>

                    {{-- VCs/NCs --}}
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <div data-i18n="VCs/NCs">VCs/NCs</div>
                        </a>
                    </li>

                    {{-- Languages --}}
                    <li class="menu-item">
                        <a href="{{ route('language.index') }}" class="menu-link">
                            <div data-i18n="Languages">Languages</div>
                        </a>
                    </li>

                    {{-- Status --}}
                    <li class="menu-item">
                        <a href="{{ route('status.index') }}" class="menu-link">
                            <div data-i18n="Status">Status</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole

        {{--  Digital Assets --}}

        <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cloud"></i>
                <div data-i18n=" Digital Assets"> Digital Assets</div>
            </a>
        </li>

        <!-- User Management -->
        @role(['Super Admin'])
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Users &amp; Managements</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                    <div data-i18n="User Management">User Management</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('user.index') }}" class="menu-link">
                            <div data-i18n="Users">Users</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('role.index') }}" class="menu-link">
                            <div data-i18n="Roles">Roles</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('permission.index') }}" class="menu-link">
                            <div data-i18n="Permissions">Permissions</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Password Reset Request">Password Reset Request</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="User Log">User Log</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole

        <!-- Support Section -->
        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Support Section</span></li>
        <li class="menu-item">
            <a href="https://pixinvent.ticksy.com/" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="https://pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/documentation-bs5/"
                target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li> --}}
    </ul>
</aside>
<!-- / sidebar Menu -->
