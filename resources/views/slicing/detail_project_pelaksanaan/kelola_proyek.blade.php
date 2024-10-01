<x-wrapper-detail-project step="2">
    @push('css')
        
    @endpush

    <div class="card" style="min-height: 400px;">
        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-900">Kelola Pelaksanaan</span>
            </h3>
            <!--end::Title-->
        </div>
        <form class="form">
            <div class="card-body">
                <div class="mb-15">
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Kerjasama</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Kerjasama ...</option>
                                <option value="1">Eksternal</option>
                                <option value="2">Internal</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Pelakasanaan</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Pelakasanaan ...</option>
                                <option value="1">Eksternal</option>
                                <option value="2">Internal</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Pembayaran</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Pembayaran ...</option>
                                <option value="1">Eksternal</option>
                                <option value="2">Internal</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12"style="text-align: right;">
                        <button type="reset" class="btn btn-secondary">Batalkan Perubahan</button>
                        <button type="reset" class="btn btn-light-warning ms-2">Simpan Project</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card mt-5" style="min-height: 400px;">
        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-900">Kelola Pelaksanaan</span>
            </h3>
            <!--end::Title-->
            <div class="card-toolbar">
                <select name="" id="" class="form-select me-5 bypass_s2" style="width: 160px;">
                    <option disabled selected>Pilih Revisi ...</option>
                    <option value="1">Revisi ke-1</option>
                    <option value="2">Revisi ke-2</option>
                    <option value="3">Revisi ke-3</option>
                </select>
                <a href="" class="button btn btn-light-warning me-3">
                    Simpan Perubahan
                </a>
                <a href="" class="button btn btn-warning">
                    Tambah Adendum
                </a>
            </div>
        </div>
        <form class="form">
            <div class="card-body">
                <div class="mb-15">
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Kode Proyek</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukan kode proyek ..."/>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Nama Proyek</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukan nama proyek ..."/>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Proyek</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Proyek ...</option>
                                <option value="1">Eksternal</option>
                                <option value="2">Internal</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Kategori Proyek</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Kategori Proyek ...</option>
                                <option value="1">Konsultasi</option>
                                <option value="2">Penelitian</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Penugasan</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Penugasan ...</option>
                                <option value="1">Pilihan 1</option>
                                <option value="2">Pilihan 2</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Kesepakatan Riset</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukan Kesepakatan Riset ..."/>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Unit Penanggung Jawab</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Unit Penanggung Jawab ...</option>
                                <option value="1">Divisi Konsultasi</option>
                                <option value="2">Divisi Penelitian</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Tagging Project</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" value="#human_resource, #angkasa_pura" id="kt_tagify_1" placeholder="Masukan Tagging Project ..."/>
                        </div>
                    </div>

                    <hr style="margin: 20px 0px;">

                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Client</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Client ...</option>
                                <option value="1">BUMN</option>
                                <option value="2">Swasta</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Nama Client</label>
                        <div class="col-lg-7">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Client Terdaftar ...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="" class="btn btn-danger" style="width: 100%;">Tambah Baru</a>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Nama Instansi</label>
                        <div class="col-lg-7">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Instansi Terdaftar ...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="" class="btn btn-danger" style="width: 100%;">Tambah Baru</a>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Nama Lembaga</label>
                        <div class="col-lg-7">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Lembaga Terdaftar ...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="" class="btn btn-danger" style="width: 100%;">Tambah Baru</a>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Industri Klien</label>
                        <div class="col-lg-7">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Industri Klien ...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="" class="btn btn-danger" style="width: 100%;">Tambah Baru</a>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Status Wapu Client</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Status Wapu Client ...</option>
                                <option value="1">Opsi 1</option>
                                <option value="2">Opsi 2</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <hr style="margin: 20px 0px;">
                    
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Ketersediaan Dokumen Kontrak/SPK</label>
                        <div class="col-lg-9">
                            <div class="d-flex" style="gap: 20px;">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckboxSm" name="status_dokumen" checked />
                                    <label class="form-check-label" for="flexCheckboxSm">
                                        Ada Dokumen
                                    </label>
                                </div>     
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="" id="flexCheckboxSm" name="status_dokumen"  />
                                    <label class="form-check-label" for="flexCheckboxSm">
                                        Belum Ada Dokumen
                                    </label>
                                </div> 
                            </div>
                                                            
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Nomor Dokumen</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukan Nomor Kontrak ..."/>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Lingkup Wilayah</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Lingkup Wilayah ...</option>
                                <option value="1">Indonesia</option>
                                <option value="2">Luar Negeri</option>
                                <option value="3">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Tahun & Triwulan Projek</label>
                        <div class="col-lg-4">
                            <div class="input-group" id="kt_td_picker_simple" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <select class="form-select bypass_s2" aria-label="Select example">
                                    <option disabled selected>Pilih Tahun ...</option>
                                    <option value="1">2022</option>
                                    <option value="2">2023</option>
                                    <option value="3">2024</option>
                                </select>
                                <span class="input-group-text" data-td-target="#kt_td_picker_basic" data-td-toggle="datetimepicker">
                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Triwulan ...</option>
                                <option value="1">Q1</option>
                                <option value="2">Q2</option>
                                <option value="3">Q3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Proyek</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Proyek ...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Unit Kerja</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Unit Kerja ...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Jenis Kontrak</label>
                        <div class="col-lg-9">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Pilih Jenis Kontrak ...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Masa Kontrak</label>
                        <div class="col-lg-4 d-flex align-items-center">
                            <div class="input-group" id="kt_td_picker_simple" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <input type="text" class="form-control fp_elem" placeholder="Masa Kontrak dari ..."/>
                                <span class="input-group-text" data-td-target="#kt_td_picker_basic" data-td-toggle="datetimepicker">
                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                            <div style="transform:translateX(10px);">
                                s/d
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group" id="kt_td_picker_simple" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <input type="text" class="form-control fp_elem" placeholder="Masa Kontrak sampai ..."/>
                                <span class="input-group-text" data-td-target="#kt_td_picker_basic" data-td-toggle="datetimepicker">
                                    <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Nilai Proyek</label>
                        <div class="col-lg-9">
                            <div class="input-group" id="kt_td_picker_simple" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <span class="input-group-text" data-td-target="#kt_td_picker_basic" data-td-toggle="datetimepicker">
                                    Rp
                                </span>
                                <input type="number" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Elemen Potongan</label>
                        <div class="col-lg-9 repeater_elem" id="kt_docs_repeater_basic">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label">Jenis Potongan</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Jenis Nilai</label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Besaran Potongan</label>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nilai Potongan (Rp)</label>
                                </div>
                                <div class="col-md-1">
                                    {{-- <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </a> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div data-repeater-list="kt_docs_repeater_basic">
                                    <div data-repeater-item class="mb-3">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <select class="form-select bypass_s2" aria-label="Select example">
                                                    <option disabled selected>Pilih Jenis Potongan</option>
                                                    <option value="1">PPN</option>
                                                    <option value="2">Pph 22/23</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-select bypass_s2" aria-label="Select example">
                                                    <option disabled selected>Pilih Jenis Nilai</option>
                                                    <option value="1">Persentase</option>
                                                    <option value="2">Nilai Rupiah</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="email" class="form-control mb-2 mb-md-0" placeholder="Enter contact number" />
                                            </div>
                                            <div class="col-md-4">
                                                <input type="email" class="form-control mb-2 mb-md-0" placeholder="Enter contact number" />
                                            </div>
                                            <div class="col-md-1">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    Tambah Potongan
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Nilai Setelah Potongan</label>
                        <div class="col-lg-9">
                            <div class="input-group" id="kt_td_picker_simple" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <span class="input-group-text" data-td-target="#kt_td_picker_basic" data-td-toggle="datetimepicker">
                                    Rp
                                </span>
                                <input type="number" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Anggaran Operasional</label>
                        <div class="col-lg-4">
                            <select class="form-select" aria-label="Select example">
                                <option disabled selected>Jenis Anggaran ...</option>
                                <option value="1">Persentase</option>
                                <option value="2">Nilai Rupiah</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group" id="kt_td_picker_simple" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <input type="number" class="form-control" placeholder="Masukan Persentase ..."/>
                                <span class="input-group-text" data-td-target="#kt_td_picker_basic" data-td-toggle="datetimepicker">
                                    %
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <hr style="margin: 20px 0px;">
                    
                    <!--
                    <div class="repeater_elem" id="kt_docs_repeater_basic_2">
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Dokumen Kontrak</label>
                            <div class="col-lg-8">
                                <div class="input-group" id="kt_td_picker_simple" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                    <input type="file" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-danger">
                                    X
                                </button>
                            </div>
                        </div>
                    </div>

                    !-->

                    <div class="form-group row mb-3">
                        <div class="col-lg-12" id="kt_docs_repeater_basic_2">
                            <div class="form-group">
                                <div data-repeater-list="kt_docs_repeater_basic_2">
                                    <div data-repeater-item class="mb-3">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Dokumen Kontrak</label>
                                            <div class="col-3">
                                                <select class="form-select bypass_s2" aria-label="Select example">
                                                    <option disabled selected>Pilih Jenis Dokumen</option>
                                                    <option value="1">Proposal</option>
                                                    <option value="2">RAB</option>
                                                    <option value="3">Kontrak Kerja/SPK</option>
                                                    <option value="4">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <input type="file" class="form-control mb-2 mb-md-0" />
                                            </div>
                                            <div class="col-1">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-5" style="text-align: right;">
                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    Tambah Dokumen
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12"style="text-align: right;">
                        <button type="reset" class="btn btn-success me-2">Simpan Project</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('js')
        <script src="{{ asset('plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            $(".fp_elem").flatpickr();
            $("select:not(.bypass_s2)").select2();

            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).fadeIn();
                },

                hide: function (deleteElement) {
                    $(this).fadeOut(deleteElement);
                }
            });

            $('#kt_docs_repeater_basic_2').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).fadeIn();
                },

                hide: function (deleteElement) {
                    $(this).fadeOut(deleteElement);
                }
            });

            // The DOM elements you wish to replace with Tagify
            var input1 = document.querySelector("#kt_tagify_1");

            // Initialize Tagify components on the above inputs
            new Tagify(input1);
        </script>
    @endpush
</x-wrapper-detail-project>