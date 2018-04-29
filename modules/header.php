<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Nano Node Monitor - <?php echo $nanoNodeName; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="robots" content="noindex" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="static/css/fontawesome-all.min.css" media="screen">
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet"> <!-- Nunito Font - Icarus -->
        <link rel="stylesheet" href="static/css/<?php echo $themeChoice; ?>.css?v=<?php echo PROJECT_VERSION; ?>" media="screen">
        <link rel="stylesheet" href="static/css/util.css">
        <link rel="icon" href="static/img/logo-only-white.svg">
    </head>
    <body>
        <script>
        var init = [];
        var GLOBAL_REFRESH = <?php echo $autoRefreshInSeconds; ?>;
        var GLOBAL_DIGITS = <?php echo $nanoNumDecimalPlaces; ?>;
        </script>


    <!--- add the navbar -->
    <?php include __DIR__ . '/navbar.php'; ?>

    <!-- logo and ticker -->
    <div class="container">
