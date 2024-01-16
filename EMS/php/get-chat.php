<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "connection.php";

        $outgoing_id = $_SESSION['unique_id'];

        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($query) > 0){
            
            while($row = mysqli_fetch_assoc($query)){
               


                if($row['outgoing_msg_id'] == $outgoing_id){
                    $output .= '<div class="d-flex flex-row-reverse mb-2">
                    <div class="right-chat-message fs-13 mb-2">
                    <div class="mb-0 mr-3 pr-4">
                    <div class="d-flex flex-row">
                    <div class="pr-2">'. $row['msg'].' </div>
                    <div class="pr-4"></div>
                    </div>
                    </div>
                    <div class="message-options dark">
                    <div class="message-time">
                    <div class="d-flex flex-row">
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                   ';
                }else{
                    $output .= '<div class="left-chat-message fs-13 mb-2">
                    <p class="mb-0 mr-3 pr-4">'. $row['msg'] .'</p>
                    <div class="message-options">
                    <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                    </div>
                    </div>'
                    
                   ;
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>