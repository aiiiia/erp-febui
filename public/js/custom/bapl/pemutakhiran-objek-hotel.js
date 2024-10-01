"use strict";

// Class definition
var KTUsersAddUser = function () {
    // Shared variables
    const element = document.getElementById('kt_content_container');
    const form = element.querySelector('#kt_modal_add_pemutakhiran_op_hotel_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initAddUser = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'jml_kamar': {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah Kamar Wajib Diisi.'
                            }
                        }
                    },
                    'gol_kamar': {
                        validators: {
                            notEmpty: {
                                message: 'Golongan Kamar Wajib Diisi.'
                            }
                        }
                    },
                    'okupansi': {
                        validators: {
                            notEmpty: {
                                message: 'Okupansi Wajib Diisi.'
                            }
                        }
                    },
                    'rate_weekday': {
                        validators: {
                            notEmpty: {
                                message: 'Tarif Weekday Wajib Diisi.'
                            }
                        }
                    },
                    'rate_weekend': {
                        validators: {
                            notEmpty: {
                                message: 'Tarif Weekend Wajib Diisi.'
                            }
                        }
                    },
                    'rate_peak_season': {
                        validators: {
                            notEmpty: {
                                message: 'Tarif High Season Wajib Diisi.'
                            }
                        }
                    },
                    'jml_meeting_room': {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah Meeting Room Wajib Diisi.'
                            }
                        }
                    },
                    'kapasitas_meeting_room': {
                        validators: {
                            notEmpty: {
                                message: 'Kapasitas Meeting Room Wajib Diisi.'
                            }
                        }
                    },
                    'rate_meeting_room_per_pax': {
                        validators: {
                            notEmpty: {
                                message: 'Harga per Pax Wajib Diisi.'
                            }
                        }
                    },
                    'is_resto': {
                        validators: {
                            notEmpty: {
                                message: 'Memiliki Restoran Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-pemutakhiran-op-hotel-action="submit"]');
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
    }

    return {
        // Public functions
        init: function () {
            initAddUser();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});
