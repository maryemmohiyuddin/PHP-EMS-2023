<?php
// Start the session (needed to access session variables)
session_start();

// Check if the user is logged in, otherwise redirect to the login page

// Check if the id parameter is provided in the URL


// Get the id from the URL
$id = $_GET["id"];

// Fetch data from the database table for the specified id
require_once "connection.php"; // Include the database connection
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

// Check if the specified id exists in the database
if (!$row) {
    header("Location:table-datatable.php");
    exit();
}
$city = $row["city"];
$gender = $row["gender"];

 // Add this line to fetch the "gender" value



?>

<script>
	function validateForm(form) {
  let pass = document.forms["myForm"]["password"].value;
  let email = document.forms["myForm"]["email"].value;
  let name = document.forms["myForm"]["name"].value;
  let gender = document.forms["myForm"]["gender"].value;
  let city = document.forms["myForm"]["city"].value;


  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  const passPattern=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

  if ((pass == "")||(email == '')||(name == '')||(gender == '')||(city == '')) {
    alert("All fields must be filled out");
    return false;
  }

  else  if (!emailPattern.test(email)) {
    alert("Email should be valid");

return false;
  }

  else  if (!passPattern.test(pass)) {
    alert("Password should be atleast 8 characters long and should contain one upperace, one lowwercase, one special character and one number");

return false;
  }

 
  
else{
  alert("form submitted successfully")
  return true;
}

}
 
    

</script>

<?php include('adminheader.php') ?>
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">User Profile</div>
				
				
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
									
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
									<form name="myForm" action="update.php?gender=<?php echo $gender; ?>"  onsubmit="return validateForm(this)" method="POST">
										<div class="row mb-3">
											<div class="col-sm-3">
											<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

												<h6 class="mb-0">Full Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
											<input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Gender</h6>
											</div>
											<!-- ... other HTML code ... -->
											<div class="col-sm-9 text-secondary">
											<input type="radio" name="gender" value="male" <?php if ($gender === "male") echo "checked"; ?>>Male
<input type="radio" name="gender" value="female" <?php if ($gender === "female") echo "checked"; ?>>Female

</div>


<!-- ... other HTML code ... -->

										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">City</h6>
											</div>
											<div class="col-sm-9 text-secondary">
											<select class="form-control" id="citySelect" name="city" >
                                  <option selected disabled >Select city</option>
                                </select>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Password</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="password" name="password" class="form-control" value="<?php echo $row["password"]; ?>" />
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
											</div>
										</div>
									</div>
</form>
<script>  // Fetch the value of the gender from PHP and store it in a JavaScript variable

  fetch("https://gist.githubusercontent.com/immujahidkhan/014fb1629ddc931e6f6d4a3a4d31abaa/raw/8f5cc4f88b9dc4efc5058c5354b9f955e4bda16f/cities.json")
    .then(response => response.json())
    .then(cities => {
        const citySelect = document.getElementById("citySelect");
        cities.forEach(city => {
            const option = document.createElement("option");
            option.value = city.name;
            option.textContent = city.name;

            // Set selected attribute if the city matches the user's city from the database
            if (city.name === "<?php echo $city; ?>") {
                option.setAttribute("selected", "selected");
            }

            citySelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error("Error fetching cities:", error);
    });</script>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		
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
	<script src="assets/admin/app.js"></script>
	<script>
		new PerfectScrollbar(".app-container")
	</script>
</body>

</html>