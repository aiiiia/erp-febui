"use strict";

// Class definition
var KTUsersAddUser = function () {
    // Shared variables
    const element = document.getElementById('kt_content_container');
    const form = element.querySelector('#kt_modal_add_pemutakhiran_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initAddUser = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'nama_wp': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'tlp_wp': {
                        validators: {
                            notEmpty: {
                                message: 'No Telepon Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'hp_wp': {
                        validators: {
                            notEmpty: {
                                message: 'No Selular Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'fax_wp': {
                        validators: {
                            notEmpty: {
                                message: 'No Fax Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'email_wp': {
                        validators: {
                            notEmpty: {
                                message: 'Email Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'alamat_wp': {
                        validators: {
                            notEmpty: {
                                message: 'Alamat Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'rt_wp': {
                        validators: {
                            notEmpty: {
                                message: 'RT Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'rw_wp': {
                        validators: {
                            notEmpty: {
                                message: 'RW Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'kec_wp': {
                        validators: {
                            notEmpty: {
                                message: 'Kecamatan Wajib Pajak Wajib Diisi.'
                            }
                        }
                    },
                    'kel_wp': {
                        validators: {
                            notEmpty: {
                                message: 'Kelurahan Wajib Pajak Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-pemutakhiran-action="submit"]');
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
