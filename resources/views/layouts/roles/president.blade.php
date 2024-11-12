<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ url('home') }}">
            <img src="{{ url('logo.png') }}" style="width: 20%" />
            <span class="align-middle">{{ config('app.name') }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{ url('home') }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#manage-farmers" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Manage Farmers</span>
                </a>
                <ul id="manage-farmers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/farmers') }}">List of Farmers</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/farmers/create') }}">Add Farmer</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="sidebar-item">
                <a data-bs-target="#manage-farms" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="map"></i>
                    <span class="align-middle">Manage Farm Land</span>
                </a>
                <ul id="manage-farms" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/farms') }}">List of Land</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/farms/create') }}">Add New Farm Land</a>
                    </li>
                </ul>
            </li> --}}
            <li class="sidebar-item">
                <a data-bs-target="#manage-farms" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="map"></i>
                    <span class="align-middle">GIS</span>
                </a>
                <ul id="manage-farms" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/geographics') }}">List of GIS</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/geographics/create') }}">Add GIS</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#consulations" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="edit-3"></i>
                    <span class="align-middle">My Consultations</span>
                </a>
                <ul id="consulations" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/consultations') }}">List of Consultations</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/consultations/create') }}">Add Consultation</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#reports-land" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="bar-chart"></i>
                    <span class="align-middle">Reports</span>
                </a>
                <ul id="reports-land" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/reports/lands') }}">Land Reports</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('president/reports/farmers') }}">Farmer Reports</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>