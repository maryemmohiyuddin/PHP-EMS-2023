<?php session_start(); ?>

<?php

if (isset($_SESSION["user_name"]) && isset($_SESSION["user_email"])) {
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

	include('userheader.php');
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
$user_id = $_SESSION["user_name"]; // Assuming you have a user name in the session

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


                            <a style="float:right;" href="useredit.php" class="btn rounded-pill edit" target="_top"><i
                                    class="fas fa-edit"></i> Edit Profile</a>



                        </div>


          
                             

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