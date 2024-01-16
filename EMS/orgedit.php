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
    margin-top: -13px;
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
#OrgForm-citySelect, .file{
      padding: 10px;
      width:100%;
      border-radius:5px;
      border:1px solid lightgrey;
    }
    

input[type="file"]::before {
  top: 12px;
}

input[type="file"]::after {
  top: 9px;
}

/* ------- From Step 2 ------- */

input[type="file"] {
    padding:0;
  position: relative;
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
  left: 25px;
  /* color: #0964b0; */
  content: "Upload Image";
}

input[type="file"]::after {
  position: absolute;
  pointer-events: none;
  /*   top: 10px; */
  left: 5px;
  height: 20px;
  width: 20px;
  content: "";
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' %3E%3Cpath d='M18 15v3H6v-3H4v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-3h-2zM7 9l1.41 1.41L11 7.83V16h2V7.83l2.59 2.58L17 9l-5-5-5 5z'/%3E%3C/svg%3E");
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
.no-hr{
    border-bottom:none !important;
}
</style>
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
$user_id = $_SESSION["organizer_name"]; // Assuming you have a user name in the session

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
											</div></div>
                                    </div><!-- username-dt end -->
                                    <div class="user-specs">
                                        <!-- Display the user's registration success message -->
                                        <h3><?php echo $user_info['name'] ; ?></h3>
                                        <span>User</span>
                                    </div>
                                </div><!-- user-profile end -->
                            </div><!-- user-data end -->
                        </div><!-- main-left-sidebar end -->
                    </div>
                    <div class="col-lg-9 col-md-8 no-pd">
                        <div class="main-ws-sec">
                            <div class="card">
                                <div class="card-body">
                                        <!-- Form to edit profile information -->   
                                        <form name="OrgForm" method="POST" action="orgupdate.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        
                                            <div class="row mb-3 no-hr">
                                                <div class="col-sm-3 mb-2">
                                                    <h6 class="font-weight-bold mb-0">Full Name</h6>
                                                </div>
                                                <div class="font-weight-bold col-sm-9 text-secondary text-right">
                                                    <input type="text" class="form-control" name="name" value="<?php echo $user_info['name'] ;?>"required>
                                                </div>
                                            </div>
                                            <div class="row mb-3 no-hr">
                                                <div class="col-sm-3 mb-2">
                                                    <h6 class="font-weight-bold mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary text-right">
                                                    <input type="email" class="form-control" name="email" value="<?php echo $user_info['email'] ; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3 no-hr">
                                                <div class="col-sm-3 mb-2">
                                                    <h6 class="font-weight-bold mb-0">Gender</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary text-right">
                                                <select class="form-control" name="gender" required>
    <option value="Male" <?php if ($user_info['gender'] === 'Male') echo 'selected'; ?>>Male</option>
    <option value="Female" <?php if ($user_info['gender'] === 'Female') echo 'selected'; ?>>Female</option>
</select><script>
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
                    populateCityDropdown('OrgForm', data);
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

            // Set the default city value based on PHP data
            const userCity = "<?php echo $user_info['city']; ?>";
            if (userCity) {
                citySelect.value = userCity;
            }
        }

        // Add an event listener to trigger the fetchCities function when the page loads
        window.addEventListener('load', fetchCities);

</script>
                                                </div>
                                            </div>
                                            <div class="row mb-3 no-hr">
                                                <div class="col-sm-3 mb-2">
                                                    <h6 class="font-weight-bold mb-0">City</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary text-right">
                                                <select id="OrgForm-citySelect" name="city" required>
    <option value="" selected><?php $user_info["city"]?></option>
 
</select>


                                                </div>
                                            </div>
                                            <div class="row mb-3 no-hr">
                                                <div class="col-sm-3">
                                                    <h6 class="font-weight-bold mb-0">Profile Picture</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary text-right">
                                                <input class="file" type="file" name="picture" id="profile_picture_input"><br><br>
            <img id="profile_picture_preview" src="<?php echo $user_info['picture'] ; ?>" alt="User Profile Picture">
            <br>
                                            </div>
                                            <!-- Add other input fields for additional data -->

                                            <!-- Submit button to save changes -->
                                            <div class="mt-3 mb-4 font-weight-bold col-sm-12 text-secondary text-right">
                                                <button type="submit" class="btn edit">Save changes</button>
                                            </div>
                                        </form>
                                        <script>
                                           
  
    function validateForm() {
        // Check if all required fields are filled
        var name = document.forms[0].name.value;
        var email = document.forms[0].email.value;
        var gender = document.forms[0].gender.value;
        var city = document.forms[0].city.value;

        if (!name || !email || !gender || !city) {
            alert("Please fill in all required fields.");
            return false;
        }

        // Check if the username exists in the database (replace 'check_username.php' with your server-side script to check the username)
        var username = document.forms[0].username.value;

        // Make an AJAX call to check the username
        // Assuming you're using jQuery for simplicity
        $.ajax({
            url: 'check_username.php',
            type: 'POST',
            data: { username: username },
            success: function (response) {
                if (response === 'exists') {
                    alert("Username already exists. Please choose a different username.");
                } else {
                    // If the username doesn't exist, you can proceed with form submission
                    document.forms[0].submit();
                }
            },
            error: function () {
                alert("Error checking username. Please try again later.");
            }
        });

        // Prevent form submission
        return false;
    }
</script>
                                </div>
                            </div><!-- main-ws-sec end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    // JavaScript code to preview the selected profile picture
    document.getElementById("profile_picture_input").addEventListener("change", function() {
        const fileInput = this;
        const profilePicturePreview = document.getElementById("profile_picture_preview");
        
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                profilePicturePreview.src = e.target.result;
            }

            reader.readAsDataURL(fileInput.files[0]);
        }
    });
</script>

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
}}
$conn->close();
?>