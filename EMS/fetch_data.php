<?php
include_once("connection.php");

// Get the start and end dates of the current week
$currentWeekStart = date('Y-m-d', strtotime('this week'));
$currentWeekEnd = date('Y-m-d', strtotime('this week +6 days'));

// Fetch posted events data for the current week
$queryPosted = "SELECT WEEKDAY(submission_time) AS event_day, COUNT(*) AS posted_count
                FROM events
                WHERE submission_time >= '$currentWeekStart' AND submission_time <= '$currentWeekEnd'
                GROUP BY WEEKDAY(submission_time)";
$eventsPostedResult = mysqli_query($conn, $queryPosted);

$eventsPostedData = array();

$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

while ($row = mysqli_fetch_assoc($eventsPostedResult)) {
    $submissionDay = $days[$row['event_day']]; // Get the day name (e.g., Monday)
    $week = $submissionDay; // Week represented as the day of submission
    
    $eventsPostedData[] = array(
        "week" => $week,
        "eventsPosted" => intval($row['posted_count']),
        "eventsInterested" => 0 // Initialize interested count to 0, you can modify this as per your data
    );
}

// Fetch interested events data for the current week
$queryInterested = "SELECT WEEKDAY(e.submission_time) AS event_day, COUNT(*) AS interested_count
                    FROM interests i
                    JOIN events e ON i.event_id = e.event_id
                    WHERE e.submission_time >= '$currentWeekStart' AND e.submission_time <= '$currentWeekEnd'
                    GROUP BY WEEKDAY(e.submission_time)";
$eventsInterestedResult = mysqli_query($conn, $queryInterested);

$eventsInterestedData = array();

while ($row = mysqli_fetch_assoc($eventsInterestedResult)) {
    $submissionDay = $days[$row['event_day']]; // Get the day name (e.g., Monday)
    $week = $submissionDay; // Week represented as the day of submission
    
    $found = false;
    
    foreach ($eventsPostedData as &$entry) {
        if ($entry['week'] === $week) {
            $entry['eventsInterested'] = intval($row['interested_count']);
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        $eventsInterestedData[] = array(
            "week" => $week,
            "eventsPosted" => 0, // Initialize posted count to 0
            "eventsInterested" => intval($row['interested_count'])
        );
    }
}

$data = $eventsPostedData + $eventsInterestedData;

header('Content-Type: application/json');
echo json_encode($data);

mysqli_close($conn);
?>
