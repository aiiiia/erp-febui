"use strict";

// Class definition
var KTUsersEditClient = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_edit_client');
    const form = element.querySelector('#kt_modal_edit_client_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initEditClient = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'initial': {
                        validators: {
                            notEmpty: {
                                message: 'Initial Client Wajib Diisi.'
                            }
                        }
                    },
                    'nama': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Client Wajib Diisi.'
                            }
                        }
                    },
                    'id_jenis': {
                        validators: {
                            notEmpty: {
                                message: 'Jenis Instansi Wajib Diisi.'
                            }
                        }
                    },
                    'id_lokasi': {
                        validators: {
                            notEmpty: {
                                message: 'Lokasi Client Wajib Diisi.'
                            }
                        }
                    },
                    'id_sumber_dana': {
                        validators: {
                            notEmpty: {
                                message: 'Sumber Dana Wajib Diisi.'
                            }
                        }
                    },
                    'alamat': {
                        validators: {
                            notEmpty: {
                                message: 'Alamat Client Wajib Diisi.'
                            }
                        }
                    },
                    'no_hp': {
                        validators: {
                            notEmpty: {
                                message: 'No Telepon Client Wajib Diisi.'
                            }
                        }
                    },
                    'no_npwp': {
                        validators: {
                            notEmpty: {
                                message: 'No NPWP Client Wajib Diisi.'
                            }
                        }
                    },
                    'status_wapu': {
                        validators: {
                            notEmpty: {
                                message: 'Status WAPU Wajib Diisi.'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-client-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log(status);

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function () {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation
                            Swal.fire({
                                text: "Forms pengisian berhasil diproses!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, lanjutkan!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    modal.hide();
                                }
                            });

                            form.submit(); // Submit form
                        }, 2000);
                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Mohon maaf, sepertinya terdapat kesalahan, silahkan coba lagi.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, lanjutkan!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelAddButton = element.querySelector('[data-kt-client-modal-action="cancel"]');
        cancelAddButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Apakah anda yakin akan membatalkan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonText: "Ya, batalkan!",
                cancelButtonText: "Tidak, kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Form pengisian anda berhasil dibatalkan!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-client-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Apakah anda yakin akan membatalkan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: true,
                confirmButtonText: "Ya, batalkan!",
                cancelButtonText: "Tidak, kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Form pengisian berhasil dikembalikan!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    return {
        // Public functions
        init: function () {
            initEditClient();
        }
    };
}();

$('body').on('click', '.viewClient', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewClient = routeViewClient.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewClient,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tableClient;

                tableClient = viewClient(data_value);

            $('#dataClient').html(tableClient);
            $('#kt_modal_edit_client').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewClient = routeConstViewClient; // * Untuk reset route view
});

function viewClient(data) {
    let tableClient;
    var clientJenis='';
    var clientLokasi='';
    var clientSumberDana='';

    for(var i = 0; i < jsonClientJenis.length; i++){
        var selected = '';
        if(data.get_client_jenis.id == jsonClientJenis[i].id_jenis){
            selected = 'selected';
        }

        clientJenis+= `<option value="${jsonClientJenis[i].id}" ${selected}>${jsonClientJenis[i].nama}</option>`;
    }

    for(var i = 0; i < jsonClientLokasi.length; i++){
        var selected = '';
        if(data.get_client_lokasi.id == jsonClientLokasi[i].id_lokasi){
            selected = 'selected';
        }

        clientLokasi+= `<option value="${jsonClientLokasi[i].id}" ${selected}>${jsonClientLokasi[i].nama}</option>`;
    }

    for(var i = 0; i < jsonClientSumberDana.length; i++){
        var selected = '';
        if(data.get_client_sumber_dana.id == jsonClientSumberDana[i].id_sumber_dana){
            selected = 'selected';
        }

        clientSumberDana+= `<option value="${jsonClientSumberDana[i].id}" ${selected}>${jsonClientSumberDana[i].nama}</option>`;
    }

    var selectedStatusWapu = '';
    if(data.status_wapu == 0){
        selectedStatusWapu = 'selected';
    }else if(data.status_wapu == 1){
        selectedStatusWapu = 'selected';
    }

    tableClient = `<div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Initial Client</label>
                        <input type="hidden" name="id_value" value="${data.id}">
                        <input type="text" class="form-control form-control-solid" placeholder="" id="initial" name="initial" value="${data.initial}" readonly/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Client</label>
                        <input type="text" class="form-control" placeholder="" id="nama" name="nama" value="${data.nama}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Jenis Instansi</label>
                        <select class="form-select" aria-label="Select example" name="id_jenis" id="id_jenis">
                            <option hidden>Silahkan Pilih Jenis Instansi...</option>
                            ${clientJenis}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Lokasi Client</label>
                        <select class="form-select" aria-label="Select example" id="id_lokasi" id="id_lokasi" name="code_client_type">
                            <option hidden>Silahkan Pilih Lokasi Client...</option>
                             ${clientLokasi}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Sumber Dana</label>
                        <select class="form-select" aria-label="Select example" id="id_sumber_dana" name="id_sumber_dana">
                            <option hidden>Silahkan Pilih Sumber Dana...</option>
                            ${clientSumberDana}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Alamat</label>
                        <textarea class="form-select" aria-label="Select example" id="alamat" name="alamat">
                            ${data.alamat}
                        </textarea>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">No Telepon</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" id="no_hp" name="no_hp" value="${data.no_hp}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">No NPWP</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" id="no_npwp" name="no_npwp" value="${data.no_npwp}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Status WAPU</label>
                        <select class="form-select" aria-label="Select example" id="status_wapu" name="status_wapu">
                            <option hidden>Silahkan Pilih Status WAPU...</option>

                            <option value="0" ${selectedStatusWapu}>Tidak</option>
                            <option value="1" ${selectedStatusWapu}>Ya</option>
                        </select>
                    </div>`;

    return tableClient;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersEditClient.init();
});
