<div class="col-lg-6 per-info">
    <div class="setting-body">
        <div class="user-info">
            <h4><strong>{{ __('Personal Information') }}</strong></h4>
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
            <form method="POST" action="{{ route('user.updateProfile') }}">
                @csrf
                <div class="row">
                    <div class="col col-lg-12 col-md-12">
                        <label class="control-label">{{ __('Your Name') }}</label>
                        <div class="form-group">
                            <input id="name" type="text" class="form-control input-width @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus placeholder="('Your Name')">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12">
                        <label class="control-label" for="email">{{ __('Your Email') }}</label>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control input-width @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" disabled autocomplete="email">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12">
                        <label class="control-label">{{ __('Your Gender') }}</label>
                        <div class="form-group is-select">
                            <select class="selectpicker form-control input-width @error('gender') is-invalid @enderror" name="gender">
                                <option disabled>{{ __('Choose Gender') }}</option>
                                <option value="{{ config('user.gender.male') }}" {{ $user->isMale() ? 'selected' : '' }}>{{ __('Male') }}</option>
                                <option value="{{ config('user.gender.female') }}" {{ $user->isFemale() ? 'selected' : '' }}>{{ __('Female') }} </option>
                            </select>
                        </div>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col col-lg-12 col-md-12">
                        <label class="control-label">{{ __('Your Birthday') }}</label>
                        <div class="form-row hide-inputbtns">
                            <input class="form-control input-width @error('datetimepicker') is-invalid @enderror" name="datetimepicker" value="{{ old('datetimepicker') ?? formatDate($user->birthday) }}" />
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12">
                        <label class="control-label" for="address">{{ __('Your Address') }}</label>
                        <div class="form-group is-empty">
                            <input id="address" type="text" class="form-control input-width @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user->address }}" autocomplete="address" autofocus placeholder="{{ __('Your Address') }}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
