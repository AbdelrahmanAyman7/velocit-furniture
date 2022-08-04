<?php
ob_start();
session_start();

include('connection.php');

$query = "SELECT * FROM categories";

$result = mysqli_query($con, $query);

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
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
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



  <!-- brand section -->

  <section class="brand_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Make A Request
        </h2>
      </div>
      <?php
                        if(isset($_SESSION['r_message'])){
                            echo '<div class="alert alert-success">'.$_SESSION["r_message"].'</div>';
                        }
                        else if(isset($_SESSION['er_message'])){
                            echo '<div class="alert alert-danger">'.$_SESSION["er_message"].'</div>';
                        }
                    ?>
      <form method="POST" action="addrequest.php" enctype="multipart/form-data">
      <div class="brand_container layout_padding2" id="categories">
        
      <?php
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '
                    <div class="box">    
                        <div class="new p-0" style="background-color: whitesmoke;width:50px;height:40px;">
                            <input type="checkbox" name="checkboxes['.$row['idcategories'].']" id="checkbox_'.$row['idcategories'].'" class="form-control">
                        </div>
                        <div class="img-box">
                            <img src="uploads/'.$row['cimage'].'" width="155px" height="163px" style="border-radius:10px;">
                            </div>
                            <div class="detail-box">
                            <h6 class="price mt-2">
                            '.$row['cname'].'
                            </h6>
                            <div style="display:none;" class="mt-1" id="quantity_'.$row['idcategories'].'">
                                <span>Quantity</span>
                                <input type="number" id="quantity-'.$row['idcategories'].'" min="0" class="form-control ml-1"  name="quantity['.$row['idcategories'].']"/>
                            </div>
                            <div id="hidden_values_'.$row["idcategories"].'" class="d-none">
                            </div>
                        </div>
                    </div>';
            }
        }

?>

      </div>
      <div class="row">
        <div class="form-group col-md-6">
            <label>From Location</label>
            <input type="text" class="form-control" required name="from_location">
        </div>
        <div class="form-group col-md-6">
            <label>To Location</label>
            <input type="text" class="form-control" required name="to_location">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6">
            <label>Pick your images</label>
            <input type="file" class="form-control" required multiple name="upload[]">
        </div>
        <div class="form-group col-md-6">
            <label>Delivery Date</label>
            <input type="date" class="form-control" name="delivery_date" id="delivery_date">
            <div id="error_m">

            </div>
        </div>
      </div>

      <div class="form-group">
        <input type="submit" value="Send Request" id="submit" name="submit" class="btn btn-success">
      </div>
      </form>
    </div>
  </section>

  <!-- end brand section -->


<?php
    include('footer.php');
?>


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
    btn.click(function (e) {

      e.preventDefault();
      nav.toggleClass("lg_nav-toggle");
      document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style")
    });
  </script>
  <script>
    $('.carousel').on('slid.bs.carousel', function () {
      $(".indicator-2 li").removeClass("active");
      indicators = $(".carousel-indicators li.active").data("slide-to");
      a = $(".indicator-2").find("[data-slide-to='" + indicators + "']").addClass("active");
      console.log(indicators);

    })
  </script>
  
  <script>
      $(document).ready(function(){
        $("#categories").change(function(e){
            var el = e.target;

            var element_id = el.id;

            var elementType = document.getElementById(element_id).type;

            var splitted = element_id.split("_")[1];

            if(elementType == "checkbox"){
                var all_quantity_element_required = "#quantity_"+splitted;
                var all_quantity_element_required2 = "#quantity-"+splitted;
                if(el.checked){
                    $(all_quantity_element_required).attr("style", "display:flex");
                    $(all_quantity_element_required2).prop('required',true);
                    $("#hidden_values_"+splitted).html('<input type="hidden" value="'+splitted+'" name="categories[]">');
                }
                else{
                    $(all_quantity_element_required).attr("style", "display:none");
                    $(all_quantity_element_required2).prop('required',false);
                    $("#hidden_values_"+splitted).html("");
                }
            }

        });

        $("#delivery_date").change(function(){
            var date_val = new Date($("#delivery_date").val());
            var today = new Date();

            if(date_val< today){
                $("#error_m").html('<span class="text-danger">The delivery date should be greater than current date</span>');
                $("#submit").attr("disabled", true);
            }
            else{
                $("#error_m").html('');
                $("#submit").attr("disabled", false);
            }
        });
      });

      
  </script>
</body>
</body>

</html>


<?php

if(isset($_POST["submit"])){

    $bool = false;

    //client_requests
    $idclient = $_SESSION['userid'];
    $from_location = $_POST["from_location"];
    $to_location = $_POST["to_location"];
    $delivery_date = $_POST["delivery_date"];
    $request_date = date('Y-m-d H:i:s');

    $query = "insert into client_requests (idclient,from_location,to_location,delivery_date,request_date) values ('$idclient','$from_location','$to_location','$delivery_date','$request_date')";

    $result = mysqli_query($con, $query);

    if($result){
        $bool = true;
    }else{
        $bool = false;
    }

    
    $idclientrequests = mysqli_insert_id($con);

    //requests files
    $files = array_filter($_FILES['upload']['name']); //Use something similar before processing files.
    // Count the number of uploaded files in array
    $total_count = count($_FILES['upload']['name']);
    // Loop through every file
    for( $i=0 ; $i < $total_count ; $i++ ) {
        //The temp file path is obtained
        $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES['upload']["name"][$i]);

        //echo $target_file.'<br>';

        if (isset($_FILES['upload']['tmp_name'][$i]) && $_FILES['upload']['tmp_name'][$i] != "") {
            if (move_uploaded_file($_FILES['upload']['tmp_name'][$i], $target_file)) {
                $profile_pic = time() . basename($_FILES['upload']["name"][$i]);
                $query = "insert into requests_files (idclientrequests,file) values ('$idclientrequests','$profile_pic')";

                $result = mysqli_query($con, $query);
                if($result){
                    $bool = true;
                }else{
                    $bool = false;
                }
            }
        }
    }


    //requests elements
    
    foreach($_POST['categories'] as $idcategory){

        $query = "insert into requests_elements (idclientrequests,idcategory,quantity) values ('$idclientrequests','$idcategory','".$_POST["quantity"][$idcategory]."')";

        $result = mysqli_query($con, $query);
        if($result){
            $bool = true;
        }else{
            $bool = false;
        }

    }

    if($bool == true){
        $_SESSION['r_message'] = 'Your request is sent successfully';
        header('Location: addrequest.php');
    }
    else{
        $_SESSION['rc_message'] = 'Your request is not added successfully, try again !!!!';
        header('Location: addrequest.php');
    }


}


?>