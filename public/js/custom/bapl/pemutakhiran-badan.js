"use strict";

// Class definition
var KTUsersAddUser = function () {
    // Shared variables
    const element = document.getElementById('kt_content_container');
    const form = element.querySelector('#kt_modal_add_pemutakhiran_wb_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initAddUser = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'nama_wb': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'tlp_wb': {
                        validators: {
                            notEmpty: {
                                message: 'No Telepon Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'hp_wb': {
                        validators: {
                            notEmpty: {
                                message: 'No Selular Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'fax_wb': {
                        validators: {
                            notEmpty: {
                                message: 'No Fax Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'email_wb': {
                        validators: {
                            notEmpty: {
                                message: 'Email Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'alamat_wb': {
                        validators: {
                            notEmpty: {
                                message: 'Alamat Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'rt_wb': {
                        validators: {
                            notEmpty: {
                                message: 'RT Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'rw_wb': {
                        validators: {
                            notEmpty: {
                                message: 'RW Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'kec_wb': {
                        validators: {
                            notEmpty: {
                                message: 'Kecamatan Wajib Pajak Badan Wajib Diisi.'
                            }
                        }
                    },
                    'kel_wb': {
                        validators: {
                            notEmpty: {
                                message: 'Kelurahan Wajib Pajak Badan Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-pemutakhiran-wb-action="submit"]');
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
