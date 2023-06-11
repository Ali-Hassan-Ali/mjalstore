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
            <label><i class="fa fa-user"></i> {{ trans('site.profile.full_name') }}</label>
            <input type="text" id="error-profile-main-name" name="name" class="form-control" value="{{ auth()->user()->name }}" />
            <span id="error-profile-main-name-message" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label><i class="fa fa-envelope"></i> {{ trans('site.profile.email') }}</label>
            <input type="email" id="error-profile-main-email" name="email" class="form-control" value="{{ auth()->user()->email }}" />
            <span id="error-profile-main-email-message" class="text-danger"></span>
        </div>
        <p>لتعديل الأسم أو بريدك الإلكتروني قم بفتح <strong>تذكرة دعم فني</strong></p>
        <div class="form-group">
            <label><i class="fa fa-phone"></i> رقم الجوال</label>
            <div class="flex20">
                <input type="text" class="form-control" value="0595285462" />
                <select>
                    <option>970</option>
                    <option style="background-image:url(images/saudi-arabia.png);">970</option>
                    <option>970</option>
                    <option>970</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary">add</button>
    </form>
    <div class="form-group"><strong>معلومات الأمن</strong></div>
    <div class="form-group">
        <label><i class="fa fa-lock"></i> كلمة المرور</label>
        <input type="password" class="form-control" value="***********" />
        <a class="pull-left mt5" data-toggle="modal" data-target="#modal-forgot-password"><strong>هل تريد تغيير كلمة المرور؟</strong></a>
    </div>
</div>