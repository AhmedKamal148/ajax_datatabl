<!-- Edit_Modal -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="update_form">
                    @csrf
                    <input type="hidden" name="city_id">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="edit_Name" type="text" class="form-control" id="name" aria-describedby="cityName"
                               placeholder="Enter Name">
                        @error('name')
                        <small id="cityName" class="form-text text-muted">{{$message}}</small>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="updateCity" type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>