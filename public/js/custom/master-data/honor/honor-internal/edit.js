"use strict";

// Class definition
var KTUsersEditHonorInternal = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_edit_honor-internal');
    const form = element.querySelector('#kt_modal_edit_honor-internal_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initEditHonorInternal = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'kode': {
                        validators: {
                            notEmpty: {
                                message: 'Kode Honor Internal Wajib Diisi.'
                            }
                        }
                    },
                    'jenis': {
                        validators: {
                            notEmpty: {
                                message: 'Jenis Honor Internal Wajib Diisi.'
                            }
                        }
                    },
                    'honor': {
                        validators: {
                            notEmpty: {
                                message: 'Nomor Honor Honor Internal Wajib Diisi.'
                            }
                        }
                    },
                    'satuan': {
                        validators: {
                            notEmpty: {
                                message: 'Satuan Honor Internal Wajib Diisi.'
                            }
                        }
                    },
                    'keterangan': {
                        validators: {
                            notEmpty: {
                                message: 'Keterangan Honor Internal Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-honor-internal-modal-action="submit"]');
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
        const cancelAddButton = element.querySelector('[data-kt-honor-internal-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-honor-internal-modal-action="close"]');
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
            initEditHonorInternal();
        }
    };
}();

$('body').on('click', '.viewHonorInternal', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewHonorInternal = routeViewHonorInternal.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewHonorInternal,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tableHonorInternal;

                tableHonorInternal = viewHonorInternal(data_value);

            $('#dataHonorInternal').html(tableHonorInternal);
            $('#kt_modal_edit_honor-internal').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewHonorInternal = routeConstViewHonorInternal; // * Untuk reset route view
});

function viewHonorInternal(data) {
    let tableHonorInternal;

    tableHonorInternal = `<div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Kode Honor Internal</label>
                            <input type="hidden" name="id_value" value="${data.id}">
                            <input type="text" value="${data.kode}" class="form-control" placeholder="" id="kode" name="kode" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Jenis Honor Internal</label>
                            <input type="text" value="${data.jenis}" class="form-control" placeholder="" id="jenis" name="jenis" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Nomor Honor Honor Internal</label>
                            <input type="number" value="${data.honor}" class="form-control" placeholder="" id="honor" name="honor" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Satuan Honor Internal</label>
                            <input type="text" value="${data.satuan}" class="form-control" placeholder="" id="satuan" name="satuan" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Keterangan Honor Internal</label>
                            <textarea class="form-control" aria-label="Keterangan" id="keterangan" name="keterangan">${data.keterangan}</textarea>
                        </div>`;

    return tableHonorInternal;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersEditHonorInternal.init();
});
