@foreach ($transactions as $transaction)
    <!-- Modal -->
    <div class="modal fade" id="detail{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $transaction->staff_name }}"
                                        readonly>
                                    <label>Staff Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->customer->name }}" readonly>
                                    <label>Customer Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->customer->phone_number }}" readonly>
                                    <label>Phone Number</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->customer->address }}" readonly>
                                    <label>Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $transaction->type }}"
                                        readonly>
                                    <label>Type</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $transaction->product }}"
                                        readonly>
                                    <label>Product</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $transaction->service }}"
                                        readonly>
                                    <label>Service</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $transaction->duration }}"
                                        readonly>
                                    <label>Duration</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="@rupiah($transaction->price) " readonly>
                                    <label>Price</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->quantity }} {{ $transaction->unit }}" readonly>
                                    <label>Quantity</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control text-center fs-5"
                                        style="font-weight: bold" value=" @rupiah($transaction->total_price) " readonly>
                                    <label style="margin: auto">Total Price</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $transaction->created_at }}"
                                        readonly>
                                    <label>Date Entry</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"
                                        value="{{ $transaction->target_date_complete }}" readonly>
                                    <label>Target Date Complete</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    @if ($transaction->date_complete === null)
                                        <input type="text" class="form-control" value="Not finished yet" readonly>
                                    @else
                                        <input type="text" class="form-control"
                                            value="{{ $transaction->date_complete }}" readonly>
                                    @endif
                                    <label>Date Complete</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    @if ($transaction->is_done)
                                        <input type="text" class="form-control" value="Done" readonly>
                                    @else
                                        <input type="text" class="form-control" value="Process" readonly>
                                    @endif
                                    <label>Status</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    @if ($transaction->cod)
                                        <input type="text" class="form-control" value="Yes" readonly>
                                    @else
                                        <input type="text" class="form-control" value="No" readonly>
                                    @endif
                                    <label>COD</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="{{ $transaction->note }}"
                                        readonly>
                                    <label>Note</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    @if ($transaction->is_paid)
                                        <input type="text" class="form-control" value="Paid" readonly>
                                    @else
                                        <input type="text" class="form-control" value="Not yet" readonly>
                                    @endif
                                    <label>Payment Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if ($transaction->is_done && !$transaction->is_paid)
                            <a href="https://api.whatsapp.com/send/?phone={{ $transaction->customer->phone_number }}&text=Laundry {{ $transaction->product }} atas nama : {{ $transaction->customer->name }}, sudah siap. Biaya sebesar @rupiah($transaction->total_price)&type=phone_number&app_absent=0"
                                target="_blank" class="btn btn-success"><span data-feather="send"></span> Chat</a>
                        @endif
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
