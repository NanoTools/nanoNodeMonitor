<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title><?php echo currencyName($currency); ?> Node Monitor - <?php echo $nanoNodeName; ?></title>

        <meta name="Description" content="Nano Node Monitor is a server-side PHP-based monitor for Nano nodes.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="robots" content="all" />
        <link rel="stylesheet" href="static/css/bootstrap.min.css?v=<?php echo PROJECT_VERSION; ?>" media="screen">
        <link rel="stylesheet" href="static/css/fontawesome-all.min.css?v=<?php echo PROJECT_VERSION; ?>" media="screen">
        <link rel="stylesheet" href="static/css/main.css?v=<?php echo PROJECT_VERSION; ?>" media="screen">
        <link rel="stylesheet" href="static/themes/<?php echo $themeChoice; ?>/css/theme.css?v=<?php echo PROJECT_VERSION; ?>" media="screen">
        <link rel="shortcut icon" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon.ico">
        <link rel="icon" sizes="16x16 32x32 64x64" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon.ico">
        <link rel="icon" type="image/png" sizes="196x196" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-192.png">
        <link rel="icon" type="image/png" sizes="160x160" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-160.png">
        <link rel="icon" type="image/png" sizes="96x96" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-96.png">
        <link rel="icon" type="image/png" sizes="64x64" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-64.png">
        <link rel="icon" type="image/png" sizes="32x32" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-16.png">
        <link rel="apple-touch-icon" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-180.png">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="static/img/favicon/<?php echo currencyName($currency); ?>/favicon-144.png">
        <meta name="msapplication-config" content="static/img/favicon/<?php echo currencyName($currency); ?>/browserconfig.xml">
        <meta property="og:title" content="<?php echo currencyName($currency); ?> Node Monitor - <?php echo $nanoNodeName; ?>">
        <meta property="og:description" content="Nano Node Monitor">
        <meta property="og:type" content="website">
        <meta property="og:image" content="static/img/nano-mark-light.png">
        <meta name="nano" content="<?php echo $nanoDonationAccount; ?>">
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
