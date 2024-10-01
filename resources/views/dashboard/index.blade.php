<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dashboards</h1>
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Dashboards</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 gx-xl-10 mb-2 mb-xl-2">
                    <!--begin::Card Total Proyek-->
                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-2 mb-xl-2">
                        <div class="card card-flush h-md-60 mb-5 mb-xl-10">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-chart-pie-3 fs-3x">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">1.000</span>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Proyek</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Card Proyek Berlangsung-->
                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-2 mb-xl-2">
                        <div class="card card-flush h-md-60 mb-2 mb-xl-2">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-chart-simple fs-3x">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">200</span>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Berlangsung</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Card Proyek Belum Mulai-->
                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush h-md-60 mb-5 mb-xl-10">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-watch fs-3x">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">500</span>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Selesai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Card Proyek Belum Selesai-->
                    <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush h-md-60 mb-5 mb-xl-10">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-check-square fs-3x">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">300</span>
                                    <span class="text-gray-500 pt-1 fw-semibold fs-6">Belum Mulai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                    <!--begin::Chart Laporan Tersubmit-->
                    <div class="col-md-7 col-lg-7 col-xl-7 col-xxl-7 mb-md-5 mb-xl-10">
                        <div class="card card-flush overflow-hidden h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Jumlah Laporan Tersubmit</span>
                                </h3>
                                <div class="card-toolbar">
                                    <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" data-kt-daterangepicker-range="today" class="btn btn-sm btn-light d-flex align-items-center px-4">
                                        <div class="text-gray-600 fw-bold">Loading date range...</div>
                                        <i class="ki-duotone ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <!--begin::Card body-->
                            <div class="card-body d-flex align-items-end p-0">
                                <div id="kt_charts_widget_36" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Chart Status Project-->
                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush overflow-hidden h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Status Project</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex align-items-end p-0">
                                <div id="pie-status-project"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                    <!--begin::Chart Jumlah Project per Unit -->
                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush overflow-hidden h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Jumlah Proyek per Unit</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex align-items-end p-0">
                                <div id="bar-project-unit"></div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Chart Status Project per Unit -->
                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush overflow-hidden h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Status Proyek per Unit</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex align-items-end p-0">
                                <div id="bar-project-status-unit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>

    @push('js')
        <!--start::Repo Highchart-->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <!--start::AmCharts Highchart-->
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>

        <!--start::Highchart JS-->
        <script src="{{ asset('js/custom/dashboard/pie-status-project.js') }}"></script>
        <script src="{{ asset('js/custom/dashboard/bar-jmlh-project-unit.js') }}"></script>
        <script src="{{ asset('js/custom/dashboard/bar-status-project-unit.js') }}"></script>

        <script src="{{ asset('js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('js/custom/widgets.js') }}"></script>
    @endpush
</x-app-layout>
