<?php
ob_start();
?>
 <div class="modal fade"  id="addoffermodal" tabindex="-1" role="dialog" aria-labelledby="addoffermodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addoffermodalLabel"> Add Offer </h5>
                    <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> -->
                </div>
                <form action="addoffer.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <input type="hidden" name="c_id2" id="c_id2">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <label for="exampleInputName1">Price</label>
                                <input type="number" step="any" required name="price" class="form-control" id="price">
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea required name="description" id="m_description" class="form-control" style="resize: none; height:150px" rows="50"></textarea>
                            </div>
                            
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit" name="update">Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["update"])) {
            session_start();
            include("connection.php");

            $idcompany = $_SESSION["userid"];

            $c_id = $_POST["c_id2"];

            if($c_id != ""){

                $price = $_POST['price'];
                $mdescription = $_POST['description'];
            
            
            
                 
                $query = "INSERT INTO offers(price, odescription, idcompany, idclientrequests) VALUES ('$price','$mdescription', '$idcompany', '$c_id')";

                $result = mysqli_query($con, $query);
                


                
                if ($result) {
                    $_SESSION['o_message'] = "Your offer is added successfully";
                    header("Location: viewrequests.php");
                    exit();
                } else {
                    $_SESSION['eo_message'] = "Your offer is not added!!!, try again";
                    header("Location: viewrequests.php");
                    exit();
                }

            }
            
            
            
        }


    ?>