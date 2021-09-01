<!-- Modal edit -->
<div class="modal fade bottom" id="modal-edit" tabindex="-1" 
     role="dialog" aria-labelledby="modal-create" aria-hidden="true">
    <div class="modal-dialog modal-default" role="document">
        <div class="modal-content">
            <div class="modal-header orange darken-4 white-text">
                <label class="modal-title" id="modal-create-label">
                    <strong>
                        <i class="fas fa-folder-open"></i> Edit
                    </strong>
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="white-text" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="edit-content" class="modal-body">
                <div class="text-center grey-text m-5 p-5">
                    <i class="fas fa-cog fa-spin fa-5x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-deep-orange btn-sm"
                        onclick="$(this).update();">
                    <i class="fas fa-edit"></i> Update
                </button>
                <button type="submit" class="btn btn-red btn-sm"
                        onclick="$(this).showDelete();">
                    <i class="fas fa-trash"></i> Delete
                </button>
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    Close
                </button>
          </div>
        </div>
    </div>
</div>