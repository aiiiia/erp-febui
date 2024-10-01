"use strict";

// Class definition
var KTUsersEditPekerjaan = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_edit_pekerjaan');
    const form = element.querySelector('#kt_modal_edit_pekerjaan_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initEditPekerjaan = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'kode': {
                        validators: {
                            notEmpty: {
                                message: 'Kode Pekerjaan Wajib Diisi.'
                            }
                        }
                    },
                    'id_kelompok': {
                        validators: {
                            notEmpty: {
                                message: 'Kelompok Pekerjaan Wajib Diisi.'
                            }
                        }
                    },
                    'nama': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Pekerjaan Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-pekerjaan-modal-action="submit"]');
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
        const cancelAddButton = element.querySelector('[data-kt-pekerjaan-modal-action="cancel"]');
        cancelAddButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Apakah anda yakin akan membatalkan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, batalkan!",
                cancelAddButtonText: "Tidak, kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelAddButton: "btn btn-active-light"
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
        const closeButton = element.querySelector('[data-kt-pekerjaan-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Apakah anda yakin akan membatalkan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, batalkan!",
                cancelAddButtonText: "Tidak, kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelAddButton: "btn btn-active-light"
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
            initEditPekerjaan();
        }
    };
}();

$('body').on('click', '.viewPekerjaan', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewPekerjaan = routeViewPekerjaan.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewPekerjaan,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tablePekerjaan;

                tablePekerjaan = viewPekerjaan(data_value);

            $('#dataPekerjaan').html(tablePekerjaan);
            $('#kt_modal_edit_pekerjaan').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewPekerjaan = routeConstViewPekerjaan; // * Untuk reset route view
});

function viewPekerjaan(data) {
    let tablePekerjaan;
    var kelompok='';

    for(var i = 0; i < jsonSektor.length; i++){
        var selected = '';
        if(data.get_kelompok.id == jsonSektor[i].id_kelompok){
            selected = 'selected';
        }

        kelompok+= `<option value="${jsonSektor[i].id}" ${selected}>${jsonSektor[i].nama}</option>`;
    }

    tablePekerjaan = `<div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kode Pekerjaan</label>
                        <input type="hidden" name="id_value" value="${data.id}">
                        <input type="text" class="form-control form-control-solid" placeholder="" id="kode" name="kode" value="${data.kode}"/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Sektor Pekerjaan</label>
                        <select class="form-select" aria-label="Select example" name="id_kelompok" id="id_kelompok">
                            <option hidden>Silahkan Pilih Sektor Pekerjaan...</option>
                            ${kelompok}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" id="nama" name="nama" value="${data.nama}" />
                    </div>`;

    return tablePekerjaan;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersEditPekerjaan.init();
});
