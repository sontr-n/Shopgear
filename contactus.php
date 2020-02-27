<html>   
   <head>
      <title>Contact Us</title>
   </head>
   
   <body>
      <?php
        include('header.php');
      ?>
   </body>
   <?php
        include_once('config.php');    
        $connection = getConnection();
        $sql = "SELECT * FROM contactus";
        $result = select($connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);        
        closeConnection($connection);
        $companyname = $row['name'];
        $address = $row['address'];
        $email = $row['email'];
        $phone = $row['phone'];
        $fanpage = $row['fanpage'];
   ?>
   <p><?php echo($companyname); ?></p>
   <p><?php echo($address); ?></p>
   <p><?php echo $email ?></p>
   <p><?php echo $phone ?></p>
   <p><?php echo $fanpage ?></p>
</html>