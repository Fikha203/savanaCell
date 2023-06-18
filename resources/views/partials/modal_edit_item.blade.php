{{-- modal edit-form popup --}}
<div class="modal fade" id="modal-edit-form" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id">
                <form id="edit-form" method='patch'>
                    @csrf
                    <div class="mb-3">
                        <label for="provider" class="form-label">Provider</label>
                        <input type="text" class="form-control" id="edit-provider" name="provider" required>
                    </div>
                    <div class="mb-3">
                        <label for="option" class="form-label">Option</label>
                        <input type="text" class="form-control" id="edit-option" name="option" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="edit-price" name="price" required>
                    </div>
                    <div class="modal-footer row">
                        <div class="col-5">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Save
                                Change</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
