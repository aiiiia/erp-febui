"use strict";

var KTPositionsList = function () {
    // Define shared variables
    var table = document.getElementById('kt_table_position');
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    // Private functions
    var initUserTable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $('#kt_table_position').DataTable({
            processing: true,
            responsive: false,
            ajax: {
                url: routeDataTable
            },
            columns: [
                { data: "DT_RowIndex", name: 'DT_RowIndex'  },
                { data: "code_position", name: 'code_position' },
                { data: "nama_position", name: 'nama_position' },
                { data: "code_position_level", name: 'code_position_level' },
                { data: "code_position_type", name: 'code_position_type' },
                { data: "code_unit", name: 'code_unit' },
                { data: "line_manager", name: 'line_manager' },
                { data: null }
            ],
            "info": true,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="fa-solid fa-bars"></i>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" class="menu-link px-3 viewPosition" data-id="`+data.id+`">Ubah</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" class="menu-link px-3" data-id="`+data.id+`" data-kt-position-table-filter="delete_row">Hapus</a>
                                    </div>
                                </div>`;
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
        const filterSearch = document.querySelector('[data-kt-position-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Delete subscirption
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-position-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();
                let dataTarget = e.target;

                // Select parent row
                const parent = e.target.closest('tr');

                // Get position name
                const positionName = parent.querySelectorAll('td')[2].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Apakah anda yakin akan menghapus data " + positionName + "?",
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
                    routeDeletePosition = routeDeletePosition.replace(":id", dataTarget.getAttribute('data-id'));

                    if (result.value && result.isConfirmed) {
                        $.ajax({
                            url: routeDeletePosition,
                            dataType: 'json',
                            method: 'POST',
                            data: {
                                _token: csrfToken,
                                _method: "DELETE",
                            },
                            success: function (resp) {
                                Swal.fire('Deleted!', '', 'success');
                                $('#kt_table_position').DataTable().ajax.reload();
                            },
                            error: function (err) {
                                console.log("Error : ", err);
                            }
                        });

                        routeDeletePosition = routeConstDeletePosition;

                        Swal.fire({
                            text: "Anda berhasil menghapus data " + positionName + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, lanjutkan!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: positionName + " tidak terhapus.",
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
        toolbarBase = document.querySelector('[data-kt-position-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-position-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-position-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-position-table-select="delete_selected"]');

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
                text: "Are you sure you want to delete selected position?",
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
                routeDeletePosition = routeDeletePosition.replace(":id", dataTarget.getAttribute('data-id'));

                if (result.value && result.isConfirmed) {
                    $.ajax({
                        url: routeDeletePosition,
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            _method: "DELETE",
                        },
                        success: function (resp) {
                            Swal.fire('Deleted!', '', 'success');
                            $('#tablePosition').DataTable().ajax.reload();
                        },
                        error: function (err) {
                            console.log("Error : ", err);
                        }
                    });

                    routeDeletePosition = routeConstDeletePosition;

                    Swal.fire({
                        text: "Anda berhasil menghapus semua data Position!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    })
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Position yang dipilih tidak berhasil dihapus.",
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

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTPositionsList.init();
});
