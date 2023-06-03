<!-- Modal -->
<div class="modal fade" id="addStore" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Add Store</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/super/master/store" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('name')
                            is-invalid
                        @enderror"
                            id="name" required value="{{ old('name') }}" name="name"
                            placeholder="store name (min length 5)">
                        <label for="name">Name</label>
                        @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea type="text"
                            class="form-control @error('address')
                            is-invalid
                        @enderror"
                            id="address" required value="{{ old('address') }}" name="address" placeholder="store address (min length 10)"></textarea>
                        <label for="address">Address</label>
                        @error('address')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
