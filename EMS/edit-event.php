<?php
// Include the database connection
require_once "connection.php";

// Check if the form was submitted for event editing
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["event_id"])) {
        $event_id = $_POST["event_id"];

        // Retrieve the event data from the "events" table
        $sql_event = "SELECT * FROM events WHERE event_id = $event_id";
        $result_event = $conn->query($sql_event);

        if ($result_event->num_rows === 1) {
            $event_data = $result_event->fetch_assoc();
        }
    }
}

// Check if the form was submitted for updating the event details
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["update_event"])) {
        // Get the updated event details from the form
        $updated_event_name = $_POST["event_name"];
        $updated_location = $_POST["location"];
        $updated_start_date = $_POST["start_date"];
        $updated_end_date = $_POST["end_date"];
        $updated_organizer_name = $_POST["organizer_name"];
        $updated_description = $_POST["description"];
        $updated_city = $_POST["city"];

        // Handle the picture upload
        $picture_path = null;
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $file_tmp_name = $_FILES['picture']['tmp_name'];
            $file_name = $_FILES['picture']['name'];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $picture_path = 'uploads/' . uniqid() . '.' . $file_extension;
            move_uploaded_file($file_tmp_name, $picture_path);
        }

        // Update the event data in the "events" table
        $sql_update = "UPDATE events SET 
                        event_name = '$updated_event_name',
                        location = '$updated_location',
                        start_date = '$updated_start_date',
                        end_date = '$updated_end_date',
                        organizer_name = '$updated_organizer_name',
                        description = '$updated_description',
                        city = '$updated_city',
                        picture = '$picture_path'
                        WHERE event_id = $event_id";

        if ($conn->query($sql_update) === TRUE) {
            // Redirect back to the event details page after successful update
            header("Location: event-details.php?event_id=$event_id");
            exit();
        } else {
            echo "Error updating event details: " . $conn->error;
        }
    }
}
?>

<?php include('adminheader.php') ?>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Event</div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h3>Edit Event</h3>
                                <form action="edit-event.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                    <div class="mb-3">
                                        <label for="event_name" class="form-label">Event Name</label>
                                        <input type="text" class="form-control" id="event_name" name="event_name" value="<?php echo $event_data['event_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="<?php echo $event_data['location']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d\TH:i', strtotime($event_data['start_date'])); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo date('Y-m-d\TH:i', strtotime($event_data['end_date'])); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="organizer_name" class="form-label">Organizer Name</label>
                                        <input type="text" class="form-control" id="organizer_name" name="organizer_name" value="<?php echo $event_data['organizer_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $event_data['city']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $event_data['description']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="picture" class="form-label">Picture</label>
                                        <input type="file" class="form-control" id="picture" name="picture" accept=".jpg, .jpeg, .png" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="update_event">Update Event</button>
                                    <a href="event-details.php?event_id=<?php echo $event_id; ?>" class="btn btn-secondary">Cancel</a>
                                </form>
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
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--app JS-->
<script src="assets/js/app.js"></script>
</body>

</html>
