<li class="nav-item
@if(\Illuminate\Support\Facades\Route::is('project.index'))
    active
@endif
">
    <a href="{{route('project.index')}}" class="nav-link">
        <span class="sidebar-icon"><span class="fas fa-tasks"></span></span>
        <span class="sidebar-text">Project Settings</span>
    </a>
</li>
