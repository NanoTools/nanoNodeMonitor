<?php
// include required files
require_once __DIR__.'/modules/includes.php';

include 'modules/header.php';
?>
<div class="page-header mb-3" id="banner">
  <div class="row">
    <div class="col-lg-8 col-md-6 col-sm-6">
      <a href="https://nano.org" target="_blank">
        <img src="static/img/logo-white.svg" width="220" alt="Nano Logo"/>
      </a>
      <p class="lead mt-2">Nano Node Monitor</p>
      <p><?php echo $welcomeMsg; ?></p>

      <div class="btn-group mb-3">
      <?php foreach ($socials as $socialkey => $socialvalue): ?>
        <a href="<?php echo $socialvalue; ?>" target="_blank" class="btn btn-secondary"><i class="fab fa-<?php echo $socialkey; ?>fa-2x"></i></a>
      <?php endforeach; ?>
      </div>

    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
      <?php include 'modules/cmc_widget.php'; ?>
    </div>
  </div>
</div>

<!-- main content -->
<div id="content"><i class="fas fa-spinner fa-spin fa-3x"></i></div>

<script src="static/js/clipboard.min.js" async></script>
<script src="static/js/index.js?v=<?php echo PROJECT_VERSION; ?>"></script>
<!--- add the footer -->
<?php include 'modules/footer.php'; ?>
