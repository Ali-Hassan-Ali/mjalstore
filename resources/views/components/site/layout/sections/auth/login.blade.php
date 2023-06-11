<form method="post" action="{{ route('site.auth.login') }}" id="auth-login">
    @csrf
    @method('post')

    <div class="form-group">
        <label><i class="fa fa-envelope"></i> {{ trans('auth.email_or_name') }}</label>
        <input type="text" name="login" class="form-control" id="error-login" placeholder="{{ trans('auth.email_or_name') }}" />
        <span class="text-danger" id="error-login-message"></span>
    </div>
    <div class="form-group">
        <label><i class="fa fa-lock"></i> {{ trans('auth.password') }}</label>
        <input type="password" name="password" class="form-control" id="error-password" placeholder="{{ trans('auth.password') }}" />
        <a class="forgot-pass">{{ trans('auth.forgot_password') }}</a>
        <span class="text-danger" id="error-password-message"></span>
    </div> 
    <div class="form-group text-center">
        <button class="btn-shop"><span>{{ trans('auth.sign_in') }}</span></button>
    </div>
    <div class="nt-account text-center">
        <p>لا تملك حساب؟ <a>أنشئ حسابك الآن!</a></p>
    </div>
    <b class="or-shape">أو</b>
    <ul class="list-social">
        <li><a><i class="fa fa-google"></i></a></li>
        <li><a><i class="fa fa-facebook"></i></a></li>
        <li><a><i class="fa fa-twitter"></i></a></li>
    </ul>
</form>