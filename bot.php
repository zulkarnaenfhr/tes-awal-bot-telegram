<?php
    $content = file_get_contents("php://input");
    if($content){
        $token = '2101388072:AAHzKX25wy_kSQ3FFCdLfAn3BMMjzpTEies';
        
        $apiLink = "https://api.telegram.org/bot$token/";
        
        echo '<pre>content = '; print_r($content); echo '</pre>';
        $update = json_decode($content, true);
        if(!@$update["message"]) $val = $update['callback_query'];
        else $val = $update;
        
        $chat_id = $val['message']['chat']['id'];
        $text = $val['message']['text'];
        $update_id = $val['update_id'];
        $sender = $val['message']['from'];
        ?>
        <b>There is a message :</b>
        <br /><br />
        <b>Username : </b> <?php echo $sender['username']; ?> <br />
        <b>Sender's Name : </b> <?php echo $sender['first_name'].' '.$sender['last_name']; ?> <br />
        <b>Text Message : </b> <?php echo $text; ?> <br /><br />
        <?php 
        
        file_get_contents($apiLink . "sendmessage?chat_id=$chat_id&text=You just sent ".$text);
        echo 'Response sent.<br /><br />';
    } else echo 'Only telegram can access this url.';
?>
