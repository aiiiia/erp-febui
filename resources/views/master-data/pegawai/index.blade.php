<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">
                    <h1 class="d-flex text-gray-900 fw-bold m-0 fs-3">Master Data Pegawai</h1>
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                        <li class="breadcrumb-item text-gray-500">Master Data</li>
                        <li class="breadcrumb-item text-gray-500">
                            <a href="{{ route('masterDataPegawai.index') }}" class="menu-link">
                                Pegawai
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
                                <input type="text" data-kt-pegawai-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Data Pegawai" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-pegawai-table-toolbar="base">
                                <form id="kt_modal_export_pegawai_form" class="form" action="#"></form>
                                <!--begin::Import-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_import_pegawai">
                                    <i class="ki-duotone ki-exit-down fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Import
                                </button>
                                <!--begin::Export-->
                                <button type="button" class="btn btn-sm btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_pegawai">
                                <i class="ki-duotone ki-exit-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Export</button>
                                <!--begin::Add pegawai-->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_pegawai">Add Pegawai</button>
                            </div>
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-pegawai-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                <span class="me-2" data-kt-pegawai-table-select="selected_count"></span>Selected</div>
                                <button type="button" class="btn btn-danger" data-kt-pegawai-table-select="delete_selected">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_pegawai">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-355px text-center">No</th>
                                    <th class="min-w-125px text-center">NIP</th>
                                    <th class="min-w-125px text-center">Nama Pegawai</th>
                                    <th class="min-w-125px text-center">Code Position</th>
                                    <th class="min-w-125px text-center">BOD Type</th>
                                    <th class="min-w-125px text-center">Status Karyawan</th>
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
        <!--begin::Modal - Pegawai - Add-->
        <div class="modal fade" id="kt_modal_add_pegawai" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_add_pegawai_header">
                        <h2 class="fw-bold">Tambah Pegawai</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-pegawai-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_add_pegawai_form" class="form" action="{{ route('masterDataPegawai.store') }}" method="POST">
                            @csrf

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_pegawai_header" data-kt-scroll-wrappers="#kt_modal_add_pegawai_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">NIP Pegawai</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="nip" name="nip" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Pegawai</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="nama" name="nama" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Job Title</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="job_title" name="job_title" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Position Pegawai</label>
                                    <select class="form-select" aria-label="Select example" id="code_position" name="code_position">
                                        <option hidden>Silahkan Pilih Position Pegawai...</option>

                                        @foreach($position as $pos)
                                            <option value="{{ $pos->code_position }}">{{ $pos->nama_position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">BOD Type</label>
                                    <select class="form-select" aria-label="Select example" id="bod_type" name="bod_type">
                                        <option hidden>Silahkan Pilih BOD Type...</option>

                                        @foreach($pos_level as $pl)
                                            <option value="{{ $pl->code_position_level }}">{{ $pl->nama_position_level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Status Karyawan</label>
                                    <select class="form-select" aria-label="Select example" id="status_karyawan" name="status_karyawan">
                                        <option hidden>Silahkan Pilih Status Karyawan...</option>
                                        <option value="Tetap">Tetap</option>
                                        <option value="Kontrak">Kontrak</option>
                                        <option value="Asociate">Asociate</option>
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Jenis Kelamin</label>
                                    <select class="form-select" aria-label="Select example" id="jenis_kelamin" name="jenis_kelamin">
                                        <option hidden>Silahkan Pilih Jenis Kelamin...</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Tempat Lahir</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" id="tempat_lahir" name="tempat_lahir" />
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Tgl Lahir</label>
                                    <input class="form-control form-control-solid" placeholder="" id="tgl_lahir" name="tgl_lahir"/>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Agama</label>
                                    <select class="form-select" aria-label="Select example" id="agama" name="agama">
                                        <option hidden>Silahkan Pilih Agama...</option>
                                        <option value="1-Islam">Islam</option>
                                        <option value="2-Kristen">Kristen</option>
                                        <option value="3-Katolik">Katolik</option>
                                        <option value="4-Hindu">Hindu</option>
                                        <option value="5-Budha">Budha</option>
                                        <option value="6-Khonghucu">Khonghucu</option>
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Status Pernikahan</label>
                                    <select class="form-select" aria-label="Select example" id="marst" name="marst">
                                        <option hidden>Silahkan Pilih Status Pernikahan...</option>
                                        <option value="Menikah">Menikah</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                        <option value="Belum Menikah">Belum Menikah</option>
                                    </select>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Alamat</label>
                                    <textarea type="text" class="form-control form-control-solid" placeholder="" id="alamat" name="alamat"></textarea>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">No KTP</label>
                                    <input class="form-control form-control-solid" placeholder="" id="no_ktp" name="no_ktp"/>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">No NPWP</label>
                                    <input class="form-control form-control-solid" placeholder="" id="no_npwp" name="no_npwp"/>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">email</label>
                                    <input class="form-control form-control-solid" placeholder="" id="email" name="email"/>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">No HP</label>
                                    <input class="form-control form-control-solid" placeholder="" id="no_hp" name="no_hp"/>
                                </div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-pegawai-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-pegawai-modal-action="submit">
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
        <!--begin::Modal - Pegawai - Edit-->
        <div class="modal fade ViewPegawai" id="kt_modal_edit_pegawai" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_edit_pegawai_header">
                        <h2 class="fw-bold">Ubah Data Pegawai</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-pegawai-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body px-5 my-7">
                        <form id="kt_modal_edit_pegawai_form" class="form" action="{{ route('masterDataPegawai.update', ':id') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_pegawai_header" data-kt-scroll-wrappers="#kt_modal_edit_pegawai_scroll" data-kt-scroll-offset="300px">
                                <div id="dataPegawai"></div>
                            </div>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-kt-pegawai-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-pegawai-modal-action="submit">
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
        <!--begin::Modal - Pegawai - Export-->
        <div class="modal fade" id="kt_modal_export_pegawai" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Export Pegawai</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-pegawai-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <form id="kt_modal_export_pegawai_form" class="form" action="{{ route('masterDataPegawai.export') }}">
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">Pilih Export Format:</label>
                                <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">
                                    <option></option>
                                    <option value="excel" selected>Excel</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="reset" class="btn btn-light me-3" data-kt-pegawai-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-pegawai-modal-action="submit">
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
        <!--begin::Modal - Pegawai  - Import-->
        <div class="modal fade" id="kt_modal_import_pegawai" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Import Pegawai</h2>
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-pegawai-modal-action="close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <form id="kt_modal_import_pegawai_form" class="form" action="{{ route('masterDataPegawai.importPegawai') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="fv-row mb-10">
                                <label class="required fs-6 fw-semibold form-label mb-2">File:</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('masterDataPegawai.templateImport') }}" class="btn btn-sm btn-success">Template</a>
                                <button type="reset" class="btn btn-light me-3" data-kt-pegawai-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-pegawai-modal-action="submit">
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

        <script src="{{ asset('js/custom/master-data/pegawai/table.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/pegawai/add.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/pegawai/edit.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/pegawai/export.js') }}"></script>
        <script src="{{ asset('js/custom/master-data/pegawai/import.js') }}"></script>

        <script type="text/javascript">
            const routeDataTable             = "{{ route('masterDataPegawai.dataTablePegawai') }}",
                    routeConstViewPegawai   = "{{ route('masterDataPegawai.show', ':id') }}",
                    routeConstDeletePegawai = "{{ route('masterDataPegawai.destroy', ':id') }}",
                    csrfToken                = "{{ csrf_token() }}";

            var routeViewPegawai   = "{{ route('masterDataPegawai.show', ':id') }}",
                routeDeletePegawai = "{{ route('masterDataPegawai.destroy', ':id') }}"
                jsonPegawaiLevel   = {!! $pos_level->toJson() !!};
                jsonPosition        = {!! $position->toJson() !!};

                $("#tgl_lahir").daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minYear: 1945,
                        maxYear: parseInt(moment().format("YYYY"),12)
                    }
                );
        </script>
    @endpush
</x-app-layout>
