<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                @can('admin')
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                                href="/dashboard">
                                <span data-feather="home" class="mb-1"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/cashiers*') ? 'active' : '' }}" aria-current="page"
                                href="/dashboard/cashiers/create">
                                <span data-feather="dollar-sign" class="mb-1"></span>
                                Cashier
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/customers*') ? 'active' : '' }}"
                                aria-current="page" href="/dashboard/customers">
                                <span data-feather="users" class="mb-1"></span>
                                Customer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/transactions*') ? 'active' : '' }}"
                                aria-current="page" href="/dashboard/transactions">
                                <span data-feather="file-text" class="mb-1"></span>
                                Transaction
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/expenditures*') ? 'active' : '' }}"
                                aria-current="page" href="/dashboard/expenditures/create">
                                <span data-feather="archive" class="mb-1"></span>
                                Expenditure
                            </a>
                        </li>
                    </ul>
                @endcan
                @can('super')
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                        <span>Super Admin</span>
                        {{-- <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle" class="align-text-bottom"></span>
                        </a> --}}
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/super">
                                <span data-feather="command" class="align-text-bottom"></span>
                                Command
                            </a>
                        </li>
                    </ul>
                @endcan
            </div>
        </nav>
    </div>
</div>
