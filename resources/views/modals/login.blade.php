<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" 
     aria-labelledby="loginForm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header mdb-color white-text text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form role="form" method="POST" action="{{ url('login') }}">
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" id="username" name="username" class="form-control validate" required>
                        <label data-error="wrong" data-success="right" for="username">Username</label>
                    </div>
        
                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <input type="password" id="password" name="password" class="form-control validate" 
                           autocomplete="false" required>
                    <label data-error="wrong" data-success="right" for="password">Password</label>
                </div>
        
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-mdb-color">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>