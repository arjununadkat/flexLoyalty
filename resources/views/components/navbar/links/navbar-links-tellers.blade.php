<li class="nav-item">
        <span
            class="nav-link  collapsed  d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#submenu-tells">
          <span>
            <span class="sidebar-icon"><span class="fas fa-table"></span></span>
            <span class="sidebar-text">Tellers</span>
          </span>
          <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
        </span>
    <div class="multi-level collapse "
         role="list" id="submenu-tells" aria-expanded="false">
        <ul class="flex-column nav">
            @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
            <li class="nav-item ">
                <a class="nav-link" href="{{route('tellers.create')}}">
                    <span class="sidebar-text">Create New Teller</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{route('tellers.index')}}">
                    <span class="sidebar-text">View All Tellers</span>
                </a>
            </li>
            @endif
            <li class="nav-item ">
                <a class="nav-link" href="{{route('teller.transactions', auth()->user()->id)}}">
                    <span class="sidebar-text">Teller Transactions</span>
                </a>
            </li>
        </ul>
    </div>
</li>
