<!--Signup Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SignUp</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                  {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="name"
                            placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                            placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email"
                          placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="address">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nric" name="nric"
                            placeholder="NRIC">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary order_button">{{ __('Register') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
