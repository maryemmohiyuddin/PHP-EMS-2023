<?php
session_start();

// Fetch the data from the database and calculate percentages
require_once "connection.php"; // Include the database connection

// Calculate the percentages
$queryInterested = "SELECT COUNT(*) AS interested_count FROM interests";
$queryTotal = "SELECT COUNT(*) AS total_count FROM events";

$resultInterested = $conn->query($queryInterested);
$resultTotal = $conn->query($queryTotal);

$rowInterested = $resultInterested->fetch_assoc();
$rowTotal = $resultTotal->fetch_assoc();

$interestedCount = $rowInterested["interested_count"];
$totalCount = $rowTotal["total_count"];

$interestedPercentage = ($interestedCount / $totalCount) * 100;
$notInterestedPercentage = 100 - $interestedPercentage;
include_once("connection.php");

// Query to fetch events from 'events' table
// Query to fetch events from 'events' table
$queryEvents = "SELECT event_name, status, start_date, end_date, event_id FROM events";
$resultEvents = mysqli_query($conn, $queryEvents);

// Query to fetch events from 'pending_events' table
$queryPendingEvents = "SELECT event_name, 'Pending' AS status, start_date, end_date, event_id FROM pending_events";
$resultPendingEvents = mysqli_query($conn, $queryPendingEvents);

$combinedEvents = array();

// Combine events from both tables
while ($row = mysqli_fetch_assoc($resultEvents)) {
    $combinedEvents[] = $row;
}

while ($row = mysqli_fetch_assoc($resultPendingEvents)) {
    $combinedEvents[] = $row;
}

// Query to fetch count of users interested in each event
$queryInterestCount = "SELECT event_id, COUNT(*) AS interest_count FROM interests GROUP BY event_id";
$resultInterestCount = mysqli_query($conn, $queryInterestCount);

$interestCounts = array();

while ($row = mysqli_fetch_assoc($resultInterestCount)) {
    $interestCounts[$row['event_id']] = $row['interest_count'];
}

// Close the database connection
$conn->close();


?>
<?php
if (isset($_SESSION["admin_name"]) && isset($_SESSION["admin_email"])) {
    // Include the header file
?>
<?php include('adminheader.php') 

?>
<?php 

include("connection.php");

// Query to fetch the count of users with type 'user'
$query = "SELECT COUNT(*) AS userCount FROM users WHERE type = 'User'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['userCount'];
} else {
echo'error';
}
$queryTotalOrganizers = "SELECT COUNT(*) AS totalOrganizers FROM users WHERE type = 'event organizer'";
$resultTotalOrganizers = mysqli_query($conn, $queryTotalOrganizers);

$totalOrganizers = 0;

if ($resultTotalOrganizers) {
    $row = mysqli_fetch_assoc($resultTotalOrganizers);
    $totalOrganizers = $row['totalOrganizers'];
}
$queryTotalEvents = "SELECT COUNT(*) AS totalEvents FROM events";
$resultTotalEvents = mysqli_query($conn, $queryTotalEvents);

$totalEvents = 0;

if ($resultTotalEvents) {
    $row = mysqli_fetch_assoc($resultTotalEvents);
    $totalEvents = $row['totalEvents'];
}
$queryTotalInterestedEvents = "SELECT COUNT(DISTINCT event_id) AS totalInterestedEvents FROM interests";
$resultTotalInterestedEvents = mysqli_query($conn, $queryTotalInterestedEvents);

$totalInterestedEvents = 0;

if ($resultTotalInterestedEvents) {
    $row = mysqli_fetch_assoc($resultTotalInterestedEvents);
    $totalInterestedEvents = $row['totalInterestedEvents'];
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Users</p>
                                <h4 class="my-1 text-info"><?php echo $userCount; ?></h4>
                                <p class="mb-0 font-13">Total registered users in the system</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Event Organizers</p>
                                <h4 class="my-1 text-info"><?php echo $totalOrganizers; ?></h4>
                                <p class="mb-0 font-13">Total event organizers registered in the system</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Events Posted</p>
                                <h4 class="my-1 text-info"><?php echo $totalEvents; ?></h4>
                                <p class="mb-0 font-13">Total events posted in the system</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                <i class="fa-regular fa-calendar-minus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Interested Events</p>
                                <h4 class="my-1 text-info"><?php echo $totalInterestedEvents; ?></h4>
                                <p class="mb-0 font-13">Total events users have shown interest in</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 p-2">Events Statistics</h6>
                            </div>
                            <div class="dropdown ms-auto">

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #14abef"></i>Events</span>
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #ffc107"></i>Interests</span>
                        </div>
                        <div class="chart-container-1">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 p-2">Interest ratio</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                            Not interested <span class="badge bg-primary rounded-pill">
                                <?php echo $notInterestedPercentage; ?>%</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Interested<span
                                class="badge bg-warning text-dark rounded-pill"><?php echo $interestedPercentage; ?>%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0 p-2 border-bottom">Recent Events</h6>
                    </div>
                    <div class="dropdown ms-auto">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Event</th>
                                    <th>Status</th>
                                    <th>Starting Date</th>
                                    <th>Ending Date</th>
                                    <th>User Interest</th>
                                </tr>
                            </thead>
                            <tbody><?php foreach ($combinedEvents as $event): ?>
                                <tr>
                                    <td><?php echo $event['event_name']; ?></td>
                                    <td>
                                        <span class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                            <?php echo $event['status']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $event['start_date']; ?></td>
                                    <td><?php echo $event['end_date']; ?></td>
                                    <td>
                                        <?php
                $interestCount = isset($interestCounts[$event['event_id']]) ? $interestCounts[$event['event_id']] : 0;
                $progressWidth = ($interestCount / 10) * 100; // Scale the progress bar width
                ?>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-gradient-quepal" role="progressbar"
                                                style="width: <?php echo $progressWidth; ?>%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>







        </div>
    </div>
</div>
<!--end row-->

</div>
</div>
<!--end page wrapper -->
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class="fa-solid fa-angle-up"></i></a>
<!--End Back To Top Button-->
<!-- <footer class="page-footer">
			<p class="mb-0">Copyright © 2022. All right reserved.</p>
		</footer> -->
</div>
<!--end wrapper-->


<!-- Bootstrap JS -->
<script src="assets/admin/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/admin/jquery.min.js"></script>
<script src="assets/admin/simplebar.min.js"></script>
<script src="assets/admin/metisMenu.min.js"></script>
<script src="assets/admin/perfect-scrollbar.js"></script>
<script src="assets/admin/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/admin/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/admin/chart.js"></script>
<script src="assets/admin/index.js"></script>
<!--app JS-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="assets/admin/app.js"></script>
<script>
new PerfectScrollbar(".app-container")
// Create the chart
var ctx = document.getElementById("chart2").getContext("2d");

var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
gradientStroke1.addColorStop(0, "#fc4a1a");
gradientStroke1.addColorStop(1, "#f7b733");

var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
gradientStroke2.addColorStop(0, "#4776e6");
gradientStroke2.addColorStop(1, "#8e54e9");

var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
gradientStroke3.addColorStop(0, "#ee0979");
gradientStroke3.addColorStop(1, "#ff6a00");

var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
gradientStroke4.addColorStop(0, "#42e695");
gradientStroke4.addColorStop(1, "#3bb2b8");

// Assuming you have calculated interestedPercentage and notInterestedPercentage as before
var interestedPercentage = <?php echo $interestedPercentage; ?>;
var notInterestedPercentage = <?php echo $notInterestedPercentage; ?>;

var myChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Interested", "Not Interested"],
        datasets: [{
            backgroundColor: [gradientStroke1, gradientStroke2],
            hoverBackgroundColor: [gradientStroke1, gradientStroke2],
            data: [interestedPercentage, notInterestedPercentage],
            borderWidth: [1, 1],
        }, ],
    },
    options: {
        maintainAspectRatio: false,
        cutout: 82,
        plugins: {
            legend: {
                display: false,
            },
        },
    },
});


var ctx = document.getElementById("chart1").getContext('2d');

var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
gradientStroke1.addColorStop(0, '#6078ea');
gradientStroke1.addColorStop(1, '#17c5ea');

var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
gradientStroke2.addColorStop(0, '#ff8359');
gradientStroke2.addColorStop(1, '#ffdf40');

var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: daysOfWeek,
        datasets: [{
                label: 'Events Posted',
                data: [],
                borderColor: gradientStroke1,
                backgroundColor: gradientStroke1,
                hoverBackgroundColor: gradientStroke1,
                pointRadius: 0,
                fill: false,
                borderRadius: 20,
                borderWidth: 0,
            },
            {
                label: 'Events Interested',
                data: [],
                borderColor: gradientStroke2,
                backgroundColor: gradientStroke2,
                hoverBackgroundColor: gradientStroke2,
                pointRadius: 0,
                fill: false,
                borderRadius: 20,
                borderWidth: 0,
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        barPercentage: 0.5,
        categoryPercentage: 0.8,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        if (Number.isInteger(value)) {
                            return value;
                        }
                    },
                },
            },
        },
        tooltips: {
            enabled: true,
            callbacks: {
                label: function(context) {
                    var label = context.dataset.label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += context.parsed.y === 0 ? '' : context.parsed.y;
                    return label;
                },
            },
        },
    },
});


// Rest of your fetch and data processing code

var apiUrl = "fetch_data.php";

fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        // Initialize data arrays for eventsPosted and eventsInterested
        var eventsPosted = Array(7).fill(0);
        var eventsInterested = Array(7).fill(0);

        // Update data arrays with fetched data
        data.forEach(item => {
            var dayIndex = daysOfWeek.indexOf(item.week);
            eventsPosted[dayIndex] = item.eventsPosted;
            eventsInterested[dayIndex] = item.eventsInterested;
        });

        // Update the chart's datasets
        myChart.data.datasets[0].data = eventsPosted;
        myChart.data.datasets[1].data = eventsInterested;

        // Update the chart
        myChart.update();
    })
    .catch(error => {
        console.error("Error fetching data:", error);
    });
</script>
</body>

</html>
<?php
} else {
    // Session variables not set, redirect to login page
    header("Location: getstarted.php");
    exit();
}
?>