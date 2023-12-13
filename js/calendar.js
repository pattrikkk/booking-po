let currentDate = new Date();

function fillDaysBetween(start, end) {
    const days = [];
    for (let d = new Date(start); d <= end; d.setDate(d.getDate() + 1)) {
        days.push(new Date(d).toISOString().split('T')[0]);
    }
    return days;
}

let allReservedDays = [];
for (let i = 0; i < reservations.length; i++) {
    const reservation = reservations[i];
    const days = fillDaysBetween(new Date(reservations[i]['dateFrom']), new Date(reservations[i]['dateTo']));
    allReservedDays = allReservedDays.concat(days);
}

console.log(allReservedDays);

function generateCalendar() {
    const monthYearString = currentDate.toLocaleDateString('default', { month: 'long', year: 'numeric' });
    document.getElementById('currentMonth').innerText = monthYearString;

    const calendarBody = document.getElementById('calendar-body');
    calendarBody.innerHTML = '';

    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    let html = '<tr>';
    for (let i = 0; i < firstDay.getDay(); i++) {
        html += '<td></td>';
    }

    for (let day = 1; day <= lastDay.getDate(); day++) {
        const dateStr = new Date(currentDate.getFullYear(), currentDate.getMonth(), day + 1).toISOString().split('T')[0];
        console.log(dateStr);
        if (allReservedDays.includes(dateStr)) {
            html += `<td class="reservation">${day}</td>`;
        } else {
            html += `<td>${day}</td>`;
        }

        if ((firstDay.getDay() + day) % 7 === 0) {
            html += '</tr><tr>';
        }
    }

    html += '</tr>';
    calendarBody.innerHTML = html;
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    generateCalendar();
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    generateCalendar();
}

// Initialize the calendar
generateCalendar();