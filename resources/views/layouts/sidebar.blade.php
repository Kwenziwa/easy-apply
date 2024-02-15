<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu active">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('home') }}">
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
    </div>
</div>
<!-- Left Sidebar End -->
