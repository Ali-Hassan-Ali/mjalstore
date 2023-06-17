<div class="main-data">
    <form method="post" action="{{ route('site.auth.profile.update') }}" id="profile-main" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview" style="background-image: url('{{ auth()->user()->image_path }}');"></div>
            </div>
            <span id="error-profile-main-image-message" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label><i class="fa fa-user"></i> {{ trans('auth.name') }}</label>
            <input type="text" id="error-profile-main-name" name="name" class="form-control" value="{{ auth()->user()->name }}" />
            <span id="error-profile-main-name-message" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label><i class="fa fa-envelope"></i> {{ trans('auth.email') }}</label>
            <input type="email" id="error-profile-main-email" name="email" class="form-control" value="{{ auth()->user()->email }}" />
            <span id="error-profile-main-email-message" class="text-danger"></span>
        </div>

        <div class="form-group">
            <label><i class="fa fa-envelope"></i> {{ trans('auth.phone') }}</label>
            <input type="tel" id="error-profile-main-phone" name="phone" class="form-control" value="{{ auth()->user()->phone }}" />
            <input id="phone-code" name="phone_code" type="tel" hidden>
            <input id="country-code" name="country_code" type="text" hidden>
            <input id="country-name" name="country_name" type="text" hidden>
            <span id="error-profile-main-phone-message" class="text-danger"></span>
        </div>

        <p>لتعديل الأسم أو بريدك الإلكتروني قم بفتح <strong>تذكرة دعم فني</strong></p>

        <button class="btn-site btn-shop">
            <span>{{ trans('admin.global.save') }}</span>
        </button>
    </form>
    <div class="form-group"><strong>معلومات الأمن</strong></div>
    <div class="form-group">
        <label><i class="fa fa-lock"></i> كلمة المرور</label>
        <input type="password" class="form-control" value="***********" />
        <a class="pull-left mt5" data-toggle="modal" data-target="#modal-forgot-password"><strong>هل تريد تغيير كلمة المرور؟</strong></a>
    </div>
</div>