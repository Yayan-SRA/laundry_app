<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/dashboard">Laundry App</a>
    {{-- @can('super')
        <form method="post" action="/dashboard">
            @csrf
            <div class="form-group">
                <select class="form-select text-white border-0" style="background-color:rgba(0, 0, 0, 1)" name="store"
                    id="store">
                    <option value="master">Master</option>
                    @foreach ($stores as $store)
                        @if (request('store'))
                            @if ($store->id === $selected->id)
                                <option value="{{ $store->name }}" selected onclick="store()">{{ $store->name }}</option>
                            @else
                                <option value="{{ $store->name }}" onclick="store()">{{ $store->name }}</option>
                            @endif
                        @else
                            <option value="{{ $store->name }}" onclick="store()">{{ $store->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </form>
    @endcan --}}
    <button class="navbar-toggler position-static d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
        aria-label="Search"> --}}
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            {{-- <a class="nav-link px-3" href="#">Log out</a> --}}
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="nav-link px-3"><i data-feather="log-out"></i>
                    Logout</button>
            </form>
        </div>
    </div>
</header>
{{-- <script>
    const element = document.querySelector('#store');
    console.log(element.value === 'master');
    // if (element.value === 'master') {
    //     console.log('1', element.value)
    //     // let url = "{{ route('dashboard.super', 'store') }}";
    //     // url = url.replace('store', '');
    //     // location.href = url;
    // } else {
    element.addEventListener("change", () => {
        if (element.value === 'master') {
            let url = "{{ route('dashboard.super') }}";
            // url = url.replace('store', '');
            location.href = url;
            // console.log('1', element.value)
        } else {
            // console.log(element.value);
            let url = "{{ route('dashboard.super', 'store') }}";
            url = url.replace('store', 'store=' + element.value);
            location.href = url;
        }
    });
    // }
    // let element = document.getElementsById("store_id")[0];
</script> --}}
