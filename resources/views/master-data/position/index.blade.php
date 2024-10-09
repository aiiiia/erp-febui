<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">
                    <h1 class="d-flex text-gray-900 fw-bold m-0 fs-3">Master Data Position</h1>
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                        <li class="breadcrumb-item text-gray-500">Master Data</li>
                        <li class="breadcrumb-item text-gray-500">
                            <a href="{{ route('masterDataPosition.index') }}" class="menu-link">
                                Position
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
                                <input type="text" data-kt-position-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Data Position" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-position-table-toolbar="base">
                                <form id="kt_modal_export_position_form" class="form" action="#"></form>
                                <!--begin::Import-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_import_unit">
                                    <i class="ki-duotone ki-exit-down fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Import
                                </button>
                                <!--begin::Export-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_position">
                                <i class="ki-duotone ki-exit-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Export</button>
                                <!--begin::Add position-->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_position">Add Position</button>
                                <!--end::Add position-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-position-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                <span class="me-2" data-kt-position-table-select="selected_count"></span>Selected</div>
                                <button type="button" class="btn btn-danger" data-kt-position-table-select="delete_selected">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_position">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-355px text-center">No</th>
                                    <th class="min-w-125px text-center">Code Position</th>
                                    <th class="min-w-125px text-center">Nama Position</th>
                                    <th class="min-w-125px text-center">Position Level</th>
                                    <th class="min-w-125px text-center">Position Type</th>
                                    <th class="min-w-125px text-center">Nama Unit</th>
                                    <th class="min-w-125px text-center">Line Manager</th>
                                    <th class="text-end min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Post-->
    </div>

    @push('css')
	    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('modal')
        <!--begin::Modal - Position - Add-->
        <div class="modal fade" id="kt_modal_add_position" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_add_position_header">
                        <h2 class="fw-bold">Tambah Position</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-position-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_add_position_form" class="form" action="{{ route('masterDataPosition.store') }}" method="POST">
                            @csrf

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_position_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_position_header" data-kt-scroll-wrappers="#kt_modal_add_position_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Code Position</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="code_position" name="code_position" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Position</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="nama_position" name="nama_position" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Code Position Level</label>
                                    <select class="form-select" aria-label="Select example" id="code_position_level" name="code_position_level">
                                        <option hidden>Silahkan Pilih Position Level...</option>

                                        @foreach($pos_level as $pl)
                                            <option value="{{ $pl->code_position_level }}">{{ $pl->nama_position_level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Code Position Type</label>
                                    <select class="form-select" aria-label="Select example" id="code_position_type" name="code_position_type">
                                        <option hidden>Silahkan Pilih Position Type...</option>

                                        @foreach($pos_type as $pt)
                                            <option value="{{ $pt->code_position_type }}">{{ $pt->nama_position_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Code Unit</label>
                                    <select class="form-select" aria-label="Select example" id="code_unit" name="code_unit">
                                        <option hidden>Silahkan Pilih Unit...</option>

                                        @foreach($unit as $un)
                                            <option value="{{ $un->code_unit }}">{{ $un->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Line Manager</label>
                                    <select class="form-select" aria-label="Select example" id="line_manager" name="line_manager">
                                        <option hidden>Silahkan Pilih Line Manager...</option>

                                        @if(count($line_manager) > 0)
                                            @foreach($line_manager as $lm)
                                                <option value="{{ $lm->code_position }}">{{ $lm->nama_position }}</option>
                                            @endforeach
                                        @else
                                            <option value="0">---Belum Ada Data Pada Master---</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-position-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-position-modal-action="submit">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Scroll-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Modal - Position - Edit-->
        <div class="modal fade ViewPosition" id="kt_modal_edit_position" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_edit_position_header">
                        <h2 class="fw-bold">Ubah Data Position</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-position-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_edit_position_form" class="form" action="{{ route('masterDataPosition.update', ':id') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_position_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_position_header" data-kt-scroll-wrappers="#kt_modal_edit_position_scroll" data-kt-scroll-offset="300px">
                                <div id="dataPosition"></div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-position-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-position-modal-action="submit">
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
        <!--begin::Modal - Position - Export-->
        <div class="modal fade" id="kt_modal_export_position" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Export Position</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-position-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <form id="kt_modal_export_position_form" class="form" action="{{ route('masterDataPosition.export') }}">
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">Pilih Export Format:</label>
                                <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">
                                    <option></option>
                                    <option value="excel" selected>Excel</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="reset" class="btn btn-light me-3" data-kt-position-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-position-modal-action="submit">
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
                        <form id="kt_modal_import_unit_form" class="form" action="{{ route('masterDataPosition.importPosition') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">File:</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('masterDataPosition.templateImport') }}" class="btn btn-sm btn-success">Template</a>
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

        <script src="{{ asset('js/custom/master-data/position/table.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/position/add.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/position/edit.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/position/export.js') }}"></script>

        <script type="text/javascript">
            const routeDataTable             = "{{ route('masterDataPosition.dataTablePosition') }}",
                    routeConstViewPosition   = "{{ route('masterDataPosition.show', ':id') }}",
                    routeConstDeletePosition = "{{ route('masterDataPosition.destroy', ':id') }}",
                    csrfToken                = "{{ csrf_token() }}";

            var routeViewPosition   = "{{ route('masterDataPosition.show', ':id') }}",
                routeDeletePosition = "{{ route('masterDataPosition.destroy', ':id') }}",
                jsonPositionLevel   = {!! $pos_level->toJson() !!},
                jsonPositionType    = {!! $pos_type->toJson() !!},
                jsonUnit            = {!! $unit->toJson() !!},
                jsonLineManager     = {!! $line_manager->toJson() !!};
        </script>
    @endpush
</x-app-layout>
