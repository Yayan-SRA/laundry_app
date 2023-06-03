<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Attributes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="input-group justify-content-center">
                        <div class="p-1">
                            @if (request('store'))
                                <form action="/dashboard/super/attributes">
                                    <input type="hidden" name="store" value="{{ request('store') }}">
                                @else
                                    <form action="/dashboard/super/master/attributes">
                            @endif
                            <input type="hidden" name="attr" value="Types">
                            <button class="btn btn-secondary btn-lg" type="submit">Types</button>
                            </form>
                        </div>
                        <div class="p-1">
                            @if (request('store'))
                                <form action="/dashboard/super/attributes">
                                    <input type="hidden" name="store" value="{{ request('store') }}">
                                @else
                                    <form action="/dashboard/super/master/attributes">
                            @endif
                            <input type="hidden" name="attr" value="Products">
                            <button class="btn btn-secondary btn-lg" type="submit">Products</button>
                            </form>
                        </div>
                        <div class="p-1">
                            @if (request('store'))
                                <form action="/dashboard/super/attributes">
                                    <input type="hidden" name="store" value="{{ request('store') }}">
                                @else
                                    <form action="/dashboard/super/master/attributes">
                            @endif
                            <input type="hidden" name="attr" value="Services">
                            <button class="btn btn-secondary btn-lg" type="submit">Services</button>
                            </form>
                        </div>
                        <div class="p-1">
                            @if (request('store'))
                                <form action="/dashboard/super/attributes">
                                    <input type="hidden" name="store" value="{{ request('store') }}">
                                @else
                                    <form action="/dashboard/super/master/attributes">
                            @endif
                            <input type="hidden" name="attr" value="Durations">
                            <button class="btn btn-secondary btn-lg" type="submit">Durations</button>
                            </form>
                        </div>
                        @if (request('store'))
                        @else
                            <div class="p-1">
                                <form action="/dashboard/super/master/attributes">
                                    <input type="hidden" name="attr" value="Prices">
                                    <button class="btn btn-secondary btn-lg" type="submit">Prices</button>
                                </form>
                            </div>
                            <div class="p-1">
                                <form action="/dashboard/super/master/attributes">
                                    <input type="hidden" name="attr" value="Units">
                                    <button class="btn btn-secondary btn-lg" type="submit">Units</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
