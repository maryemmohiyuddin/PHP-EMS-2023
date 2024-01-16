<?php session_start();
 include('adminheader.php') ?>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Events List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"></a></li>
                        <li class="" aria-current="page">Pending Events</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Event Name</th>
                                <th>Organizer Name</th>
                                <th>Start Date</th>
                                <th>Submitted Date</th>
                                <th>End Date</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "connection.php";
                            require 'PHPMailer.php';
                            require 'Exception.php';
require 'SMTP.php';




                            // Check if the form was submitted for event approval/rejection
                            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                if (isset($_POST["event_id"]) && isset($_POST["action"])) {
                                    $event_id = $_POST["event_id"];
                                    $action = $_POST["action"];

                                    if ($action === "approve") {
                                        // Retrieve event data from "pending_events" table
                                        $sql_event = "SELECT * FROM pending_events WHERE event_id = $event_id";
                                        $result_event = $conn->query($sql_event);

                                        if ($result_event->num_rows === 1) {
                                            $event_data = $result_event->fetch_assoc();

                                            // Insert the approved event data into the "events" table
                                            $sql_approve = "INSERT INTO events (event_name, location, start_date, end_date, picture, organizer_name, description, city, submission_time)
                                                        VALUES ('" . $event_data['event_name'] . "', '" . $event_data['location'] . "', '"
                                                . $event_data['start_date'] . "', '" . $event_data['end_date'] . "', '"
                                                . $event_data['picture'] . "', '" . $event_data['organizer_name'] . "', '"
                                                . $event_data['description'] . "', '" . $event_data['city'] . "', NOW())";
                                                $eventCity =  $event_data['city'] ;
                                                $sql = "SELECT email FROM users WHERE city = '$eventCity'";
                                                $result = $conn->query($sql);
                                                $eventCity = $event_data['city'];
                    $sql = "SELECT email FROM users WHERE city = '$eventCity'";
                    $result = $conn->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        // Loop through the users and send email notifications
                        while ($row = $result->fetch_assoc()) {
                            $userEmail = $row["email"];
                    
                            // Create a new PHPMailer instance
                            $mail = new PHPMailer\PHPMailer\PHPMailer();
                    
                            // Set up SMTP (Optional: If you want to use SMTP to send emails)
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'maryammohiyuddin123@gmail.com';
                            $mail->Password = 'psbmwqolhvzubrbt

                            ';  
                            $mail->SMTPSecure = 'tls'; // or 'ssl' for SSL encryption
                            $mail->Port = 587; // or 465 for SSL
                    
                            // Set up other email parameters
                            $mail->setFrom('maryammohiyuddin123@Gmail.com', 'Maryam Mohiyuddin'); // Replace with your email and name
                            $mail->addAddress($userEmail); // Recipient's email
                            $mail->Subject = 'New Event in Your City';
    // Prepare the email body with event details
    $emailBody = 'A new event has been posted in your city. Check it out!'."\n\n";

    $emailBody .= 'Event Name: ' . $event_data['event_name'] . "\n";
    $emailBody .= 'Organizer Name: ' . $event_data['organizer_name'] . "\n";
    $emailBody .= 'Location: ' . $event_data['location'] . "\n";
    $emailBody .= 'Start Date: ' . $event_data['start_date'] . "\n";
    $emailBody .= 'End Date: ' . $event_data['end_date'] . "\n";
    // You can include more event details as needed

    $mail->Body = $emailBody;                            
                            // Send the email
                            if ($mail->send()) {
                                // Email sent successfully
                            } else {
                                // Email sending failed
                                echo "Failed to send email to: " . $userEmail . "<br>";
                                echo "Error: " . $mail->ErrorInfo . "<br>";
                            }
                        }       
                    
                    }
                    

                                            if ($conn->query($sql_approve) === TRUE) {
                                                // Remove the event from the "pending_events" table
                                                $sql_delete = "DELETE FROM pending_events WHERE event_id = $event_id";
                                                $conn->query($sql_delete);
                                            }
                                        }
                                    } elseif ($action === "reject") {
                                        // Remove the event from the "pending_events" table
                                        $sql_delete = "DELETE FROM pending_events WHERE event_id = $event_id";
                                        $conn->query($sql_delete);
                                    }
                                }
                                
                            }
                          
                            // Retrieve pending events from the "pending_events" table
                            $sql = "SELECT * FROM pending_events";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<div class='d-flex align-items-center'>";
                                    echo "<div>";
                                    echo "<h6 class='mb-0 font-14'>" . $row["event_name"] . "</h6>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>" . $row["organizer_name"] . "</td>";
                                    echo "<td>" . $row["start_date"] . "</td>";
                                    echo "<td>" . $row["submission_time"] . "</td>";
                                    echo "<td>" . $row["end_date"] . "</td>";
                                    echo "<td><a href='event-details.php?event_id=" . $row["event_id"] . "' class='btn btn-primary btn-sm radius-30 px-4'>View Details</a></td>";
                                    echo "<td>";
                                    echo "<div class='d-flex order-actions'>";
                                    echo "<form action='ecommerce-orders.php' method='post'>";
                                    echo "<input type='hidden' name='event_id' value='" . $row["event_id"] . "'>"; // Add event_id as a hidden field
                                    echo "<input type='hidden' name='action' value='approve'>"; // Add hidden field for action (approve/reject)
                                    echo "<button type='submit' class='btn btn-success btn-sm'><i class='bx bxs-check-circle'></i></button>";
                                    echo "</form>";

                                    echo "<form action='ecommerce-orders.php' method='post'>";
                                    echo "<input type='hidden' name='event_id' value='" . $row["event_id"] . "'>"; // Add event_id as a hidden field
                                    echo "<input type='hidden' name='action' value='reject'>"; // Add hidden field for action (approve/reject)
                                    echo "<button type='submit' class='btn btn-danger btn-sm ms-2'><i class='bx bxs-x-circle'></i></button>";
                                    echo "</form>";

                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No events pending for approval.</td></tr>";
                            }

                            // Close the database connection
                           
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Events List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"></a></li>
                        <li class="" aria-current="page">Approved Events</li>
                    </ol>
                </nav>
            </div>
        </div>
		        <!-- Approved Events Section -->
				<div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Event Name</th>
                                <th>Organizer Name</th>
                                <th>Start Date</th>
                                <th>Submission Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
                            // Include the database connection
                            require_once "connection.php";

                            // Retrieve approved events from the "events" table
                            $sql_approved = "SELECT * FROM events";
                            $result_approved = $conn->query($sql_approved);

                            if ($result_approved->num_rows > 0) {
                                while ($row = $result_approved->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<div class='d-flex align-items-center'>";
                                    echo "<div>";
                                    echo "<h6 class='mb-0 font-14'>" . $row["event_name"] . "</h6>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>" . $row["organizer_name"] . "</td>";
                                    echo "<td>" . $row["start_date"] . "</td>";
                                    echo "<td>" . $row["submission_time"] . "</td>";
                                    echo "<td>" . $row["end_date"] . "</td>";
                                    echo "<td>";
                                    echo "<div class='d-flex order-actions'>";
                                    echo "<form action='edit-event.php' method='post'>";
                                    echo "<input type='hidden' name='event_id' value='" . $row["event_id"] . "'>";
                                    echo "<button type='submit' class='btn btn-primary btn-sm me-2'><i class='bx bxs-edit'></i> Edit</button>";
                                    echo "</form>";

                                    echo "<form action='block_event.php' method='post'>";
                                    echo "<input type='hidden' name='event_id' value='" . $row["event_id"] . "'>";
                                    echo "<button type='submit' class='btn btn-warning btn-sm me-2'><i class='bx bx-block'></i> Block</button>";
                                    echo "</form>";

                                    echo "<form action='delete_event.php' method='post'>";
                                    echo "<input type='hidden' name='event_id' value='" . $row["event_id"] . "'>";
                                    echo "<button type='submit' class='btn btn-danger btn-sm'><i class='bx bxs-trash'></i> Delete</button>";
                                    echo "</form>";

                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No events approved yet.</td></tr>";
                            }

                            // Close the database connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End of Approved Events Section -->
    </div>
</div>
<!--end page wrapper -->

<!--start overlay-->
<!--end overlay-->

<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class="fa-solid fa-angle-up"></i></a>
<!--End Back To Top Button-->
</div>
<!--end wrapper-->

<!--end switcher-->

<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--app JS-->
<script src="assets/js/app.js"></script>
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
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script src="assets/admin/app.js"></script>
	<script>
</body>

</html>