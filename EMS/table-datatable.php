
<?php session_start();
 include('adminheader.php')?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb--> <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">             </a>
                        </li>
                       Data Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">DataTable</h6>
        <hr/>
       
      
        <?php
// Include the database connection
require_once "connection.php";

// Fetch data from the "users" table
// Fetch data from the "users" table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any records in the table
if ($result->num_rows > 0) {
    // Output the table headers
    echo "<div class='card'>
        <div class='card-body'>
            <div class='table-responsive'>
                <table id='example' class='table table-striped table-bordered' style='width:100%'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th>Password</th>
                            <th>Type</th>
                            <th>Edit</th>
                            <th>Delete</th> <!-- New Delete button column -->

                        </tr>
                    </thead>
                    <tbody>";

    // Output the data from each row in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["gender"] . "</td>
                <td>" . $row["city"] . "</td>
                <td>" . $row["password"] . "</td>
                <td>" . $row["type"] . "</td>
                <td><a href='user-profile.php?id=" . $row["id"] . "'>Edit</a></td>
                <td><a href='delete-user.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td> <!-- New Delete button link -->

            </tr>";
    }

    // Close the tbody, table, and other div elements
    echo "</tbody>
        </table>
    </div>
    </div>
    </div>";

    // Close the table
    echo "</table>";
} else {
    // If no records found, display a message
    echo "No records found.";
}

// Close the database connection
$conn->close();

?>
       

                
    </div>
</div>
<!--end page wrapper -->
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