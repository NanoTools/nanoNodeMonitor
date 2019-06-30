<?php
// include required files
require_once __DIR__.'/modules/includes.php';

include 'modules/header.php';

$coinURL = 'https://nano.org';
if ($currency == 'banano') {
    $coinURL = 'https://banano.co.in/';
}

?>
<div class="page-header mb-3" id="banner">
  <div class="row">
    <div class="col-lg-8 col-md-6 col-sm-6">
      <a href="<?php echo $coinURL; ?>" target="_blank" rel="noopener">
        <img src="static/img/nano-full-<?php echo $themeChoice; ?>.svg" width="220" alt="Logo"/>
      </a>
      <p class="lead mt-2"><?php echo currencyName($currency); ?> Node Monitor</p>
      <p><?php echo $welcomeMsg; ?></p>

      <div class="btn-group mb-3">
      <?php foreach ($socials as $socialkey => $socialvalue): ?>
      <a href="<?php echo $socialvalue; ?>" target="_blank" rel="noopener" class="btn btn-secondary" aria-label="Social Media">
        <i class="fab fa-<?php echo $socialkey; ?>"></i>
      </a>
      <?php endforeach; ?>
      </div>

    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
      <?php include 'modules/widget.php'; ?>
    </div>
  </div>
</div>

<!-- main content -->
<div id="content"><i class="fas fa-spinner fa-spin fa-3x"></i></div>

<script src="static/js/clipboard.min.js" async></script>
<script src="static/js/index.js?v=<?php echo PROJECT_VERSION; ?>"></script>
<!--- add the footer -->
<?php include 'modules/footer.php'; ?>
