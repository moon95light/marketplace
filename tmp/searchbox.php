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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.5.3/video-js.min.css" integrity="sha512-OxFNWAvUrErw1lQmH+xnjFJZePnr6zA0/H/ldxoXaYUn3yHcII7RpB6cfysY0rhxRZeCIUzQIECLOCXIYrfOIw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/css/social-share-kit.css" type="text/css">
    <style>
        header {
            background: white;
            position: fixed;
            top: 0;
            transition: top 0.2s ease-in-out;
            width: 100%;
            z-index: 300;
        }

        .nav-up {
            top: -40px;
        }

        .img-fluid-message {
            max-width: 30%;
            border-radius: 50%;
            width: 24px;
            height: 24px;
        }

        .bg-message {
            width: 40%;
        }

        .modal-header {
            display: flex;
            justify-content: normal;
        }

        .modal-title {
            margin-left: 10px;
        }

        #message {
            border: none;
            width: 100%;
            height: 100%;
        }

        #message:focus {
            border: none;
            outline: none;
        }

        .modal .modal-dialog.modal-bottom-right {
            right: 0;
            bottom: 0;
        }

        .modal .modal-side {
            position: absolute;
            width: 100%;
            right: var(--mdb-modal-side-right);
            bottom: var(--mdb-modal-side-bottom);
            margin: 0;
        }

        .modal-footer {
            flex-wrap: nowrap;
        }

        .bottom-text {
            margin-bottom: 0;
            font-size: 13px;
        }

        .footer-left {
            text-align: center;
            margin-right: 50px;
            margin-left: 100px;
        }

        .error-msg {
            color: green;
            display: none;
        }

        #success-subscription {
            font-size: 12px;
            /* margin-left: 70%; */
        }

        #success-message {
            font-size: 12px;
            /* margin-left: 83%; */
        }

        .duration {
            position: relative;
            font-size: 12px;
            top: 72px;
            background-color: #000000;
            width: fit-content;
            border-radius: 10px;
            padding-left: 5px;
            padding-right: 5px;
            margin-left: 260px;
        }

        /* @media (max-width: 1400px) {
      .duration {
        margin-right: 25px;
      }
    }
    @media (max-width: 1410px) {
      .duration {
        margin-right: 35px;
      }
    } */
        #search {
            bottom: -45px;
            right: 0;
            width: 20%;
            z-index: -1;
            transition: transform 500ms;
            position: absolute;
            display: none;
        }

        .show-search {
            transform: translate(0, 100%);
        }
    </style>
</head>

<body>
    <header class="nav-down">
        <nav data-mdb-navbar-init class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0 ml-5" href="#">
                        <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="15" alt="MDB Logo" loading="lazy" />
                    </a>
                    <!-- Left links -->
                    <ul hidden class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " href="#">TECHNOLOGY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">FINANCE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">SALES & MARKETING</a>
                        </li>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">
                    <!-- Icon -->
                    <!-- <input type="search" id="search" class="form-control position-absolute shadow-sm" placeholder="Search"> -->
                    <form id="search" action="https://marketplace.tube/search?q=">
                        <div class="input-group mt-10">
                            <div class="form-outline bg-white" data-mdb-input-init>
                                <input id="search-input" type="search" id="form1" class="form-control" />
                                <label class="form-label" for="form1">Search</label>
                            </div>
                            <button id="search-button" type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <a class="text-reset me-3" href="#" id="btn-search" role="button">
                        <i class="fas fa-search"></i>
                    </a>

                    <!-- Notifications -->
                    <div class="dropdown">
                        <a data-mdb-dropdown-init class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="#">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
    </header>