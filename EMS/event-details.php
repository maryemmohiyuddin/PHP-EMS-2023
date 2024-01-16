<?php
// Start the session (needed to access session variables)
session_start();

// Check if the user is logged in, otherwise redirect to the login page
// You can add your login check logic here.

// Include the database connection
require_once "connection.php";

// Check if the event_id query parameter is set
if (isset($_GET["event_id"])) {
    $event_id = $_GET["event_id"];

    // Retrieve event data from "pending_events" table
    $sql = "SELECT * FROM pending_events WHERE event_id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $event_data = $result->fetch_assoc();
    } else {
        // Event not found, handle the error (e.g., redirect to a 404 page)
        // For simplicity, we will redirect back to the previous page (ecommerce-orders.php) in this example
        header("Location: ecommerce-orders.php");
        exit();
    }
} else {
    // event_id not provided, handle the error (e.g., redirect to a 404 page)
    // For simplicity, we will redirect back to the previous page (ecommerce-orders.php) in this example
    header("Location: ecommerce-orders.php");
    exit();
}
?>

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
                                    <h3><?php echo $event_data["event_name"]; ?></h3>
                                    <p><strong>Location:</strong> <?php echo $event_data["location"]; ?></p>
                                    <p><strong>Start Date and Time:</strong> <?php echo $event_data["start_date"]; ?></p>
                                    <p><strong>End Date and Time:</strong> <?php echo $event_data["end_date"]; ?></p>
                                    <p><strong>Organizer Name:</strong> <?php echo $event_data["organizer_name"]; ?></p>
                                    <p><strong>City:</strong> <?php echo $event_data["city"]; ?></p>
                                    <p><strong>Submission Time:</strong> <?php echo $event_data["submission_time"]; ?></p>
                                    <p><strong>Description:</strong> <?php echo $event_data["description"]; ?></p>

                                    <?php
                                    // Display the picture if available
                                    if ($event_data["picture"]) {
                                        echo "<img src='" . $event_data["picture"] . "' alt='" . $event_data["event_name"] . "' width='200'>";
                                    }
                                    ?>

                                    <hr>
                                    <a href="ecommerce-orders.php" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    <!--start overlay-->
    <!--end overlay-->
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
</div>
<!--end wrapper-->

<!--end switcher-->
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
