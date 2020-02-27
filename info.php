<?php 
    include('users.php');
    session_start();
    if(!isset($_SESSION['login_user']) || !$_SESSION['login_user']){
        header("Location:login.php?url=".urlencode('index.php'));
    }

    $user = getUserById($_SESSION['id']);


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = getConnection();
        
        $userid = $_POST['userid'];
        $username = $_POST['username'];
        $password = $_POST['password'];        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
       
        updateUser($userid, $username, $password, $firstname, $lastname, $email, $phone);
        header("Location:index.php");
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<html>   
<head>
   <title>Cập nhật thông tin</title>
   <link rel="stylesheet" href="css/bootstrap.css" />
   <link rel="stylesheet" href="css/font-awesome.css" />
   <link rel="stylesheet" href="css/styles.css" />
   <script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<body>
    
     
    <h2 align ="center" class="form-signin-heading">Cập nhật thông tin</h2>   
        
    <div class="container">
    <form action = "" method = "POST">
        <div class="form-group">
        <input type="hidden" id="userid" name="userid" value="<?php echo $user['userid']; ?>">
        <label for="usr">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
        </div>

        <div class="form-group">            
        <label for="usr">Pasword:</label>
        <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
        </div>

        <div class="form-group">            
        <label for="usr">First Name:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
        </div>

        <div class="form-group">            
        <label for="usr">Last Name:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
        </div>

        <div class="form-group">            
        <label for="usr">Email:</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
        </div>

        <div class="form-group">            
        <label for="usr">Phone:</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
        </div>        

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Lưu</button>
            </div>
        </div>

        <div class="row text-right">
            <div class="col-md-12">
                <a class="btn btn-info" href="index.php"><i class="fa fa-arrow-left"></i> Về trang chủ</a>

            </div>
        </div>
      </form>
    </div>
   </body>
</html>