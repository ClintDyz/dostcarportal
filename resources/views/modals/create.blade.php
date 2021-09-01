<!-- Modal create -->
<div class="modal fade bottom" id="modal-create" tabindex="-1" 
     role="dialog" aria-labelledby="modal-create" aria-hidden="true">
    <div class="modal-dialog modal-default" role="document">
        <div class="modal-content">
            <div class="modal-header trans-blue-bg white-text">
                <label class="modal-title" id="modal-create-label">
                    <strong>
                        <i class="fas fa-folder-plus"></i> Create
                    </strong>
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="white-text" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="create-content" class="modal-body">
                <div class="text-center grey-text m-5 p-5">
                    <i class="fas fa-cog fa-spin fa-5x"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-mdb-color btn-sm"
                        onclick="$(this).store();">
                    <i class="fas fa-folder-plus"></i> Add
                </button>
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    Close
                </button>
          </div>
        </div>
    </div>
</div>