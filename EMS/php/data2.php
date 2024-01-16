<style>
    .no-top{
margin-top:0 !important;
padding:0px !important
    }

    .col-9{
        padding-left:0 !important
    }
 p{
        display:block;
        text-align:left !important;
        line-height:10px !important;
    }
    .row{
       padding: 17px 20px 0px 20px;
       border-bottom: 1px solid #e5e5e5 !important;

    }
</style>

<?php
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
        $output .= '<div class="row">
        <div class="col-3 no-top">
        <a href="messenger1.php?user_id='. $row['unique_id'] .'" target="_top">
        <img style="border-radius:50%; width:40px; height:40px; object-fit:cover" src="'. $row["picture"] .'" alt=""></div>
        <div class="col-9">

            <p>'. $row['name'] .'</p><br>
            <p>'. $you . $msg .'</p><br>
            </a>   </div>
    </div> ';

    }
?>
