<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">
                    <h1 class="d-flex text-gray-900 fw-bold m-0 fs-3">Master Data Unit</h1>
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                        <li class="breadcrumb-item text-gray-500">Master Data</li>
                        <li class="breadcrumb-item text-gray-500">
                            <a href="{{ route('masterDataUnit.index') }}" class="menu-link">
                                Unit
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-unit-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Cari Data Unit" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-unit-table-toolbar="base">
                                <form id="kt_modal_export_unit_form" class="form" action="#"></form>
                                <!--begin::Import-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_import_unit">
                                    <i class="ki-duotone ki-exit-down fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Import
                                </button>
                                <!--begin::Export-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_unit">
                                    <i class="ki-duotone ki-exit-up fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Export
                                </button>
                                <!--begin::Add Unit-->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_unit">Tambah Unit</button>
                            </div>
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-unit-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                <span class="me-2" data-kt-unit-table-select="selected_count"></span>Selected</div>
                                <button type="button" class="btn btn-danger" data-kt-unit-table-select="delete_selected">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_unit">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-355px text-center">No</th>
                                    <th class="min-w-125px text-center">Code Unit</th>
                                    <th class="min-w-125px text-center">Nama Unit</th>
                                    <th class="text-end min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
	    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('modal')
        <!--begin::Modal - Unit - Add-->
        <div class="modal fade" id="kt_modal_add_unit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_add_unit_header">
                        <h2 class="fw-bold">Tambah Unit</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-unit-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_add_unit_form" class="form" action="{{ route('masterDataUnit.store') }}" method="POST">
                            @csrf
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_unit_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_unit_header" data-kt-scroll-wrappers="#kt_modal_add_unit_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Code Unit</label>
                                    <input type="text" class="form-control" placeholder="" id="code_unit" name="code_unit" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Unit</label>
                                    <input type="text" class="form-control" placeholder="" id="nama_unit" name="nama_unit" />
                                </div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-unit-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-unit-modal-action="submit">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Modal - Unit - Edit-->
        <div class="modal fade ViewUnit" id="kt_modal_edit_unit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_edit_unit_header">
                        <h2 class="fw-bold">Ubah Data Unit</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-unit-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_edit_unit_form" class="form" action="{{ route('masterDataUnit.update', ':id') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_unit_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_unit_header" data-kt-scroll-wrappers="#kt_modal_edit_unit_scroll" data-kt-scroll-offset="300px">
                                <div id="dataUnit"></div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-unit-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-unit-modal-action="submit">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Modal - Unit - Export-->
        <div class="modal fade" id="kt_modal_export_unit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Export Unit</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-unit-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <form id="kt_modal_export_unit_form" class="form" action="{{ route('masterDataUnit.export') }}">
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">Pilih Export Format:</label>
                                <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">
                                    <option></option>
                                    <option value="excel" selected>Excel</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="reset" class="btn btn-light me-3" data-kt-unit-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-unit-modal-action="submit">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Modal - Unit  - Import-->
        <div class="modal fade" id="kt_modal_import_unit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Import Unit</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-unit-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <form id="kt_modal_import_unit_form" class="form" action="{{ route('masterDataUnit.importUnit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">File:</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('masterDataUnit.templateImport') }}" class="btn btn-sm btn-success">Template</a>
                                <button type="reset" class="btn btn-light me-3" data-kt-unit-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-unit-modal-action="submit">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('js')
        <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

        <script src="{{ asset('js/custom/master-data/unit/table.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/unit/add.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/unit/edit.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/unit/export.js') }}"></script>

        <script type="text/javascript">
            const routeDataTable         = "{{ route('masterDataUnit.dataTableUnit') }}",
                    routeConstViewUnit   = "{{ route('masterDataUnit.show', ':id') }}",
                    routeConstDeleteUnit = "{{ route('masterDataUnit.destroy', ':id') }}",
                    csrfToken            = "{{ csrf_token() }}";

            var routeViewUnit   = "{{ route('masterDataUnit.show', ':id') }}",
                routeDeleteUnit = "{{ route('masterDataUnit.destroy', ':id') }}";
        </script>
    @endpush
</x-app-layout>
