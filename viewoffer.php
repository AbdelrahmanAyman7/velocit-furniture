<?php
ob_start();
session_start();

include('connection.php');

$id = $_GET["id"];

$query = "SELECT * from offers o left join users u on u.idusers = o.idcompany WHERE idclientrequests = '$id'";

$result = mysqli_query($con, $query);

if (isset($_POST['submit'])) {
   // echo var_dump($_POST);

    $offer = $_POST["offer"];
    $idrequest = $_POST["c_id"];

    $paid = 1;

    //echo $error_msg;
    $query = "UPDATE client_requests SET offer_selected = '$offer', paid='$paid' WHERE idclient_requests='$idrequest'";

    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['o_message'] = 'Your Offer is selected successfully';
        header('Location: viewrequests.php');
    } else {
        $_SESSION['eo_message'] = 'Your Offer is not selected, try again !!!!';
        header('Location: viewrequests.php');
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


    <style>
        input[type=radio] {
            height: 15px;
            width: 15px;
            background-color: transparent;
            box-shadow: none;
        }

        #t {
            box-shadow: none;
        }
    </style>

    <style>
        .card-bounding {
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            /* top:50%; */
            /* transform: translateY(-50%); */
            padding: 30px;
            border: 1px solid #2eca6a;
            border-radius: 6px;
            font-family: 'Roboto';
            background: #ffffff;
        }

        .card-bounding aside {
            font-size: 24px;
            padding-bottom: 8px;
        }

        .card-container {
            width: 100%;
            padding-left: 80px;
            padding-right: 40px;
            position: relative;
            box-sizing: border-box;
            border: 1px solid #ccc;
            margin: 0 auto 30px auto;
        }

        .card-container input {
            width: 100%;
            letter-spacing: 1px;
            font-size: 30px;
            padding: 15px 15px 15px 25px;
            border: 0;
            outline: none;
            box-sizing: border-box;
        }

        .card-type {
            width: 80px;
            height: 56px;
            background: url("cards.png");
            background-position: 0 -291px;
            background-repeat: no-repeat;
            position: absolute;
            top: 3px;
            left: 4px;
        }

        .card-type.mastercard {
            background-position: 0 0;
        }

        .card-type.visa {
            background-position: 0 -115px;
        }

        .card-type.amex {
            background-position: 0 -57px;
        }

        .card-type.discover {
            background-position: 0 -174px;
        }

        .card-valid {
            position: absolute;
            top: 0;
            right: 15px;
            line-height: 60px;
            font-size: 40px;
            font-family: 'icons';
            color: #ccc;
        }

        .card-valid.active {
            color: green;
        }

        .card-details {
            width: 100%;
            text-align: left;
            margin-bottom: 30px;
            transition: 300ms ease;
        }

        .card-details input {
            font-size: 30px;
            padding: 15px;
            box-sizing: border-box;
            width: 100%;
        }

        .card-details input.error {
            border: 1px solid #2eca6a;
            box-shadow: 0 4px 8px 0 rgba(238, 76, 87, 0.3);
            outline: none;
        }

        .card-details .expiration {
            width: 50%;
            float: left;
            padding-right: 5%;
        }

        .card-details .cvv {
            width: 45%;
            float: left;
        }
    </style>
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
                    View Offers & Pay
                </h2>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="viewoffer.php?id=<?php echo $id;?>" method="POST">
                        <input type="hidden" name="c_id" id="c_id" value="<?php echo $id; ?>">

                        <div class="table-responsive">
                            <table class="table table-bordered tableexample">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Offer Description</th>
                                        <th>Offer Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                    <td><input required type='radio' name='offer' value='" . $row["idoffers"] . "'/></td>
                                                    <td>" . $row["name"] . "</td>
                                                    <td>" . $row["odescription"] . "</td>
                                                    <td>" . $row["price"] . "</td>
                                                </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex">
                            <div class="card-bounding mt-3 justify-content-center" id="visacard">

                                <aside>Card Number:</aside>
                                <div class="card-container">
                                    <!--- ".card-type" is a sprite used as a background image with associated classes for the major card types, providing x-y coordinates for the sprite --->
                                    <div class="card-type"></div>
                                    <input placeholder="0000 0000 0000 0000" id="t" onkeyup="$cc.validate(event)" name="creditcard" />
                                    <!-- The checkmark ".card-valid" used is a custom font from icomoon.io --->
                                    <div class="card-valid">&#x2713;</div>
                                </div>

                                <div class="card-details clearfix">

                                    <div class="expiration">
                                        <aside>Expiration Date</aside>
                                        <input onkeyup="$cc.expiry.call(this,event)" maxlength="7" name="expiration_date" placeholder="mm/yyyy" />
                                    </div>

                                    <div class="cvv">
                                        <aside>CVV</aside>
                                        <input placeholder="XXX" name="cvv" />
                                    </div>

                                </div>


                            </div>
                        </div>
                        
                        <input type="submit" value="Submit" name="submit" class="btn mt-4">
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