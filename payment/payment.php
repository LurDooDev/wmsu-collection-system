<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="global.css"/>
    <link rel="stylesheet" href="fees.css"/>
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap"/>
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
          .sidebar a {float: left;}
          div.content {margin-left: 0;}
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

    <title>Dashboard</title>
    <div class="sidebar">
      <div class="profile_info">
        <img src="images/logo.jpg" width="150"  alt="CCS COLLECTION FEE">
      </div>
      <a class="#" href="homepage.html">Dashboard</a>
      <a href="fees.html">Fees</a>
      <a href="#remit-records">Remit Records</a>
      <a href="#colleges">Colleges</a>
      <a href="#funds">Funds</a>
      <a href="#financial-report">Financial Report</a>
      <a href="#audit-log">Audit log</a>
      <a href="#admin-settings">Admin Settings</a>
      <a href="#log-out" id='a_logout'> Log Out</a>
    </div>
    <div class="l">l</div>
    <img class="icon-awesome-search" alt="" src= "public/icon-awesomesearch.svg"/>
    <div class="search-name-date">Search name, date, sem, status</div>
    <div class="payments-child"></div>
    <div class="bg"></div>
    <div class="div"></div>
      <div class="div"></div>
      <div class="div2"></div>
      <div class="div"></div>
      <div class="div2"></div>
    <div class="payments1">Payments</div>
    <div class="icon-ionic-ios-add-circle-parent" id="groupContainer">
      <img class="icon-ionic-ios-add-circle" alt="" src="public/icon-ioniciosaddcircle.svg"/>
      <div class="add-payments2 " style= "text-align: right;">Add Payments</div>
    </div>
    <b class="action">Action</b>
    <div class="edit" id="editContainer"><div class="edit1">Edit</div></div>
    <div class="edit"><div class="edit1">Edit</div></div>
    <div class="delete-frame" id="groupContainer4">
      <div class="delete2">Delete</div>
      <b class="type-of-fee4">Type of Fee</b
      ><b class="type-of-fee4">Type of Fee</b>
      <div class="csc">CSC</div>
      <div class="csc">CSC</div>
      <div class="csc2">CSC</div>
      <div class="csc2">CSC</div>
      <b class="description6">Description</b
      ><b class="description6">Description</b>
      <div class="csc-college-student-council">CSC-College Student Council</div>
      <div class="csc-college-student-council">CSC-College Student Council</div>
      <div class="csc-college-student-council2">
        CSC-College Student Council
      </div>
      <div class="csc-college-student-council2">
        CSC-College Student Council
      </div>
      <b class="duration4">Duration</b><b class="duration4">Duration</b>
      <div class="st-semester">1st Semester</div>
      <div class="st-semester">1st Semester</div>
      <div class="st-semester2">1st Semester</div>
      <div class="st-semester2">1st Semester</div>
      <b class="amount4">Amount</b><b class="amount4">Amount</b>
      <div class="php-20000">Php 200.00</div>
      <div class="php-20000">Php 200.00</div>
      <div class="php-200002">Php 200.00</div>
      <div class="php-200002">Php 200.00</div>
  

      </body>
</html>
