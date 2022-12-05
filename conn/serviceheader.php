<?php
include 'connection.php';
session_start();
if (empty($_SESSION['id'])) {
    header('location: index.php');
}
$user_id =  $_SESSION['id'];

$user_name =   $_SESSION['name'];

$user_type    = $_SESSION['user_type'];
$c_count = "";
$s_count = "";
$required_resource = "";
$total_resource = "";
$sql = mysqli_query($conn, "SELECT * FROM user");
                // $total=mysqli_fetch_array($sql);
$resource = mysqli_query($conn, "SELECT COUNT(user_type) FROM user WHERE user_Type='customer'");
$resource = mysqli_fetch_array($resource);

$resource1 = mysqli_query($conn, "SELECT COUNT(user_type) FROM user WHERE user_Type='service_provide'");
$resource1 = mysqli_fetch_array($resource1);

$resource2 = mysqli_query($conn, "SELECT SUM(required_resource) FROM user");
$resource2 = mysqli_fetch_array($resource2);

$resource3 = mysqli_query($conn, "SELECT SUM(total_resource) FROM user");
$resource3 = mysqli_fetch_array($resource3);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery%20dashboard/jquery.min.js"></script>
    <script src="vendor/bootstrap_dashboard/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- <link href="css/profile.css"> -->

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <title>Dashboard</title>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                paging: false,
                scrollY: 400
            });
        });

        $(document).ready(function() {
            $('#myResponse').DataTable({
                paging: false,
                scrollY: 400
            });
        });
    </script>
    <style>
        /* ------------------ for flash msg -------------------- */
    #snackbar {
    		visibility: hidden;
    		min-width: 250px;
    		margin-left: -125px;
    		background-color: #4e73df;
    background-image: linear-gradient(180deg,#4e73df 10%,#224abe 100%);
    		color: #fff;
    		text-align: center;
    		border-radius: 2px;
    		padding: 16px;
    		position: fixed;
    		z-index: 1;
    		left: 50%;
    		/* bottom: 30px; */
			top:30px;
    		font-size: 17px;
    	}

    	#snackbar.show {
    		visibility: visible;
    		-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    		animation: fadein 0.5s, fadeout 0.5s 2.5s;
    	}

    	@-webkit-keyframes fadein {
    		from {
				top: 0;
    			/* bottom: 0; */
    			opacity: 0;
    		}

    		to {
    			top : 30px;
				/* bottom: 30px; */
    			opacity: 1;
    		}
    	}

    	@keyframes fadein {
    		from {
				top : 0 ;
    			/* bottom: 0; */
    			opacity: 0;
    		}

    		to {
				top:30px; 
    			/* bottom: 30px; */
    			opacity: 1;
    		}
    	}

    	@-webkit-keyframes fadeout {
    		from {
				top: 30px;
    			/* bottom: 30px; */
    			opacity: 1;
    		}

    		to {
				top:0;
    			/* bottom: 0; */
    			opacity: 0;
    		}
    	}

    	@keyframes fadeout {
    		from {
				top:30px;
    			/* bottom: 30px; */
    			opacity: 1;
    		}

    		to {
				top:0;
    			/* bottom: 0; */
    			opacity: 0;
    		}
    	}
        img.img-profile.rounded-circle {
    object-fit: cover;
} 
        div#myResponse_info {
            position: relative;
            top: 10px;
        }

        div#reply_modal_body {
            padding: 0px 43px;
        }

        .table.table.dataTable.no-footer {
            width: 1018px !important;
        }

        .input-group-append {
            position: relative;
            top: 9px;
            height: 44px;
        }

        input[type=text],
        select {
            width: 100%;
            padding: 4px 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }


        input[type=date],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        #submit_reply {
            width: 100%;
            background-color: #1cc88a;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #submit_add_rec {
            width: 100%;
            background-color: #1cc88a;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        #Add-res-form-div {
            /*       border-radius: 5px;*/
            background-color: #fff;
            /*  padding: 20px;*/
            position: relative;
            flex: 1 1 auto;
            /* min-height: 1px; */
            padding: 1.25rem;
            height: 41rem;
        }
    </style>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <script src="js/jquery.js"></script>  -->



</head>

<body id="page-top">
    <!-- current user details -->

    <input type="hidden" id="currentUserName" value="<php  echo  $_SESSION['name'];  ?>">
    <input type="hidden" id="currentUserId" value="<php  echo $_SESSION['id'];  ?>">
    <input type="hidden" id="currentUserType" value="<php   echo  $_SESSION['user_type'];?>">

    <!-- current user details end -->
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- <?php
                    // include"header.php"
                ; ?> -->
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="route.php?param=servicedashboard">
                    <i class="fa fa-home "></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="route.php?param=serviceResourceReq">
                    <i class="fa fa-paper-plane"></i>
                    <span>Resource Requests</span>
                </a>
                <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Send Request</h6>
                        <a class="collapse-item" onclick="resource_requests()"></a>
                        <a class="collapse-item" href="myResponse.php">My Response </a>
                        
                    </div>
                </div> -->
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="route.php?param=serviceMyResponse">
                    <i class="fa fa-reply"></i>
                    <span>My Response</span>
                </a>
                <!-- <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div> -->
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Addons
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item"> -->
                <!-- <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a> -->
                <!-- <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div> -->
            <!-- </li> -->

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php 
                                $query=mysqli_query($conn,"SELECT * FROM notification WHERE service_pro_id='$user_id' ORDER BY ID DESC LIMIT 3");
                               
                                ?>
                                <!-- <span class="badge badge-danger badge-counter">3+</span> -->
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notification
                                </h6>
                                <?php 
                             While($notification=mysqli_fetch_array($query)){
                                $date=$notification['datetime'];
                                $message=$notification['msg_to_service'];
                            
                            $Noti='<a class="dropdown-item d-flex align-items-center" href="route.php?param=serviceMyResponse">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">'.$date.'</div>
                                        <span class="font-weight-bold">'.$message.'</span>
                                    </div>
                                </a>'; echo $Noti;}
                               
                        
                                ?>
                                <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a> -->
                                <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a> -->
                                <a class="dropdown-item text-center small text-gray-500" href="route.php?param=serviceNotification">Show All Notification</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <!-- <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i> -->
                            <!-- Counter - Messages -->
                            <!-- <span class="badge badge-danger badge-counter">7</span> -->
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <?php
                                $query = mysqli_query($conn, "SELECT * from user where ID='$user_id'");
                                while ($img = mysqli_fetch_array($query)) {
                                    $profile = $img['image'];
                                    $name= $img['name'];
                                }
                                ?>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  $name; ?></span>
                                
                                <img class="img-profile rounded-circle" src="<?php echo $profile; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="route.php?param=serviceprofile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="route.php?param=serviceSetting">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="route.php?param=logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <script type="text/javascript">
                    function resource_requests() {
                        var a = document.getElementById("resource_requests");
                        if (a.style.display == "none") {
                            a.style.display = "block";
                        } else {
                            a.style.display = "none";
                        }
                    }
                </script>