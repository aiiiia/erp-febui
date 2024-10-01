"use strict";

var KTBanksList = function () {
    // Define shared variables
    var table = document.getElementById('kt_table_bank');
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    // Private functions
    var initBankTable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $('#kt_table_bank').DataTable({
            processing: true,
            responsive: false,
            ajax: {
                url: routeDataTable
            },
            columns: [
                { data: "DT_RowIndex", name: 'DT_RowIndex'  },
                { data: "code_bank", name: 'code_bank' },
                { data: "nama_bank", name: 'namanama_bank' },
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
                                        <a href="javascript:void(0)" class="menu-link px-3 viewBank" data-id="`+data.id+`">Ubah</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" class="menu-link px-3" data-id="`+data.id+`" data-kt-bank-table-filter="delete_row">Hapus</a>
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
        const filterSearch = document.querySelector('[data-kt-bank-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Delete subscirption
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-bank-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();
                let dataTarget = e.target;

                // Select parent row
                const parent = e.target.closest('tr');

                // Get bank name
                const bankName = parent.querySelectorAll('td')[2].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Apakah anda yakin akan menghapus data " + bankName + "?",
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
                    routeDeleteBank = routeDeleteBank.replace(":id", dataTarget.getAttribute('data-id'));

                    if (result.value && result.isConfirmed) {
                        $.ajax({
                            url: routeDeleteBank,
                            dataType: 'json',
                            method: 'POST',
                            data: {
                                _token: csrfToken,
                                _method: "DELETE",
                            },
                            success: function (resp) {
                                Swal.fire('Deleted!', '', 'success');
                                $('#kt_table_bank').DataTable().ajax.reload();
                            },
                            error: function (err) {
                                console.log("Error : ", err);
                            }
                        });

                        routeDeleteBank = routeConstDeleteBank;

                        Swal.fire({
                            text: "Anda berhasil menghapus data " + bankName + "!.",
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
                            text: bankName + " tidak terhapus.",
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
        toolbarBase = document.querySelector('[data-kt-bank-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-bank-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-bank-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-bank-table-select="delete_selected"]');

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
                text: "Are you sure you want to delete selected bank?",
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
                routeDeleteBank = routeDeleteBank.replace(":id", dataTarget.getAttribute('data-id'));

                if (result.value && result.isConfirmed) {
                    $.ajax({
                        url: routeDeleteBank,
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            _method: "DELETE",
                        },
                        success: function (resp) {
                            Swal.fire('Deleted!', '', 'success');
                            $('#tableBank').DataTable().ajax.reload();
                        },
                        error: function (err) {
                            console.log("Error : ", err);
                        }
                    });

                    routeDeleteBank = routeConstDeleteBank;

                    Swal.fire({
                        text: "Anda berhasil menghapus semua data Bank!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    })
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Bank yang dipilih tidak berhasil dihapus.",
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

            initBankTable();
            initToggleToolbar();
            handleSearchDatatable();
            //handleResetForm();
            handleDeleteRows();
            //handleFilterDatatable();

        }
    }
}();

$('body').on('click', '.viewBank', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewBank = routeViewBank.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewBank,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tableBank;

                tableBank = viewBank(data_value);

            $('#dataBank').html(tableBank);
            $('#kt_modal_edit_bank').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewBank = routeConstViewBank; // * Untuk reset route view
});

function viewBank(data) {
    let tableBank;

    tableBank = `<div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Code Bank</label>
                            <input type="hidden" name="id_value" value="${data.id}">
                            <input type="text" class="form-control form-control-solid" placeholder="" name="code_bank" value="${data.code_bank}" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Nama Bank</label>
                            <input type="text" class="form-control form-control-solid" placeholder="" name="nama_bank" value="${data.nama_bank}" />
                        </div>`;

    return tableBank;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTBanksList.init();
});
