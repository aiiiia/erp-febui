"use strict";

// Class definition
var KTUsersEditPegawai = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_edit_pegawai');
    const form = element.querySelector('#kt_modal_edit_pegawai_form');
    const modal = new bootstrap.Modal(element);

    // Init edit schedule modal
    var initEditPegawai = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'code_pegawai': {
                        validators: {
                            notEmpty: {
                                message: 'Code Pegawai Wajib Diisi.'
                            }
                        }
                    },
                    'nama_pegawai': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Pegawai Wajib Diisi.'
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
        const submitButton = element.querySelector('[data-kt-pegawai-modal-action="submit"]');
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
        const cancelAddButton = element.querySelector('[data-kt-pegawai-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-pegawai-modal-action="close"]');
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
            initEditPegawai();
        }
    };
}();

$('body').on('click', '.viewPegawai', function (e) {
    e.preventDefault();
    let dataTarget = e.target;

    routeViewPegawai = routeViewPegawai.replace(':id', dataTarget.getAttribute('data-id'));
    $.ajax({
        url: routeViewPegawai,
        dataType: 'json',
        success: function (resp) {
            let data_value = resp.data,
                tablePegawai;

                tablePegawai = viewPegawai(data_value);

            $('#dataPegawai').html(tablePegawai);
            $('#kt_modal_edit_pegawai').modal('show');
        },
        error: function (err) {
            console.log("Error : ", err);
        }
    });

    routeViewPegawai = routeConstViewPegawai; // * Untuk reset route view
});

function viewPegawai(data) {
    let tablePegawai;
    var posLevel='';
    var pos='';
    var selectStatusKaryawan='';
    var selectJenisKelamin='';
    var selectAgama='';
    var selectMarst='';
    console.log(data);

    for(var i = 0; i < jsonPegawaiLevel.length; i++){
        var selected = '';
        if(data.get_position.get_position_level.code_position_level == jsonPegawaiLevel[i].code_position_level){
            selected = 'selected';
        }

        posLevel+= `<option value="${jsonPegawaiLevel[i].code_position_level}" ${selected}>${jsonPegawaiLevel[i].nama_position_level}</option>`;
    }

    for(var i = 0; i < jsonPosition.length; i++){
        var selected = '';
        if(data.get_position.code_position == jsonPosition[i].code_position){
            selected = 'selected';
        }

        pos+= `<option value="${jsonPosition[i].code_position}" ${selected}>${jsonPosition[i].nama_position}</option>`;
    }

    if(data.status_karyawan == "Tetap"){
        selectStatusKaryawan = "selected";
    }else if(data.status_karyawan == "Kontrak"){
        selectStatusKaryawan = "selected";
    }else if(data.status_karyawan == "Asociate"){
        selectStatusKaryawan = "selected";
    }

    if(data.jenis_kelamin == "Laki-Laki"){
        selectJenisKelamin = "selected";
    }else if(data.jenis_kelamin == "Perempuan"){
        selectJenisKelamin = "selected";
    }

    if(data.agama == "1-Islam"){
        selectAgama = "selected";
    }else if(data.agama == "2-Kristen"){
        selectAgama = "selected";
    }else if(data.agama == "3-Katolik"){
        selectAgama = "selected";
    }else if(data.agama == "4-Hindu"){
        selectAgama = "selected";
    }else if(data.agama == "5-Budha"){
        selectAgama = "selected";
    }else if(data.agama == "6-Khonghucu"){
        selectAgama = "selected";
    }

    if(data.marst == "Menikah"){
        selectMarst = "selected";
    }else if(data.marst == "Cerai Hidup"){
        selectMarst = "selected";
    }else if(data.marst == "Cerai Mati"){
        selectMarst = "selected";
    }else if(data.marst == "Belum Menikah"){
        selectMarst = "selected";
    }

    tablePegawai = `<div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Code Pegawai</label>
                        <input type="hidden" name="id_value" value="${data.id}">
                        <input type="text" class="form-control form-control-solid" placeholder="" id="nip" name="nip" value="${data.nip}" readonly/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Pegawai</label>
                        <input type="text" class="form-control" placeholder="" id="nama" name="nama" value="${data.nama}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Job Title</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" id="job_title" name="job_title" value="${data.job_title}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Position Pegawai</label>
                        <select class="form-select" aria-label="Select example" id="code_position" name="code_position">
                            <option hidden>Silahkan Pilih Position Pegawai...</option>
                            ${pos}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">BOD Type</label>
                        <select class="form-select" aria-label="Select example" id="bod_type" name="bod_type">
                            <option hidden>Silahkan Pilih BOD Type...</option>
                            ${posLevel}
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Status Karyawan</label>
                        <select class="form-select" aria-label="Select example" id="status_karyawan" name="status_karyawan">
                            <option hidden>Silahkan Pilih Status Karyawan...</option>
                            <option value="Tetap" ${data.status_karyawan == "Tetap" ? "selected" : ""}>Tetap</option>
                            <option value="Kontrak" ${data.status_karyawan == "Kontrak" ? "selected" : ""}>Kontrak</option>
                            <option value="Asociate" ${data.status_karyawan == "Asociate" ? "selected" : ""}>Asociate</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Jenis Kelamin</label>
                        <select class="form-select" aria-label="Select example" id="jenis_kelamin" name="jenis_kelamin">
                            <option hidden>Silahkan Pilih Jenis Kelamin...</option>
                            <option value="Laki-Laki" ${data.jenis_kelamin == "Laki-Laki" ? "selected" : ""}>Laki-Laki</option>
                            <option value="Perempuan" ${data.jenis_kelamin == "Perempuan" ? "selected" : ""}>Perempuan</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Tempat Lahir</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" id="tempat_lahir" name="tempat_lahir" value="${data.tempat_lahir}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Tgl Lahir</label>
                        <input class="form-control form-control-solid" placeholder="" id="tgl_lahir" name="tgl_lahir" value="${data.tgl_lahir}"/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Agama</label>
                        <select class="form-select" aria-label="Select example" id="agama" name="agama">
                            <option hidden>Silahkan Pilih Agama...</option>
                            <option value="1-Islam" ${data.agama == "1-Islam" ? "selected" : ""}>Islam</option>
                            <option value="2-Kristen" ${data.agama == "2-Kristen" ? "selected" : ""}>Kristen</option>
                            <option value="3-Katolik" ${data.agama == "3-Katolik" ? "selected" : ""}>Katolik</option>
                            <option value="4-Hindu" ${data.agama == "4-Hindu" ? "selected" : ""}>Hindu</option>
                            <option value="5-Budha" ${data.agama == "5-Budha" ? "selected" : ""}>Budha</option>
                            <option value="6-Khonghucu" ${data.agama == "6-Khonghucu" ? "selected" : ""}>Khonghucu</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Status Pernikahan</label>
                        <select class="form-select" aria-label="Select example" id="marst" name="marst">
                            <option hidden>Silahkan Pilih Status Pernikahan...</option>
                            <option value="Menikah" ${data.marst == "Menikah" ? "selected" : ""}>Menikah</option>
                            <option value="Cerai Hidup" ${data.marst == "Cerai Hidup" ? "selected" : ""}>Cerai Hidup</option>
                            <option value="Cerai Mati" ${data.marst == "Cerai Mati" ? "selected" : ""}>Cerai Mati</option>
                            <option value="Belum Menikah" ${data.marst == "Belum Menikah" ? "selected" : ""}>Belum Menikah</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Alamat</label>
                        <textarea type="text" class="form-control form-control-solid" placeholder="" id="alamat" name="alamat">${data.alamat}</textarea>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">No KTP</label>
                        <input class="form-control form-control-solid" placeholder="" id="no_ktp" name="no_ktp" value="${data.no_ktp}"/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">No NPWP</label>
                        <input class="form-control form-control-solid" placeholder="" id="no_npwp" name="no_npwp" value="${data.no_npwp}"/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">email</label>
                        <input class="form-control form-control-solid" placeholder="" id="email" name="email" value="${data.email}"/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">No HP</label>
                        <input class="form-control form-control-solid" placeholder="" id="no_hp" name="no_hp" value="${data.no_hp}"/>
                    </div>`;

    return tablePegawai;
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersEditPegawai.init();
});
