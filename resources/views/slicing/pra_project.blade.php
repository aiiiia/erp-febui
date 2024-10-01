<x-app-content-wrapper judul="Pra Proyek">
    @push('css')
        <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .table-striped>tbody>tr:nth-of-type(odd)>*{
                background: #fff1f1;
            }
            th *{
                font-weight: 900;
            }
        </style>
    @endpush
    
    <div class="card" style="min-height: 400px;">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3" data-kt-user-table-toolbar="base">
                <a href="{{ route('slicing') }}?nama_blade=tambah_project_pra" class="btn btn-sm btn-primary">
                    Tambah Proyek
                </a>
            </div>

            <div class="table-responsive">
                <table id="kt_datatable_fixed_columns" class="table table-striped table-row-bordered gy-5 gs-7">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Proyek</th>
                            <th>Klien</th>
                            <th>Jenis Proyek</th>
                            <th>Unit</th>
                            <th>Created At</th>
                            <th>Status Proyek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pelatihan Kenaikan Jabatan</td>
                            <td>PT Angkasa Pura</td>
                            <td>Training</td>
                            <td>Divisi Training</td>
                            <td>01 Jan 2024</td>
                            <td><span class="badge badge-light-warning">Pra Proyek</span></td>
                            <td class="actions">
                                <div class="dropdown dropdown-inline mr-4">
                                    <button class="btn btn-sm btn-light-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=tambah_project_pra">Ubah Project</a></li>
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=detail_project_pra.ringkasan">Detail Project</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pelatihan Kenaikan Jabatan</td>
                            <td>PT Angkasa Pura</td>
                            <td>Konsultasi</td>
                            <td>Divisi Konsultasi</td>
                            <td>01 Jan 2024</td>
                            <td><span class="badge badge-light-warning">Pra Proyek</span></td>
                            <td class="actions">
                                 <div class="dropdown dropdown-inline mr-4">
                                    <button class="btn btn-sm btn-light-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=tambah_project_pra">Ubah Project</a></li>
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=detail_project_pra.ringkasan">Detail Project</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pelatihan Kenaikan Jabatan</td>
                            <td>PT Angkasa Pura</td>
                            <td>Konsultasi</td>
                            <td>Divisi Konsultasi</td>
                            <td>01 Jan 2024</td>
                            <td><span class="badge badge-light-warning">Pra Proyek</span></td>
                            <td class="actions">
                                 <div class="dropdown dropdown-inline mr-4">
                                    <button class="btn btn-sm btn-light-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=tambah_project_pra">Ubah Project</a></li>
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=detail_project_pra.ringkasan">Detail Project</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Pelatihan Kenaikan Jabatan</td>
                            <td>PT Angkasa Pura</td>
                            <td>Assessment</td>
                            <td>Divisi Assessment</td>
                            <td>01 Jan 2024</td>
                            <td><span class="badge badge-light-warning">Pra Proyek</span></td>
                            <td class="actions">
                                 <div class="dropdown dropdown-inline mr-4">
                                    <button class="btn btn-sm btn-light-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=tambah_project_pra">Ubah Project</a></li>
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=detail_project_pra.ringkasan">Detail Project</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Pelatihan Kenaikan Jabatan</td>
                            <td>PT Angkasa Pura</td>
                            <td>Training</td>
                            <td>Divisi Training</td>
                            <td>01 Jan 2024</td>
                            <td><span class="badge badge-danger">Batal</span></td>
                            <td class="actions">
                                 <div class="dropdown dropdown-inline mr-4">
                                    <button class="btn btn-sm btn-light-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=tambah_project_pra">Ubah Project</a></li>
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=detail_project_pra.ringkasan">Detail Project</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Pelatihan Kenaikan Jabatan</td>
                            <td>PT Angkasa Pura</td>
                            <td>Training</td>
                            <td>Divisi Training</td>
                            <td>01 Jan 2024</td>
                            <td><span class="badge badge-danger">Batal</span></td>
                            <td class="actions">
                                 <div class="dropdown dropdown-inline mr-4">
                                    <button class="btn btn-sm btn-light-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=tambah_project_pra">Ubah Project</a></li>
                                        <li><a class="dropdown-item" href="{{ route('slicing') }}?nama_blade=detail_project_pra.ringkasan">Detail Project</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
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
</x-app-content-wrapper>

