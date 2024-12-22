const addPatientBtn = document.getElementById("add-patient-btn")
const addPatientPopup = document.querySelector(".add-patient-popup")

const addDoctorBtn = document.getElementById("add-doctor-btn")
const addDoctorPopup = document.querySelector(".add-doctor-popup")

const addAppointmentBtn = document.getElementById("add-appointment-btn")
const addAppointmentPopup = document.querySelector(".add-appointment-popup")

const addMedicalRecordBtn = document.getElementById("add-medical-record-btn")
const addMedicalRecordPopup = document.querySelector(".add-medical-record-popup")

const deletePatientBtns = document.querySelectorAll(".delete-patient")

const deleteDoctorBtns = document.querySelectorAll(".delete-doctor")

const deleteAppointmentBtns = document.querySelectorAll(".delete-appointment")

const deleteMedicalRecordBtns = document.querySelectorAll(".delete-medical-record")

document.addEventListener("click", function(e) {

    if(addPatientBtn && !addPatientPopup.contains(e.target) && addPatientPopup.classList.contains('show')) {
        addPatientPopup.classList.remove("show")
        document.body.classList.remove("overlay")
    } else if(e.target === addPatientBtn && !addPatientPopup.classList.contains('show')) {
        addPatientPopup.classList.add("show")
        document.body.classList.add("overlay")
    } 
    
    
    if(addDoctorBtn && !addDoctorPopup.contains(e.target) && addDoctorPopup.classList.contains('show')) {
        addDoctorPopup.classList.remove("show")
        document.body.classList.remove("overlay")
    } else if(e.target === addDoctorBtn && !addDoctorPopup.classList.contains('show')) {
        addDoctorPopup.classList.add("show")
        document.body.classList.add("overlay")
    }

    if(addAppointmentBtn && !addAppointmentPopup.contains(e.target) && addAppointmentPopup.classList.contains('show')) {
        addAppointmentPopup.classList.remove("show")
        document.body.classList.remove("overlay")
    } else if(e.target === addAppointmentBtn && !addAppointmentPopup.classList.contains('show')) {
        addAppointmentPopup.classList.add("show")
        document.body.classList.add("overlay")
    }

    if(addMedicalRecordBtn && !addMedicalRecordPopup.contains(e.target) && addMedicalRecordPopup.classList.contains('show')) {
        addMedicalRecordPopup.classList.remove("show")
        document.body.classList.remove("overlay")
    } else if(e.target === addMedicalRecordBtn && !addMedicalRecordPopup.classList.contains('show')) {
        addMedicalRecordPopup.classList.add("show")
        document.body.classList.add("overlay")
    }

})



deletePatientBtns.forEach(deletePatientBtn => {
    deletePatientBtn.addEventListener("click", function() {
        const deletePatientPopupId = deletePatientBtn.dataset.id;

        const deletePatientPopup = document.querySelector(".delete-patient-popup-"+deletePatientPopupId)

        if(deletePatientPopup) {
            deletePatientPopup.classList.add('show')
            document.body.classList.add("overlay")
        }

        const cancelPatientPopupBtn = deletePatientPopup.querySelector(".cancel-delete-patient")

        if(cancelPatientPopupBtn) {
            cancelPatientPopupBtn.addEventListener("click", function() {
                deletePatientPopup.classList.remove('show')
                document.body.classList.remove("overlay")
            })
        }
    
    })
})



deleteDoctorBtns.forEach(deleteDoctorBtn => {
    deleteDoctorBtn.addEventListener("click", function() {
        const deleteDoctorPopupId = deleteDoctorBtn.dataset.id;

        const deleteDoctorPopup = document.querySelector(".delete-doctor-popup-"+deleteDoctorPopupId)

        if(deleteDoctorPopup) {
            deleteDoctorPopup.classList.add('show')
            document.body.classList.add("overlay")
        }

        const cancelDoctorPopupBtn = deleteDoctorPopup.querySelector(".cancel-delete-doctor")

        if(cancelDoctorPopupBtn) {
            cancelDoctorPopupBtn.addEventListener("click", function() {
                deleteDoctorPopup.classList.remove('show')
                document.body.classList.remove("overlay")
            })
        }
    
    })
})


deleteAppointmentBtns.forEach(deleteAppointmentBtn => {
    deleteAppointmentBtn.addEventListener("click", function() {
        const deleteAppointmentPopupId = deleteAppointmentBtn.dataset.id;

        const deleteAppointmentPopup = document.querySelector(".delete-appointment-popup-"+deleteAppointmentPopupId)

        if(deleteAppointmentPopup) {
            deleteAppointmentPopup.classList.add('show')
            document.body.classList.add("overlay")
        }

        const cancelAppointmentPopupBtn = deleteAppointmentPopup.querySelector(".cancel-delete-appointment")

        if(cancelAppointmentPopupBtn) {
            cancelAppointmentPopupBtn.addEventListener("click", function() {
                deleteAppointmentPopup.classList.remove('show')
                document.body.classList.remove("overlay")
            })
        }
    
    })
})


const ths = document.querySelectorAll("thead th")


ths.forEach(th => {
    th.addEventListener("click", function() {
        if(th.dataset.sort) {
            const icon = th.querySelector("i")
            let sortType = 'asc'

            if(icon.classList.contains('fa-caret-down')) {
                icon.classList.remove('fa-caret-down')
                icon.classList.add('fa-caret-up')
                sortType = 'asc'
            } else {
                icon.classList.remove('fa-caret-up')
                icon.classList.add('fa-caret-down')
                sortType = 'desc'
            }

            const currentUrl = new URL(window.location.href);

            currentUrl.searchParams.set('sort', th.dataset.sort);
            currentUrl.searchParams.set('sortType', sortType);
            
            window.location.href = currentUrl.href;
        }
    })
})