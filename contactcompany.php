<?php
ob_start();
session_start();

include('connection.php');

$id = $_GET["id"];

$query = "SELECT * from client_requests cr left join offers o on o.idoffers = cr.offer_selected left join users u on u.idusers = o.idcompany WHERE cr.idclient_requests = '$id'";

$result = mysqli_query($con, $query);

$company_image = "";
$company_phone = "";
$company_email = "";
$company_id = "";

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $company_image = $row["image"];
        $company_phone = $row["phone"];
        $company_email = $row["email"];
        $company_id = $row["idcompany"];
    }
}



if (isset($_POST['submit'])) {
    // echo var_dump($_POST);

    $idrequest = $_POST["c_id"];
    $idclient = $_SESSION["userid"];
    $title = $_POST["title"];
    $message = $_POST["message"];

    $profile_pic = "";



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


    if(isset($_FILES["fileToUpload"]["tmp_name"])){
        $query = "INSERT INTO client_requests_messages(idclientrequests, idclient, qtitle, qmessage, idcompany, qfile) VALUES('$idrequest', '$idclient', '$title', '$message', '$company_id', '$profile_pic')";

    }
    else{
        $query = "INSERT INTO client_requests_messages(idclientrequests, idclient, qtitle, qmessage, idcompany) VALUES('$idrequest', '$idclient', '$title', '$message', '$company_id')";
    }

    //echo $error_msg;

    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['c_message'] = 'Your question is sent successfully';
        header('Location: viewquestions.php');
    } else {
        $_SESSION['ec_message'] = 'Your question is not sent, try again !!!!';
        header('Location: viewquestions.php');
    }
}



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
    <link href="js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />



</head>

<body class="sub_page">
    <div class="hero_area">
        <?php
        if (isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin') {
            include('adminnavbar.php');
        } else if (isset($_SESSION['userrole']) && $_SESSION['userrole'] ==  'client') {
            include('clientnavbar.php');
        } else if (isset($_SESSION['userrole']) && $_SESSION['userrole'] ==  'company') {
            include('companynavbar.php');
        } else {
            header('Location: index.php');
            exit();
        }

        ?>
    </div>


    <!-- contact section -->

    <section class="contact_section layout_padding">
        <div class="container ">
            <div class="heading_container">
                <h2 class="">
                    Contact Company
                </h2>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="map_container">
                        <div class="map-responsive">
                            <img src="uploads/<?php echo $company_image?>" style="width:500px;height:300px;" />
                            <p>
                                <h5><i class="fa fa-phone"><?php echo $company_phone;?></i></h5>
                                <h5><i class="fa fa-email"><?php echo $company_email;?></i></h5>
                            </p>
                        </div>
                    </div>
                    
                </div>

                <div class="col-md-6">
                    <form action="contactcompany.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="c_id" id="c_id" value="<?php echo $id; ?>">
                        <div>
                            <input type="text" required placeholder="Title" name="title" />
                        </div>
                        <div>
                            <input type="text" required class="message-box" name="message" placeholder="Message" />
                        </div>
                        <div>
                            <input type="file" required  name="fileToUpload"/>
                        </div>
                        <div class="d-flex ">
                            <button type="submit" name="submit">
                                SEND
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

    <script src="js/datatables/jquery.dataTables.min.js"></script>
    <script src="js/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js-CreditCardValidator-master/creditCardValidator.js"></script>

    <script>
        $(document).ready(function() {
            $(".tableexample").DataTable();
        });
    </script>


</body>
</body>

</html>