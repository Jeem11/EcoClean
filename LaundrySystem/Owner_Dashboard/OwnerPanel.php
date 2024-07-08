<!DOCTYPE html>
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

    <link rel="stylesheet" href="OwnerPanel.css" type="text/css" />
  </head>
  <body>
    <section>
      <div class="left-div">
        <br />
        <h2 class="logo">Eco<span style="font-weight: 100">Clean</span></h2>
        <hr class="hr" />
        <ul class="nav">
          <li class="active">
            <a href="#" id="section_post"><i class="fa fa-pencil"></i> Post</a>
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
        <button id='b_posting'>Posting</button>
        <button id='b_timeline'>Timeline</button>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="Script_BusinessTable.js"></script>

<!-- Employee Request -->

<div class="requestemp-div">
    <div class="rq_employee">
        <link rel="stylesheet" href="rqemployee_style.css" type="text/css">
        <button id='e_posting'>Posting</button>
        <button id='e_timeline'>Timeline</button>
        <div class="table_border">
            <table id="rqemployee_container">
                <thead>
                    <tr>
                        <th>Date</th>

                    </tr>
                </thead>
                <tbody>
                     <!-- Table rows will be populated here by fetch_rqemployee.php -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="Script_EmployeeTable.js"></script> 

      <div class="clearfix"></div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Script_Admin.js"></script>
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
