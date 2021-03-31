<li class="nav-item">
        <span
            class="nav-link  collapsed  d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#submenu-trans">
          <span>
            <span class="sidebar-icon"><span class="fas fa-money-bill-wave"></span></span>
            <span class="sidebar-text">Transactions</span>
          </span>
          <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
        </span>
    <div class="multi-level collapse "
         role="list" id="submenu-trans" aria-expanded="false">
        <ul class="flex-column nav">

            <li class="nav-item ">
                <a class="nav-link" href="{{route('transactions.create')}}">
                    <span class="sidebar-text">New Transaction</span>
                </a>
            </li>

            @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
            <li class="nav-item ">
                <a class="nav-link" href="{{route('transactions.index')}}">
                    <span class="sidebar-text">View All Transactions</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</li>
