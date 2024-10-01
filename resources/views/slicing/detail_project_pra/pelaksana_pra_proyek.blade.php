<x-wrapper-detail-project step="1">
    @push('css')
        <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    
    @php
        $data_dummy = [
            [
                "no" => "1",
                "Nama Pelaksana" => "Lestari Handayani",
                "Jabatan" => "Eksternal",
                "Peranan" => "Subject Matter Expert",
                "Honorarium" => "Ya",
                "Aksi" => ""
            ],
            [
                "no" => "2",
                "Nama Pelaksana" => "Wahyu Sudrajat",
                "Jabatan" => "Internal",
                "Peranan" => "Kepala Tim",
                "Honorarium" => "Tidak",
                "Aksi" => ""
            ],
            [
                "no" => "3",
                "Nama Pelaksana" => "Siti Nurjanah",
                "Jabatan" => "Eksternal",
                "Peranan" => "Konsultan",
                "Honorarium" => "Ya",
                "Aksi" => ""
            ],
            [
                "no" => "4",
                "Nama Pelaksana" => "Ahmad Fathoni",
                "Jabatan" => "Internal",
                "Peranan" => "Manajer Proyek",
                "Honorarium" => "Tidak",
                "Aksi" => ""
            ],
            [
                "no" => "5",
                "Nama Pelaksana" => "Dewi Sartika",
                "Jabatan" => "Eksternal",
                "Peranan" => "Koordinator Lapangan",
                "Honorarium" => "Ya",
                "Aksi" => ""
            ],
            [
                "no" => "6",
                "Nama Pelaksana" => "Budi Santoso",
                "Jabatan" => "Internal",
                "Peranan" => "Konsultan Senior",
                "Honorarium" => "Tidak",
                "Aksi" => ""
            ],
            [
                "no" => "7",
                "Nama Pelaksana" => "Taufik Hidayat",
                "Jabatan" => "Eksternal",
                "Peranan" => "Analis Proyek",
                "Honorarium" => "Ya",
                "Aksi" => ""
            ]
        ];
    @endphp

    <div class="card" style="min-height: 400px;">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3" data-kt-user-table-toolbar="base">
                <a data-bs-toggle="modal" data-bs-target="#modal1" class="btn btn-sm btn-primary">
                    Tambah Pelaksana Pra Proyek
                </a>
            </div>

            <div class="table-responsive">
                <table id="kt_datatable_fixed_columns" class="table table-row-bordered gy-5 gs-7">
                    <thead>
                        <tr>
                            @foreach(array_keys($data_dummy[0]) as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
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