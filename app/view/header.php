<html>
<head>
    <title><?php echo $this->page_title ?></title>
    <link rel="stylesheet" href="<?php echo URL ?>dist/css/bootstrap.min.css">
</head>
<body>
<div id="header">
    <nav class="navbar navbar-light bg-faded" role="navigation">
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapsing-navbar">
            &#9776;
        </button>
        <div class="collapse navbar-toggleable-xs" id="collapsing-navbar">
            <a class="navbar-brand" href="/">Logo</a>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="/help" class="nav-link">Help</a>
                </li>
                <?php if(!App::userLoggedIn()): ?>
                <li class="nav-item">
                    <a href="/login" class="nav-link">Login</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">Account</a>
                </li>
                <li class="nav-item">
                    <a href="/login/out" class="nav-link">Logout</a>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</div>
<div class="container">
    <!-- Content here -->
    <div class="row">
        <div class="col-lg-8">
