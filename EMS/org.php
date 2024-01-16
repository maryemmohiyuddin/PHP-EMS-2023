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

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/line-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/line-awesome-font-awesome.min.css">
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/slick/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
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
	
    align-items: center; /* Add this line */
		}
		/* CSS for the popup */
	
/* CSS for the popup */
.post-popup {
    width: 40%;
    height: 95%;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    /* Other styles for the popup */
}
.post-project-fields {
    height: 570px; /* Set the desired height */
    overflow-y: auto; /* Enable vertical scrolling if needed */
}
label{
	margin-bottom:5px;
}


input[type="file"]::before {
  top: 12px;
}

input[type="file"]::after {
  top: 9px;
}

/* ------- From Step 2 ------- */

input[type="file"] {
  position: relative;
  padding:0px !important;
}

input[type="file"]::file-selector-button {
  width: 136px;
  color: transparent;
}

/* Faked label styles and icon */
input[type="file"]::before {
  position: absolute;
  pointer-events: none;
  /*   top: 11px; */
  left: 35px;
  /* color: #0964b0; */
  content: "Upload Image";
}

input[type="file"]::after {
  position: absolute;
  pointer-events: none;
  /*   top: 10px; */
  left: 11px;
  height: 20px;
  width: 20px;
  content: "";
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' %3E%3Cpath d='M18 15v3H6v-3H4v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-3h-2zM7 9l1.41 1.41L11 7.83V16h2V7.83l2.59 2.58L17 9l-5-5-5 5z'/%3E%3C/svg%3E");
}
textarea{
	height:80px !important;
}
/* ------- From Step 1 ------- */

/* file upload button */
input[type="file"]::file-selector-button {
  color:white;
  border-radius: 4px;
  padding: 0 16px;
  height: 40px;
  cursor: pointer;
  border: 1px solid rgba(0, 0, 0, 0);
  margin-right: 16px;
}

/* file upload button hover state */
input[type="file"]::file-selector-button:hover {
  background-color: #f3f4f6;
}

/* file upload button active state */
input[type="file"]::file-selector-button:active {
  background-color: #e5e7eb;
}
.post-project h3 {
    border-top-left-radius: 10px; 
    border-top-right-radius: 10px; /* Rounded corners */
	/* Rounded corners */
}
.post-project {
        /* width: 300px; Set your desired width */
        /* max-height: 200px; Set your desired max height */
        border-radius: 10px; /* Rounded corners */
        overflow:auto;
        position: relative;
    }

    /* Style for the container's content */
    .post-project-fields {
        padding-top: 35px;
    }

    /* Style for the custom scrollbar track */
    .post-project::-webkit-scrollbar {
        width: 10px; /* Set the width of the scrollbar */
    }

    /* Style for the custom scrollbar thumb */
    .post-project::-webkit-scrollbar-thumb {
        background-color: #888; /* Color of the thumb */
        border-radius: 5px; /* Rounded thumb */
    }

    /* Style for the custom scrollbar track on hover */
    .post-project:hover::-webkit-scrollbar-thumb {
        background-color: #555; /* Color of the thumb on hover */
    }
	
</style>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".post-project-fields").each(function(index) {
            $(this).on("mouseenter", function() {
                $(this).css("scrollbar-width", "thin");
            }).on("mouseleave", function() {
                $(this).css("scrollbar-width", "none");
            });
        });
    });
</script>


	<script>
			function showPopup(popupId) {
				document.getElementById(popupId).style.display = "block";
			}

			function hidePopup(popupId) {
				document.getElementById(popupId).style.display = "none";
			}
		</script>
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
										<div class="username-dt">
											<!-- PHP code to fetch and store user's profile picture path in session -->
											<!-- Display the user's profile picture if available, otherwise show a default image -->
											<div class="usr-pic">
												<?php
												if (isset($_SESSION["picture"]) && !empty($_SESSION["picture"])) {
												?>
													<img src="<?php echo $_SESSION["picture"]; ?>" alt="User Profile Picture">
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

											<h3><?php echo $_SESSION["organizer_name"]; ?></h3>

											<span>Event organizer</span>
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
							<div class="post-topbar">
											<div class="user-picy">
											<img src="<?php echo $_SESSION["picture"]; ?>" alt="User Profile Picture">
											</div>
											<div class="post-st">
												<ul>
													<li><a class="post_project active" href="#" title="">Post a Project</a></li>
												</ul>
											</div><!--post-st end-->
										</div><!--post-topbar end-->

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
														<li><a href="#" title="" class="followw">Message</a></li>

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
														<li><img src="images/icon8.png" alt=""><span><?php echo $row["location"]; ?></span></li>
														<li><img src="images/icon9.png" alt=""><span><?php echo $row["city"]; ?></span></li>
													</ul>
													<ul class="bk-links">
														
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
										<i class="la la-ellipsis-v"></i>
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
            <span><i class="la la-plus"></i></span>
        </div>
    <?php
        }
    } else {
        echo '<p>No events found.</p>';
    }
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





	<div style="border-radius:10px" id="popup" class="post-popup pst-pj">
	<div class="post-project">
					<h3 >Post an event</h3>

					<div style="border-bottom-left-radius:10px; border-bottom-right-radius:10px; " class="post-project-fields">
			<form action="submit_event.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
				<div class="row">
					<div class="col-lg-12">
					<label for="event_name">Event Name:</label>

						<input type="text" name="event_name" placeholder="Event Name" required>
					</div>
					<div class="col-lg-12">
					<label for="location">Location:</label>

						<input type="text" name="location" placeholder="Location" required>
					</div>
					<div class="col-lg-12">
						<label for="start_date">Start Date and Time:</label>
						<input type="datetime-local" id="start_date" name="start_date" required>
					</div>
					<div class="col-lg-12">
						<label for="end_date">End Date and Time:</label>
						<input type="datetime-local" id="end_date" name="end_date" required>
					</div>
					<div class="col-lg-12">
						<label for="picture">Picture (PNG, JPEG, JPG only):</label>
						<input type="file" id="picture" name="picture" accept=".png, .jpeg, .jpg" required>
					</div>
					<div class="col-lg-12">
					<input type="hidden" name="organizer_name" value="<?php echo isset($_SESSION['organizer_name']) ? $_SESSION['organizer_name'] : ''; ?>">
					</div>
					<div class="col-lg-12">
						<label for="description">Description:</label>
						<textarea name="description" placeholder="Description" rows="4" cols="50" required></textarea>
					</div>
					<div class="col-lg-12">
						<label for="city">City:</label>
						<select id="userForm-citySelect" name="city" required></select>
					</div>
    <!-- Hidden input to store the submission time -->
    <div class="col-lg-12">
    <!-- Hidden input to store the submission time -->
    <input type="hidden" id="submissionTime" name="submissionTime" value="">
    <ul  style="float: right; margin-right: -10px;" class="list-inline d-flex justify-content-end">
        <li class="list-inline-item"><a href="organizerdashboard.php" title="">Cancel</a></li>
        <li class="list-inline-item"><button class="active" type="submit" value="post">Post</button></li>

    </ul>
</div>


				</div>
			</form>
		</div><!--post-project-fields end-->


		<script>
			const fields = document.querySelectorAll(".sn-field input, .sn-field select");
			fields.forEach(field => {
			field.addEventListener("input", updatePlaceholderStyles);
			});

			function fetchCities() {
			// Fetch JSON data from the local file 'cities.json'
			fetch('https://gist.githubusercontent.com/immujahidkhan/014fb1629ddc931e6f6d4a3a4d31abaa/raw/8f5cc4f88b9dc4efc5058c5354b9f955e4bda16f/cities.json')
				.then(response => {
				if (!response.ok) {
					throw new Error('Error loading cities.json');
				}
				return response.json();
				})
				.then(data => {
				populateCityDropdown('userForm', data);
				populateCityDropdown('OrganizerForm', data);
				})
				.catch(error => {
				console.error('Error fetching cities:', error);
				});
			}

			function populateCityDropdown(formName, data) {
			// Get the select element based on the form name
			const citySelect = document.getElementById(`${formName}-citySelect`);

			// Clear the select element to avoid duplicate entries if this function is called multiple times
			citySelect.innerHTML = "";

			// Add the "Select city" default option
			const defaultOption = document.createElement('option');
			defaultOption.value = ""; // Set an empty value for the default option
			defaultOption.textContent = "Select city";
			citySelect.appendChild(defaultOption);

			// Loop through the cities and create option elements
			data.forEach(city => {
				const option = document.createElement('option');
				option.value = city.name;
				option.textContent = city.name;
				citySelect.appendChild(option);
			});
			}

			// Add an event listener to trigger the fetchCities function when the page loads
			window.addEventListener('load', fetchCities);

			// Form validation function
			function validateForm() {
				// ... (existing code)

				// Validate description word count (between 50 to 80 words)
				const descriptionInput = document.getElementById("description");
				const description = descriptionInput.value.trim();

				// Split the description by whitespace to count words
				const words = description.split(/\s+/);
				const wordCount = words.length;

				if (wordCount < 50 || wordCount > 80) {
					alert("Description must contain between 50 and 80 words.");
					return false;
				}

				return true; // Form submission proceeds if validation passes
			}
			// JavaScript to handle the overflow toggle



		</script>
			</div><!--post-project-popup end-->




		</div>
		</div>
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