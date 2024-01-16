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

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href=
	"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
	<!-- Vendor CSS Files -->



	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/line-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/line-awesome-font-awesome.min.css">
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/userstyles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.mg {
			margin-left: 2px;
			margin-bottom: 40px;
		}
		button{
			margin:Auto;
			display: flex;
    justify-content: center;
	
    align-items: center; /* Add this line */}
	li i.fa-location-crosshairs,li i.fa-city {
  float: left; /* Float the icon to the left */
  margin-right: 5px; 
  color:#47b2e4;/* Add some spacing between the icon and the text */
}

		

	</style>
	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">

	<main>
		<div class="main-section">
			<div class="container">
				<div class="main-section-data">
					<div class="row">
						<div class="col-lg-3 col-md-4" >
						<div class=" pd-left-none position-fixed no-pd">
							<div class=" main-left-sidebar no-margin ">
								<div class="user-data full-width-left ">
									<div class="user-profile">
										<div class="username-dt"><?php 
										// Fetch the user's profile picture and name from the database
$user_id = $_SESSION["user_name"]; // Assuming you have a user name in the session

// Enclose the $user_id in single quotes in the SQL query
$user_info_query = "SELECT * FROM users WHERE name = '$user_id'";

$user_info_result = mysqli_query($conn, $user_info_query);

if ($user_info_result && mysqli_num_rows($user_info_result) > 0) {
    $user_info = mysqli_fetch_assoc($user_info_result);

?>

											<!-- PHP code to fetch and store user's profile picture path in session -->
											<!-- Display the user's profile picture if available, otherwise show a default image -->
											<div class="usr-pic">
												<?php
												if (isset($_SESSION["picture"]) && !empty($_SESSION["picture"])) {
												?>


													<img style="object-fit: cover;" src="<?php echo $user_info['picture'] ; ?>" alt="User Profile Picture">
												<?php
												} else {
												?>
													<img src="path/to/default_image.jpg" alt="Default Profile Picture">
												<?php
												}
												?>
											</div>

										</div><!--username-dt end-->
										<div class="user-specs">
											<!-- Display the user's registration success message -->

											<h3><?php echo $user_info['name']; ?></h3>

											<span>User</span>
										</div>
									</div><!--user-profile end-->
									<ul class="user-fw-status">

										<li>
											<a href="my-profile.html" title="">View Profile</a>
										</li>
									</ul>
								</div><!--user-data end-->
						

						
								<!--tags-sec end-->
							</div><!--main-left-sidebar end-->
						</div>
						</div>
						<div class="col-lg-6 col-md-8 no-pd pt-2">
							
							<!--search-bar end--><!-- Add this script tag at the end of your HTML code, before the closing </body> tag -->
							<script>
								function searchEvents(event) {
									event.preventDefault(); // Prevent form submission

									// Get the search query from the input field
									const searchQuery = document.getElementById("searchInput").value;

									// Make an AJAX request to the server
									const xhr = new XMLHttpRequest();
									xhr.onreadystatechange = function() {
										if (this.readyState === 4 && this.status === 200) {
											// Update the event list with the search results
											const eventsContainer = document.querySelector(".posts-section");
											eventsContainer.innerHTML = this.responseText;
										}
									};

									// Replace 'search_events.php' with the actual server-side PHP script that handles the search
									const url = `search_events.php?query=${encodeURIComponent(searchQuery)}`;
									xhr.open("GET", url, true);
									xhr.send();
								}
							</script>
							<div class="main-ws-sec">


								<div class="posts-section">
									<div class="top-profiles">
										<div class="pf-hd">
											<h3>Top Profiles</h3>
										</div>
										<div class="profiles-slider">
											<?php foreach ($topOrganizers as $organizer) : ?>
												<div class="user-profy">
													<img style="border-radius: 50%; width:70px; height:70px;" src="<?php echo $organizer['picture']; ?>" alt="Organizer">
													<h3><?php echo $organizer['organizer_name']; ?></h3>
													<span>Event Organizer</span>
													<ul> 
														<li>           <?php
// Replace 'Organizer Name' with the actual organizer's name you want to message
$organizerName =  $organizer['organizer_name'];

// Query to fetch the unique_id based on the organizer's name
$queryy = "SELECT unique_id FROM users WHERE name = '$organizerName'";

// Execute the query
$result1 = mysqli_query($conn, $queryy);

if ($result1 && mysqli_num_rows($result1) > 0) {
    $row1 = mysqli_fetch_assoc($result1);
    $organizerUniqueId = $row1['unique_id'];
} else {
    // Handle the case where the organizer is not found
    echo "Organizer not found.";
}
?>

<a href="messenger.php?user_id=<?php echo $organizerUniqueId; ?>" class="followw">Message</a>

</li>

													</ul>
													<a href="#" title="">View Profile</a>
												</div>
											<?php endforeach; ?>

										</div><!--profiles-slider end-->
									</div><!--top-profiles end-->
									<?php
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
									?><!-- Event Post Template -->
											<div class="post-bar">
												<div style="padding:0;" class="suggestion-usd"></div>
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="<?php echo $organizer['picture'] ?>" width="35px" height="35px" alt="">
														<div class="usy-name">
															<h3><?php echo $row["organizer_name"]; ?></h3>
															<span><?php echo $row["submission_time"]; ?></span>
														</div>
													</div>




												</div>
												<div class="epi-sec">
													<ul class="descp">
													<li>
  <i class="fa-solid fa-location-crosshairs"></i>
  <span><?php echo $row["location"]; ?></span>
</li><?php

        // Check if the user already bookmarked this event
		// Check if the user already bookmarked this event


// Debugging: Log user ID and event ID
$user_id_query = "SELECT id FROM users WHERE name = '" . $_SESSION['user_name'] . "'";
$user_id_result = mysqli_query($conn, $user_id_query);
$user_id = mysqli_fetch_assoc($user_id_result)['id'];


$bookmark_query = "SELECT * FROM interests WHERE user_id = $user_id AND event_id = " . $row['event_id'];
$bookmark_result = mysqli_query($conn, $bookmark_query);
$isBookmarked = mysqli_num_rows($bookmark_result);

// Debugging: Log the result


        ?>
														<li><i class="fa-solid fa-city"></i><span><?php echo $row["city"]; ?></span></li>
													</ul>
													<ul class="bk-links">
														<li> <!-- Inside the loop to display events -->
															<a href="save_bookmark.php?event_id=<?php echo $row["event_id"]; ?>" class="bookmark-btn">
															<i class="<?php echo $isBookmarked ? 'fa-solid' : 'fa-regular'; ?> fa-heart"></i></a>
													</ul>
												</div>
												<div class="job_descp">
													<h3><?php echo $row["event_name"]; ?></h3>
													<p><?php echo $row["description"]; ?> </p>

													<?php
													$pictureFilePath = $row["picture"];
													?>
													<img src="<?php echo $pictureFilePath ; ?>" width="3100" height="40%" alt="Event Picture" style="margin-bottom:20px">


												</div>
												
											</div><!--post-bar end-->

									<?php
										}
									} else {
										echo "<p>No events found.</p>";
									}
									?>


								</div>
							</div><!--main-ws-sec end-->
						</div>						<div class="col-lg-3 col-md-4" >

						<div class="pd-left-none1 no-pd position-fixed">
					
							<div class=" main-left-sidebar no-margin">
							<div class="mg search-bar">
								<form onsubmit="searchEvents(event)">
									<input type="text" name="search" id="searchInput" placeholder="Search...">
									<button type="submit"><img src="images/search.png" alt="" width="20px"></button>
								</form>
							</div><!--search-bar end-->
									
								<div class="suggestions full-width">
									
									<div class="sd-title">
										<h3>Suggestions</h3>
										<i class="fa fa-lightbulb-o"></i>
									</div><!--sd-title end-->
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

?> <script>// JavaScript code to fetch and display event details and postbar
function fetchPostbar(eventId) {
    // Make an AJAX request to fetch the postbar content based on eventId
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            // Update the postbar container with the fetched content
            const postbarContainer = document.querySelector(".posts-section");
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
}}
?>






</div><!--suggestions-list end-->

								</div><!--suggestions end-->
								<!--tags-sec end-->
							</div><!--main-left-sidebar end-->
						</div>
						</div>


					</div><!--widget-about end-->

				</div>
			</div>
		</div><!-- main-section-data end-->
		</div>
		</div>
	</main>










	</div><!--theme-layout end-->



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