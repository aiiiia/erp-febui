<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title>{{ config('app.name', 'ERP System') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ERP System') }}</title>
        <meta charset="utf-8" />
		<meta name="description" content="Enterprise Resource Planning (ERP) Systems" />
		<meta name="keywords" content="lm feb ui, feb ui, sistem informasi, manajemen projek, universitas indonesia" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Enterprise Resource Planning (ERP) Systems" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="ERP Systems by LM FEB UI" />

        <link rel="shortcut icon" href="{{ asset('images/logos/fav.ico') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->

		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

		<style>
			.app-header{
				background-color: white;
			}

			[data-kt-app-layout=dark-sidebar] .app-sidebar{
				background: #252525 !important;
			}

			.menu-item .menu-icon i{
				font-size: 30px !important;
				color: white !important;
			}
		</style>
        @stack('css')
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
					<!--begin::Header container-->
					<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						<!--begin::Sidebar mobile toggle-->
						<div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Menampilkan Main Menu">
							<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
								<i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
							</div>
						</div>
						<!--end::Sidebar mobile toggle-->
						<!--begin::Mobile logo-->
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
							<a href="index.html" class="d-lg-none">
								<img alt="Logo" src="{{ asset('images/logos/febui.png') }}" class="h-30px" />
							</a>
						</div>
						<!--end::Mobile logo-->
						<!--begin::Header wrapper-->
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
							<!--begin::Menu wrapper-->
							<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">

									@if(auth()->user()->role == 1)
                                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                        <span class="menu-link">
											<span class="menu-icon">
												<i style="color: black !important;" class="ki-outline ki-data"></i>
											</span>
                                            <span class="menu-title">Master Data</span>
                                            <span class="menu-arrow d-lg-none"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-300px w-xxl-350px">
                                            {{-- <div class="menu-item">
                                                <a class="menu-link" href="{{ route('masterDataBank.index') }}" title="Menampilkan Daftar Bank" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-rocket fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">Kode Bank</span>
                                                </a>
                                            </div> --}}
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{ route('masterDataKategoriProyek.index') }}" title="Menampilkan Pengelolaan Kategori Proyek Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Kategori Proyek</span>
                                                </a>
                                            </div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<!--begin:Menu link-->
												<span class="menu-link">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
													<span class="menu-title">Klasifikasi Industri</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataIndustri.index') }}" title="Menampilkan Pengelolaan Klasifikasi Industri Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">List Industri</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataIndustriSektor.index') }}" title="Menampilkan Pengelolaan Sektor Pada Klasifikasi Industri" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span>Sektor Industri</span>
                                                        </a>
                                                    </div>
												</div>
											</div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<!--begin:Menu link-->
												<span class="menu-link">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
													<span class="menu-title">Klasifikasi Pekerjaan</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataPekerjaan.index') }}" title="Menampilkan Pengelolaan Klasifikasi Pekerjaan Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Jenis Pekerjaan</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataPekerjaanKelompok.index') }}" title="Menampilkan Pengelolaan Kelompok Pada Klasifikasi Pekerjaan" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span>Kelompok Pekerjaan</span>
                                                        </a>
                                                    </div>
												</div>
											</div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<!--begin:Menu link-->
												<span class="menu-link">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
													<span class="menu-title">Klasifikasi Pelatihan</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataPelatihan.index') }}" title="Menampilkan Pengelolaan Klasifikasi Pelatihan Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Jenis Pelatihan</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataPelatihanKelompok.index') }}" title="Menampilkan Pengelolaan Kelompok Pada Klasifikasi Pelatihan" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span>Kelompok Pelatihan</span>
                                                        </a>
                                                    </div>
												</div>
											</div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<!--begin:Menu link-->
												<span class="menu-link">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
													<span class="menu-title">Klien</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataClient.index') }}" title="Menampilkan Pengelolaan Klien Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">List Klien</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataClientJenis.index') }}" title="Menampilkan Pengelolaan Jenis Klien Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span>Jenis Klien</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataClientLokasi.index') }}" title="Menampilkan Pengelolaan Lokasi Klien Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span>Lokasi Klien</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataClientSumberDana.index') }}" title="Menampilkan Pengelolaan Sumber Dana Klien Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span>Sumber Dana Klien</span>
                                                        </a>
                                                    </div>
												</div>
											</div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<!--begin:Menu link-->
												<span class="menu-link">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
													<span class="menu-title">Manajemen Honor</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataHonorAsesmen.index') }}" title="Menampilkan Pengelolaan Honor Pada Divisi Asesmen" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Div. Asesmen</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataHonorInternal.index') }}" title="Menampilkan Pengelolaan Honor Internal" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Internal</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataHonorRiset.index') }}" title="Menampilkan Pengelolaan Honor Pada Divisi Riset & Konsultasi" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Div. Riset & Konsultasi</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataHonorTraining.index') }}" title="Menampilkan Pengelolaan Honor Pada Divisi Training" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Div. Training</span>
                                                        </a>
                                                    </div>
												</div>
											</div>
                                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<!--begin:Menu link-->
												<span class="menu-link">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
													<span class="menu-title">Organization</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px">
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataUnit.index') }}" title="Menampilkan Pengelolaan Unit Kerja Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Unit Kerja</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataPositionLevel.index') }}" title="Menampilkan Pengelolaan Position Level Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Position Level</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataPositionType.index') }}" title="Menampilkan Pengelolaan Position Type Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Position Type</span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route('masterDataPosition.index') }}" title="Menampilkan Pengelolaan Position Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">Position</span>
                                                        </a>
                                                    </div>
												</div>
											</div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{ route('masterDataPegawai.index') }}" title="Menampilkan Pengelolaan Pegawai Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Sumber Daya</span>
                                                </a>
                                            </div>
                                            {{-- <div class="menu-item">
                                                <a class="menu-link" href="#" title="Menampilkan Pengelolaan Klien Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-abstract-26 fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">COA</span>
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                        <span class="menu-link">
											<span class="menu-icon">
												<i style="color: black !important;" class="ki-outline ki-faceid"></i>
											</span>
                                            <span class="menu-title">Manajemen Pengguna</span>
                                            <span class="menu-arrow d-lg-none"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-300px w-xxl-350px">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{ route('masterDataUser.index') }}" title="Menampilkan Pengelolaan Pengguna Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-rocket fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">Daftar Pengguna</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="#" title="Menampilkan Pengelolaan Peran Pengguna Pada ERP" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-abstract-26 fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">Kelola Peran Pengguna</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
									@endif
                                </div>
							</div>
							<div class="app-navbar flex-shrink-0">
								<div class="app-navbar-item ms-1 ms-md-4">
									<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
										<i class="ki-duotone ki-notification-status fs-2">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
											<span class="path4"></span>
										</i>
									</div>
									<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
										<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url({{ asset('images/bg/menu-header-bg.jpg') }})">
											<h3 class="text-white fw-semibold px-9 mt-10 mb-6">Notifications
											<span class="fs-8 opacity-75 ps-3">24 reports</span></h3>
											<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
												<li class="nav-item">
													<a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_1">Alerts</a>
												</li>
											</ul>
										</div>
										<div class="tab-content">
											<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
												<div class="scroll-y mh-325px my-5 px-8">
													<div class="d-flex flex-stack py-4">
														<div class="d-flex align-items-center">
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-primary">
																	<i class="ki-duotone ki-abstract-28 fs-2 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
															</div>
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Alice</a>
																<div class="text-gray-500 fs-7">Phase 1 development</div>
															</div>
														</div>
														<span class="badge badge-light fs-8">1 hr</span>
													</div>
													<div class="d-flex flex-stack py-4">
														<div class="d-flex align-items-center">
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-danger">
																	<i class="ki-duotone ki-information fs-2 text-danger">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																	</i>
																</span>
															</div>
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">HR Confidential</a>
																<div class="text-gray-500 fs-7">Confidential staff documents</div>
															</div>
														</div>
														<span class="badge badge-light fs-8">2 hrs</span>
													</div>
													<div class="d-flex flex-stack py-4">
														<div class="d-flex align-items-center">
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<i class="ki-duotone ki-briefcase fs-2 text-warning">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
															</div>
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Company HR</a>
																<div class="text-gray-500 fs-7">Corporeate staff profiles</div>
															</div>
														</div>
														<span class="badge badge-light fs-8">5 hrs</span>
													</div>
													<div class="d-flex flex-stack py-4">
														<div class="d-flex align-items-center">
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-success">
																	<i class="ki-duotone ki-abstract-12 fs-2 text-success">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
															</div>
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Redux</a>
																<div class="text-gray-500 fs-7">New frontend admin theme</div>
															</div>
														</div>
														<span class="badge badge-light fs-8">2 days</span>
													</div>
													<div class="d-flex flex-stack py-4">
														<div class="d-flex align-items-center">
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-primary">
																	<i class="ki-duotone ki-colors-square fs-2 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																		<span class="path4"></span>
																	</i>
																</span>
															</div>
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Breafing</a>
																<div class="text-gray-500 fs-7">Product launch status update</div>
															</div>
														</div>
														<span class="badge badge-light fs-8">21 Jan</span>
													</div>
													<div class="d-flex flex-stack py-4">
														<div class="d-flex align-items-center">
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-info">
																	<i class="ki-duotone ki-picture fs-2 text-info"></i>
																</span>
															</div>
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Banner Assets</a>
																<div class="text-gray-500 fs-7">Collection of banner images</div>
															</div>
														</div>
														<span class="badge badge-light fs-8">21 Jan</span>
													</div>
													<div class="d-flex flex-stack py-4">
														<div class="d-flex align-items-center">
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<i class="ki-duotone ki-color-swatch fs-2 text-warning">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																		<span class="path4"></span>
																		<span class="path5"></span>
																		<span class="path6"></span>
																		<span class="path7"></span>
																		<span class="path8"></span>
																		<span class="path9"></span>
																		<span class="path10"></span>
																		<span class="path11"></span>
																		<span class="path12"></span>
																		<span class="path13"></span>
																		<span class="path14"></span>
																		<span class="path15"></span>
																		<span class="path16"></span>
																		<span class="path17"></span>
																		<span class="path18"></span>
																		<span class="path19"></span>
																		<span class="path20"></span>
																		<span class="path21"></span>
																	</i>
																</span>
															</div>
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Icon Assets</a>
																<div class="text-gray-500 fs-7">Collection of SVG icons</div>
															</div>
														</div>
														<span class="badge badge-light fs-8">20 March</span>
													</div>
												</div>
												<div class="py-3 text-center border-top">
													<a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All
                                                        <i class="ki-duotone ki-arrow-right fs-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="app-navbar-item ms-1 ms-md-4">
									<!--begin::Menu toggle-->
									<a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<i class="ki-duotone ki-night-day theme-light-show fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
											<span class="path4"></span>
											<span class="path5"></span>
											<span class="path6"></span>
											<span class="path7"></span>
											<span class="path8"></span>
											<span class="path9"></span>
											<span class="path10"></span>
										</i>
										<i class="ki-duotone ki-moon theme-dark-show fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</a>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
										<!--begin::Menu item-->
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-night-day fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
													</i>
												</span>
												<span class="menu-title">Light</span>
											</a>
										</div>
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-moon fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
												<span class="menu-title">Dark</span>
											</a>
										</div>
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-screen fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
												</span>
												<span class="menu-title">System</span>
											</a>
										</div>
									</div>
                                </div>
                                <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                                    <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 ps-2 pe-2 me-n2" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
                                            <span class="opacity-75 fs-8 fw-semibold lh-1 mb-1">{{ auth()->user()->name }}</span>
                                            <span class="fs-8 fw-bold lh-1">
                                                @if(auth()->user()->role == 1)
                                                    Administrator
                                                @elseif(auth()->user()->role == 2)
                                                    Petugas
                                                @endif
                                            </span>
                                        </div>
                                        <div class="symbol symbol-30px symbol-md-40px">
                                            <img src="{{ asset('images/avatars/blank.png') }}" alt="image" />
                                        </div>
                                    </div>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="{{ asset('images/avatars/blank.png') }}" />
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bold d-flex align-items-center fs-5">
                                                        {{ auth()->user()->name }}
                                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                                            @if(auth()->user()->role == 1)
                                                                Administrator
                                                            @elseif(auth()->user()->role == 2)
                                                                Petugas Lapangan
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator my-2"></div>
                                        <div class="menu-item px-5">
                                            <a href="{{ route('auth.logout') }}" class="menu-link px-5">Keluar</a>
                                        </div>
                                    </div>
                                </div>
								<div class="app-navbar-item d-lg-none ms-2 me-n2" title="Menampilkan Master Data dan User Menu">
									<div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
										<i class="ki-duotone ki-element-4 fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
						<!--begin::Logo-->
						<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
							<!--begin::Logo image-->
							<a href="index.html">
								<img alt="Logo" src="{{ asset('images/logos/febui-dark.png') }}" class="h-50px app-sidebar-logo-default" />
								<img alt="Logo" src="{{ asset('images/logos/fav.ico') }}" class="h-20px app-sidebar-logo-minimize" />
							</a>
							<div id="kt_app_sidebar_toggle" style="background: #B02A00 !important; border: unset !important; zoom: 1.2;" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
								<i style="color: white;" class="ki-outline ki-double-left fs-4 rotate-180"></i>
							</div>
						</div>
						<!--begin::sidebar menu-->
						<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
							<!--begin::Menu wrapper-->
							<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
								<div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
									<div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
										<div class="menu-item">
											<a class="menu-link {{ Route::is('dashboard.*') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
												<span class="menu-icon">
													<i class="ki-solid ki-abstract-26"></i>
												</span>
												<span class="menu-title">Dashboards</span>
											</a>
										</div>
										@if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                        <div class="menu-item pt-5">
											<div class="menu-content">
												<span class="menu-heading fw-bold text-uppercase fs-7">Manajemen Projek</span>
											</div>
										</div>
                                        <div class="menu-item">
											<a class="menu-link" href="{{ route('slicing') }}?nama_blade=pra_project">
												<span class="menu-icon">
												<i class="ki-duotone ki-file-down">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
												</span>
												<span class="menu-title">Pra Projek</span>
											</a>
                                        </div>
										<div class="menu-item">
											<a class="menu-link" href="{{ route('slicing') }}?nama_blade=pelaksanaan_project">
												<span class="menu-icon">
													<i class="ki-duotone ki-notepad-edit">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
												<span class="menu-title">Pelaksanaan Projek</span>
											</a>
                                        </div>
										<div class="menu-item">
											<a class="menu-link" href="{{ route('slicing') }}?nama_blade=selesai_project">
												<span class="menu-icon">
													<i class="ki-duotone ki-tablet-ok">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span>
												<span class="menu-title">Projek Selesai</span>
											</a>
                                        </div>
                                        <div class="menu-item">
											<a class="menu-link" href="#">
												<span class="menu-icon">
													<i class="ki-duotone ki-wallet">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
												</span>
												<span class="menu-title">Pembayaran</span>
											</a>
                                        </div>
                                        <div class="menu-item">
											<a class="menu-link" href="#">
												<span class="menu-icon">
													<i class="ki-duotone ki-some-files">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
												<span class="menu-title">Laporan</span>
											</a>
                                        </div>
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
											<span class="menu-link">
												<span class="menu-icon">
													<i class="ki-duotone ki-archive-tick                        ">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
												<span class="menu-title">Arsip</span>
												<span class="menu-arrow"></span>
											</span>
											<div class="menu-sub menu-sub-accordion">
												<div class="menu-item">
													<a class="menu-link" href="#">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Proyek Selesai</span>
													</a>
												</div>
												<div class="menu-item">
													<a class="menu-link" href="#">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Data Klien</span>
													</a>
												</div>
											</div>
										</div>
										@endif

										@if(auth()->user()->role == 1 || auth()->user()->role == 3)
                                        <div class="menu-item pt-5">
                                            <div class="menu-content">
                                                <span class="menu-heading fw-bold text-uppercase fs-7">Akuntansi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="#">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-tag">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
                                                </span>
                                                <span class="menu-title">Kelola Belanja</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" href="#">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-finance-calculator">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
													</i>
                                                </span>
                                                <span class="menu-title">Laporan Keuangan</span>
                                            </a>
                                        </div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        {{ $slot }}
						<!--begin::Footer-->
						<div id="kt_app_footer" class="app-footer">
							<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<!--begin::Copyright-->
								<div class="text-gray-900 order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2024&copy;</span>
									<a href="#" class="text-gray-800 text-hover-primary">LM FEB UI</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>

        @stack('modal')

		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('js/scripts.bundle.js') }}"></script>

        @stack('js')
	</body>
</html>
