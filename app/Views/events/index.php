<!DOCTYPE html>
<html>
<head>
    <title>Events - Elite Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

    <div class="events-container">
        <div class="events-header">
            <div class="header-content">
                <h1 class="events-title">Chess Club Events</h1>
                <p class="events-subtitle">Sign up for a tournament or class below. All your info is filled in for you!</p>
            </div>
            <div class="view-toggle">
                <button class="toggle-btn active" onclick="showCalendar()">
                    <i class="fas fa-calendar-alt"></i>
                    Calendar
                </button>
                <button class="toggle-btn" onclick="showList()">
                    <i class="fas fa-list"></i>
                    List
                </button>
            </div>
        </div>

        <!-- Calendar View -->
        <div class="calendar-section" id="calendar-section">
            <div class="calendar-header">
                <button class="calendar-nav" onclick="previousMonth()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <h2 class="current-month" id="current-month">January 2024</h2>
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

        <!-- List View -->
        <div class="list-section hidden" id="list-section">
            <div class="events-grid">
                <?php foreach ($events as $event): ?>
                    <div class="event-card">
                        <div class="event-header">
                            <div class="event-type <?= strtolower($event['type']) ?>">
                                <i class="fas fa-<?= $event['type'] === 'Tournament' ? 'trophy' : 'graduation-cap' ?>"></i>
                                <?= esc($event['type']) ?>
                            </div>
                            <div class="event-date">
                                <i class="fas fa-calendar"></i>
                                <?= date('M j, Y', strtotime($event['event_date'])) ?>
                            </div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title"><?= esc($event['title']) ?></h3>
                            <p class="event-description"><?= esc($event['description']) ?></p>
                            <div class="event-time">
                                <i class="fas fa-clock"></i>
                                <?= date('g:i A', strtotime($event['event_date'])) ?>
                            </div>
                        </div>
                        <div class="event-actions">
                            <a href="<?= base_url('events/register/' . $event['id']) ?>" class="join-btn">
                                <i class="fas fa-sign-in-alt"></i>
                                Join Now
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
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

    <script>
        // Calendar functionality
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        
        // Sample events data (replace with actual data from backend)
        const events = <?= json_encode($events) ?>;
        
        function renderCalendar() {
            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());
            
            const calendarDays = document.getElementById('calendar-days');
            const currentMonthElement = document.getElementById('current-month');
            
            // Update month display
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                               'July', 'August', 'September', 'October', 'November', 'December'];
            currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            
            // Clear calendar
            calendarDays.innerHTML = '';
            
            // Generate calendar days
            for (let i = 0; i < 42; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                dayElement.textContent = date.getDate();
                
                // Check if it's today
                if (date.toDateString() === new Date().toDateString()) {
                    dayElement.classList.add('today');
                }
                
                // Check if it's from other month
                if (date.getMonth() !== currentMonth) {
                    dayElement.classList.add('other-month');
                }
                
                // Check if day has events
                const dayEvents = getEventsForDate(date);
                if (dayEvents.length > 0) {
                    dayElement.classList.add('has-events');
                    dayElement.onclick = () => showDayEvents(date, dayEvents);
                }
                
                calendarDays.appendChild(dayElement);
            }
        }
        
        function getEventsForDate(date) {
            return events.filter(event => {
                const eventDate = new Date(event.event_date);
                return eventDate.toDateString() === date.toDateString();
            });
        }
        
        function showDayEvents(date, dayEvents) {
            const modal = document.getElementById('event-modal');
            const modalTitle = document.getElementById('modal-title');
            const modalContent = document.getElementById('modal-content');
            
            const dateString = date.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            modalTitle.textContent = `Events on ${dateString}`;
            
            let content = '';
            if (dayEvents.length === 0) {
                content = '<p>No events scheduled for this date.</p>';
            } else {
                dayEvents.forEach(event => {
                    content += `
                        <div class="event-summary">
                            <h4>${event.title}</h4>
                            <p><i class="fas fa-trophy"></i> ${event.type}</p>
                            <p><i class="fas fa-clock"></i> ${new Date(event.event_date).toLocaleTimeString()}</p>
                            <p><i class="fas fa-info-circle"></i> ${event.description}</p>
                            <div class="modal-actions">
                                <a href="${baseUrl}events/join/${event.id}" class="join-btn small">
                                    <i class="fas fa-sign-in-alt"></i> Join Event
                                </a>
                            </div>
                        </div>
                    `;
                });
            }
            
            modalContent.innerHTML = content;
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
        
        function showCalendar() {
            document.getElementById('calendar-section').style.display = 'block';
            document.getElementById('list-section').classList.add('hidden');
            document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
        }
        
        function showList() {
            document.getElementById('calendar-section').style.display = 'none';
            document.getElementById('list-section').classList.remove('hidden');
            document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
        }
        
        // Close modal
        document.getElementById('modal-close').addEventListener('click', () => {
            document.getElementById('event-modal').classList.remove('show');
        });
        
        // Close modal when clicking outside
        document.getElementById('event-modal').addEventListener('click', (e) => {
            if (e.target.id === 'event-modal') {
                e.target.classList.remove('show');
            }
        });
        
        // Initialize calendar
        const baseUrl = '<?= base_url() ?>';
        renderCalendar();
    </script>
</body>
</html>
