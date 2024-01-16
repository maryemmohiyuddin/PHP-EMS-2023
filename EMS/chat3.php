

                  <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
                <?php session_start(); ?>

                <?php 
  include_once "connection.php";
  if(!isset($_SESSION['unique_id'])){
echo'user not found';  }

?>
                  <link rel="stylesheet" href="assets/admin/css/chat.css">

<div class="container">
  <div class="row">
    <div class="col-4">
           <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          
        <img src="<?php echo $_SESSION["picture"]  ?>" alt="">
          <div class="details">
            <span><?php echo $row['name']?></span>
          </div>
         
         <div class="users-list">
     
         </div>
     </div>
  
 

  <script src="javascript/users.js"></script>


                <?php 
  include_once "connection.php";
  if(!isset($_SESSION['unique_id'])){
echo'error';  }
?>

<div class="col-8">
  <div class="wrapper">
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $row['picture']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['name'] ?></span>
        </div>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
  </div>
        </div>
  <script src="javascript/chat.js"></script>






            </div>
        </div>

<script type="text/javascript" src="assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/admin/js/popper.js"></script>
<script type="text/javascript" src="assets/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/admin/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="assets/admin/js/slick.min.js"></script>
<script type="text/javascript" src="assets/admin/js/scrollbar.js"></script>
<script type="text/javascript" src="assets/admin/js/script.js"></script>

