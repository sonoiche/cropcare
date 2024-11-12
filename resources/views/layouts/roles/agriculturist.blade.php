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
                <a class="sidebar-link" href="{{ url('agriculturist/consultations') }}">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Consultations</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('agriculturist/geographics') }}">
                    <i class="align-middle" data-feather="map"></i>
                    <span class="align-middle">GIS</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#reports-land" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="bar-chart"></i>
                    <span class="align-middle">Reports</span>
                </a>
                <ul id="reports-land" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('agriculturist/reports/available-lands') }}">Farm Lands</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('agriculturist/reports/report-consultations') }}">Consultations</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>