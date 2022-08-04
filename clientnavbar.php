<?php
ob_start();
?>
<!-- header section strats -->
<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="#">
                <img src="images/logo-1.png" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  ">
                    <li class="nav-item">
                        <a class="nav-link" href="addrequest.php"> Add Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewrequests.php"> View Requests</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="viewquestions.php"> View Questions</a>
                    </li>
                </ul>
                <div class="user_option">
                    <a href="logout.php">
                        <img src="images/user.png" alt="">
                        <span><?php echo $_SESSION['username'];?></span>
                        <span class="ml-2">
                            Logout
                        </span>
                    </a>
                    <!-- <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                    </form> -->
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
<!-- end header section -->