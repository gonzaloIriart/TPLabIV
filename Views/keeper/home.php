<?php 
    require_once("Views/nav.php");
?>
<div class="calendar-container">
    <div id="header">
        <div id="monthDisplay"></div>
        <div>
            <button id="backButton">Back</button>
            <button id="nextButton">Next</button>
        </div>
    </div>

    <div id="weekdays">
        <div>Sunday</div>
        <div>Monday</div>
        <div>Tuesday</div>
        <div>Wednesday</div>
        <div>Thursday</div>
        <div>Friday</div>
        <div>Saturday</div>
    </div>

    <div id="calendar"></div>
</div>

<div id="newEventModal">
    <form method="post" action="<?php echo FRONT_ROOT . "Keeper/AddUnavailableEvent"?>">
        <h2>Dias no disponible</h2>
        <input name="status" value="unavailable" type="hidden">
        <input type="date" name="startDate">
        <input type="date" name="endDate">

        <button id="saveButton" type="submit">Save</button>
    </form>
        <button id="cancelButton">Cancel</button>
</div>

<div id="deleteEventModal">
    <h2>Habilitar dias?</h2>

    <p id="eventText"></p>

    <form method="post" action="<?php echo FRONT_ROOT . "Keeper/DeleteEvent"?>">
        <input id="eventId" name="eventId" hidden>
        <button type="submit" id="deleteButton">Delete</button>
    </form>
    <button id="closeButton">Close</button>

    <div id="modalBackDrop"></div>
</div>
<script>
    let nav = 0;
    let clicked = null;
    let events = <?php echo json_encode($events, JSON_HEX_TAG);?>;
    console.log( events);
    const calendar = document.getElementById('calendar');
    const newEventModal = document.getElementById('newEventModal');
    const deleteEventModal = document.getElementById('deleteEventModal');
    const backDrop = document.getElementById('modalBackDrop');
    const eventTitleInput = document.getElementById('eventTitleInput');
    const weekdays = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];

    function openModal(date) {
        clicked = date;
        console.log(clicked);
        const eventForDay = events.find(e => clicked >= e.startDate && clicked <= e.endDate);

        if (eventForDay) {
            document.getElementById('eventText').innerText = `${eventForDay.startDate} - ${eventForDay.endDate}`;
            document.getElementById('eventId').value = eventForDay.id;
            deleteEventModal.style.display = 'block';
        } else {
            newEventModal.style.display = 'block';
        }

        backDrop.style.display = 'block';
    }

    function load() {
        const dt = new Date();

        if (nav !== 0) {
            dt.setMonth(new Date().getMonth() + nav);
        }

        const day = dt.getDate();
        const month = dt.getMonth();
        const year = dt.getFullYear();

        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
            weekday: 'long',
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
        });
        const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

        document.getElementById('monthDisplay').innerText =
            `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

        calendar.innerHTML = '';

        for (let i = 1; i <= paddingDays + daysInMonth; i++) {
            const daySquare = document.createElement('div');
            daySquare.classList.add('day');

            const dayString = `${month + 1}/${i - paddingDays}/${year}`;
            const date = new Date(dayString);

            console.table([date, events[0].startDate, Date.parse(dayString) > Date.parse(events[0].startDate)]);

            if (i > paddingDays) {
                daySquare.innerText = i - paddingDays;
                const eventForDay = events.find(e => date >=  Date.parse(e.startDate)  && date <=  Date.parse(e.endDate));

                if (i - paddingDays === day && nav === 0) {
                    daySquare.id = 'currentDay';
                }

                if (eventForDay) {
                    const eventDiv = document.createElement('div');
                    eventDiv.classList.add('event');
                    eventDiv.innerText = eventForDay.status;
                    daySquare.appendChild(eventDiv);
                }

                daySquare.addEventListener('click', () => openModal(dayString));
            } else {
                daySquare.classList.add('padding');
            }

            calendar.appendChild(daySquare);
        }
    }

    function closeModal() {
        newEventModal.style.display = 'none';
        deleteEventModal.style.display = 'none';
        backDrop.style.display = 'none';
        clicked = null;
        load();
    }

    function initButtons() {
        document.getElementById('nextButton').addEventListener('click', () => {
            nav++;
            load();
        });

        document.getElementById('backButton').addEventListener('click', () => {
            nav--;
            load();
        });

        document.getElementById('cancelButton').addEventListener('click', closeModal);
        document.getElementById('closeButton').addEventListener('click', closeModal);
    }

    initButtons();
    load();
</script>