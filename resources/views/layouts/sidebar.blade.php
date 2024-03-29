<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu active">

    <div data-simplebar class="h-100">

        @if(Auth::user()->type == 'user')
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('student.home') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboard')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subjects') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-subjects">Subjects</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('next-of-kin.index') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-next-of-kin">Next Of Kin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-documents.index') }}">
                        <i data-feather="file-plus"></i>
                        <span data-key="t-file-tex">Docs</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        @elseif(Auth::user()->type == 'admin')

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('admin.home') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboard')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-users">@lang('Users')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('universities.index') }}">
                        <i class="mdi mdi-hospital-building"></i>
                        <span data-key="t-universities">@lang('Universities')</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('school-subjects.index') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-subjects">School Subjects</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('programmes.index') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-subjects">Programmes</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('next-of-kin.index') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-next-of-kin">Next Of Kin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-documents.index') }}">
                        <i data-feather="file-plus"></i>
                        <span data-key="t-file-tex">Docs</span>
                    </a>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->

        @elseif(Auth::user()->type == 'university')

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('university.home') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboard')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-programmes.index') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-subjects">Programmes</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->

        @endif

    </div>
</div>
<!-- Left Sidebar End -->
