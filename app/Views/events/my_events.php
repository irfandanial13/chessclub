<!DOCTYPE html>
<html>
<head>
    <title>My Registered Events - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="elite-chess-theme">
    <div class="elite-background">
        <div class="wood-pattern"></div>
        <div class="elite-overlay"></div>
        <div class="club-elements">
            <div class="trophy-element">🏆</div>
            <div class="medal-element">🥇</div>
            <div class="chess-piece king">♔</div>
            <div class="chess-piece queen">♕</div>
            <div class="chess-piece rook">♖</div>
            <div class="chess-piece bishop">♗</div>
            <div class="chess-piece knight">♘</div>
            <div class="chess-piece pawn">♙</div>
        </div>
    </div>
    <?= view('partials/navbar') ?>
    <div class="elite-login" style="max-width: 900px;">
        <div class="section-header" style="text-align:center;">
            <h2 class="events-title">My Registered Events</h2>
            <p class="events-subtitle">Your tournaments and classes are shown on the calendar below. Click a date to see details!</p>
        </div>
        <div class="calendar-section" id="calendar-section">
            <div class="calendar-header">
                <button class="calendar-nav" onclick="previousMonth()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <h2 class="current-month" id="current-month">Month Year</h2>
                <button class="calendar-nav" onclick="nextMonth()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="calendar-grid">
                <div class="calendar-weekdays">
                    <div class="weekday">Sun</div>
                    <div class="weekday">Mon</div>
                    <div class="weekday">Tue</div>
                    <div class="weekday">Wed</div>
                    <div class="weekday">Thu</div>
                    <div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>
                </div>
                <div class="calendar-days" id="calendar-days">
                    <!-- Calendar days will be generated here -->
                </div>
            </div>
        </div>
        <!-- Event Modal -->
        <div class="event-modal" id="event-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title">Event Details</h3>
                    <button class="modal-close" id="modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="event-detail" id="modal-content">
                        <!-- Event details will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    const myEvents = <?= json_encode($myEvents) ?>;

    function renderCalendar() {
        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - firstDay.getDay());

        const calendarDays = document.getElementById('calendar-days');
        const currentMonthElement = document.getElementById('current-month');
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'];
        currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;
        calendarDays.innerHTML = '';

        for (let i = 0; i < 42; i++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            dayElement.textContent = date.getDate();
            if (date.toDateString() === new Date().toDateString()) {
                dayElement.classList.add('today');
            }
            if (date.getMonth() !== currentMonth) {
                dayElement.classList.add('other-month');
            }
            const dayEvents = getEventsForDate(date);
            if (dayEvents.length > 0) {
                dayElement.classList.add('has-events');
                dayElement.onclick = () => showDayEvents(date, dayEvents);
            }
            calendarDays.appendChild(dayElement);
        }
    }
    function getEventsForDate(date) {
        return myEvents.filter(event => {
            const eventDate = new Date(event.event_date);
            return eventDate.toDateString() === date.toDateString();
        });
    }
    function showDayEvents(date, dayEvents) {
        const modal = document.getElementById('event-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalContent = document.getElementById('modal-content');
        const dateString = date.toLocaleDateString('en-US', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
        modalTitle.textContent = `Events on ${dateString}`;
        modalContent.innerHTML = '';
        dayEvents.forEach(event => {
            const div = document.createElement('div');
            div.innerHTML = `<strong>${event.title}</strong> (${event.type})<br>
                <span>${event.description}</span><br>
                <span>${new Date(event.event_date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span><hr>`;
            modalContent.appendChild(div);
        });
        modal.classList.add('show');
    }
    function previousMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    }
    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    }
    document.getElementById('modal-close').onclick = function() {
        document.getElementById('event-modal').classList.remove('show');
    };
    renderCalendar();
</script>
</body>
</html>