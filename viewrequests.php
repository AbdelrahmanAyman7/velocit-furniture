<?php
ob_start();
session_start();

include('connection.php');

if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 'client'){
    $query = "SELECT cr.*,u.*,o.price as oprice FROM client_requests cr LEFT JOIN offers o on o.idoffers = cr.offer_selected LEFT JOIN users u on u.idusers = cr.idclient WHERE cr.idclient='".$_SESSION["userid"]."'";

    $result = mysqli_query($con, $query);
}
else if(isset($_SESSION["userrole"]) && ($_SESSION["userrole"] == 'admin' || $_SESSION["userrole"] == 'company')){
    $query = "SELECT cr.*,u.*,o.price as oprice FROM client_requests cr LEFT JOIN offers o on o.idoffers = cr.offer_selected LEFT JOIN users u on u.idusers = cr.idclient";

    $result = mysqli_query($con, $query);
}
else{
    header('Location: index.php');
    exit();
}


//get all categories

$query2 = "SELECT * FROM categories order by idcategories";

$result2 = mysqli_query($con, $query2);

include('addoffer.php');

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
    <!-- font awesome style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        #usertype1,
        #usertype2 {
            height: 15px;
            width: 15px;
            background-color: transparent;
            box-shadow: none;
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
                    View Requests
                </h2>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_SESSION['o_message'])) {
                        echo '<div class="alert alert-success">' . $_SESSION["o_message"] . '</div>';
                    } else if (isset($_SESSION['eo_message'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION["eo_message"] . '</div>';
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered tableexample">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Request From Location</th>
                                    <th>Request To Location</th>
                                    <th>Request Delivery Date</th>
                                    <?php
                                    if (mysqli_num_rows($result2) > 0) {
                                        // output data of each row
                                        while ($row = mysqli_fetch_assoc($result2)) {
                                            echo "<th>" . $row["cname"] . "</th>";
                                        }
                                    }
                                    ?>
                                    <th>Requests Files</th>
                                    <th>Offer Selected</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                    <td>" . $row["idclient_requests"] . "</td>
                                    <td>" . $row["name"] . "</td>
                                    <td>" . $row["from_location"] . "</td>
                                    <td>" . $row["to_location"] . "</td>
                                    <td>" . $row["delivery_date"] . "</td>";

                                        $idcategories = [];
                                        $elementidcategories = [];

                                        $query3 = "SELECT * from categories c left join requests_elements re on re.idcategory = c.idcategories WHERE re.idclientrequests = '" . $row["idclient_requests"] . "' order by idcategories ";

                                        $result3 = mysqli_query($con, $query3);
                                        if (mysqli_num_rows($result3) > 0) {
                                            // output data of each row
                                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                                array_push($idcategories, $row2["idcategories"]);
                                                $elementidcategories[$row2["idcategories"]] = $row2;
                                            }
                                        }


                                        $queryy = "SELECT * from categories WHERE idcategories NOT IN ('" . implode("', '", $idcategories) . "')";
                                        $resultt = mysqli_query($con, $queryy);


                                        if (mysqli_num_rows($resultt) > 0) {
                                            // output data of each row
                                            while ($roww = mysqli_fetch_assoc($resultt)) {
                                                $elementidcategories[$roww["idcategories"]] = "";
                                            }
                                        }
                                        //var_dump($elementidcategories);
                                        ksort($elementidcategories);

                                        foreach ($elementidcategories as $elem) {
                                            if ($elem && !empty($elem)) {
                                                echo "<td>" . $elem["quantity"] . "</td>";
                                            } else {
                                                echo "<td></td>";
                                            }
                                        }


                                        $query4 = "SELECT * from requests_files  WHERE idclientrequests = '" . $row["idclient_requests"] . "'";

                                        $result4 = mysqli_query($con, $query4);
                                        echo "<td>";
                                        if (mysqli_num_rows($result4) > 0) {
                                            // output data of each row
                                            while ($row3 = mysqli_fetch_assoc($result4)) {
                                                echo '<a href="uploads/' . $row3["file"] . '" class="ml-1" download><i class="fa fa-download"></i></a>';
                                            }
                                        }
                                        echo "
                                            </td>
                                            <td>".$row["oprice"]."</td>
                                            <td class='d-flex'>";

                                        $actions = "";


                                        if ($_SESSION['userrole'] == 'client') {
                                            if(isset($row["paid"]) && (int)$row["paid"] == 1){
                                                $actions = '<a type="button" class="btn btn-success" href="contactcompany.php?id='.$row["idclient_requests"].'"> <i class="fa fa-reply" style="color:white;"></i></a>';
                                            }
                                            else{
                                                $actions = '<a type="button" class="btn btn-success" href="viewoffer.php?id='.$row["idclient_requests"].'"> <i class="fa fa-eye" style="color:white;"></i></a>';
                                            }
                                        } 
                                        else if ($_SESSION['userrole'] == 'company' && !isset($row["oprice"])) {
                                            $actions = '<a type="button" class="btn btn-dark offerbtn mr-2"> <i class="fa fa-plus" style="color:white;"></i></a>';
                                        }

                                        echo $actions;


                                        echo "
                                    </td>
                                  </tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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

    <script>
        $(document).ready(function() {
            $(".tableexample").DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.offerbtn').on('click', function() {

                $('#addoffermodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#c_id2').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.viewbtn0').on('click', function() {

                $('#viewoffermodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#c_id').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>

</body>
</body>

</html>