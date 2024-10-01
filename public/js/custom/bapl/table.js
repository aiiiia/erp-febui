"use strict";

var KTUsersList = function () {
    // Define shared variables
    var table = document.getElementById('kt_table_bapl');
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    // Private functions
    var initUserTable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $('#kt_table_bapl').DataTable({
            processing: true,
            responsive: false,
            ajax: {
                url: routeDataTable
            },
            columns: [
                { data: "DT_RowIndex", name: 'DT_RowIndex' },
                { data: "tgl_bapl", name: 'tgl_bapl' },
                { data: "nama_merk", name: 'nama_merk' },
                { data: "bapl", name: 'bapl' },
                { data: "bapl_detail", name: 'bapl_detail' },
                { data: null }
            ],
            "info": true,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 },
                { orderable: false, targets: 3 },
                { orderable: false, targets: 4 },
                {
                    targets: -1,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        var routePemutakhirans = routePemutakhiran.replace(':ids', data.id);

                        return `<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 viewBapl" data-id="`+data.id+`">Ubah</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="`+routePemutakhirans+`" class="menu-link px-3">Pemutakhiran</a>
                                </div>
                            </div>`;

                            // <div class="menu-item px-3">
                            //         <a href="javascript:void(0)" class="menu-link px-3" data-id="`+data.id+`" data-kt-pegawai-table-filter="delete_row">Hapus</a>
                            //     </div>
                    },
                }, // Disable ordering on column 6 (actions)
            ]
        })

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            // initToggleToolbar();
            handleDeleteRows();
            // toggleToolbars();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-bapl-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    // var handleFilterDatatable = () => {
    //     // Select filter options
    //     const filterForm = document.querySelector('[data-kt-bapl-table-filter="form"]');
    //     const filterButton = filterForm.querySelector('[data-kt-bapl-table-filter="filter"]');
    //     const selectOptions = filterForm.querySelectorAll('select');

    //     // Filter datatable on submit
    //     filterButton.addEventListener('click', function () {
    //         var filterString = '';

    //         // Get filter values
    //         selectOptions.forEach((item, index) => {
    //             if (item.value && item.value !== '') {
    //                 if (index !== 0) {
    //                     filterString += ' ';
    //                 }

    //                 // Build filter value options
    //                 filterString += item.value;
    //             }
    //         });

    //         // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         datatable.search(filterString).draw();
    //     });
    // }

    // Reset Filter
    // var handleResetForm = () => {
    //     // Select reset button
    //     const resetButton = document.querySelector('[data-kt-bapl-table-filter="reset"]');

    //     // Reset datatable
    //     resetButton.addEventListener('click', function () {
    //         // Select filter options
    //         const filterForm = document.querySelector('[data-kt-bapl-table-filter="form"]');
    //         const selectOptions = filterForm.querySelectorAll('select');

    //         // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
    //         selectOptions.forEach(select => {
    //             $(select).val('').trigger('change');
    //         });

    //         // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
    //         datatable.search('').draw();
    //     });
    // }


    // Delete subscirption
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-bapl-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get bapl name
                const baplName = parent.querySelectorAll('td')[1].querySelectorAll('a')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Apakah anda yakin akan menghapus data ini? " + baplName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, batalkan",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "Anda telah menghapus data " + baplName + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, lanjutkan!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        }).then(function () {
                            // Detect checked checkboxes
                            toggleToolbars();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: baplName + " telah dihapus.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, lanjutkan!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-bapl-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-bapl-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-bapl-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-bapl-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Apakah anda yakin akan menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        text: "Anda berhasil menghapus semua data BAPL!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        // Remove all selected customers
                        checkboxes.forEach(c => {
                            if (c.checked) {
                                datatable.row($(c.closest('tbody tr'))).remove().draw();
                            }
                        });

                        // Remove header checked box
                        const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;
                    }).then(function () {
                        toggleToolbars(); // Detect checked checkboxes
                        initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Data yang terpilih tidak terhapus.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initUserTable();
            initToggleToolbar();
            handleSearchDatatable();
            //handleResetForm();
            handleDeleteRows();
            //handleFilterDatatable();

        }
    }
}();

$('body').on('click', '.viewBapl', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewBapl = routeViewBapl.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewBapl,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                data_petugas = resp.petugas,
                data_petugas2 = resp.petugas2,
                tableBapl;

            tableBapl = viewBapl(data_value, data_petugas, data_petugas2);

            $('#kt_modal_edit_bapl').modal('show');
            $('#dataBapl').html(tableBapl);

            ClassicEditor.create(document.querySelector('#kt_docs_ckeditor_classic_edit'));
            $("#kt_daterangepicker_4").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2020,
                maxYear: parseInt(moment().format("YYYY"),12),
                parentEl: $('#kt_modal_edit_bapl_form'),
                locale: {
                    format: "YYYY-MM-DD"
                }
            });
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewBapl = routeConstViewBapl; // * Untuk reset route view
});

function viewBapl(data, data_petugas, data_petugas2) {
    let tableBapl,
        routeImage1 = routeImage.replace(':ids', data.image_1),
        routeImage2 = routeImage.replace(':ids', data.image_2);

    tableBapl = `<div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Tanggal Berita Acara Penelitian Lapangan</label>
                    <input type="hidden" name="id" value="${data.id}">
                    <input class="form-control form-control-solid" placeholder="Tgl Pelaksanaan BAPL" id="kt_daterangepicker_4" name="tgl_bapl" value="${data.tgl_bapl}"/>
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Petugas Pendata 1</label>
                    ${data_petugas}
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Petugas Pendata 2</label>
                    ${data_petugas2}
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Nama Merk Dagang</label>
                    <input type="text" class="form-control form-control-solid" placeholder="Nama Merk Dagang" name="nama_merk" value="${data.nama_merk}" />
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Alamat Merk Dagang</label>
                    <textarea class="form-control" aria-label="With textarea" name="alamat_merk">${data.alamat_merk}</textarea>
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">NPWP Merk Dagang</label>
                    <input type="text" class="form-control form-control-solid" placeholder="NPWP Merk Dagang" name="npwp_merk" value="${data.npwp_merk}" />
                </div>
                <div class="fv-row mb-7">
                    <label class="required fs-6 fw-semibold mb-2">Informasi Merk Dagang</label>
                    <textarea name="deskripsi_merk" id="kt_docs_ckeditor_classic_edit">${data.deskripsi_merk}</textarea>
                </div>
                    <hr>
                <h2>Titik Lokasi Merk Dagang</h2>
                    <br>
                <div class="fv-row mb-7 center">
                    <div class="col-sm-6">
                        <a onclick="getLocation()" class="btn btn-primary pull-right">Mengambil Titik Koordinat</a>
                    </div>
                </div>
                    <br>
                <div class="fv-row mb-7 clearfix">
                    <label class="required fs-6 fw-semibold mb-2">Latitude</label>
                    <input type="text" class="form-control form-control-solid" id="latInput" name="latInput" placeholder="  Masukan Latitude..." value="${data.lat}" readonly />
                </div>
                <div class="fv-row mb-7 clearfix">
                    <label class="required fs-6 fw-semibold mb-2">Longitude</label>
                    <input type="text" class="form-control form-control-solid" id="lngInput" name="lngInput" placeholder="  Masukan Longitude..." value="${data.lang}" readonly />
                </div>
                <div id="animated-thumbnials" class="list-unstyled row clearfix maps">
                    <div class="col-sm-12 center form-group" id="images">
                        <img id="gambar" src="${data.map_image}" class="imgFitWindowResize center"/>
                    </div>
                </div>
                <input type="hidden" id="image_map" name="image_map" />
                    <hr>
                <h2>Dokumentasi </h2>
                    <br>
                <div class="fv-row mb-7 clearfix">
                    <label class="required fs-6 fw-semibold mb-2">Lampiran 1</label>
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('${routeImage1}')">
                        <!--begin::Image preview wrapper-->
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('${routeImage1}')"></div>
                        <!--end::Image preview wrapper-->

                        <!--begin::Edit button-->
                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change"
                        data-bs-toggle="tooltip"
                        data-bs-dismiss="click"
                        title="Ubah Lampiran">
                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                            <!--begin::Inputs-->
                            <input type="file" name="image_1" accept=".png, .jpg, .jpeg" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->

                        <!--begin::Cancel button-->
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel"
                        data-bs-toggle="tooltip"
                        data-bs-dismiss="click"
                        title="Reset">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!--end::Cancel button-->

                        <!--begin::Remove button-->
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="remove"
                        data-bs-toggle="tooltip"
                        data-bs-dismiss="click"
                        title="Hapus Lampiran">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!--end::Remove button-->
                    </div>
                    <!--end::Image input-->
                </div>
                <div class="fv-row mb-7 clearfix">
                    <label class="required fs-6 fw-semibold mb-2">Lampiran 2</label>
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('${routeImage2}')">
                        <!--begin::Image preview wrapper-->
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('${routeImage2}')"></div>
                        <!--end::Image preview wrapper-->

                        <!--begin::Edit button-->
                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change"
                        data-bs-toggle="tooltip"
                        data-bs-dismiss="click"
                        title="Ubah Lampiran">
                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                            <!--begin::Inputs-->
                            <input type="file" name="image_2" accept=".png, .jpg, .jpeg" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->

                        <!--begin::Cancel button-->
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel"
                        data-bs-toggle="tooltip"
                        data-bs-dismiss="click"
                        title="Reset">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!--end::Cancel button-->

                        <!--begin::Remove button-->
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="remove"
                        data-bs-toggle="tooltip"
                        data-bs-dismiss="click"
                        title="Hapus Lampiran">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!--end::Remove button-->
                    </div>
                    <!--end::Image input-->
                </div>`;

    routeImage = routeConstImage;

    return tableBapl;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});
