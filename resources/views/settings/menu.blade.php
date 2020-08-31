<div class="col-lg-3">
    <aside id="leftsidebar" class="sidebar">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="detail">
                        <h4>{{ __('Your Profile') }}</h4>
                    </div>
                </div>
            </li>
            <li>
                <small class="text-muted"><a href="{{ route('user.getProfile') }}">{{ __('Personal Information' )}} <em class="fa fa-angle-right pull-right"></em></a> </small><br/>
                <small class="text-muted"><a href="{{ route('user.getChangePassword') }}">{{ __('Change Password') }} <em class="fa fa-angle-right pull-right"></em></a> </small><br/>
                <hr>
                <small class="text-muted"><a href="#">{{ __('Notifications') }} <em class="fa fa-angle-right pull-right"></em></a> </small><br/>
                <hr>
            </li>
        </ul>
    </aside>
</div>
