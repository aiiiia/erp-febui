"use strict";

// Class definition
var KTUsersEditHonorAsesmen = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_edit_honor-asesmen');
    const form = element.querySelector('#kt_modal_edit_honor-asesmen_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initEditHonorAsesmen = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'kode': {
                        validators: {
                            notEmpty: {
                                message: 'Kode Honor Asesmen Wajib Diisi.'
                            }
                        }
                    },
                    'jenis': {
                        validators: {
                            notEmpty: {
                                message: 'Jenis Honor Asesmen Wajib Diisi.'
                            }
                        }
                    },
                    'honor': {
                        validators: {
                            notEmpty: {
                                message: 'Nomor Honor Honor Asesmen Wajib Diisi.'
                            }
                        }
                    },
                    'satuan': {
                        validators: {
                            notEmpty: {
                                message: 'Satuan Honor Asesmen Wajib Diisi.'
                            }
                        }
                    },
                    'keterangan': {
                        validators: {
                            notEmpty: {
                                message: 'Keterangan Honor Asesmen Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-honor-asesmen-modal-action="submit"]');
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
        const cancelAddButton = element.querySelector('[data-kt-honor-asesmen-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-honor-asesmen-modal-action="close"]');
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
            initEditHonorAsesmen();
        }
    };
}();

$('body').on('click', '.viewHonorAsesmen', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewHonorAsesmen = routeViewHonorAsesmen.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewHonorAsesmen,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tableHonorAsesmen;

                tableHonorAsesmen = viewHonorAsesmen(data_value);

            $('#dataHonorAsesmen').html(tableHonorAsesmen);
            $('#kt_modal_edit_honor-asesmen').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewHonorAsesmen = routeConstViewHonorAsesmen; // * Untuk reset route view
});

function viewHonorAsesmen(data) {
    let tableHonorAsesmen;

    tableHonorAsesmen = `<div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Kode Honor Asesmen</label>
                            <input type="hidden" name="id_value" value="${data.id}">
                            <input type="text" value="${data.kode}" class="form-control" placeholder="" id="kode" name="kode" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Jenis Honor Asesmen</label>
                            <input type="text" value="${data.jenis}" class="form-control" placeholder="" id="jenis" name="jenis" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Nomor Honor Honor Asesmen</label>
                            <input type="number" value="${data.honor}" class="form-control" placeholder="" id="honor" name="honor" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Satuan Honor Asesmen</label>
                            <input type="text" value="${data.satuan}" class="form-control" placeholder="" id="satuan" name="satuan" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Keterangan Honor Asesmen</label>
                            <textarea class="form-control" aria-label="Keterangan" id="keterangan" name="keterangan">${data.keterangan}</textarea>
                        </div>`;

    return tableHonorAsesmen;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersEditHonorAsesmen.init();
});
