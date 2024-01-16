   
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>User Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<style>
		header{
			padding:8px !important;
			    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Adjust values as needed */
				position: sticky;
    top: 0;
    z-index: 100; /* Adjust the z-index as needed */
				}
		.icon-container {
margin-bottom:8px}
		body{
			font-family: "Jost", sans-serif;

		}
		 .logo { 
			

    font-size: 30px;
    padding: 0;
    letter-spacing: 2px;
    text-transform:capitalize;   
	line-height: 1;
    font-weight: 500;
	
	 }
	 .logo a{
		color:rgba(40, 58, 90, 0.9);
		margin-top:5px;
	 }

	nav{
		font-size:15px !important;
	}
	.username{
		color:rgba(40, 58, 90, 0.9) !important;
	}
	</style>

	<link rel="stylesheet" type="text/css" href="assets/admin/css/slick.css">
	<link rel="stylesheet" type="text/css" href="assets/admin/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css">
</head>

<body>	

	<div class="wrapper ">	
		<header>
			<div class="container">
				<div class="header-data">
					<div class="logo">
					<h1 class="logo me-auto"><a class="planner" href="index.php">PrePlanner</a></h1>
					</div><!--logo end-->
					
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

					<nav>
						<ul>
							<li>
								<a href="userdashboard.php" title="" target="_top">
								<span class="icon-container"><img src="images/icon1.png" alt="" width="22px"></span>
									
								</a>
							</li>
							
							<li>
								<a href="userprofile.php" title="" target="_top">
									<span  class="icon-container"><img src="images/icon4.png" alt="" width="22px"></span>
								</a>
								
							</li>
							<li>
								<a href="#" title="" class="not-box-openm">
									<span  class="icon-container"><img src="images/icon6.png" alt=""  width="22px"></span>
								</a>
								<div class="notification-box msg" id="message">
									<div class="nt-title">
										<h4>Setting</h4>
										<a href="#" title="">Clear all</a>
									</div>
									<div class="nott-list">
										<div style="overflow:auto; height:250px; padding:0" class="notfication-details">
							  				<div class="noty-user-img">
</div><?php 
  include_once "connection.php";
  if(!isset($_SESSION['unique_id'])){
echo'user not found';  }

?>  <?php 
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql) > 0){
  $row = mysqli_fetch_assoc($sql);
}
?>  <div  style=""  class="user-list">
  
</div> <script src="javascript/user.js"></script>

							  				
						  				</div>
						  				
									</div><!--nott-list end-->
								</div><!--notification-box end-->
							</li>
							<li>
								<a href="#" title="" class="not-box-open">
									<span  class="icon-container"><img src="images/icon7.png" alt=""  width="22px"></span>
								</a>
								<div class="notification-box noti" id="notification">
									<div class="nt-title">
										<h4>Setting</h4>
										<a href="#" title="">Clear all</a>
									</div>
									<div class="nott-list">
										<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img1.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img2.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img3.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img2.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				
									</div><!--nott-list end-->
								</div><!--notification-box end-->
							</li>
						</ul>
					</nav><!--nav end-->
					<div class="menu-btn">
						<a href="#" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					<div class="user-account">
					<div class="user-info"><?php 
										// Fetch the user's profile picture and name from the database
$user_id = $_SESSION["user_name"]; // Assuming you have a user name in the session

// Enclose the $user_id in single quotes in the SQL query
$user_info_query = "SELECT * FROM users WHERE name = '$user_id'";

$user_info_result = mysqli_query($conn, $user_info_query);

if ($user_info_result && mysqli_num_rows($user_info_result) > 0) {
    $user_info = mysqli_fetch_assoc($user_info_result);

?>
    <img src="<?php echo $user_info["picture"];} ?>" alt="User Profile Picture">
</div>

						<div class="user-account-settingss" id="users">
							
							<h3>Setting</h3>
							<ul class="us-links">
								<li><a href="profile-account-setting.html" title="">Account Setting</a></li>
								<li><a href="#" title="">Privacy</a></li>
								<li><a href="#" title="">Faqs</a></li>
								<li><a href="#" title="">Terms & Conditions</a></li>
							</ul>
							<h3 class="tc"><a href="logout.php" title="">Logout</a></h3>
						</div><!--user-account-settingss end-->
					</div>
				</div><!--header-data end-->
			</div>
		</header><!--header end-->	