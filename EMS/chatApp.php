<?php 
  session_start();

?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
         include('connection.php');

         $organizer_name = $_SESSION['user_name'];
                               
         $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE name = ?");
         mysqli_stmt_bind_param($stmt, "s", $organizer_name);
         mysqli_stmt_execute($stmt);
         
         $result = mysqli_stmt_get_result($stmt);
         
         if(mysqli_num_rows($result) > 0){
             $row = mysqli_fetch_assoc($result);
         }
         
          ?>
          <img src="php/images/<?php echo $row['picture']; ?>" alt="">  
          <div class="details">
            <span><?php echo $row['name']?></span>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $_SESSION['user_name']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
