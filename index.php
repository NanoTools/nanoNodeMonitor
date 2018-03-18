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
      <p></p>
      <p class="lead">Nano Node Monitor</p>
      <p><?php echo $welcomeMsg; ?></p>

      <div class="btn-group">
      <?php foreach ($socials as $socialkey => $socialvalue): ?>
        <a href="<?php echo $socialvalue; ?>" target="_blank" class="btn btn-secondary"><i class="fab fa-<?php echo $socialkey; ?>"></i></a>
      <?php endforeach; ?>
      </div>

    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="coinmarketcap-currency-widget" 
      data-currencyid="1567" 
      data-base="<?php echo $cmcBaseCurrency; ?>" 
      data-secondary="<?php echo $cmcSecondaryCurrency; ?>" 
      data-ticker="<?php echo bool2string($cmcTicker); ?>" 
      data-rank="<?php echo bool2string($cmcRank); ?>" 
      data-marketcap="<?php echo bool2string($cmcMarketcap); ?>" 
      data-volume="<?php echo bool2string($cmcVolume); ?>" 
      data-stats="<?php echo $cmcBaseCurrency; ?>" 
      data-statsticker="<?php echo bool2string($cmcStatsticker); ?>"></div>
    </div>
  </div>
</div>

<!-- main content -->
<div id="content"><i class="fas fa-spinner fa-spin fa-3x"></i></div>

<script src="static/js/index.js?v=<?php echo PROJECT_VERSION; ?>"></script>
<!--- add the footer -->
<?php include 'modules/footer.php'; ?>
