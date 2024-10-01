<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard.index') }}" action="{{ route('login') }}">
        @csrf

        <div class="text-center mb-11">
            <h1 class="text-gray-900 fw-bolder mb-3">ERP System</h1>
        </div>
        <div class="fv-row mb-8">
            <input type="text" placeholder="Username" name="username" autocomplete="off" class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-3 input-group">
            <input type="password" placeholder="Password" id="password" name="password" autocomplete="off" class="form-control bg-transparent" />
            <span class="input-group-text">
                <i class="fa fa-eye icon-md mr-5" id="icon-view-pwd"></i>
            </span>
        </div>
        <!--begin::Wrapper-->
        {{--
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <!--begin::Link-->
            <a href="authentication/layouts/creative/reset-password.html" class="link-primary">Forgot Password ?</a>
            <!--end::Link-->
        </div>
        --}}
        <!--end::Wrapper-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">Masuk</span>
                <span class="indicator-progress">Silahkan Tunggu...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>

    @push('js')
        <script type="text/javascript">
            $("#icon-view-pwd").on("click", function(){
                let thisIcon = $(this).hasClass("fa-eye");
                if (thisIcon){
                    $(this).removeClass("fa-eye");
                    $(this).addClass("fa-eye-slash");
                    $('#password').prop('type', 'text');
                } else {
                    $(this).removeClass("fa-eye-slash");
                    $(this).addClass("fa-eye");
                    $('#password').prop('type', 'password');
                }
            });
        </script>
    @endpush
</x-guest-layout>
