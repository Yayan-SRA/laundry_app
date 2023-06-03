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
                            @if (request('store'))
                                <a class="nav-link fs-6" href="/dashboard/super?store={{ request('store') }}">
                                @else
                                    <a class="nav-link fs-6" href="/dashboard/super">
                            @endif
                            <span data-feather="command" class="align-text-bottom"></span>
                            Command
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="accordion" id="accordionCommands">
                                <div class="accordion-item bg-light border-0">
                                    <a href="/dashboard/super" class="accordion-button collapsed nav-link bg-light fs-6"
                                        style="padding-left:1em;padding-top:0.5em;padding-bottom:0.5em" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#commands" aria-expanded="false"
                                        aria-controls="commands">
                                        <span data-feather="sliders" class="align-text-bottom"
                                            style="margin-right: 0.5em"></span>
                                        Attributes
                                    </a>
                                    @include('dashboard.layouts.accordianSidebarSuper')
                                </div>
                            </div>
                        </li>
                        @if (request('store'))
                            <li class="nav-item">
                                <a class="nav-link fs-6" href="/dashboard/super/order?store={{ request('store') }}">
                                    <span data-feather="plus-square" class="mb-1"></span>
                                    Add Order
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6" href="/dashboard/super/transactions?store={{ request('store') }}">
                                    <span data-feather="book-open" class="mb-1"></span>
                                    Transactions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6" href="/dashboard/super/customers?store={{ request('store') }}">
                                    <span data-feather="users" class="mb-1"></span>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6"
                                    href="/dashboard/super/cashiers/create?store={{ request('store') }}">
                                    <span data-feather="dollar-sign" class="mb-1"></span>
                                    Cashier
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6"
                                    href="/dashboard/super/expenditure/create?store={{ request('store') }}">
                                    <span data-feather="credit-card" class="mb-1"></span>
                                    Expenditure
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6" href="/dashboard/super/finance?store={{ request('store') }}">
                                    <span data-feather="trending-up" class="mb-1"></span>
                                    Finance
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link fs-6" href="/dashboard/super/master/user">
                                    <span data-feather="users" class="mb-1"></span>
                                    User
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6" href="/dashboard/super/master/store">
                                    <span data-feather="grid" class="mb-1"></span>
                                    Store
                                </a>
                            </li>
                        @endif
                    </ul>
                @endcan
            </div>
        </nav>
    </div>
</div>
