<?php
ob_start();
session_start();

include('connection.php');

$query = "SELECT * FROM categories";

$result = mysqli_query($con, $query);

include('editcategory.php');

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
                    Categories
                </h2>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-bordered tableexample">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>
                                    <td>".$row["idcategories"]."</td>
                                    <td>".$row["cname"]."</td>
                                    <td>".$row["cdescription"]."</td>
                                    <td><img src='uploads/".$row["cimage"]."' height='150px' width='250px'/></td>
                                    <td>";
                                    echo '
                                    <button type="button" class="btn btn-success editbtn0"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
                                   ';
                                   echo"
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

            $('.editbtn0').on('click', function() {

                $('#editcategorymodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#m_id').val(data[0].replaceAll(' ', ''));
                $('#m_name').val(data[1]);
                $('#m_description').val(data[2]);

            });
        });
    </script>

</body>
</body>

</html>
