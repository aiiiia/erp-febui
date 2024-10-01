@props(['step'])

<!--begin::Stepper-->
<div class="card mb-10 py-10">
    <div class="stepper stepper-pills" id="kt_stepper_example_basic">
        <!--begin::Nav-->
        <div class="stepper-nav flex-center flex-wrap">
            <!--begin::Step 1-->
            <div class="stepper-item mx-8 my-4 {{ $step=="1" ? 'current' : '' }}" data-kt-stepper-element="nav">
                <!--begin::Wrapper-->
                <div class="stepper-wrapper d-flex align-items-center">
                    <!--begin::Icon-->
                    <div class="stepper-icon w-40px h-40px">
                        <i class="stepper-check fas fa-check"></i>
                        <span class="stepper-number">1</span>
                    </div>
                    <!--end::Icon-->
        
                    <!--begin::Label-->
                    <div class="stepper-label">
                        <h3 class="stepper-title">
                            Pra Proyek
                        </h3>
        
                        <div class="stepper-desc">
                            Persiapan Pra KickOff
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
                <!--end::Wrapper-->
        
                <!--begin::Line-->
                <div class="stepper-line h-40px"></div>
                <!--end::Line-->
            </div>
            <!--end::Step 1-->
        
            <!--begin::Step 2-->
            <div class="stepper-item mx-8 my-4 {{ $step=="2" ? 'current' : '' }}" data-kt-stepper-element="nav">
                <!--begin::Wrapper-->
                <div class="stepper-wrapper d-flex align-items-center">
                    <!--begin::Icon-->
                    <div class="stepper-icon w-40px h-40px">
                        <i class="stepper-check fas fa-check"></i>
                        <span class="stepper-number">2</span>
                    </div>
                    <!--begin::Icon-->
        
                    <!--begin::Label-->
                    <div class="stepper-label">
                        <h3 class="stepper-title">
                            Pelaksanaan
                        </h3>
        
                        <div class="stepper-desc">
                            Monitoring dan Pelaporan
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
                <!--end::Wrapper-->
        
                <!--begin::Line-->
                <div class="stepper-line h-40px"></div>
                <!--end::Line-->
            </div>
            <!--end::Step 2-->
        
            <!--begin::Step 3-->
            <div class="stepper-item mx-8 my-4 {{ $step=="3" ? 'current' : '' }}" data-kt-stepper-element="nav">
                <!--begin::Wrapper-->
                <div class="stepper-wrapper d-flex align-items-center">
                    <!--begin::Icon-->
                    <div class="stepper-icon w-40px h-40px">
                        <i class="stepper-check fas fa-check"></i>
                        <span class="stepper-number">3</span>
                    </div>
                    <!--begin::Icon-->
        
                    <!--begin::Label-->
                    <div class="stepper-label">
                        <h3 class="stepper-title">
                            Selesai
                        </h3>
        
                        <div class="stepper-desc">
                            Closing dan Finalisasi
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
                <!--end::Wrapper-->
        
                <!--begin::Line-->
                <div class="stepper-line h-40px"></div>
                <!--end::Line-->
            </div>
            <!--end::Step 3-->
        </div>
        <!--end::Nav-->
    </div>
</div>
<!--end::Stepper-->