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



    $id = "";
    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $successMessage = "";


    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        # Request Received using GET method 
        # then editing-> show the data of the employee...
        
        //Check Id is exist or not!
       
        if (!isset($_GET["id"])) {
             #if not exist then
            header("location: ./index.php");
            exit;

        }

        //if exist employee id

        $id = $_GET["id"];

        $sql = "SELECT * FROM employee WHERE id=$id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            #if row does not consist any value
            header("location: ./index.php");
            exit;
        }

        
        //if row consist value, then read all the data from database and store it in form variable.
        $name =$row["name"];
        $email =$row["email"];
        $phone =$row["phone"];
        $address =$row["address"]; 



    }else {
        # request Reveived form POST
        # POST method update the data of Employee...
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        
        do {
            # code...
            if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
                # code...
                $errorMessage = "All fields are required!";
                break;
            
            }
            
            $sql = "UPDATE employee SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id='$id'";
            
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query : " . $connection->error);
                break;
            }

            $successMessage = "Employee Updated Successfully!";
            header("location: ./index.php");
            exit;



        } while (false);



    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Employee Management CRUD | New Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<style>

/* for showing validation msg red */
*{
        padding: 0px;
        margin:0px;
}
.navbar{
        margin: 0px;
}
.error {
        color: red;
        font-style: italic;
}

.mycolor{
        background: #748EC6;
}
.text-w{
        color:#748EC6;
}
.background-color-w{
        color:#F2F5FA;
}

.section-bg {
    background-color: #f2f5fa;
    padding: 0px;
    margin: 0px;
}

.card-shadow{
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;

}

</style>



</head>
<body>



<!-- navbar start -->
<nav class="navbar navbar-expand-lg navbar-dark mycolor">
                <a class="navbar-brand" href="index.php">Employee Management</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                                <li class="nav-item active"><a class="nav-link" href="index.php">Home

                                </a></li>
                                <li class="nav-item active"><a class="nav-link" href="./create-new-employee.php">Add
                                                Employee</a></li>
                                <li class="nav-item dropdown"><a
                                        class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"> Dropdown </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="#">Action</a> <a
                                                        class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                        </div></li>
                                        <li class="nav-item"><a class="nav-link disabled" href="#">Disabled</a>
                                </li>
                        </ul>

                </div>
        </nav>

<!-- navbar End -->



    <div class="container my-5">
        <h2 class="text-center mb-5">Update Employee</h2>
        <!-- employee form -->
        
        
        <?php
            if(!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <form method="post">

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email"  class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" name="address" value="<?php echo $address; ?>">
                    </div>
                </div>

                
                <?php
            if(!empty($successMessage)){
                echo "
                
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
ubuntu@ip-172-31-36-125:~/PHP-MySQL-CRUD-Operation-Employee-Management-CRUD$ 
ubuntu@ip-172-31-36-125:~/PHP-MySQL-CRUD-Operation-Employee-Management-CRUD$ 
ubuntu@ip-172-31-36-125:~/PHP-MySQL-CRUD-Operation-Employee-Management-CRUD$ ll
total 60
drwxrwxr-x 3 ubuntu ubuntu  4096 Jun  1 14:19 ./
drwxr-x--- 6 ubuntu ubuntu  4096 Jun  1 14:19 ../
drwxrwxr-x 8 ubuntu ubuntu  4096 May 31 11:18 .git/
-rw-rw-r-- 1 ubuntu ubuntu   486 Jun  1 14:14 Dockerfile
-rw-rw-r-- 1 ubuntu ubuntu   695 Jun  1 14:14 README.md
-rw-r--r-- 1 root   root    6990 Jun  1 14:14 create-new-employee.php
-rw-r--r-- 1 root   root     792 Jun  1 14:14 delete-employee.php
-rw-r--r-- 1 root   root    7888 Jun  1 14:14 edit-employee.php
-rw-r--r-- 1 root   root   10671 Jun  1 14:14 index.html
-rw-r--r-- 1 ubuntu ubuntu  4736 Jun  1 14:19 index.php
ubuntu@ip-172-31-36-125:~/PHP-MySQL-CRUD-Operation-Employee-Management-CRUD$ cat create-new-employee.php 
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



    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $successMessage = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //echo "DDD";
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];


        do {
            # code...
            if(empty($name) || empty($email) || empty($phone) || empty($address)){
                $errorMessage = "All the fields are required";
                break;
                //echo $errorMessage;
            }
    
            //add new employee into database

            $sql = "INSERT INTO employee (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query : " . $connection->error);
                break;
            }
    
            $name = "";
            $email = "";
            $phone = "";
            $address = "";
    
            $successMessage = "";
    
            $successMessage = "Employee Added Successfully!";

            header("location: ./index.php");
            exit;


        } while (false);

        
    }else{
        //echo "ELse";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Employee Management CRUD | New Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<style>

/* for showing validation msg red */
*{
        padding: 0px;
        margin:0px;
}
.navbar{
        margin: 0px;
}
.error {
        color: red;
        font-style: italic;
}

.mycolor{
        background: #748EC6;
}
.text-w{
        color:#748EC6;
}
.background-color-w{
        color:#F2F5FA;
}

.section-bg {
    background-color: #f2f5fa;
    padding: 0px;
    margin: 0px;
}

.card-shadow{
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;

}

</style>



</head>
<body>



<!-- navbar start -->
<nav class="navbar navbar-expand-lg navbar-dark mycolor">
                <a class="navbar-brand" href="index.php">Employee Management</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                                <li class="nav-item active"><a class="nav-link" href="index.php">Home

                                </a></li>
                                <li class="nav-item active"><a class="nav-link" href="./create-new-employee.php">Add
                                                Employee</a></li>
                                <li class="nav-item dropdown"><a
                                        class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"> Dropdown </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="#">Action</a> <a
                                                        class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                        </div></li>
                                        <li class="nav-item"><a class="nav-link disabled" href="#">Disabled</a>
                                </li>
                        </ul>

                </div>
        </nav>

<!-- navbar End -->



    <div class="container my-5">
        <h2 class="text-center mb-5">New Employee</h2>
        <!-- employee form -->
        
        
        <?php
            if(!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <form method="post">
                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email"  class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text"  class="form-control" name="address" value="<?php echo $address; ?>">
                    </div>
                </div>

                
                <?php
            if(!empty($successMessage)){
                echo "
                
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
                
                
                ";
            }
        ?>
                
                <div class="row mb-3">
                    
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a href="./index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                    </div>
                </div>


        </form>
    </div>



    
</body>
</html>
