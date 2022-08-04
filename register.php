<?php
ob_start();
session_start();

include('connection.php');



?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Velocity</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <style>
        #usertype1, #usertype2{
            height: 15px;
            width: 15px;
            background-color: transparent;
            box-shadow:none;
        }
    </style>
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="#">
            <img src="images/logo-1.png" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="about.html"> About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.html">Shop </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="furniture.html"> Furniture </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact us</a>
              </li> -->
            </ul>
            <div class="user_option">
              <a href="login.php">
                <img src="images/user.png" alt="">
                <span>
                  Login
                </span>
              </a>
              <a href="register.php" class="ml-2">
                <span>
                  Register
                </span>
              </a>
            </div>
          </div>
          <div>
            <div class="custom_menu-btn ">
              <button>
                <span class=" s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
            </div>
          </div>

        </nav>
      </div>
    </header>
    </div>



    <!-- contact section -->

    <section class="contact_section layout_padding">
        <div class="container ">
            <div class="heading_container">
                <h2 class="">
                    Register
                </h2>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if(isset($_SESSION['message'])){
                            echo '<div class="alert alert-success">'.$_SESSION["message"].'</div>';
                        }
                        else if(isset($_SESSION['e_message'])){
                            echo '<div class="alert alert-danger">'.$_SESSION["e_message"].'</div>';
                        }
                    ?>
                    <form action="register.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group row" id="radios">
                            <div class="col-md-6">
                                <input class="rad" required type="radio" name="usertype" id="usertype1" value="client">
                                <label class="form-check-label" for="usertype1">Client</label>
                            </div>
                            <div class="col-md-6">
                                <input class="rad" required type="radio" name="usertype" id="usertype2" value="company">
                                <label class="form-check-label" for="usertype2">Company</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Name" name="username" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone" name="phone" required/>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email" name="email" required />
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" required />
                        </div>
                        <div class="form-group company" style="display: none;">
                            <input type="text" class="message-box" name="description" placeholder="Description" />
                        </div>
                        <div class="form-group">
                            <input type="file"  name="fileToUpload" required />
                        </div>
                        <div class="d-flex ">
                            <button type="submit" name="submit">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- end contact section -->



    <?php include('footer.php'); ?>


    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
    </script>
    <script type="text/javascript">
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: [],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                420: {
                    items: 2
                },
                1000: {
                    items: 5
                }
            }

        });
    </script>
    <script>
        var nav = $("#navbarSupportedContent");
        var btn = $(".custom_menu-btn");
        btn.click
        btn.click(function(e) {

            e.preventDefault();
            nav.toggleClass("lg_nav-toggle");
            document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style")
        });
    </script>
    <script>
        $('.carousel').on('slid.bs.carousel', function() {
            $(".indicator-2 li").removeClass("active");
            indicators = $(".carousel-indicators li.active").data("slide-to");
            a = $(".indicator-2").find("[data-slide-to='" + indicators + "']").addClass("active");
            console.log(indicators);

        })
    </script>

    <script>
        $('.rad').change(function(){
            //console.log($('.rad:checked').val());
            if($('.rad:checked').val() == 'company'){
                $('.company').css('display', 'block');
                $('.client').css('display', 'none');
            }
            else{
                $('.company').css('display', 'none');
                $('.client').css('display', 'block');
            }
        });
    </script>

</body>
</body>

</html>



<?php

if (isset($_POST['submit'])) {
    //echo var_dump($_POST);

    $client_type = $_POST["usertype"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $description = $_POST["description"];

    $profile_pic = "";
    $emails = [];

    $query1 = "
    SELECT email from users
  ";

    $result = mysqli_query($con, $query1);

    while ($row = mysqli_fetch_assoc($result)) {
        $emails[] = $row['email'];
    }


    if (!in_array($email, $emails)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

        //get all emails to be validated


        if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        }

        $date = date('Y-m-d H:i:s');


        //echo $error_msg;
        $query = "insert into users (name,email,password,phone,image,role,regdate,description) values ('$username','$email','$password','$phone','$profile_pic','$client_type','$date','$description')";

        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['message'] = 'Your account is registered successfully';
            header('Location: register.php');
        } else {
            $_SESSION['e_message'] = 'Your account is not registered, try again !!!!';
            header('Location: register.php');
        }
    } else {
        $_SESSION['e_message'] = 'Your account is not registered, email already in use, try again !!!!';
        header('Location: register.php');
    }
}


?>