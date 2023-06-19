{{-- modal-creat-form popup --}}
<div class="modal fade" id="modal-create-form" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden">
                <form id="create-form">
                    @csrf
                    <div class="mb-3">
                        <label for="provider" class="form-label">Provider</label>
                        <input type="text" class="form-control" id="create-provider" name="provider" required>
                    </div>
                    <div class="mb-3">
                        <label for="option" class="form-label">Option</label>
                        <input type="text" class="form-control" id="create-option" name="option" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="create-price" name="price" required>
                    </div>
                    <div class="modal-footer row">
    <div class="col-5">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="background-color: #8f9fba;">Close</button>
    </div>
    <div class="col-6">
        <button type="submit" class="btn btn-primary" style="background-color: #8f9fba;">Save Change</button>
    </div>
</div>


                </form>
            </div>
        </div>
    </div>
</div>
