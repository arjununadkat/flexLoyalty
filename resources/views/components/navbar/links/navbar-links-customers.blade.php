<li class="nav-item">
        <span
            class="nav-link  collapsed  d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#submenu-cust">
          <span>
            <span class="sidebar-icon"><span class="fas fa-table"></span></span>
            <span class="sidebar-text">Customers</span>
          </span>
          <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
        </span>
    <div class="multi-level collapse "
         role="list" id="submenu-cust" aria-expanded="false">
        <ul class="flex-column nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{route('customers.create')}}">
                    <span class="sidebar-text">Create New Customer</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{route('customers.index')}}">
                    <span class="sidebar-text">View All Customers</span>
                </a>
            </li>
        </ul>
    </div>
</li>
