"use strict";

// Class definition
var KTUsersEditPosition = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_edit_position');
    const form = element.querySelector('#kt_modal_edit_position_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initEditPosition = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'code_position': {
                        validators: {
                            notEmpty: {
                                message: 'Code Position Wajib Diisi.'
                            }
                        }
                    },
                    'nama_position': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Position Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-position-modal-action="submit"]');
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
        const cancelAddButton = element.querySelector('[data-kt-position-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-position-modal-action="close"]');
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
            initEditPosition();
        }
    };
}();

$('body').on('click', '.viewPosition', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewPosition = routeViewPosition.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewPosition,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tablePosition;

                tablePosition = viewPosition(data_value);

            $('#dataPosition').html(tablePosition);
            $('#kt_modal_edit_position').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewPosition = routeConstViewPosition; // * Untuk reset route view
});

function viewPosition(data) {
    let tablePosition;
    var posLevel='';
    var posType='';
    var un='';
    var lm='';

    for(var i = 0; i < jsonPositionLevel.length; i++){
        var selected = '';
        if(data.get_position_level.code_position_level == jsonPositionLevel[i].code_position_level){
            selected = 'selected';
        }

        posLevel+= `<option value="${jsonPositionLevel[i].code_position_level}" ${selected}>${jsonPositionLevel[i].nama_position_level}</option>`;
    }

    for(var i = 0; i < jsonPositionType.length; i++){
        var selected = '';
        if(data.get_position_type.code_position_type == jsonPositionType[i].code_position_type){
            selected = 'selected';
        }

        posType+= `<option value="${jsonPositionType[i].code_position_type}" ${selected}>${jsonPositionType[i].nama_position_type}</option>`;
    }

    for(var i = 0; i < jsonUnit.length; i++){
        var selected = '';
        if(data.get_unit.code_unit == jsonUnit[i].code_unit){
            selected = 'selected';
        }

        un+= `<option value="${jsonUnit[i].code_unit}" ${selected}>${jsonUnit[i].nama_unit}</option>`;
    }

    for(var i = 0; i < jsonLineManager.length; i++){
        var selected = '';
        if(data.get_line_manager.code_position == jsonLineManager[i].code_position){
            selected = 'selected';
        }

        lm+= `<option value="${jsonLineManager[i].code_position}" ${selected}>${jsonLineManager[i].nama_position}</option>`;
    }

    tablePosition = `<div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Code Position</label>
                        <input type="hidden" name="id_value" value="${data.id}">
                        <input type="text" class="form-control form-control-solid" placeholder="" id="code_position" name="code_position" value="${data.code_position}" readonly/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Position</label>
                        <input type="text" class="form-control" placeholder="" id="nama_position" name="nama_position" value="${data.nama_position}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Code Position Level</label>
                        <select class="form-select" aria-label="Select example" name="code_position_level" id="code_position_level">
                            <option hidden>Silahkan Pilih Position Level...</option>
                            ${posLevel}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Code Position Type</label>
                        <select class="form-select" aria-label="Select example" id="code_position_type" id="code_position_type" name="code_position_type">
                            <option hidden>Silahkan Pilih Position Type...</option>
                             ${posType}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Code Unit</label>
                        <select class="form-select" aria-label="Select example" id="code_unit" id="code_unit" name="code_unit">
                            <option hidden>Silahkan Pilih Unit...</option>
                            ${un}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Line Manager</label>
                        <select class="form-select" aria-label="Select example" id="line_manager" name="line_manager">
                            <option hidden>Silahkan Pilih Line Manager...</option>
                            ${lm}
                        </select>
                    </div>`;

    return tablePosition;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersEditPosition.init();
});
