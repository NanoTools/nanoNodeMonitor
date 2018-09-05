<?php if ($currency == 'nano'): ?>

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
<script src="https://files.coinmarketcap.com/static/widget/currency.js" async></script>

<?php elseif($currency == 'banano'): ?>
<img id="monkey" src="http://www.monkeygen.com/image?address=<?php echo $nanoNodeAccount; ?>" 
title="monKey for <?php echo $nanoNodeAccount; ?>"
style="max-width:250px; display:block; margin:0 auto;" />
<?php endif; ?>