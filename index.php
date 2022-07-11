<?php 
include 'functions/session.php';

$thisyear = date("Y");
$thisMonth = date("m");
$timenow = date("H:i");
$today = date("Y-m-d");



?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ron Dayan">
  <title>Working Time Checker</title>

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

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="mr-2 d-none d-lg-inline text-gray-600 large">You are currently working at <span style="font-weight: bold;" id="theCompanyName"><?php echo $u_company_name ?></span></div>
        <button class="btn btn-danger" id="editComapnyName" style="float: left;" data-toggle="modal" data-target="#editCompanyNameLoader" onclick="getAllCompanies(<?php echo $u_id ?>);">Edit Company Info</button>                                           
        <button class="btn btn-secondary" id="addComapnyName" style="float: left; margin: 0 15px;" data-toggle="modal" data-target="#addCompanyNameLoader">Add New Company</button>                                           
        
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="userName"><?php echo $u_name ?></span>
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
            <h1 class="h3 mb-0 text-gray-800" id="pageTitle">Working Hours</h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="downloadPDF()">Generate Report <i class="fas fa-download fa-sm text-white-50"></i></button>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Expect monthly working hours -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Expect monthly working hours</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="hoursOfWork"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- How much did you work that month? -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">How much did you work that month?</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="hoursIDid"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- How many hours left to complete this month -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">How many hours left to complete this month</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="hoursLeftToDo"></div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" id="precentOfTime" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- How many days did you work this month? -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">How many days did you work this month?</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="daysOfWork"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <!-- New Dash Row -->

          <!-- How Many free days I have? -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">How many free day I have? </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="freeDaysIHave">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="far fa-smile-beam fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Free days I used this month -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #6e707e !important;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Free days I used this month</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="freeDaysIDid">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-sun fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- How many sick days I have? -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #c717e5 !important;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">How many sick days I have?</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="sickDaysIHave">0</div>
                        </div>                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-head-side-virus fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Sick days I used this month -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #3ef5f6 !important;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sick days I used this month</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="sickDaysIDid">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-head-side-cough fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>



          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Hours Overview Table</h6>
                  <p class="confirmMsg" id="confirmMsg"></p>                      
                  <select name="months" class="fixMonthsSelect" id="months" onchange="getWorkdaysByDates(<?php echo $u_id ?>, 0, 0)">
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                  </select>
                  <select name="years" id="years" onchange="getWorkdaysByDates(<?php echo $u_id ?>, 0, 0)">
                  <option value="2026">2026</option>
                  <option value="2025">2025</option>
                  <option value="2024">2024</option>
                  <option value="2023">2023</option>
                  <option value="2022">2022</option>
                  <option value="2021" selected>2021</option>
                  <option value="2020">2020</option>
                  <option value="2019">2019</option>                  
                  </select>
              
                  

 
                </div>
                <!-- Card Body -->
                <div class="card-body" style="min-height: 426px;">
                  <div class="chart-area">
                  <table border="1" id="theTableOfHours" width="100%">

<tr>
<th onclick="sortByDate()" id="sortDateButton" class="pointer">↓ Date</th>
<th>Start At</th>
<th>Finish At</th>
<th>Total Time</th>
<th>Update</th>
<th>Delete</th>
</tr>
<tbody id="myHours">
</tbody>
</table>
<!-- DivTable.com -->
                  </div>
                </div>
              </div>
            </div>

            
            <div class="col-xl-6 col-lg-5">

            <!-- Checking hours card -->

              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Hours Informer</h6>                  
                  <p class="anyMessages" id="anyMessages"></p>                  
                </div>
                <!-- Card Body -->
                <div class="card-body row">                  
                  <div class="col-xl-3 col-md-3 text-center small">
                    <label for="inhour">Start: <br>
                    <input type="time" min="08:00" max="19:00" value="<?php echo $timenow ?>" name="inhour" id="inhour"> 
                    </label>
                  </div>  
                  <div class="col-xl-3 col-md-3 text-center small">
                    <label for="inhour">End: <br>
                    <input type="time" min="08:00" max="19:00" value="18:00" name="outhour" id="outhour"> 
                    </label>
                  </div>  
                  <div class="col-xl-3 col-md-3 text-center small">
                    <label for="inhour">date: <br>
                    <input type="date" value="<?php echo date('Y-m-d') ?>" name="dateofhours" id="dateofhours"> 
                    </label>
                  </div> 
                  <div class="col-xl-3 col-md-12 mt-3 text-center small">                    
                    <input type="submit" value="Add Work Day" name="workday" id="workday"  onclick='insertWorkday(<?php echo $u_id ?>)'> 
                    </label>
                  </div>                    
                </div>                
              </div> 
              
              <!-- Checking sick days card -->
              
              <div class="col-xl-12 col-sm-12 card shadow mb-4" style="display: inline-block;">

                <!-- Sick day informer -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Sick day informer</h6>                   
                </div>
                <!-- Card Body -->
                <div class="card-body row">                    
                  <div class="col-xl-3 col-md-3 text-center small">
                    <label for="inhour">date: <br>
                    <input type="date" value="<?php echo date('Y-m-d') ?>" name="dateofSickDays" id="dateofSickDays"> 
                    </label>
                  </div> 
                  <div class="col-xl-9 col-md-12 mt-3 text-right small">                    
                    <input type="submit" value="Add Sick Day" name="sickday" id="sickday"  onclick='insertSickDays(<?php echo $u_id ?>)'> 
                    </label>
                  </div>                    
                </div>                
              </div>   


              
              
              <div class="col-xl-12 col-sm-12 card shadow mb-4" style="display: inline-block;">
              
                <!-- Free day informer -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Free day informer</h6>                                    
                </div>
                <!-- Card Body -->
                <div class="card-body row">                    
                  <div class="col-xl-3 col-md-3 text-center small">
                    <label for="inhour">date: <br>
                    <input type="date" value="<?php echo date('Y-m-d') ?>" name="dateofFreeDays" id="dateofFreeDays"> 
                    </label>
                  </div> 
                  <div class="col-xl-9 col-md-12 mt-3 text-right small">                    
                    <input type="submit" value="Add Free Day" name="freeday" id="freeday"  onclick='insertFreeDays(<?php echo $u_id ?>)'> 
                    </label>
                  </div>                    
                </div>                
              </div>   


            </div>
          </div>        

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Year Calendar</h6>
                </div>
                <div class="card-body" style="padding: 5px;">
                <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Europe%2FLondon&amp;src=Y18wMjVza29iZDUxN2ZnYm9ycWc5ZHV0bzV1Z0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=ZW4udWsjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%239E69AF&amp;color=%230B8043&amp;showTitle=0&amp;showNav=1&amp;showDate=1&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0" style="border:solid 1px #777; margin-left: 20px;" width="95%" height="500" frameborder="0" scrolling="no"></iframe>
                </div>
              </div>
              
            </div>

            <div class="col-lg-6 mb-4">             

              <!-- Notes -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary" style="display: inline;">Notes about working hours</h6>
                  <button class="writeNote" id="writeNote" style="float: right;" data-toggle="modal" data-target="#theNoteLoader">Write A Note</button>                                   
                </div>
                <div class="card-body" id="notesZone">
                  
                  <!-- <div class="row notes">
                          <div class="col-xl-1 col-md-1 text-center medium">
                          <i class="fas fa-sticky-note"></i>                            
                          </div>                          
                          <div class="col-xl-11 col-md-11 medium">                          
                            <p> This october, there is october fest in gemany and we are in israel! </p>                  
                          </div>                          
                  </div>                   -->

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>Copyright &copy; Ron Dayan - <?php echo date("Y"); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

      </div>
      <!-- End of Main Content -->



      
<!-- Modal of the hours -->

<div class="modal fade" id="theFixer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">      
        <h5 class="modal-title" id="fixDate">Modal title</h5>
        <div name="theId"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <label>Start At: <input type="time" id="fixInHour" class="fixInputOfTime"></label>
        <label style="float: right;">Finish At: <input type="time" id="fixOutHour" class="fixInputOfTime"></label>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="updateWorkdayBtn">Update changes</button>
      </div>      
    </div>
  </div>
</div>


<!-- Modal of the Notes -->

<div class="modal fade" id="theNoteLoader" tabindex="-1" aria-labelledby="modalNotes" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">      
        <h5 class="modal-title" id="fixDate">Write a Note for the team:</h5>
        <div name="theId"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <label>
        <select name="nicon" id="nicon">
        <option value="0" disabled selected>Choose level for message</option>
        <option value="n1">Urgent!</option>
        <option value="n2">Very Important</option>
        <option value="n3">Important</option>
        <option value="n4">Regular Note</option>
        <option value="n5">By the way message</option>
        </select>
        
        </label>
        <label style="float: right;">Message: <textarea id="ndesc" name="ndesc" rows="4" cols="50"></textarea></label>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="submitNote" onclick="insertNote(<?php echo $u_id ?>)">Submit</button>
      </div>      
    </div>
  </div>

  <!-- End of Main Content --> 
  
  

   


</div>
           


        

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

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


  <!-- Modal of Company Name -->


  <div class="modal fade" id="editCompanyNameLoader" tabindex="-1" aria-labelledby="modalComapnyName" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">      
        <h5 class="modal-title" id="modalComapnyName">Add / Edit your company info:</h5>
        <div name="theId"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
      
        <div class="row">
          <div class="col-7">
          <h5 style="padding-left: 10px; margin: 20px;">Current workplace:</h5>
          </div>
          <div class="col-5">
          <select name="selectCompanyName" id="selectCompanyName" style="margin: 18px 0;" onchange="setCompany(<?php echo $u_id ?>,this.value);">
        <option id="theChoosenSelectedCompnay" value="<?php echo $u_company_name ?>" selected><?php echo $u_company_name ?></option>        
        </select>  
          </div>        
        </div>
                  
        <hr>
        

        <p style="padding-left: 10px; margin: 20px 0;">Start of work: <span id="startDateOfWork"><?php echo $u_start_date ?></span></p>
      <label style="padding-left: 10px; margin-right: 10px;"> Change date of begin:
      <input type="date" name="editCompanyStartDate" id="editCompanyStartDate" value="<?php echo $u_start_date ?>" onchange="setNewCompanyStartDate(<?php echo $u_id ?>, this.value)"/>               
      </label>

      <hr>
        
      <label style="padding-left: 10px; margin-right: 10px;"> Monthly Hours of work (A Month):
      <input type="number" name="updateHoursOfWork" id="updateHoursOfWork" placeholder="186" value="186" onchange="updateHoursOfWork(<?php echo $u_id ?>, this.value)"/>               
      </label>

      <hr>
        
      <label style="padding-left: 10px; margin-right: 10px;"> Free days (A Year):
      <input type="number" name="updateFreeDays" id="updateFreeDays" placeholder="12" value="12" onchange="updateFreeDays(<?php echo $u_id ?>, this.value)"/>               
      </label>

      <hr>
        
      <label style="padding-left: 10px; margin-right: 10px;"> Sick days (A Year):
      <input type="number" name="updateSickDays" id="updateSickDays" placeholder="12" value="12" onchange="updateSickDays(<?php echo $u_id ?>, this.value)"/>               
      </label>


      </div>



      <div class="modal-footer">      
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="setNewNumbers();">Save</button>
      </div>      
    </div>
  </div>
</div>
  

  <!-- End of edit Company Name -->  



  <!-- Modal of Add Company Name -->


  <div class="modal fade" id="addCompanyNameLoader" tabindex="-1" aria-labelledby="modalComapnyName" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">      
        <h5 class="modal-title" id="modalComapnyName">Add new company info:</h5>
        <div name="theId"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">         

        <div class="row">
          <div class="col-12">
          <input type="text" class="companyNameInput" name="newCompanyName" id="newCompanyName" placeholder="Company Name..."/>
          </div>          
        </div>        
      
        <hr>
        
      <label style="padding-left: 10px; margin-right: 10px;"> Start of work:
      <input type="date" name="addCompanyStartDate" id="addCompanyStartDate" value="<?php echo $today ?>"/>               
      </label>
      </div>



      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button class="btn btn-primary" data-dismiss="modal" onclick="addNewCompany(<?php echo $u_id ?>)">Add company</button>               
      </div>      
    </div>
  </div>
  <input type="hidden" id="theUserId" value="<?php echo $u_id ?>" />
</div>
  

  <!-- End of add Company Name --> 



  <!-- Adding the functions JS -->
  <script src="js/functions.js"></script>

  <!-- Adding the functions JS -->
  <script src="js/requestsHours.js"></script>  
  <script src="js/requestsNotes.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

 

<!-- Call workdays -->
<script>
selectOption(<?php echo $thisMonth ?>, <?php echo $thisyear ?>);
getWorkdaysByDates(<?php echo $u_id ?>, <?php echo $thisMonth ?>, <?php echo $thisyear ?>);
getNotes(<?php echo $u_id ?>);
</script>
   


</body>

</html>
