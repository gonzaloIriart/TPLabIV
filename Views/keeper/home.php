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
    <form method="post" action="<?php echo FRONT_ROOT . "Keeper/AddUnavailableEvent" ?>">
        <h2>Dias no disponible</h2>
        <input name="status" value="unavailable" type="hidden">
        <input type="date" id="startDate" name="startDate">
        <input type="date" id="endDate" name="endDate">

        <button class="saveButton" type="submit">Save</button>
    </form>
    <button id="cancelButton">Cancel</button>
</div>

<div id="deleteEventModal">
    <h2>Habilitar dias?</h2>

    <p id="eventText"></p>

    <form method="post" action="<?php echo FRONT_ROOT . "Keeper/DeleteEvent" ?>">
        <input id="eventId" name="eventId" hidden>
        <button style="width: 100px;"  type="submit" class="btn btn-primary">Habilitar</button>
    </form>

</div>

<div id="pendingReserveModal" style="max-width: 60rem;" class="container card text-center">
    <div class="card-body">
        <h5 id="petName" class="card-title"></h5>
        <p id="petSize" class="card-text"></p>
        <p id="pendingStartDate" class="card-text"></p>
        <p id="pendingEndDate" class="card-text"></p>
        <div class="container">
            <form class="buttonForm" method="post" action="<?php echo (FRONT_ROOT . "/Keeper/AcceptReserve/"); ?>">
                <input id="pendingReserveId" name="reserveId" hidden>
                <button type="submit" class="btn btn-primary">Aceptar Reserva</button>
            </form>
            <form class="buttonForm" method="post" action="<?php echo (FRONT_ROOT . "/Keeper/DeleteReserveFromCalendar/"); ?>">
                <input id="pendingDelReserveId" name="reserveId" hidden>
                <button type="submit" class="btn btn-outline-danger">Rechazar</button>
            </form>
        </div>
    </div>
</div>

<div id="detailReserveModal" style="max-width: 60rem;" class="container card text-center">
    <div class="card-body">
        <h5 id="detPetName" class="card-title"></h5>
        <p id="detPetSize" class="card-text"></p>
        <p id="detPendingStartDate" class="card-text"></p>
        <p id="detPendingEndDate" class="card-text"></p>
    </div>
</div>

<div id="modalBackDrop"></div>
<script>
    let nav = 0;
    let clicked = null;
    let events = <?php echo json_encode($events, JSON_HEX_TAG); ?>;
    let reserves = <?php echo json_encode($reserves, JSON_HEX_TAG); ?>;

    console.log(events);
    console.log(reserves);
    const calendar = document.getElementById('calendar');
    const newEventModal = document.getElementById('newEventModal');
    const deleteEventModal = document.getElementById('deleteEventModal');
    const pendingReserveModal = document.getElementById('pendingReserveModal');
    const detailReserveModal = document.getElementById('detailReserveModal');
    const backDrop = document.getElementById('modalBackDrop');
    const eventTitleInput = document.getElementById('eventTitleInput');
    const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    function openModal(date, eventForDay) {
        console.log(eventForDay);
        if (eventForDay) {
            handleEventModal(eventForDay);
        } else {
            document.getElementById('startDate').value = date;
            document.getElementById('endDate').value = date;
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
            `${dt.toLocaleDateString('es-ar', { month: 'long' })} ${year}`;

        calendar.innerHTML = '';

        for (let i = 1; i <= paddingDays + daysInMonth; i++) {
            const daySquare = document.createElement('div');
            daySquare.classList.add('day');

            //const dayString = `${month + 1}/${i - paddingDays}/${year}`;

            const modalDayString = `${year}-${month + 1 >= 10 ? month + 1 :'0' + (month + 1)}-${i - paddingDays >= 10? i - paddingDays :'0' + (i - paddingDays)}`;
            const date = new Date(modalDayString + 'T00:00');

            //events[15] && console.table([modalDayString, date, new Date(events[15].startDate), date >= new Date(events[15].startDate)]);

            if (i > paddingDays) {
                daySquare.innerText = i - paddingDays;
                const eventForDay = events.find(e => date >= new Date(e.startDate) && date <= new Date(e.endDate));
                if (i - paddingDays === day && nav === 0) {
                    daySquare.id = 'currentDay';
                }

                daySquare.addEventListener('click', () => openModal(modalDayString, eventForDay));
                if (eventForDay) {
                    const eventDiv = document.createElement('div');
                    eventDiv.classList.add(eventForDay.status);
                    eventDiv.innerText = eventForDay.status;
                    daySquare.appendChild(eventDiv);
                }
            } else {
                daySquare.classList.add('padding');
            }

            calendar.appendChild(daySquare);
        }
    }

    function closeModal() {
        newEventModal.style.display = 'none';
        deleteEventModal.style.display = 'none';
        pendingReserveModal.style.display = 'none';
        detailReserveModal.style.display = 'none';
        backDrop.style.display = 'none';
        clicked = null;
        load();
    }

    function handleEventModal(dayEvent) {
        switch (dayEvent.status) {
            case 'pending':
                console.log("PENDING MODAL")
                let reserve = reserves.find(r => r.eventId === dayEvent.id);
                document.getElementById('petName').innerText = `${reserve.pet.name}`;
                document.getElementById('petSize').innerText = `${reserve.pet.size}`;
                document.getElementById('pendingStartDate').innerText = `Desde: ${formatDate(dayEvent.startDate)}`;
                document.getElementById('pendingEndDate').innerText = `Hasta: ${formatDate(dayEvent.endDate)}`;
                document.getElementById('pendingReserveId').value = reserve.id;
                document.getElementById('pendingDelReserveId').value = reserve.id;
                pendingReserveModal.style.display = 'block';
                backDrop.style.display = 'block';
                break;
            case 'reserved':
                let reserved = reserves.find(r => r.eventId === dayEvent.id);
                console.log("RESERVED MODAL");
                document.getElementById('detPetName').innerText = `${reserved.pet.name}`;
                document.getElementById('detPetSize').innerText = `${reserved.pet.size}`;
                document.getElementById('detPendingStartDate').innerText = `Desde: ${formatDate(dayEvent.startDate)}`;
                document.getElementById('detPendingEndDate').innerText = `Hasta: ${formatDate(dayEvent.endDate)}`;
                detailReserveModal.style.display = 'block';
                backDrop.style.display = 'block';
                break;
            case 'unavailable':
                console.log("UNAVAILABLE MODAL")
                document.getElementById('eventText').innerText = `${dayEvent.startDate} - ${dayEvent.endDate}`;
                document.getElementById('eventId').value = dayEvent.id;
                deleteEventModal.style.display = 'block';
                break;
        }
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
        document.getElementById('modalBackDrop').addEventListener('click', closeModal);
    }

    initButtons();
    load();

    function formatDate(date) {
        let year = date.slice(0,4);
        let month = date.slice(5,7);
        let day = date.slice(8,10);
        return `${day}/${month}/${year}`;
    }
</script>