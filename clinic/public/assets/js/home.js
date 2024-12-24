document.addEventListener("click", function(e) {

    const target = e.target
    const popup = target.closest('.doctor').querySelector('.book-doctor')
    
    if(target.classList.contains('book-doctor-btn')) {
        popup.classList.add("show")
    } else if(!popup.contains(target)) {
        popup.classList.remove("show")
    }
    
})


/* Load more doctors */

const doctorsSection = document.querySelector(".doctors")
let page = 2;

function loadDoctors() {

    const xhttp = new XMLHttpRequest()
    let formData = new FormData()
    formData.append("page", page)
    
    xhttp.onreadystatechange = function() {
    
        if(xhttp.readyState == 4 && xhttp.status == 200) {

            page = page + 1

            const data = JSON.parse(xhttp.responseText)

            console.log(data)
            
            data.forEach(doctor => {
                
                doctorsSection.innerHTML += `
            
                <div class="doctor">
                    <div class="title">
                        <h4>${doctor.name} -  <em>( ${doctor.specialization} )</em></h4>
                        <h5>Email : ${doctor.email}</h5>
                        <h5>Phone : ${doctor.phone}</h5>
                    </div>
                    <button class="book-doctor-btn" data-btn="${doctor.doctor_id}">Book</button>
                    <hr>
                    <div class="book-doctor book-doctor-${doctor.doctor_id}">
                        <form action="/bookDoctor" method="post">
                            <input type="hidden" value="${doctor.doctor_id}">
                            <input type="date" name="date">
                            <input type="time" name="time">
                            <button type="submit">Book</button>
                        </form>
                    </div>
                </div>
                `
            })
            
            
        }
    }
    xhttp.open("POST", "/getDoctors")
    xhttp.send(formData)
}

document.addEventListener("scroll", function(e) {

    const scroll = document.documentElement.scrollHeight - window.innerHeight;

    if(scroll == window.scrollY) {
        loadDoctors();
    }
});