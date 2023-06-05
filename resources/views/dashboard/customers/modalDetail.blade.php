@foreach ($customers as $customer)
    <!-- Modal -->
    <div class="modal fade" id="detail{{ $customer->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Customer Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $customer->key }}" readonly>
                                    <label>Code</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $customer->name }}" readonly>
                                    <label>Customer Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $customer->phone_number }}"
                                        readonly>
                                    <label>Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $customer->address }}"
                                        readonly>
                                    <label>Address</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
