<?php session_start(); ?>

<?php

if (isset($_SESSION["organizer_name"]) && isset($_SESSION["organizer_email"])) {
?>
<?php
	require_once "connection.php";

	$sql = "SELECT * FROM events WHERE status = 'active'";

	$result = $conn->query($sql);

	$quer = "
    SELECT e.organizer_name, u.picture, COUNT(*) AS event_count
    FROM events e
    INNER JOIN users u ON e.organizer_name = u.name
    GROUP BY e.organizer_name, u.picture
    ORDER BY event_count DESC
    LIMIT 5
";
	$resul = mysqli_query($conn, $quer);

	$topOrganizers = array();

	while ($row = mysqli_fetch_assoc($resul)) {
		$topOrganizers[] = $row;
	}
	$sl = "SELECT e.event_name, e.picture, e.organizer_name, COUNT(i.interest_id) AS interest_count
	FROM events e
	JOIN interests i ON e.event_id = i.event_id
	GROUP BY e.event_id
	ORDER BY interest_count DESC
	LIMIT 10";
	$resu = $conn->query($sl);

	include('orgheader.php');
?>

<link href="assets/img/favicon.png" rel="icon">
<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/css/line-awesome-font-awesome.min.css">
<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/userstyles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
.mg {
    margin-left: 2px;
    margin-bottom: 40px;
}

button {
    margin: Auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

li i.fa-location-crosshairs,
li i.fa-city {
    float: left;
    margin-right: 5px;
    color: #47b2e4;
}

.card-profile {
    background-color: white;
    color: black;

}

.profile-picture-box img {
    object-fit: cover;
    /* Zoom and cover the container */
    width: 100%;
    height: 100%;
}

.profile-picture-box {
    /* margin-top:10px; */
    border-radius: 50%;
    float: left;
    border: 2px solid #ccc;
    display: block;
    /* Display as inline block to contain the image */
    height: 200px;
    width: 200px;
    overflow: hidden;
    /* Hide overflowing parts of the image */
}

.head {
    font-size: 35px;
    font-family: 'Open Sans', sans-serif !important;
    color: rgba(40, 58, 90, 0.9);
}

.ml {}

.user {
    font-size: 15px;
    font-family: 'Calibri', sans-serif !important;
    margin-top: 7px;
    display: inline-block;
}

.user-f {
    font-size: 25px;
    font-family: 'Calibri', sans-serif !important;
}

.height {
    height: 170px;
}

.posts-section-pro {
    margin-top: 80px;
}

.edit {
    margin-top:-29px;
    background-color: #47b2e4;
    color: white;
}

.section {
    background-color: white;
    border: 1px solid #e5e5e5;
    height: 60px;
    margin-bottom: 15px;
}

.section h1 {
    color: #000000;
    font-size: 20px;
    font-weight: 600;
    text-transform: capitalize;
    float: left;
    padding: 20px;
}

.col-3{
    margin-top:80px
}
</style>
<link href="assets/css/style.css" rel="stylesheet">

<main style="padding:0">
    <div class="main-section">
        <div class="main-section-data">
            <div class="main-ws-sec">
                <div class="card card-profile mb-2">
                    <div class="card-body height">

                        <div class="container more-aligned">

                            <?php
require_once "connection.php";

// Fetch the user's profile picture and name from the database
$user_id = $_SESSION["organizer_name"]; // Assuming you have a user name in the session

// Enclose the $user_id in single quotes in the SQL query
$user_info_query = "SELECT * FROM users WHERE name = '$user_id'";

$user_info_result = mysqli_query($conn, $user_info_query);

if ($user_info_result && mysqli_num_rows($user_info_result) > 0) {
    $user_info = mysqli_fetch_assoc($user_info_result);

    // Display the user's profile picture
    echo '<div class="profile-picture-box">';
    echo '<img src="' . $user_info['picture'] . '" alt="User Profile Picture">';
    echo '</div>';

    // Display the user's name
    echo '<h1 class="font-weight-bold ms-2 head ml" style=" margin-left:17px; margin-top:85px; display:inline-block">' . $user_info['name'] . '</h1><br>';

    // echo '<i class="fa-solid fa-envelope" style="font-size:15px; margin-left:17px; ""></i> <h6 style="margin-top:15px" class="user">' . $user_info['email'] . '</h6><br>';

    // echo '<i class=" fas fa-user" style="font-size:15px; margin-left:17px; "></i>
    //  <h6 style="" class="user">' . $user_info['gender'] . '</h6><br>';
    // echo '<i class="fas fa-map-marker-alt" style="font-size:15px; margin-left:17px;"></i>
    // <h6 style="" class=" user">' . $user_info['city'] . '</h6>';

}
?>


                            <a style="float:right;" href="orgedit.php" class="btn rounded-pill edit"><i
                                    class="fas fa-edit"></i> Edit Profile</a>



                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <div class="main-left-sidebar no-margin">
                            <div class="container">
                                <div class="posts-section-pro
                                ">
                                    <div class="section">
                                        <h1>Interested Events</h1>
                                    </div>
                                    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Check if the user has liked this event
            $user_name = $_SESSION['organizer_name']; // Assuming you have a user name in the session

            // Fetch the user's ID from the database
            $user_id_query = "SELECT id FROM users WHERE name = '$user_name'";
            $user_id_result = mysqli_query($conn, $user_id_query);

            if ($user_id_result && mysqli_num_rows($user_id_result) > 0) {
                $user_id = mysqli_fetch_assoc($user_id_result)['id'];

                // Check if the user has liked this event
                $liked_query = "SELECT * FROM interests WHERE user_id = $user_id AND event_id = " . $row['event_id'];
                $liked_result = mysqli_query($conn, $liked_query);

                if ($liked_result && mysqli_num_rows($liked_result) > 0) {
                    $organizer_name = $row["organizer_name"];
                    $organizer_query = "SELECT * FROM users WHERE name = '$organizer_name'";
                    $organizer_result = mysqli_query($conn, $organizer_query);
                    $organizer = mysqli_fetch_assoc($organizer_result);

                    // Display the event post
                    echo '<div class="post-bar">';
                    echo '<div style="padding:0;" class="suggestion-usd"></div>';
                    echo '<div class="post_topbar">';
                    echo '<div class="usy-dt">';
                    echo '<img src="' . $organizer['picture'] . '" width="35px" height="35px" alt="">';
                    echo '<div class="usy-name">';
                    echo '<h3>' . $row["organizer_name"] . '</h3>';
                    echo '<span>' . $row["submission_time"] . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="epi-sec">';
                    echo '<ul class="descp">';
                    echo '<li>';
                    echo '<i class="fa-solid fa-location-crosshairs"></i>';
                    echo '<span>' . $row["location"] . '</span>';
                    echo '</li>';
                    // Check if the user already bookmarked this event
                    $user_id_query = "SELECT id FROM users WHERE name = '$user_name'";
                    $user_id_result = mysqli_query($conn, $user_id_query);
                    $user_id = mysqli_fetch_assoc($user_id_result)['id'];
                    $bookmark_query = "SELECT * FROM interests WHERE user_id = $user_id AND event_id = " . $row['event_id'];
                    $bookmark_result = mysqli_query($conn, $bookmark_query);
                    $isBookmarked = mysqli_num_rows($bookmark_result);
                    echo '<li>';
                    echo '<i class="fa-solid fa-city"></i>';
                    echo '<span>' . $row["city"] . '</span>';
                    echo '</li>';
                    echo '</ul>';
                    echo '<ul class="bk-links">';
                    echo '<li>';
                    echo '<a href="save_bookmark.php?event_id=' . $row["event_id"] . '" class="bookmark-btn">';
                    echo '<i class="' . ($isBookmarked ? 'fa-solid' : 'fa-regular') . ' fa-heart"></i>';
                    echo '</a>';
                    echo '</li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '<div class="job_descp">';
                    echo '<h3>' . $row["event_name"] . '</h3>';
                    echo '<p>' . $row["description"] . '</p>';
                    $pictureFilePath = $row["picture"];
                    if (!empty($pictureFilePath)) {
                        echo '<img src="' . $pictureFilePath . '" width="3100" height="40%" alt="Event Picture" style="margin-bottom:20px">';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
    } else {
        echo "<p>No events found.</p>";
    }
    ?>
                                </div>
                            </div></div></div>
                            <div class="col-3">
                                <div class="suggestions full-width-pro">

                                    <div class="sd-title">
                                        <h3>Suggestions</h3>
                                        <i style="margin-rhgt:10px !important" class="fa fa-lightbulb-o"></i>
                                    </div>
                                    <!--sd-title end-->
                                    <div class="suggestions-list">
                                        <?php
if ($resu->num_rows > 0) {
    while ($row = $resu->fetch_assoc()) {
        ?>
                                        <div class="suggestion-usd">
                                            <img width="30px" height="30px" src="<?php echo $row['picture']; ?>">
                                            <div class="sgt-text">
                                                <h4><?php echo $row['event_name']; ?></h4>
                                                <span><?php echo $row['organizer_name']; ?></span>
                                            </div>
                                            <?php if (isset($row["event_name"])) {
    $event_name = urldecode($row["event_name"]);
    // Use $event_name to fetch the corresponding event_id from the database
    
    // Simplified query to retrieve the event_id based on event_name
    $sql = "SELECT event_id FROM events WHERE event_name = '$event_name'";
    
    // Execute the query and fetch the result
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $event_id = $row["event_id"];
        
        // Now, $event_id contains the event_id for the specified event_name
    } else {
    }
}

?> <script>
                                            // JavaScript code to fetch and display event details and postbar
                                            function fetchPostbar(eventId) {
                                                // Make an AJAX request to fetch the postbar content based on eventId
                                                const xhr = new XMLHttpRequest();
                                                xhr.onreadystatechange = function() {
                                                    if (this.readyState === 4 && this.status === 200) {
                                                        // Update the postbar container with the fetched content
                                                        const postbarContainer = document.querySelector(
                                                            ".posts-section-pro");
                                                        postbarContainer.innerHTML = this.responseText;
                                                    }
                                                };

                                                // Replace 'fetch_postbar.php' with the actual server-side PHP script
                                                // that fetches the postbar content based on eventId
                                                const url = `fetch_postbar.php?event_id=${eventId}`;
                                                xhr.open("GET", url, true);
                                                xhr.send();
                                            }
                                            </script>
                                            <span>
                                                <a onclick="fetchPostbar(<?php echo $row['event_id']; ?>)">
                                                    <i class="fa-solid fa-info"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <?php
    }
} else {
    echo '<p>No events found.</p>';
}
?>






                                    </div>
                                    <!--suggestions-list end-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>

<script type="text/javascript" src="assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/admin/js/popper.js"></script>
<script type="text/javascript" src="assets/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/admin/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="assets/admin/js/slick.min.js"></script>
<script type="text/javascript" src="assets/admin/js/scrollbar.js"></script>
<script type="text/javascript" src="assets/admin/js/script.js"></script>

</body>

</html>
<?php

} else {
	header("location: getstarted.php");
	exit();
}
$conn->close();
?>