<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title>
    <?= $title; ?>
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.5.3/video-js.min.css"
    integrity="sha512-OxFNWAvUrErw1lQmH+xnjFJZePnr6zA0/H/ldxoXaYUn3yHcII7RpB6cfysY0rhxRZeCIUzQIECLOCXIYrfOIw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../tmp/dist/css/social-share-kit.css" type="text/css">
  <link rel="stylesheet" href="/style.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    #search-x {
      display: none;
    }
  </style>

</head>

<body>
  <form action="/search" method="get" class="p-0 m-0">
    <header class="nav-down">
      <nav data-mdb-navbar-init class="navbar navbar-expand-lg navbar-light bg-body-tertiary ">
        <!-- Container wrapper -->
        <div class="container-fluid">
          <!-- Toggle button -->
          <a class="mx-4 sidebar" href="javascript:void(0);">
            <img src="/images/menu.svg" class="mx-3 my-3" height="20" />

          </a>

          <!-- Collapsible wrapper -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0 ml-5" href="/home">
              <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="15" alt="MDB Logo"
                loading="lazy" />
            </a>
            <!-- Left links -->


            <div class="input-group border mx-5">

              <button type="submit" class="btn btn-link btn-lg bg-white border-0 input-group-text py-0 px-2 my-0 mx-1">
                <i class="fa fa-search"></i>
              </button>



              <input type="text" name="q" id="q" value="<?php if (isset($_GET['q'])) {
                echo trim($_GET['q']);
              } ?>" class="form-control bg-white border-0 px-0" placeholder="Search" aria-label="Search"
                aria-describedby="Search" />
  </form>
  <button class="input-group-text bg-white border-0" id="search-x"><i class="fa fa-times"></i></button>
  </div>


  <!-- Left links -->
  </div>
  <!-- Collapsible wrapper -->

  <!-- Right elements -->
  <div class="d-flex align-items-center">
    <!-- Icon -->
    <a class="text-reset me-3" href="<?= $create_channel_url; ?>" target="_window">
      <!-- <i class="fas fa-video mx-3 my-3"></i> -->
      <img src="/images/video.svg" class="mx-3 my-3" height="20" />
    </a>

    <!-- Notifications -->
    <a class="text-reset me-3 " href="/notifications">
      <img src="/images/bell.svg" class="mx-3 my-3" height="20" />
    </a>

    <!-- Avatar -->
    <div class="dropdown">
      <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
        id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
        <img src="/images/user.svg" class="mx-3 my-3" height="20" />
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
        <?php if ($uid != "0") {

          echo "<li><a class='dropdown-item' href='/logout'> Logout </a></li>";

        } else {

          echo "<li><a class='dropdown-item' href='/login'>Sign In </a></li>";
        } ?>

      </ul>
    </div>
  </div>
  <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
  </nav>
  </header>




  <div class="container-fluid">
    <div class="row equal-height-row ">
      <div id="sidebar" class="col-2 px-0 py-5 border border-left-0 border-bottom-0" style="display:none;">

        <div class="py-5" id="sidebarcom">
          <a class="dropdown-item py-2 px-4 small" href="/home"><i class="fa-solid fa-house"></i> Home</a>
          <a class="dropdown-item py-2 px-4 small" href="/latest"><i class="fa-solid fa-cloud"></i> Latest</a>
          <a class="dropdown-item py-2 px-4 small" href="/popular"><i class="fa fa-bullhorn"></i> Popular</a>
          <a class="dropdown-item py-2 px-4 small" href="/trending"><i class="fa fa-chart-bar"></i> Trending</a>
          <a class="dropdown-item py-2 px-4 small" href="/recommended"><i class="fa-solid fa-check"></i> Recommended</a>
          <a class="dropdown-item py-2 px-4 small" href="/saved"><i class="fa-solid fa-save"></i> Saved</a>
          <a class="dropdown-item py-2 px-4 small" href="/later"><i class="fa-solid fa-eye"></i> Watch Later</a>
          <a class="dropdown-item py-2 px-4 small" href="/liked"><i class="fa-solid fa-thumbs-up"></i> Liked Videos</a>
          <a class="dropdown-item py-2 px-4 small" href="/subscriptions"><i class="fa-solid fa-bell"></i>
            Subscriptions</a>
          <a class="dropdown-item py-2 px-4 small" href="<?= $create_channel_url; ?>" target="_window"><i
              class="fa-solid fa-television"></i> Create a Channel</a>
          <a class="dropdown-item py-1 px-4 small" href="#"></a>
          <div class="dropdown-divider py-1"></div>
          <a class="dropdown-item py-2 px-4 small" href="javascript:void();">CHANNELS</a>

          <?php
          $results = $client->sql('SELECT user_id, channel FROM marketplace GROUP BY user_id ORDER BY created_at desc LIMIT 50');
          foreach ($results['hits']['hits'] as $hit) {
            echo "<a class='dropdown-item py-2 px-4 small' href='/channel/?v=" . $hit['_source']['user_id'] . "'>" . $hit['_source']['channel'] . "</a>";
          }
          ?>





        </div>




      </div>
      <div id="page-container" class="col-md p-0">