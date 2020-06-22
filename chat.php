<?php
     
    
     $servername = "localhost";
      $username = "ubuntu";
      $password = "Esc@34423427";

      #sudo apt-get install php7.3-mysql
      #alter user 'username'@'localhost' identified with mysql_native_password by 'password';

      try {
         $conn = new PDO("mysql:host=$servername;dbname=chat", $username, $password);
         // set the PDO error mode to exception
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         #echo "Connected successfully";
         }
      catch(PDOException $e)
         {
         echo "Connection failed: " . $e->getMessage();
         }
     

     

    $result = array();
    $message = $_POST['message'];
    $from = $_POST['from'];

    if(!empty($message) && !empty($from)){
        $sql = "INSERT INTO `chat`.`chat` (`message`,`from`) VALUES ('".$message."','".$from."');";
        $result['send_status'] = $conn->query($sql);

    }


    
    $conn = null;


?>
