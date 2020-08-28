<div class="col-lg-6 per-info">
    <div class="setting-body">
        <div class="user-info">
            <h4><strong>{{ __('Change Password') }}</strong></h4>
        </div>
        <div class="ui-block-content">
            @if (session('error'))
                <div class="alert alert-danger" role="alert" style="text-align: center;">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert" style="text-align: center;">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('user.changePassword') }}">
                @csrf
                <div class="row">
                    <div class="col col-lg-12 col-md-12">
                        <div class="form-group label-floating">
                            <label class="control-label">{{ __('Confirm Current Password') }}</label>
                            <input class="form-control input-width @error('current_password') is-invalid @enderror" type="password" name="current_password" required>
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">{{ __('Your New Password') }}</label>
                            <input class="form-control input-width @error('new_password') is-invalid @enderror" placeholder="" type="password" name="new_password" required>
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">{{ __('Confirm New Password') }}</label>
                            <input class="form-control input-width @error('new_password_confirm') is-invalid @enderror" placeholder="" type="password" name="new_password_confirmation" required>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12">
                        <button class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
