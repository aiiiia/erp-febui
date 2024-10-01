"use strict";

// Class definition
var KTUsersAddUser = function () {
    // Shared variables
    const element = document.getElementById('kt_content_container');
    const form = element.querySelector('#kt_modal_add_pemutakhiran_op_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initAddUser = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'nama_op': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Merk Dagang Wajib Diisi.'
                            }
                        }
                    },
                    'tlp_op': {
                        validators: {
                            notEmpty: {
                                message: 'No Telepon Merk Dagang Wajib Diisi.'
                            }
                        }
                    },
                    'alamat_op': {
                        validators: {
                            notEmpty: {
                                message: 'Alamat Merk Dagang Wajib Diisi.'
                            }
                        }
                    },
                    'rt_op': {
                        validators: {
                            notEmpty: {
                                message: 'RT Merk Dagang Wajib Diisi.'
                            }
                        }
                    },
                    'rw_op': {
                        validators: {
                            notEmpty: {
                                message: 'RW Merk Dagang Wajib Diisi.'
                            }
                        }
                    },
                    'kec_op': {
                        validators: {
                            notEmpty: {
                                message: 'Kecamatan Merk Dagang Wajib Diisi.'
                            }
                        }
                    },
                    'kel_op': {
                        validators: {
                            notEmpty: {
                                message: 'Kelurahan Merk Dgang Wajib Diisi.'
                            }
                        }
                    },
                    'jml_peg_op': {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah Pegawai Wajib Diisi.'
                            }
                        }
                    },
                    'gaji_peg_op': {
                        validators: {
                            notEmpty: {
                                message: 'Gaji Pegawai Wajib Diisi.'
                            }
                        }
                    },
                    'tgl_mulai_usaha_op': {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal Mulai Usaha Wajib Diisi.'
                            }
                        }
                    },
                    'jenis_objek_op': {
                        validators: {
                            notEmpty: {
                                message: 'Jenis Objek Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-pemutakhiran-op-action="submit"]');
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
