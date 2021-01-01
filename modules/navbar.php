<div class="navbar navbar-expand-lg n-navbar-theme fixed-top">
  <div class="container">
    <a href="index.php" class="navbar-brand">
      <img src="static/img/nano-mark-<?php echo $themeChoice; ?>.svg" alt="Nano Logo" style="height: 1em;"/>
      <span class="n-logo-theme"><?php echo currencyName($currency); ?> Node Monitor</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

      <ul class="nav navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="index.php" target="_self">Node Monitor</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo PROJECT_URL; ?>" target="_blank" rel="noopener">GitHub Project</a>
        </li>
      </ul>

    </div>
  </div>
</div>