<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">
                    <h1 class="d-flex text-gray-900 fw-bold m-0 fs-3">Master Data Client</h1>
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                        <li class="breadcrumb-item text-gray-500">Master Data</li>
                        <li class="breadcrumb-item text-gray-500">Klien</li>
                        <li class="breadcrumb-item text-gray-500">
                            <a href="{{ route('masterDataClient.index') }}" class="menu-link">
                                Client
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
                                <input type="text" data-kt-client-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Data Client" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-client-table-toolbar="base">
                                <!--begin::Import-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_import_client">
                                    <i class="ki-duotone ki-exit-down fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Import
                                </button>
                                <!--begin::Export-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_client">
                                <i class="ki-duotone ki-exit-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Export</button>
                                <!--begin::Add client-->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_client">Add Client</button>
                                <!--end::Add client-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-client-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                <span class="me-2" data-kt-client-table-select="selected_count"></span>Selected</div>
                                <button type="button" class="btn btn-danger" data-kt-client-table-select="delete_selected">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_client">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-355px text-center">No</th>
                                    <th class="min-w-125px text-center">Initial</th>
                                    <th class="min-w-125px text-center">Nama Client</th>
                                    <th class="min-w-125px text-center">Alamat Client</th>
                                    <th class="min-w-125px text-center">Lokasi Client</th>
                                    <th class="min-w-125px text-center">Telepon Client</th>
                                    <th class="min-w-125px text-center">Jenis Instansi</th>
                                    <th class="min-w-125px text-center">Sumber Dana</th>
                                    <th class="min-w-125px text-center">No NPWP</th>
                                    <th class="min-w-125px text-center">Status WAPU</th>
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
        <!--begin::Modal - Client - Add-->
        <div class="modal fade" id="kt_modal_add_client" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_add_client_header">
                        <h2 class="fw-bold">Tambah Client</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-client-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_add_client_form" class="form" action="{{ route('masterDataClient.store') }}" method="POST">
                            @csrf

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_client_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_client_header" data-kt-scroll-wrappers="#kt_modal_add_client_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Initial</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="initial" name="initial" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Client</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="nama" name="nama" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Jenis Instansi</label>
                                    <select class="form-select" aria-label="Select example" id="id_jenis" name="id_jenis">
                                        <option hidden>Silahkan Pilih Jenis Instansi...</option>

                                        @if(count($client_jenis) > 0)
                                            @foreach($client_jenis as $cj)
                                                <option value="{{ $cj->id }}">{{ $cj->nama }}</option>
                                            @endforeach
                                        @else
                                            <option disabled>---Belum Ada Data Pada Master---</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Lokasi Client </label>
                                    <select class="form-select" aria-label="Select example" id="id_lokasi" name="id_lokasi">
                                        <option hidden>Silahkan Pilih Lokasi Client...</option>

                                        @if(count($client_lokasi) > 0)
                                            @foreach($client_lokasi as $cl)
                                                <option value="{{ $cl->id }}">{{ $cl->nama }}</option>
                                            @endforeach
                                        @else
                                            <option disabled>---Belum Ada Data Pada Master---</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Sumber Dana</label>
                                    <select class="form-select" aria-label="Select example" id="id_sumber_dana" name="id_sumber_dana">
                                        <option hidden>Silahkan Pilih Sumber Dana...</option>

                                        @if(count($client_sumber_dana) > 0)
                                            @foreach($client_sumber_dana as $csd)
                                                <option value="{{ $csd->id }}">{{ $csd->nama }}</option>
                                            @endforeach
                                        @else
                                            <option disabled>---Belum Ada Data Pada Master---</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Alamat</label>
                                    <textarea class="form-select" aria-label="Select example" id="alamat" name="alamat"></textarea>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">No Telepon</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="no_hp" name="no_hp" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">No NPWP</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="no_npwp" name="no_npwp" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Status WAPU</label>
                                    <select class="form-select" aria-label="Select example" id="status_wapu" name="status_wapu">
                                        <option hidden>Silahkan Pilih Status WAPU...</option>

                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-client-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-client-modal-action="submit">
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
        <!--begin::Modal - Client - Edit-->
        <div class="modal fade ViewClient" id="kt_modal_edit_client" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_edit_client_header">
                        <h2 class="fw-bold">Ubah Data Client</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-client-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_edit_client_form" class="form" action="{{ route('masterDataClient.update', ':id') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_client_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_client_header" data-kt-scroll-wrappers="#kt_modal_edit_client_scroll" data-kt-scroll-offset="300px">
                                <div id="dataClient"></div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-client-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-client-modal-action="submit">
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
        <!--begin::Modal - Client - Export-->
        <div class="modal fade" id="kt_modal_export_client" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Export Client</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-client-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <form id="kt_modal_export_client_form" class="form" action="{{ route('masterDataClient.export') }}">
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">Pilih Export Format:</label>
                                <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">
                                    <option></option>
                                    <option value="excel" selected>Excel</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="reset" class="btn btn-light me-3" data-kt-client-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-client-modal-action="submit">
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
        <!--begin::Modal - Client - Import-->
        <div class="modal fade" id="kt_modal_import_client" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Import Klien</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-client-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <form id="kt_modal_import_client_form" class="form" action="{{ route('masterDataClient.importClient') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">File:</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('masterDataClient.templateImport') }}" class="btn btn-sm btn-success">Template</a>
                                <button type="reset" class="btn btn-light me-3" data-kt-client-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-client-modal-action="submit">
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

        <script src="{{ asset('js/custom/master-data/klien/client/table.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/klien/client/add.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/klien/client/edit.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/klien/client/export.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/klien/client/import.js') }}"></script>

        <script type="text/javascript">
            const routeDataTable             = "{{ route('masterDataClient.dataTableClient') }}",
                    routeConstViewClient   = "{{ route('masterDataClient.show', ':id') }}",
                    routeConstDeleteClient = "{{ route('masterDataClient.destroy', ':id') }}",
                    csrfToken                = "{{ csrf_token() }}";

            var routeViewClient      = "{{ route('masterDataClient.show', ':id') }}",
                routeDeleteClient    = "{{ route('masterDataClient.destroy', ':id') }}"
                jsonClientJenis      = {!! $client_jenis->toJson() !!};
                jsonClientLokasi     = {!! $client_lokasi->toJson() !!};
                jsonClientSumberDana = {!! $client_sumber_dana->toJson() !!};
        </script>
    @endpush
</x-app-layout>
