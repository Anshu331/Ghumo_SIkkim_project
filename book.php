<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <!--swiper css link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


    <!--font awsome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!--bootstrap cdn link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
</head>
<body>

    <style>
    body{
    padding:50px;
    }
    .container{ 
    font-size: 2rem;
    max-width: 800px;
    height: 4%;
    margin:0 auto;
    padding:50px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }
   .form-group{
    color: black;
    font-size: 1.5rem;
    margin-bottom:30px;
}
    </style>
 

    <!--header section starts-->
    <section class="header">
        <a href="home.html" class="logo">Ghumo Sikkim</a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="package.php">Package</a>
            <a href="book.php">Book</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <div class="heading" style="background: url(img/bookinf.webp) no-repeat">
        <h1>Book Now</h1>

    </div>


  

    <!--booking section starts-->
    
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $phone = $_POST["phone"];
           $address = $_POST["address"];
           $location = $_POST["location"];
           $visiters= $_POST["visiters"];
           $arrivals = $_POST['arrivals'];
           $leaving = $_POST['leaving'];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "data_base.php";
           $sql = "SELECT * FROM customer WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($false);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO customer (full_name, email, phone, address, location, visiters, arrivals, leaving, password) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sssssssss",$fullName, $email, $phone, $address, $location, $visiters, $arrivals, $leaving, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <form action="book.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phone" placeholder="Phone:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="location" placeholder="Location:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="visiters" placeholder="Visiters:">
            </div>
            <div class="form-group">
                <input type="date" class="form-control" name="arrivals" placeholder="Arrivals:">
            </div>
            <div class="form-group">
                <input type="date" class="form-control" name="leaving" placeholder="Leaving:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="submit" name="submit">
            </div>
        </form>
        <div>
        <div><p></a></p></div>
      </div>
    </div>




    <!--booking section ends-->

    






    <!--footer section starts-->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a href="home.php"><i class="fas fa-angle-right"></i>Home</a>
                <a href="about.php"><i class="fas fa-angle-right"></i>About</a>
                <a href="package.php"><i class="fas fa-angle-right"></i>Package</a>
                <a href="book.php"><i class="fas fa-angle-right"></i>Book</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#"><i class="fas fa-angle-right"></i>ask questions</a>
                <a href="#"><i class="fas fa-angle-right"></i>about us</a>
                <a href="#"><i class="fas fa-angle-right"></i>privacy policy</a>
                <a href="#"><i class="fas fa-angle-right"></i>terms of use</a>
                <a href="#"><i class="fas fa-angle-right"></i>ask questions</a>
                
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#"><i class="fas fa-phone"></i> +917667411679 </a>
                <a href="#"><i class="fas fa-phone"></i> +917970758244 </a>
                <a href="#"><i class="fas fa-envelope"></i> anshubishwas0@gmail.com </a>
                <a href="#"><i class="fas fa-map"></i> majitar,india-737136 </a> 
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#"><i class="fas fa-facebook"></i> facebook </a>
                <a href="#"><i class="fas fa-twitter"></i> twitter </a>
                <a href="#"><i class="fas fa-instagram"></i> instagram </a>
                <a href="#"><i class="fas fa-linkedin"></i> linkedin </a>
               
            </div>
        </div>
        <div class="credit"> Thank you<br><span>Visit Us Again</span></div>
    </section>









<!--swiper js link-->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


<!--custom js file link-->
<script src="js/script.js"></script>    
</body>
</html>