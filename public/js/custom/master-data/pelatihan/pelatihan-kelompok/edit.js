"use strict";

// Class definition
var KTPelatihanKelompoksEdit = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_edit_pelatihan_kelompok');
    const form = element.querySelector('#kt_modal_edit_pelatihan_kelompok_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initEditPelatihanKelompok = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'nama': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Pelatihan Kelompok Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-pelatihan-kelompok-modal-action="submit"]');
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
        const cancelAddButton = element.querySelector('[data-kt-pelatihan-kelompok-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-pelatihan-kelompok-modal-action="close"]');
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
            initEditPelatihanKelompok();
        }
    };
}();

$('body').on('click', '.viewPelatihanKelompok', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewPelatihanKelompok = routeViewPelatihanKelompok.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewPelatihanKelompok,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tablePelatihanKelompok;

                tablePelatihanKelompok = viewPelatihanKelompok(data_value);

            $('#dataPelatihanKelompok').html(tablePelatihanKelompok);
            $('#kt_modal_edit_pelatihan_kelompok').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewPelatihanKelompok = routeConstViewPelatihanKelompok; // * Untuk reset route view
});

function viewPelatihanKelompok(data) {
    let tablePelatihanKelompok;

    tablePelatihanKelompok = `<div class="fv-row mb-7">
                            <input type="hidden" name="id_value" value="${data.id}">
                            <label class="required fs-6 fw-semibold mb-2">Nama Pelatihan Kelompok</label>
                            <input type="text" class="form-control" placeholder="" id="nama" name="nama" value="${data.nama}" />
                        </div>`;

    return tablePelatihanKelompok;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTPelatihanKelompoksEdit.init();
});
