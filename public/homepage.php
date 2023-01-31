<?php
 session_start();
    //prevent horny people
 if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
    // Redirect the user to the login page if they are not logged in
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Collection Fee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../global.css" />
    <link rel="stylesheet" href="../dashboard.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@700&display=swap">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<style>
        * {
            margin: 0;
            padding: 0;
            width: 100%;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
          margin: 0;
          padding: 0;
          width: 200px;
          background-color: #FFFFFF;
          position: fixed;
          height: 100%;
          overflow: auto;
        }
        .sidebar a {
          display: block;
          color: black;
          padding: 15px;
          text-decoration: none;
        }

        .sidebar a.active {
          background-color: #04AA6D;
          color: white;
        }

        .sidebar a:hover:not(.active) {
          background-color: #555;
          color: white;
        }
          #a_logout{
            width: 200px;
            position: absolute;
            bottom: 0;
          }

        div.content {
          margin-left: auto;
          padding: 1px 16px;
          height: 850px;
          background-color: #EAF2FF;
        }

        @media screen and (max-width: 700px) {
          .sidebar {
            width: 100%;
            height: auto;
            position: relative;
          }
          .sidebar a {float: left};
          div.content {margin-left: 0};
        }
        @media screen and (max-width: 400px) {
          .sidebar a {
            text-align: center;
            float: none;
          }
          .container .content .content-2{
            min-height: 60vh;
            display:flex;
            justify-content: space-around;
            align-items: flex-start;
            flex-wrap: wrap;
            }
            .container .content .content-2 .transactions{
              min-height: 50vh;
              flex: 5;
              background: #FFFF;
              margin: 0 25px 25px 25px;
              box-shadow: 0 4px 8px 0 rgb(210 223 232), 0 6px 20pxrgb(210 223 232);}

        .page-loading {
          position: fixed;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          width: 100%;
          height: 100%;
          -webkit-transition: all .4s .2s ease-in-out;
          transition: all .4s .2s ease-in-out;
          background-color: #fff;
          opacity: 0;
          visibility: hidden;
          z-index: 9999;
        }
        .dark-mode .page-loading {
          background-color: #131022;
        }
        .page-loading.active {
          opacity: 1;
          visibility: visible;
        }
        .page-loading-inner {
          position: absolute;
          top: 50%;
          left: 0;
          width: 100%;
          text-align: center;
          -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
          -webkit-transition: opacity .2s ease-in-out;
          transition: opacity .2s ease-in-out;
          opacity: 0;
        }
        .page-loading.active>.page-loading-inner {
          opacity: 1;
        }
        .page-loading-inner>span {
          display: block;
          font-size: 1rem;
          font-weight: normal;
          color: #9397ad;
        }
        .dark-mode .page-loading-inner>span {
          color: #fff;
          opacity: .6;
        }
        .page-spinner {
          display: inline-block;
          width: 2.75rem;
          height: 2.75rem;
          margin-bottom: .75rem;
          vertical-align: text-bottom;
          border: .15em solid #b4b7c9;
          border-right-color: transparent;
          border-radius: 50%;
          -webkit-animation: spinner .75s linear infinite;
          animation: spinner .75s linear infinite;
        }
        .dark-mode .page-spinner {
          border-color: rgba(255, 255, 255, .4);
          border-right-color: transparent;
        }

        @-webkit-keyframes spinner {
          100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        @keyframes spinner {
          100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
    }
      </style>
      <script>
          let mode = window.localStorage.getItem('mode'),
              root = document.getElementsByTagName('html')[0];
          if (mode !== undefined && mode === 'dark') {
            root.classList.add('dark-mode');
          } else {
            root.classList.remove('dark-mode');
          }
      </script>
      <script>
        (function () {
          window.onload = function () {
            const preloader = document.querySelector('.page-loading');
            preloader.classList.remove('active');
            setTimeout(function () {
              preloader.remove();
            }, 1000);
          };
        })();
      </script>

    </head>
    <body>
      <div class="page-loading active">
        <div class="page-loading-inner">
          <div class="page-spinner"></div><span>Loading</span>
        </div>
      </div>
  </head>
  <body>
  <title>Dashboard</title>
    <div class="sidebar">
      <div class="profile_info">
        <img src="images/logo.jpg" width="150"  alt="CCS COLLECTION FEE">
      </div>
      <a class="active" href="#home">Dashboard</a>
      <a href="payments.html">Fees</a>
      <a href="#remit-records">Remit Records</a>
      <a href="#colleges">Colleges</a>
      <a href="#funds">Funds</a>
      <a href="#financial-report">Financial Report</a>
      <a href="#audit-log">Audit log</a>
      <a href="#admin-settings">Admin Settings</a>
      <a href="logout.php" id='a_logout'> Log Out</a>
    </div>
    <!-- Main dahboard area -->

    <div class="traffic">
      <div class="linkedin">
        <img class="bar-icon" alt="" src="public/bar.svg"/><img
          class="progress-icon" alt="" src="public/progress.svg"/>
        <b class="b1">College of Agriculture</b>
      </div>
      <div class="linkedin1">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon1" alt="" src="public/progress1.svg"/>
        <b class="b4">College of Architecture</b>
      </div>
      <div class="linkedin2">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon2" alt="" src="public/progress2.svg"/>
          <b class="b4">College of Criminal Justice Education</b>
      </div>
      <div class="linkedin3">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon3" alt="" src="public/progress3.svg"/>
        <b class="b4">College of Engineering</b>
      </div>
      <div class="linkedin4">
        <img class="bar-icon1" alt="" src="public/bar.svg" /><img class="progress-icon4" alt="" src="../images/progress4.svg"/>
        <b class="b4">College of Forestry and Environmental Studies</b>
      </div>
      <div class="linkedin5">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon5" alt="" src="../images/progress5.svg"/>
        <b class="b4">College of Home Economics</b>
      </div>
      <div class="linkedin6">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon6" alt="" src="../images/progress6.svg"/>
      <b class="b4">College of Law</b>
      </div>
      <div class="linkedin7">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon7" alt=""src="../images/progress7.svg"/>
        <b class="b4">College of Liberal Arts</b>
      </div>
      <div class="linkedin8">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon8" alt=""src="../images/progress8.svg"/>
        <b class="b4">College of Nursing</b>
      </div>
      <div class="linkedin9">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon9" alt="" src="../images/progress9.svg"/>
        <b class="b4">College of Public Administration and Development Studies</b>
      </div>
      <div class="linkedin10">
        <img class="bar-icon1" alt="" src="public/bar.svg" /><img class="progress-icon10" alt=""src="../images/progress10.svg"/>
          <b class="b4">College of Sports Science and Physical Education</b>
      </div>
      <div class="linkedin11">
        <img class="bar-icon1" alt="" src="public/bar.svg" /><img class="progress-icon11" alt="" src="../images/progress11.svg"/>
          <b class="b4">College of Science and Mathematics</b>
      </div>
      <div class="linkedin12">
        <img class="bar-icon1" alt="" src="public/bar.svg" /><img class="progress-icon12" alt="" src="../images/progress12.svg"/>
          <b class="b4">College of Social Work and Community Development</b>
      </div>
      <div class="linkedin13">
        <img class="bar-icon13" alt="" src="../images/bar.svg"/><img class="progress-icon13" alt="" src="../images/progress13.svg"/>
          <b class="b40"><p class="college-of-teacher">College of Teacher Education</p></b>
      </div>
      <div class="linkedin14">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon14" alt=""src="public/progress14.svg"/>
          <b class="b4">College of Computing Studies</b>
      </div>
      <div class="linkedin15">
        <img class="bar-icon1" alt="" src="public/bar.svg"/><img class="progress-icon15" alt="" src="public/progress15.svg"/>
        <b class="b4">College of Asian and Islamic Studies</b>
      </div>
    </div>
    <div class="php-13942000-parent">
      <div class="php-13942000">Php 139,420.00</div>
      <div class="total-30">Total 30 % of CSC Remitted Fund</div>
    </div>
    <div class="php-35052000-parent">
      <div class="php-35052000">Php 350,520.00</div>
      <div class="total-fund-collected">Total Fund Collected</div>
    </div>
    <script>
        function showSideBar() {
            document.getElementById('responsive-side-bar').style.width = '180px';
        }

        function closeNav() {
            document.getElementById('responsive-side-bar').style.width = '0px';
        }

        function showContent() {
            var content = document.getElementById('content').style;
            if ( content.height === '0vh' ) {
                content.height = '35vh'
            }

            else {
                content.height = '0vh';
            }
        }

        function toggleContent() {
            var content = document.getElementById('content2').style;
            if ( content.height === '0vh' ) {
                content.height = '35vh'
            }

            else {
                content.height = '0vh';
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>