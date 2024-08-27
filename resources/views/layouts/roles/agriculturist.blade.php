<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ url('home') }}">
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
                <a data-bs-target="#consulations" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Consultations</span>
                </a>
                <ul id="consulations" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('agriculturist/consultations') }}">List of Consultations</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('agriculturist/consultations/create') }}">Add Consultation</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('agriculturist/geographics') }}">
                    <i class="align-middle" data-feather="map"></i>
                    <span class="align-middle">GIS</span>
                </a>
            </li>
        </ul>
    </div>
</nav>