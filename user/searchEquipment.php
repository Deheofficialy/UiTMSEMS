<?php
include("../include/dbconn.php");
include("../session.php");
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../login');
}

include("../include/newnavbarUser.php");
?>

<head>
  <title>Search Equipment</title>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);



    #search {
      width: 100%;
      position: relative;
      display: flex;
      align-content: flex-start;
    }

    #searchTerm {
      width: 100%;
      border: 3px solid #673AB7;
      border-right: none;
      padding: 5px;
      height: 36px;
      border-radius: 5px 0 0 5px;
      outline: none;
      color: #9DBFAF;
    }

    #searchTerm:focus {
      color: #272c33;
    }

    #searchButton {
      width: 40px;
      height: 36px;
      border: 1px solid #673AB7;
      background: #673AB7;
      text-align: center;
      color: #fff;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      font-size: 20px;
      align-self: flex-end;
    }

    /*Resize the wrap to see the search bar change!*/
    #wrap {
      width: 30%;
      position: absolute;
      top: 15%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    #form {
      width: 100%;
      display: flex;
    }
  </style>

</head>

<body>
  <div id="wrap">
    <div id="search">
      <form method="POST" action="search.php" id="form">
        <input type="text" id="searchTerm" name="searchname" placeholder="What are you looking for?">
        <button type="submit" name="search" id="searchButton">
          <i class="fa fa-search"></i>
        </button>
      </form>
    </div>
  </div>
</body>

</html>