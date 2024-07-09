<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>

    <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap"
      rel="stylesheet"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <link rel="stylesheet" href="Style_Dashboard.css" type="text/css" />
  </head>
  <body>
    <section>
      <div class="left-div">
        <br />
        <h2 class="logo">Eco<span style="font-weight: 100">Clean</span></h2>
        <hr class="hr" />
        <ul class="nav">
          <li class="active">
            <a href="#" id="section_requests"><i class="fa fa-user"></i> Requests</a>
          </li>
          <li>
            <a href="#" id="section_registered"><i class="fa fa-user"></i> Registered</a>
          </li>
          <li>
            <a href="#" id="section_payment"><i class="fa fa-bullhorn"></i> Payments</a>
          </li>
          <li>
            <a href="index.php"><i class="fa fa-power-off"></i> Quit</a>
          </li>
        </ul>
        <br /><br />
        <img src="logo.png" class="support">
      </div>
      <div class="right-div">
        <div id="main">
          <br />
          <div class="head">
            <div class="col-div-6">
              <p class="nav">DASHBOARD</p>
            </div>

            <div class="col-div-6">
              <div class="profile">
                <img src="" class="pro-img" />
                
                <div class="profile-div">
                  <!-- <p><i href="index.html"class="fa fa-power-off"></i> Log Out</p> -->
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>


<!-- Request Section --> 

<!-- Business Request -->

<div class="request-div">
    <div class="rq_business">
        <link rel="stylesheet" href="rqbusiness_style.css" type="text/css">
        <button id='b_business'>Business</button>
        <button id='b_employee'>Employee</button>
        <button id='b_user'>User/Client</button>
        <div class="table_border">
            <table id="rqbusiness_container">
                <thead>
                    <tr>
                        <th>Laundry Shop Name</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Request Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows will be populated here by fetch_rqbusiness.php -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="Script_BusinessTable.js"></script>
</div>


<!-- Employee Request -->

<div class="requestemp-div">
    <div class="rq_employee">
        <link rel="stylesheet" href="rqemployee_style.css" type="text/css">
        <button id='e_business'>Business</button>
        <button id='e_employee'>Employee</button>
        <button id='e_user'>User/Client</button>
        <div class="table_border">
            <table id="rqemployee_container">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Affiliated Shop</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Table rows will be populated here by fetch_rqemployee.php -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="Script_EmployeeTable.js"></script> 
</div>

 
<!-- User/Client Request -->

<div class="requestuse-div">
    <div class="rq_user">
        <link rel="stylesheet" href="rquser_style.css" type="text/css">
        <button id='u_business'>Business</button>
        <button id='u_employee'>Employee</button>
        <button id='u_user'>User/Client</button>
        <div class="table_border">
            <table id="rquser_container">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Table rows will be populated here by fetch_rquser.php -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="Script_UserTable.js"></script> 
</div>

<!-- Registered Section -->

<!-- Registered Business -->

<div class="business-div">
    <div class="business">
        <link rel="stylesheet" href="business_style.css" type="text/css">
        <button id='bb_business'>Business</button>
        <button id='bb_user'>User/Client</button>
        <div class="table_border">
            <table id="business_container">
                <thead>
                    <tr>
                    <th>Laundry Shop Name</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Registered Date</th>
                        <th>End of Subscription</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Table rows will be populated here by fetch_business.php -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="Script_ABusiness.js"></script> 
</div>




<!-- Payment Section -->

<!--Pending Payments-->
<div class="penpay-div">
    <div class="pendingpay">
        <link rel="stylesheet" href="penpay_style.css" type="text/css">
        <button id='p_unpaid'>Unpaid</button>
        <button id='p_paid'>Paid</button>
        <div class="table_border">
            <table id="penpay_container">
                <thead>
                    <tr>
                    <th>Laundry Shop Name</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Registered Date</th>
                        <th>Subscription</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Table rows will be populated here by fetch_penpay.php -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="Script_Penpay.js"></script> 
</div>












      <div class="clearfix"></div>
    </section>
      
      

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Script_Admin.js"></script> <!-- Corrected closing tag -->
<script>
  $(document).ready(function () {
    $(".profile p").click(function () {
      $(".profile-div").toggle();
    });
    $(".noti-icon").click(function () {
      $(".notification-div").toggle();
    });
  });
</script>
<script type="text/javascript">
  $("li").click(function () {
    $("li").removeClass("active");
    $(this).addClass("active");
  });
</script>

  </body>
</html>
