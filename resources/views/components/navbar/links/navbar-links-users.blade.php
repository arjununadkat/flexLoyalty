<li class="nav-item">
        <span
            class="nav-link  collapsed  d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#submenu-user">
          <span>
            <span class="sidebar-icon"><span class="fas fa-table"></span></span>
            <span class="sidebar-text">Users</span>
          </span>
          <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
        </span>
    <div class="multi-level collapse "
         role="list" id="submenu-user" aria-expanded="false">
        <ul class="flex-column nav">
            @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('users.create')}}">
                        <span class="sidebar-text">Create New User</span>
                    </a>
                </li>
            @endif
            <li class="nav-item ">
                <a class="nav-link" href="{{route('users.index')}}">
                    <span class="sidebar-text">View All Users</span>
                </a>
            </li>
        </ul>
    </div>
</li>
