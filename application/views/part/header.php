<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    
    <link rel="stylesheet" href="<?=base_url();?>assets/css/main/app.css">
    <link rel="shortcut icon" href="<?=base_url();?>assets/images/logo/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url();?>assets/images/logo/favicon.png" type="image/png">
    
    <link rel="stylesheet" href="<?=base_url();?>assets/css/shared/iconly.css">
    <?php if($formatData == "tables"){?>
        <link rel="stylesheet" href="<?=base_url();?>assets/css/pages/fontawesome.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/pages/datatables.css">
    <?php } ?>
    <style>#logoutMain {display:none;} @media screen and (max-width: 425px) {.logo, .logo img {width: 50px;} .dropdown {display: none;} #logoutMain {display:block;}}</style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if($autoComplete == "yes"){?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/css/autoComplete.01.min.css">
    <?php } ?>
    <?php if($dateTeimePicker == "yes"){?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css">
    <?php } ?>
    
    <style>
        /* HTML: <div class="loader"></div> */
        .loader{width:50px;aspect-ratio:1;display:grid}.loader::after,.loader::before{content:"";grid-area:1/1;--c:no-repeat radial-gradient(farthest-side,#25b09b 92%,#0000);background:var(--c) 50% 0,var(--c) 50% 100%,var(--c) 100% 50%,var(--c) 0 50%;background-size:12px 12px;animation:1s infinite l12}.loader::before{margin:4px;filter:hue-rotate(45deg);background-size:8px 8px;animation-timing-function:linear}@keyframes l12{100%{transform:rotate(.5turn)}}
    </style>
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <img src="<?=base_url();?>assets/images/logo/logothis3.png" alt="Logo">
                        </div>
                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="<?=base_url();?>assets/images/faces/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?=ucfirst($sess_username);?></h6>
                                        <p class="user-dropdown-status text-sm text-muted"><?=$sess_akses;?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                  <li><a class="dropdown-item" href="javacript:void(0);">My Account</a></li>
                                  <li><a class="dropdown-item" href="javacript:void(0);">Settings</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="<?=base_url('login/logout');?>">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>