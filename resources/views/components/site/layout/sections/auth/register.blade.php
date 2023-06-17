<form method="post" action="{{ route('site.auth.register') }}" id="auth-register">
    @csrf
    @method('post')

    <div class="form-group">
        <label><i class="fa fa-user"></i> {{ trans('auth.name') }}</label>
        <input type="text" class="form-control" name="name" id="error-register-name" placeholder="{{ trans('auth.name') }}" />
        <span class="text-danger" id="error-register-name-message"></span>
    </div>
    <div class="form-group">
        <label><i class="fa fa-envelope"></i> {{ trans('auth.email') }}</label>
        <input type="email" class="form-control" name="email" id="error-register-email" placeholder="{{ trans('auth.email') }}" />
        <span class="text-danger" id="error-register-email-message"></span>
    </div>
    <div class="form-group">
        <label><i class="fa fa-phone"></i> {{ trans('auth.phone') }}</label>
        <input type="number" class="form-control" name="phone" id="error-register-phone" placeholder="{{ trans('auth.phone') }}" />
        <input id="phone-code" name="phone_code" type="tel" hidden>
        <input id="country-code" name="country_code" type="text" hidden>
        <input id="country-name" name="country_name" type="text" hidden>
        <span class="text-danger" id="error-register-phone-message"></span>
    </div>
    <div class="form-group">
        <label><i class="fa fa-lock"></i> {{ trans('auth.password') }}</label>
        <input type="password" class="form-control" name="password" id="error-register-password" placeholder="{{ trans('auth.password') }}" />
        <span class="text-danger" id="error-register-password-message"></span>
    </div> 
    <div class="form-group text-center">
        <button class="btn-shop"><span>{{ trans('auth.sign_up') }}</span></button>
    </div>
    <div class="nt-account text-center">
        <p>هل لديك حساب بالفعل؟ <a>تسجيل دخول</a></p>
    </div>
    <b class="or-shape">أو</b>
    <ul class="list-social">
        <li><a><i class="fa fa-google"></i></a></li>
        <li><a><i class="fa fa-facebook"></i></a></li>
        <li><a><i class="fa fa-twitter"></i></a></li>
    </ul>
</form>