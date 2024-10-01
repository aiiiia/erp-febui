<x-wrapper-detail-project step="1">
    @push('css')
        <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @php
        $data_dummy = [
        [
            "no" => "1",
            "Nama Tenaga Ahli" => "Wahyu Sudrajat",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Kepala Dinas",
            "Keterlibatan Proyek" => "3 Proyek",
            "Beban Pekerjaan" => "2 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "2",
            "Nama Tenaga Ahli" => "Siti Nurjanah",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Asisten Proyek",
            "Keterlibatan Proyek" => "2 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "3",
            "Nama Tenaga Ahli" => "Ahmad Fathoni",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Manajer Teknis",
            "Keterlibatan Proyek" => "4 Proyek",
            "Beban Pekerjaan" => "3 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "4",
            "Nama Tenaga Ahli" => "Dewi Sartika",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Pengawas Lapangan",
            "Keterlibatan Proyek" => "1 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "5",
            "Nama Tenaga Ahli" => "Budi Santoso",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Konsultan Senior",
            "Keterlibatan Proyek" => "5 Proyek",
            "Beban Pekerjaan" => "4 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "6",
            "Nama Tenaga Ahli" => "Lestari Handayani",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Analis Proyek",
            "Keterlibatan Proyek" => "3 Proyek",
            "Beban Pekerjaan" => "2 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "7",
            "Nama Tenaga Ahli" => "Taufik Hidayat",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Koordinator Lapangan",
            "Keterlibatan Proyek" => "2 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "8",
            "Nama Tenaga Ahli" => "Sri Mulyani",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Konsultan Proyek",
            "Keterlibatan Proyek" => "4 Proyek",
            "Beban Pekerjaan" => "3 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "9",
            "Nama Tenaga Ahli" => "Imam Kusuma",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Asisten Manajer",
            "Keterlibatan Proyek" => "3 Proyek",
            "Beban Pekerjaan" => "2 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "10",
            "Nama Tenaga Ahli" => "Ratna Dewi",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Manajer Proyek",
            "Keterlibatan Proyek" => "5 Proyek",
            "Beban Pekerjaan" => "4 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "11",
            "Nama Tenaga Ahli" => "Hendro Wibowo",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Teknisi Lapangan",
            "Keterlibatan Proyek" => "2 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "12",
            "Nama Tenaga Ahli" => "Farida Lestari",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Konsultan Proyek",
            "Keterlibatan Proyek" => "4 Proyek",
            "Beban Pekerjaan" => "3 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "13",
            "Nama Tenaga Ahli" => "Bayu Pratama",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Pengawas Lapangan",
            "Keterlibatan Proyek" => "2 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "14",
            "Nama Tenaga Ahli" => "Indah Permata",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Asisten Konsultan",
            "Keterlibatan Proyek" => "1 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "15",
            "Nama Tenaga Ahli" => "Rudi Hartono",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Konsultan Senior",
            "Keterlibatan Proyek" => "5 Proyek",
            "Beban Pekerjaan" => "4 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "16",
            "Nama Tenaga Ahli" => "Fitriani Ahmad",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Asisten Teknis",
            "Keterlibatan Proyek" => "2 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "17",
            "Nama Tenaga Ahli" => "Rahmat Santoso",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Pengawas Proyek",
            "Keterlibatan Proyek" => "3 Proyek",
            "Beban Pekerjaan" => "2 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "18",
            "Nama Tenaga Ahli" => "Yulianti Kusuma",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Konsultan Teknis",
            "Keterlibatan Proyek" => "4 Proyek",
            "Beban Pekerjaan" => "3 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "19",
            "Nama Tenaga Ahli" => "Denny Susanto",
            "Jenis Kepegawaian" => "Kontrak",
            "Jabatan" => "Asisten Pengawas",
            "Keterlibatan Proyek" => "1 Proyek",
            "Beban Pekerjaan" => "1 Proyek",
            "Aksi" => ""
        ],
        [
            "no" => "20",
            "Nama Tenaga Ahli" => "Anggi Pratama",
            "Jenis Kepegawaian" => "Tetap",
            "Jabatan" => "Manajer Proyek",
            "Keterlibatan Proyek" => "5 Proyek",
            "Beban Pekerjaan" => "4 Proyek",
            "Aksi" => ""
        ]
    ];
    @endphp
    
    <div class="card" style="min-height: 400px;">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3" data-kt-user-table-toolbar="base">
                <a data-bs-toggle="modal" data-bs-target="#modal1" class="btn btn-sm btn-primary">
                    Tambah Tenaga Ahli
                </a>
            </div>

            <div class="table-responsive">
                <table id="kt_datatable_fixed_columns" class="table table-row-bordered gy-5 gs-7">
                    <thead>
                        @foreach(array_keys($data_dummy[0]) as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach($data_dummy as $dummy)
                            <tr>
                                @foreach($dummy as $value)
                                    @php
                                        $header = array_keys($dummy)[$loop->index];
                                    @endphp
                                    @if ($header == "Beban Pekerjaan")
                                        <td>
                                            <span class="badge badge-light-primary">
                                                {{ $value }}
                                            </span>
                                        </td>
                                    @elseif($header == "Aksi")
                                        <td class="actions">
                                            <div class="dropdown dropdown-inline mr-4">
                                                <button class="btn btn-sm btn-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item">Ubah</a></li>
                                                    <li><a class="dropdown-item">Detail</a></li>
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