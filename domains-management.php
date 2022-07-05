<?php 
include 'functions/session.php';

$date = date('d-m-Y');
$date = strtotime($date);
$new_date = strtotime('+ 1 year', $date);
$yearFromNow = date('d-m-Y', $new_date);
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Manager - Marketing</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styling --> 

  <style>
  .card-body {  
  overflow-y: auto;
}
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div id="lord<?php echo $u_id ?>" class="sidebar-brand-text mx-3"><?php echo $u_name ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item pointer" id="dashboard">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>

      <!-- Nav Item - Hours Checker -->
      <li class="nav-item pointer" id="workingHours">
        <a class="nav-link" href="hours.php">
          <i class="fas fa-fw fa-clock"></i>
          <span>Working Hours</span></a>
      </li>

      <!-- Nav Item - Hours Checker -->
      <li class="nav-item pointer active" id="departureBudget">
        <a class="nav-link" href="domains-management.php">
          <i class="far fa-window-maximize"></i>
          <span>Domains Management</span></a>
      </li>       

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

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

          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">   
            
          <div class="timeAndDate">
              <p id="timeAndDate">           
                     
              </p>
          </div>
          
              

            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $u_name ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">                
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Main Content -->

        <!-- Begin Page Content -->
        <div id="section" class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" id="pageTitle">Domains Management</h1>
            <a href="downloadReport.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Generate Report <i class="fas fa-download fa-sm text-white-50"></i></a>
          </div>

          <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment for Domains</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="payDom">$0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Domains</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="actDom">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-window-maximize fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Soon Expire Domains</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="expDom">0</div>
                        </div>                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-window-close fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Servers Accounts</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="serDom">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-server fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Brands</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="braDom">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">General Blogs</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="genDom">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-blog fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

         

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List Of Domains</h6>                  
                </div>
                <!-- Card Body -->
                <div class="card-body" style="height: 555px;">
                  <div class="chart-area">
                  <table border="1" id="theTableOfDomains" width="100%">

<tr>
<th>Url</th>
<th onclick="sortByDate()" id="sortDateButton" class="pointer">Date Of Expiration</th>
<th>Domain Settings</th>
</tr>
<tbody id="ourDomains">
</tbody>
</table>
<!-- DivTable.com -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-3 col-lg-4">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Inform on a new Domain:</h6>                  
                  <p class="anyMessages" id="anyMessages"></p>                  
                </div>
                <!-- Card Body -->
                <div class="card-body row" id="domainsForm">                  
                  <div class="col-xl-12 col-md-12 text-left small">                    
                    <input type="text" class="domainInput" placeholder="Name of the domain" name="dTitle" id="dTitle">                     
                  </div>  
                  <div class="col-xl-12 col-md-12 text-left small">                    
                    <input type="text" class="domainInput" placeholder="Url Address" name="dUrl" id="dUrl">                     
                  </div>                    
                  <div class="col-xl-12 col-md-12 text-left small">                    
                    <input type="number" placeholder="Annual Domain price ($USD):" class="domainInput"  name="dPrice" id="dPrice">                     
                  </div>
                  <div class="col-xl-12 col-md-12 text-left small">                                        
                    <select name="dSupplier" class="domainInput" id="dSupplier">
                  <option value="0" disabled selected>Domain Supplier:</option>
                  <option value="gd-179884774">Godaddy - 179884774</option>
                  <option value="gd-177590709">Godaddy - 177590709</option>
                  <option value="gd-123253606">Godaddy - 123253606</option>
                  <option value="gd-103439344">Godaddy - 103439344</option>
                  <option value="gd-171242917">Godaddy - 171242917</option>
                  <option value="gd-171247078">Godaddy - 171247078</option>
                  <option value="nc-Nmchpacntt">NameCheap - Nmchpacntt</option>                                    
                  </select>                    
                  </div>
                  <div class="col-xl-12 col-md-12 text-left small">                                        
                    <select name="dServer" class="domainInput" id="dServer">
                  <option value="0" disabled selected>Choose Server:</option>
                  <option value="not">Not settled yet</option>
                  <option value="digitalOcean">Digital Ocean</option>
                  <option value="siteground">Site Ground</option>                  
                  <option value="hetzner">Hetzner</option>                    
                  </select>                    
                  </div>
                  <div class="col-xl-12 col-md-12 text-left small">                    
                  <select name="dCategory" class="domainInput" id="dCategory">
                  <option value="0" disabled selected>Choose Domain Purpose:</option>
                  <option value="brand">Brand</option>
                  <option value="company">Company</option>                  
                  <option value="general">General Blog</option>                  
                  <option value="marketing">Marketing</option>                  
                  <option value="pr">Brand Reputation</option>                  
                  <option value="affiliate">Affiliate</option>                  
                  </select>                    
                  </div>
                  <div class="col-xl-4 col-md-4 text-left small">
                    <p style="padding: 15px 0px 0px 10px; color: #000; font-size: 16px;"> Expiry date: </p>                    
                  </div>
                  <div class="col-xl-8 col-md-8 text-left small">
                    <input type="date" value="<?php echo $yearFromNow ?>" class="domainInput"  name="dExpirationDate" id="dExpirationDate">                     
                  </div>
                  <div class="col-xl-12 col-md-12 text-left small"> 
                  <select name="dRenew" class="domainInput" id="dRenew">
                  <option value="0" disabled selected>Renew Active:</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>                  
                  </select>
                  </div>
                  <div class="col-xl-12 col-md-12 text-left small"> 
                  <select name="dProtected" class="domainInput" id="dProtected">
                  <option value="0" disabled selected>Protected Domain:</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>                  
                  </select>   
                  </div>
                  <div class="col-xl-12 col-md-12 mt-3 text-center small">                    
                    <input type="submit" value="Add New Domain" name="newDomain" id="newDomain"> 
                    </label>
                  </div>                    
                </div>                
              </div>              
            </div>
          </div>        

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-9 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Soon Expire Domains</h6>
                </div>
                <div class="card-body">
                <table border="1" id="theTableOfExpires" width="100%">
                <tr>
                <th>Url</th>
<th onclick="sortByDate()" id="sortDateButton" class="pointer">Date Of Expiration</th>
<th>Domain Settings</th>
</tr>
<tbody id="ourExpiredDomains">
</tbody>
</table>
                </div>
              </div>              
            </div>

            <div class="col-lg-3 mb-4">             

              <!-- Notes -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary" style="display: inline;">Notes about domains</h6>
                  <button class="writeNote" id="writeNote" style="float: right;" data-toggle="modal" data-target="#theNoteLoader">Write A Note</button>                                   
                </div>
                <div class="card-body" id="notesZone">

                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->





           


        <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>Copyright &copy; rom-marketing.com - marketing department 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

<!-- Modal of the hours -->

<div class="modal fade" id="domainSettings" tabindex="-1" aria-labelledby="domainSettings" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">      
        <h5 class="modal-title" id="domainSettingHeader"></h5>
        <div name="theId"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="inputModalHeight">Domain Purpose:                                 
        <select class="domainInputOfModalAnswers" id="dimp">                  
        <option value="brand">Brand</option>
        <option value="company">Company</option>                  
        <option value="general">General Blog</option>                  
        <option value="marketing">Marketing</option>                  
        <option value="pr">Brand Reputation</option>                  
        <option value="affiliate">Affiliate</option>                  
        </select>   
      </div>           
        <div class="inputModalHeight">Domain Price (Annual): <span style="position: absolute; right: 28%; font-weight: bold; color: #000;">$</span><input type="number" class="domainInputOfModalNumber" id="dipa"></div>        
        <div class="inputModalHeight"> Domain Supplier: 
          <select class="domainInputOfModalAnswers" id="dsup">                  
                  <option value="gd-179884774">Godaddy - 179884774</option>
                  <option value="gd-177590709">Godaddy - 177590709</option>
                  <option value="gd-123253606">Godaddy - 123253606</option>
                  <option value="gd-103439344">Godaddy - 103439344</option>
                  <option value="gd-171242917">Godaddy - 171242917</option>
                  <option value="gd-171247078">Godaddy - 171247078</option>
                  <option value="nc-Nmchpacntt">NameCheap - Nmchpacntt</option>                                    
                  </select> 
                </div>        
        <div class="inputModalHeight"> Domain Server:
        <select class="domainInputOfModalAnswers" id="dser">                  
                  <option value="digitalOcean">Digital Ocean</option>
                  <option value="siteground">Site Ground</option>                  
                  <option value="hetzner">Hetzner</option>                    
                  </select> 
        </div>        
        <div class="inputModalHeight" >Expiry Date: <input type="date" class="domainInputOfModalAnswers" id="dexp"></div>        
        <div class="makeThemCenter inputModalHeight">Domain Revew: <input type="checkbox" class="pointer inputCheckBoxesModalDomain" name="drenewChecker" id="drenewChecker"></div>        
        <div class="makeThemCenter inputModalHeight">Domain Protected: <input type="checkbox" class="pointer inputCheckBoxesModalDomain" name="dprotectedChecker" id="dprotectedChecker"></div>                
      </div>
      <div class="modal-footer" id="modalFooter">      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>      
    </div>
  </div>
</div>




  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Adding the functions JS -->
  <script src="js/functions.js"></script>

  <!-- Adding the Domains JS -->
  <script src="js/requestsDomains.js"></script>  
  <script src="js/requestsNotes.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

   <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>


</body>

</html>
