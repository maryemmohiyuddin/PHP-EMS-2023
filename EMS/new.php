<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Example</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- FullCalendar CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css">

    <!-- Your custom CSS, if any -->
    <!-- <link rel="stylesheet" href="assets/css/custom.css"> -->
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FullCalendar JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // You can change the initial view here
                events: [
                    // Replace this with your event data
                    {
                        title: 'Event 1',
                        start: '2023-08-10'
                    },
                    {
                        title: 'Event 2',
                        start: '2023-08-15',
                        end: '2023-08-17'
                    }
                    // Add more events as needed
                ]
            });

            calendar.render();
        });
    </script>

</body>

</html>
