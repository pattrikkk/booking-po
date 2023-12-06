let currentDate = new Date();

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
        const dateStr = new Date(currentDate.getFullYear(), currentDate.getMonth(), day).toISOString().split('T')[0];

        if (reservations.includes(dateStr)) {
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

// Replace this array with your reservation dates (in the format YYYY-MM-DD)
const reservations = ['2023-12-10', '2023-12-15', '2023-12-20'];

// Initialize the calendar
generateCalendar();