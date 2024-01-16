
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
		datasets: [
			{
				backgroundColor: [gradientStroke1, gradientStroke2],
				hoverBackgroundColor: [gradientStroke1, gradientStroke2],
				data: [interestedPercentage, notInterestedPercentage],
				borderWidth: [1, 1],
			},
		],
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
        datasets: [
            {
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
                    callback: function (value) {
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
                label: function (context) {
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
    exit();
}
?>