<x-wrapper-detail-project step="1">
    @push('css')
        <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @php
        $dataKegiatan = [
            [
                "no" => "1",
                "Nama Kegiatan" => "Survey Lokasi Proyek",
                "Jenis Kegiatan" => "Pengumpulan Data",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Mengumpulkan data terkait lokasi proyek",
                "Aksi" => ""
            ],
            [
                "no" => "2",
                "Nama Kegiatan" => "Penyusunan Anggaran",
                "Jenis Kegiatan" => "Perencanaan Keuangan",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Menyusun anggaran biaya proyek secara detail",
                "Aksi" => ""
            ],
            [
                "no" => "3",
                "Nama Kegiatan" => "Pengadaan Material",
                "Jenis Kegiatan" => "Pembelian Barang",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Melakukan pengadaan material proyek",
                "Aksi" => ""
            ],
            [
                "no" => "4",
                "Nama Kegiatan" => "Rekrutmen Tenaga Kerja",
                "Jenis Kegiatan" => "SDM",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Mencari dan merekrut pekerja untuk proyek",
                "Aksi" => ""
            ],
            [
                "no" => "5",
                "Nama Kegiatan" => "Pembangunan Pondasi",
                "Jenis Kegiatan" => "Konstruksi",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Pembangunan pondasi bangunan proyek",
                "Aksi" => ""
            ],
            [
                "no" => "6",
                "Nama Kegiatan" => "Pemasangan Kerangka",
                "Jenis Kegiatan" => "Konstruksi",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Pemasangan kerangka bangunan utama",
                "Aksi" => ""
            ],
            [
                "no" => "7",
                "Nama Kegiatan" => "Pemasangan Atap",
                "Jenis Kegiatan" => "Konstruksi",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Pemasangan atap bangunan",
                "Aksi" => ""
            ],
            [
                "no" => "8",
                "Nama Kegiatan" => "Finishing Interior",
                "Jenis Kegiatan" => "Dekorasi",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Penyelesaian interior bangunan",
                "Aksi" => ""
            ],
            [
                "no" => "9",
                "Nama Kegiatan" => "Pemeriksaan Kualitas",
                "Jenis Kegiatan" => "Quality Control",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Pemeriksaan kualitas hasil pekerjaan proyek",
                "Aksi" => ""
            ],
            [
                "no" => "10",
                "Nama Kegiatan" => "Penyerahan Proyek",
                "Jenis Kegiatan" => "Administrasi",
                "Waktu Kegiatan" => "waktu",
                "Lampiran" => "",
                "Keterangan" => "Penyerahan hasil proyek kepada pemilik",
                "Aksi" => ""
            ]
        ];
    @endphp
    
    <div class="card" style="min-height: 400px;">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3" data-kt-user-table-toolbar="base">
                <a data-bs-toggle="modal" data-bs-target="#modal1" class="btn btn-sm btn-primary">
                    Tambah Kegiatan
                </a>
            </div>

            <div class="table-responsive">
                <table id="kt_datatable_fixed_columns" class="table table-row-bordered gy-5 gs-7">
                    <thead>
                        <tr>
                            @if (!empty($dataKegiatan) && is_array($dataKegiatan))
                                @foreach(array_keys($dataKegiatan[0]) as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataKegiatan as $kegiatan)
                            <tr>
                                @foreach($kegiatan as $value)
                                    @php
                                        $header = array_keys($kegiatan)[$loop->index];
                                    @endphp
                                    @if ($header == "Waktu Kegiatan")
                                        <td>20 Juli 2024</td>
                                    @elseif($header == "Lampiran")
                                        <td>
                                            <button class="btn btn-light-primary">
                                                Lihat Lampiran
                                            </button>
                                        </td>
                                    @elseif($header == "Aksi")
                                        <td class="actions">
                                            <div class="dropdown dropdown-inline mr-4">
                                                <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item">Ubah Kegiatan</a></li>
                                                    <li><a class="dropdown-item">Detail Kegiatan</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ $value }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>   
    </div>

    @push('js')
        <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script >
            $('table').DataTable({
                pageLength: 5,
                filter: true,
                "searching": true
            });
        </script>
    @endpush
</x-wrapper-detail-project>