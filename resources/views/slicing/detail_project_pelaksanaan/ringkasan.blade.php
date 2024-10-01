<x-wrapper-detail-project step="2">
    @push('css')
        <link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .fc .fc-toolbar{
                white-space: nowrap;
            }
        </style>
    @endpush

    <div class="row gy-5 g-xl-10">
        <div class="col-6">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Info Proyek</h3>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="account/settings.html" class="btn btn-sm btn-primary align-self-center">Edit Data Proyek</a>
                    <!--end::Action-->
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Nama Projek</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">Aero Smart Bussiness</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Sumber Dana</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-semibold text-gray-800 fs-6">Eksternal</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Jenis Instansi
                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                            <i class="ki-duotone ki-information fs-7">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 d-flex align-items-center">
                            <span class="fw-bold fs-6 text-gray-800 me-2">BUMN</span>
                            <span class="badge badge-success">Verified</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Tahun Project</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">2024</a>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Jenis Project 
                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Country of origination" data-bs-original-title="Country of origination" data-kt-initialized="1">
                            <i class="ki-duotone ki-information fs-7">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">Konsultasi</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">Unit Kerja</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">Divisi Konsultasi</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <h2 class="card-title fw-bold">Kalender Pra Proyek</h2>
                    <div class="card-toolbar">
                        <button class="btn btn-sm btn-flex btn-primary" data-kt-calendar="add">
                        <i class="ki-duotone ki-plus fs-2"></i>Add Event</button>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <div id="kt_docs_fullcalendar_selectable"></div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
        
        
        <script>
            "use strict";

            // Class definition
            var KTGeneralFullCalendarSelectDemos = function () {
                // Private functions

                var exampleSelect = function () {
                    // Define variables
                    var calendarEl = document.getElementById('kt_docs_fullcalendar_selectable');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        initialDate: '2024-09-10',
                        navLinks: true, // can click day/week names to navigate views
                        selectable: true,
                        selectMirror: true,

                        // Create new event
                        select: function (arg) {
                            Swal.fire({
                                html: '<div class="mb-7">Create new event?</div><div class="fw-bolder mb-5">Event Name:</div><input type="text" class="form-control" name="event_name" />',
                                icon: "info",
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonText: "Yes, create it!",
                                cancelButtonText: "No, return",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-active-light"
                                }
                            }).then(function (result) {
                                if (result.value) {
                                    var title = document.querySelector('input[name="event_name"]').value;
                                    if (title) {
                                        calendar.addEvent({
                                            title: title,
                                            start: arg.start,
                                            end: arg.end,
                                            allDay: arg.allDay
                                        })
                                    }
                                    calendar.unselect()
                                } else if (result.dismiss === 'cancel') {
                                    Swal.fire({
                                        text: "Event creation was declined!.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        }
                                    });
                                }
                            });
                        },

                        // Delete event
                        eventClick: function (arg) {
                            Swal.fire({
                                text: 'Are you sure you want to delete this event?',
                                icon: "warning",
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonText: "Yes, delete it!",
                                cancelButtonText: "No, return",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-active-light"
                                }
                            }).then(function (result) {
                                if (result.value) {
                                    arg.event.remove()
                                } else if (result.dismiss === 'cancel') {
                                    Swal.fire({
                                        text: "Event was not deleted!.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        }
                                    });
                                }
                            });
                        },
                        editable: true,
                        dayMaxEvents: true, // allow "more" link when too many events
                        events: [
                            {
                                title: 'All Day Event',
                                start: '2024-09-01'
                            },
                            {
                                title: 'Long Event',
                                start: '2024-09-07',
                                end: '2024-09-10'
                            },
                            {
                                groupId: 999,
                                title: 'Repeating Event',
                                start: '2024-09-09T16:00:00'
                            },
                            {
                                groupId: 999,
                                title: 'Repeating Event',
                                start: '2024-09-16T16:00:00'
                            },
                            {
                                title: 'Conference',
                                start: '2024-09-11',
                                end: '2024-09-13'
                            },
                            {
                                title: 'Meeting',
                                start: '2024-09-12T10:30:00',
                                end: '2024-09-12T12:30:00'
                            },
                            {
                                title: 'Lunch',
                                start: '2024-09-12T12:00:00'
                            },
                            {
                                title: 'Meeting',
                                start: '2024-09-12T14:30:00'
                            },
                            {
                                title: 'Happy Hour',
                                start: '2024-09-12T17:30:00'
                            },
                            {
                                title: 'Dinner',
                                start: '2024-09-12T20:00:00'
                            },
                            {
                                title: 'Birthday Party',
                                start: '2024-09-13T07:00:00'
                            },
                            {
                                title: 'Click for Google',
                                url: 'http://google.com/',
                                start: '2024-09-28'
                            }
                        ]
                    });

                    calendar.render();
                }

                return {
                    // Public Functions
                    init: function () {
                        exampleSelect();
                    }
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTGeneralFullCalendarSelectDemos.init();
            });
        </script>
    @endpush
</x-wrapper-detail-project>