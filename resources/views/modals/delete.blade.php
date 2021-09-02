<!-- Modal delete -->
<div class="modal fade bottom" id="modal-delete" tabindex="-1" 
     role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
    <div class="modal-dialog modal-default modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header red darken-4 white-text">
                <label class="modal-title" id="modal-delete-label">
                    <strong>
                        <i class="fas fa-trash"></i> Delete
                    </strong>
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="white-text" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-times-circle fa-3x red-text mb-4"></i>
                <h6>
                    Are you sure you want to delete this data?
                </h6>

                <form id="form-delete" method="POST">
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-red btn-sm"
                        onclick="$(this).delete();">
                    <i class="fas fa-trash"></i> Yes
                </button>
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    No
                </button>
          </div>
        </div>
    </div>
</div>