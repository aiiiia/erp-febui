<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
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

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
        <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
    </head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('{{ asset('images/bg/bg4.jpg') }}'); } [data-bs-theme="dark"] body { background-image: url('{{ asset('images/bg/bg4-dark.jpg') }}'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<div class="d-flex flex-center flex-lg-start flex-column text-center">
						<h2 class="text-white fw-normal m-0 text-center">Enterprise Resource Planning (ERP) Systems</h2>
						<a href="#" class="mb-7">
							<img alt="Logo" src="{{ asset('images/logos/febui-dark.png') }}" style="width: 150px"/>
						</a>
					</div>
				</div>
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
					<div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
						<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                            {{ $slot }}
                        </div>
						<div class="d-flex flex-stack px-lg-10">
							<div class="d-flex fw-semibold text-primary fs-base gap-5">
								<div class="text-gray-900 order-2 order-md-1">
                                    <span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
                                    <a href="#" target="_blank" class="text-gray-800 text-hover-primary">LM FEB UI</a>
							    </div>
							</div>
						</div>
					</div>
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{ asset('js/custom/authentication/sign-in/general.js') }}"></script>
        @stack('js')
    </body>
</html>
