<!doctype html>
<html lang="en" class="no-js">
  <html>
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <title>Wmsu Collection System</title>
    </head>

      <body>
      <div class="d-flex" id="wrapper">
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../login/images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
            <div class="darna my-3">
                <a href="#" class="active">
                    Dashboard</a>
                <a href="#" class="#">
                    Fees</a>
                <a href="#" class="#">
                    Remit Records</a>
                <a href="#" class="# ">
                    Colleges</a>
                <a href="#" class="#"> 
                    Funds</a>
                <a href="#" class="#"> 
                     Financial Report</a>
                <a href="#" class="#">
                     Audit Log</a> 
                     <a href="#" class="#"> 
                     Admin Settings</a>
                <a href="#" class="#" id='a_logout'>
                    Logout</a>
            </div>
        </div>
  <div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Dashboard</h2>
        </div>
    </nav>
  <div class="graphBox">
    <div class="box">
    <canvas id="myChart"></canvas>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../js/chart.js"></script>

