<x-wrapper-detail-project step="2">
    @push('css')
        
    @endpush

    @php
        $dataPelaksanaan = [
        [
            "nama" => "Riset Proyek",
            "tipe" => "Preparation",
            "status" => "SELESAI",
            "anggaran" => "8.890.000",
            "unit_terkait" => "Divisi Riset"
        ],
        [
            "nama" => "Pengembangan Sistem",
            "tipe" => "Implementation",
            "status" => "DALAM PROSES",
            "anggaran" => "15.000.000",
            "unit_terkait" => "Divisi IT"
        ],
        [
            "nama" => "Pelatihan Karyawan",
            "tipe" => "Training",
            "status" => "SELESAI",
            "anggaran" => "5.000.000",
            "unit_terkait" => "Divisi HRD"
        ],
        [
            "nama" => "Survey Pasar",
            "tipe" => "Research",
            "status" => "SELESAI",
            "anggaran" => "4.500.000",
            "unit_terkait" => "Divisi Marketing"
        ],
        [
            "nama" => "Audit Keuangan",
            "tipe" => "Audit",
            "status" => "DALAM PROSES",
            "anggaran" => "10.000.000",
            "unit_terkait" => "Divisi Keuangan"
        ],
        [
            "nama" => "Pemeliharaan Infrastruktur",
            "tipe" => "Maintenance",
            "status" => "BELUM DIMULAI",
            "anggaran" => "20.000.000",
            "unit_terkait" => "Divisi Teknik"
        ],
        [
            "nama" => "Pengadaan Alat Kantor",
            "tipe" => "Procurement",
            "status" => "SELESAI",
            "anggaran" => "12.000.000",
            "unit_terkait" => "Divisi Umum"
        ],
        [
            "nama" => "Perancangan Produk Baru",
            "tipe" => "Design",
            "status" => "DALAM PROSES",
            "anggaran" => "18.000.000",
            "unit_terkait" => "Divisi R&D"
        ],
        [
            "nama" => "Pengembangan Website",
            "tipe" => "Implementation",
            "status" => "SELESAI",
            "anggaran" => "7.500.000",
            "unit_terkait" => "Divisi IT"
        ],
        [
            "nama" => "Strategi Pemasaran",
            "tipe" => "Planning",
            "status" => "DALAM PROSES",
            "anggaran" => "9.000.000",
            "unit_terkait" => "Divisi Marketing"
        ],
        [
            "nama" => "Analisis Kompetitor",
            "tipe" => "Research",
            "status" => "SELESAI",
            "anggaran" => "5.500.000",
            "unit_terkait" => "Divisi Riset"
        ],
        [
            "nama" => "Peningkatan Keamanan",
            "tipe" => "Implementation",
            "status" => "BELUM DIMULAI",
            "anggaran" => "22.000.000",
            "unit_terkait" => "Divisi IT"
        ],
        [
            "nama" => "Evaluasi Kinerja",
            "tipe" => "Evaluation",
            "status" => "SELESAI",
            "anggaran" => "6.000.000",
            "unit_terkait" => "Divisi HRD"
        ],
        [
            "nama" => "Pembelian Software Baru",
            "tipe" => "Procurement",
            "status" => "DALAM PROSES",
            "anggaran" => "8.000.000",
            "unit_terkait" => "Divisi IT"
        ],
        [
            "nama" => "Pengembangan Produk",
            "tipe" => "R&D",
            "status" => "DALAM PROSES",
            "anggaran" => "14.000.000",
            "unit_terkait" => "Divisi R&D"
        ],
        [
            "nama" => "Kampanye Media Sosial",
            "tipe" => "Marketing",
            "status" => "SELESAI",
            "anggaran" => "3.000.000",
            "unit_terkait" => "Divisi Marketing"
        ],
        [
            "nama" => "Pembenahan Sarana Prasarana",
            "tipe" => "Maintenance",
            "status" => "BELUM DIMULAI",
            "anggaran" => "10.000.000",
            "unit_terkait" => "Divisi Umum"
        ],
        [
            "nama" => "Implementasi Sistem Baru",
            "tipe" => "Implementation",
            "status" => "SELESAI",
            "anggaran" => "25.000.000",
            "unit_terkait" => "Divisi IT"
        ],
        [
            "nama" => "Workshop Peningkatan Kinerja",
            "tipe" => "Training",
            "status" => "SELESAI",
            "anggaran" => "6.500.000",
            "unit_terkait" => "Divisi HRD"
        ],
        [
            "nama" => "Pengukuran Kinerja Tahunan",
            "tipe" => "Evaluation",
            "status" => "DALAM PROSES",
            "anggaran" => "8.500.000",
            "unit_terkait" => "Divisi HRD"
        ]
    ];

    @endphp

    <div class="d-flex" style="flex-wrap: wrap; gap: 30px;">
        
        @foreach ($dataPelaksanaan as $data)
            <div class="card" style="min-height: 100px; width: 370px;">
                <div class="card-header pt-5" style="flex-wrap: nowrap;">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">{{ $data["nama"] }}</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">{{ $data["tipe"] }}</span>
                    </h3>
                    <!--end::Title-->
                    <div class="card-toolbar">
                        <span class="badge badge-light-{{ $data["status"] == "SELESAI" ? "success" : "primary" }} flex-shrink-0 align-self-center py-3 px-4 fs-7">{{ $data["status"] }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                            <!--begin::Number-->
                            <span class="fs-6 text-gray-700 fw-bold">Rp
                                <span class="ms-n1 counted" data-kt-countup="true" data-kt-countup-value="284,900.00" data-kt-initialized="1">{{ $data["anggaran"] }}</span>
                            </span>
                            <!--end::Number-->
                            <!--begin::Label-->
                            <div class="fw-semibold text-gray-500">Anggaran</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                            <!--begin::Date-->
                            <span class="fs-6 text-gray-700 fw-bold text-nowrap">{{ $data["unit_terkait"] }}</span>
                            <!--end::Date-->
                            <!--begin::Label-->
                            <div class="fw-semibold text-gray-500">Unit Terkait</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12"style="text-align: right;">
                            <button type="reset" class="btn btn-light-danger me-2">Detail Pelaksanaan</button>
                            <button type="reset" class="btn btn-light-danger me-2">
                                <i class="fa fa-ellipsis-vertical"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    
    </div>

    @push('js')
    
        
    @endpush
</x-wrapper-detail-project>