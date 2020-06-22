<?php
    
    $db = new mysqli('localhost','ubuntu', 'Esc@34423427', 'chat');


    $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $qr = $db->query("SELECT * FROM chat.chat WHERE id >".$start);

    while($row = $qr->fetch_assoc()):
        $result['items'][] = $row;
    endwhile;
    echo json_encode($result);
    mysqli_close($db);
?> 
