<!-- Modal success -->
@if (!empty(Session::get('success')))
<div class="modal fade bottom" id="modal-success" tabindex="-1" 
     role="dialog" aria-labelledby="modal-success" aria-hidden="true">
    <div class="modal-dialog modal-default modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header green darken-4 white-text">
                <label class="modal-title" id="modal-success-label">
                    <strong>
                        <i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Success!
                    </strong>
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="white-text" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-4">
                <i class="fas fa-check-circle fa-3x green-text mb-4"></i>
                <h6 id="success-text">{{ Session::get('success') }}</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    Close
                </button>
          </div>
        </div>
    </div>
</div>
@endif

<!-- Modal danger -->
@if (!empty(Session::get('danger')))
<div class="modal fade bottom" id="modal-danger" tabindex="-1" 
     role="dialog" aria-labelledby="modal-danger" aria-hidden="true">
    <div class="modal-dialog modal-default modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header red darken-4 white-text">
                <label class="modal-title" id="modal-danger-label">
                    <strong>
                        <i class="fas fa-thumbs-down"></i>&nbsp;&nbsp;Failed!
                    </strong>
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="white-text" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-4">
                <i class="fas fa-times-circle fa-3x red-text mb-4"></i>
                <h6 id="danger-text"> {{ Session::get('danger') }} </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                    Close
                </button>
          </div>
        </div>
    </div>
</div>
@endif