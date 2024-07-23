$(document).ready(function () {
    var calendarE4 = document.getElementById('fc-bg-events');
    const now = new Date();
        
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');

    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

    var fcBgEvents = new FullCalendar.Calendar(calendarE4, {
        header: {
            left: 'prev,next today',
            center: 'title',
            right: "dayGridMonth,timeGridWeek,timeGridDay"
        },
        defaultDate: formattedDateTime,
        navLinks: true,
        businessHours: true,
        plugins: ['dayGrid', 'timeGrid', 'interaction'],
        events: function(info, successCallback, failureCallback) {
            // Make an AJAX request to fetch events data from the server
            $.ajax({
                url: '/calender/calendar-events/', // Endpoint to fetch events data dynamically
                type: 'GET',
                success: function(response) {
                    // Parse the JSON data
                    var events = [];
                    response.forEach(function(eventData) {
                        var event = {
                            title: eventData.name,
                            start: eventData.start_date,
                            end: eventData.end_date,
                            color: eventData.color, 
                            url: '/events/view/' + eventData.id // Add a URL property to each event
                        };
                        events.push(event);
                    });
                    // Pass the parsed events data to FullCalendar for rendering
                    successCallback(events);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle error
                    failureCallback(error);
                }
            });
        },
        eventClick: function(info) {
            // Open the URL associated with the clicked event in a new tab
            window.open(info.event.url, '_blank');
        }
    });

    fcBgEvents.render();
});
