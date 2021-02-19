<li class="nav-item
@if(\Illuminate\Support\Facades\Route::is('dashboard.index'))
    active
@endif
">
    <a href="{{route('dashboard.index')}}" class="nav-link">
        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
        <span class="sidebar-text">Dashboard</span>
    </a>
</li>
