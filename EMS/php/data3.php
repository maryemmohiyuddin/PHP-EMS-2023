<style>
    .chat-user-panel{
        overflow:auto !important; 
    }
</style><?php
 include_once "connection.php";
    while($row = mysqli_fetch_assoc($query)){
        
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
        $output .= '
        <a href="messenger1.php?user_id='. $row['unique_id'] .'">
         <div class="chat-user-panel">
        <div class="pb-3 d-flex flex-column navigation-mobile pagination-scrool chat-user-scroll">
        <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
        <div class="w-100">
        <div class="d-flex pl-0">
        
        <img class="rounded-circle shadow avatar-sm mr-3" src="'. $row["picture"] .'"
        <div>
        <p class="margin-auto fw-400 text-dark-75">'. $row['name'] .'</p>
        <div class="d-flex flex-row mt-1">
        <span>
        <div class="svg15 "></div>
        </span>
        <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">'. $you . $msg .'</span>
        </div>
        </div>
        </div>
        </div>
        </div>

        </div>
        </div>





    </a>';

    }
?>