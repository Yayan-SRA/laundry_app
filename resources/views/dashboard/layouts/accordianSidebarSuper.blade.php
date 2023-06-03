<div id="commands" class="accordion-collapse collapse" data-bs-parent="#accordionCommands">
    <div class="accordion-body p-0">
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                @if (request('store'))
                    <a class="nav-link" style="margin-left: 1.5em"
                        href="/dashboard/super/attributes?store={{ request('store') }}&attr=Types">
                    @else
                        <a class="nav-link" style="margin-left: 1.5em"
                            href="/dashboard/super/master/attributes?attr=Types">
                @endif
                <span data-feather="layers" class="align-text-bottom"></span>
                Types
                </a>
            </li>
            <li class="nav-item">
                @if (request('store'))
                    <a class="nav-link" style="margin-left: 1.5em"
                        href="/dashboard/super/attributes?store={{ request('store') }}&attr=Products">
                    @else
                        <a class="nav-link" style="margin-left: 1.5em"
                            href="/dashboard/super/master/attributes?attr=Products">
                @endif
                <span data-feather="tag" class="align-text-bottom"></span>
                Products
                </a>
            </li>
            <li class="nav-item">
                @if (request('store'))
                    <a class="nav-link" style="margin-left: 1.5em"
                        href="/dashboard/super/attributes?store={{ request('store') }}&attr=Services">
                    @else
                        <a class="nav-link" style="margin-left: 1.5em"
                            href="/dashboard/super/master/attributes?attr=Services">
                @endif
                <span data-feather="slack" class="align-text-bottom"></span>
                Services
                </a>
            </li>
            <li class="nav-item">
                @if (request('store'))
                    <a class="nav-link" style="margin-left: 1.5em"
                        href="/dashboard/super/attributes?store={{ request('store') }}&attr=Durations">
                    @else
                        <a class="nav-link" style="margin-left: 1.5em"
                            href="/dashboard/super/master/attributes?attr=Durations">
                @endif
                <span data-feather="zap" class="align-text-bottom"></span>
                Durations
                </a>
            </li>
            @if (!request('store'))
                <li class="nav-item">
                    <a class="nav-link" style="margin-left: 1.5em"
                        href="/dashboard/super/master/attributes?attr=Prices">
                        <span data-feather="cpu" class="align-text-bottom"></span>
                        Prices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="margin-left: 1.5em" href="/dashboard/super/master/attributes?attr=Units">
                        <span data-feather="cpu" class="align-text-bottom"></span>
                        Units
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
