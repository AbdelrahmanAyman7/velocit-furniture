<?php
ob_start();
?>
 <div class="modal fade"  id="replymessagemodal" tabindex="-1" role="dialog" aria-labelledby="replymessagemodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="replymessagemodalLabel"> Reply Message </h5>
                    <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> -->
                </div>
                <form action="replymessage.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <input type="hidden" name="r_id" id="r_id">
                       
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Message</label>
                                <textarea required name="description" id="m_description" class="form-control" style="resize: none; height:150px" rows="50"></textarea>
                            </div>
                            
                        </div>

                        <div class="row">


                            <div class="form-group col-md-12">
                                <label for="exampleInputPassword1">File </label>
                                <input type="file"  name="fileToUpload" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit" name="update">Reply</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["update"])) {
            include("connection.php");

            $r_id = $_POST["r_id"];

            $profile_pic = "";

            if($r_id != ""){

                $mdescription = $_POST['description'];
            
            
            
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
            
            
                if($profile_pic != ""){
                    $query = "UPDATE client_requests_messages SET replymessage = ?,replyfile = ? WHERE idclient_requests_messages = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["r_id"];

                    $stmt->bind_param('ssi', $mdescription,$profile_pic, $id);

                    $stmt->execute();

                }
                else{
                    $query = "UPDATE client_requests_messages SET replymessage = ? WHERE idclient_requests_messages = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["r_id"];

                    $stmt->bind_param('si', $mdescription, $id);

                    $stmt->execute();

                }


                
                if ($stmt) {
                    $_SESSION['c_message'] = 'Your reply is sent successfully';
                    header("Location: viewquestions.php");
                    exit();
                } else {
                    $_SESSION['ec_message'] = 'Your reply is not sent!!!, try again';

                    header("Location: viewquestions.php");
                    exit();
                }

                //echo var_dump($stmt);
            }
            
            
            
        }


    ?>