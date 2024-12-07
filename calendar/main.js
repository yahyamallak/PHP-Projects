let timeInput = document.querySelector("p.time")
let dateInput = document.querySelector("p.date")
let subDateInput = document.querySelector("p.sub-date")
let tbody = document.querySelector("tbody")
let days = []
let daysNum
const lastMonthBtn = document.getElementById("last")
const nextMonthBtn = document.getElementById("next")
let month, year;

setInterval(()=> {
    getTime();
}, 1000)

buildCalendar();

async function buildCalendar(month = null, year = null) {
    
    tbody.innerHTML = ""
    days = []
    days.length = 0

    await getDate();
    await getSubDate(month, year);
    await getLastWeekOfPreviousMonth(month, year);
    await getDaysInMonth(month, year);
    firstWeekOfNextMonth();

    let row = ''
    let rows = ''

    days.forEach((day, index) => {
        row += day

        if((index + 1) % 7 === 0) {
            rows += `<tr>${row}</tr>`
            row = ''
        }
    })

    tbody.innerHTML = rows

    if(month == null || year == null) {
        month = await getMonth();
        year = await getYear();
    }

    lastMonthBtn.dataset.month = month <= 1 ? 12 : month - 1
    lastMonthBtn.dataset.year = month <= 1 ? year - 1 : year

    nextMonthBtn.dataset.month = month >= 12 ? 1 : month + 1
    nextMonthBtn.dataset.year = month >= 12 ? year + 1 : year
}


async function getMonth() {
    let res = await fetch("/calendar/getMonth");
    let month = await res.text()
    
    return +month
}

async function getYear() {
    let res = await fetch("/calendar/getYear");
    let year = await res.text()
    
    return +year
}


async function getTime() {
    let res = await fetch("/calendar/getTime");
    let time = await res.text()
    timeInput.innerText = time
}

async function getDate() {
    let res = await fetch("/calendar/getDate");
    let date = await res.text()
    dateInput.innerText = date
}

async function getSubDate(month = null, year = null) {

    let data = new FormData();
    data.append("month", month);
    data.append("year", year);

    const res = await fetch("/calendar/getSubDate", {
        method: "POST",
        body: data
    });

    const result = await res.json();

    subDateInput.innerText = result
}


async function getLastWeekOfPreviousMonth(month = null, year = null){

    let data = new FormData();
    data.append("month", month);
    data.append("year", year);

    const res = await fetch("/calendar/getLastWeekOfPreviousMonth", {
        method: "POST",
        body: data
    });

    const result = await res.json();
    result.forEach(day => {
        days.push(`<td class='low-opacity'>${day}</td>`);
    });

}


async function getDaysInMonth(month = null, year = null) {

    let data = new FormData();
    data.append("month", month);
    data.append("year", year);

    const res = await fetch("/calendar/getDaysOfMonth", {
        method: "POST",
        body: data
    });

    const result = await res.json();
    result.forEach(day => {
        days.push(`<td>${day}</td>`);
    });
}


function firstWeekOfNextMonth() {
    let j = 1;
    while(days.length < 42) {
        days.push(`<td class='low-opacity'>${j}</td>`);
        j++;
    }
}



lastMonthBtn.addEventListener("click", function() {
    const month = +lastMonthBtn.dataset.month;
    const year = +lastMonthBtn.dataset.year;

    buildCalendar(month, year);
});


nextMonthBtn.addEventListener("click", function() {
    const month = +nextMonthBtn.dataset.month;
    const year = +nextMonthBtn.dataset.year;

    buildCalendar(month, year)
});