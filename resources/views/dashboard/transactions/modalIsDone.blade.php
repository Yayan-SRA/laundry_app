@foreach ($transactions as $transaction)
    <!-- Modal -->
    <div class="modal fade" id="isDone{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">This order has been completed?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/transactions/{{ $transaction->id }}" method="post">
                        @method('put')
                        @csrf
                        <input type="hidden" name="store" value="{{ request('store') }}">
                        <input type="hidden" name="is_done" value="true">
                        <button class="btn btn-success" type="submit">Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
