<?php
   //connect to database
   $servername = "database-1.cdaqmc6max1u.us-east-1.rds.amazonaws.com";
   $username = "admin";
   $password = "root12345";
   $database = "php";

   //Create Connection
   $connection = new mysqli($servername, $username, $password, $database);

   //Check connection stablished or not!
   if ($connection->connect_error) {
       die("Connection failed: " . $connection->connect_error);
   }

   if (isset($_GET["id"])) {
    #if not exist then
        $id = $_GET['id'];
        
        $sql = "DELETE FROM employee WHERE id=$id"; 
        $result = $connection->query($sql);

        // if (!$result) {
        //     die("Invalid query : " . $connection->error);
        //     break;
        // }

}     
   header("location: ./index.php");
   exit;


?>
