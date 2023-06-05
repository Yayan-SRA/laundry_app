@foreach ($customers as $customer)
    <!-- Modal -->
    <div class="modal fade" id="edit{{ $customer->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Customer Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/customers/{{ $customer->id }}" method="post">
                        @method('put')
                        @csrf
                        @if (request('store'))
                            <input type="hidden" name="store" value="{{ request('store') }}">
                        @endif
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{ $customer->key }}" readonly
                                            disabled>
                                        <label>Code</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $customer->name }}">
                                        <label for="name">Customer Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            value="{{ $customer->phone_number }}">
                                        <label for="phone_number">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="{{ $customer->address }}">
                                        <label for="address">Address</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
