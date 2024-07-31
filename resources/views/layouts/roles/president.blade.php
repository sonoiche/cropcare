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
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('president/listings') }}">
                    <i class="align-middle" data-feather="map"></i>
                    <span class="align-middle">Manage Farmlands</span>
                </a>
            </li>
        </ul>
    </div>
</nav>