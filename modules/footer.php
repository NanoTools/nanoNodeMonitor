<footer id="footer">

  <p>
   <?php echo getVersionInformation(); ?>
   <br>
    Made by <a href="https://github.com/NanoTools" target="_blank">Nano Tools</a>.
   <br>
    GitHub: <a href="<?php echo PROJECT_URL; ?>" target="_blank">Source</a> | <a href="<?php echo PROJECT_URL . '/wiki'; ?>" target="_blank">Wiki</a> | <a href="<?php echo PROJECT_URL . '/wiki/API-Description'; ?>" target="_blank">API</a>  
  </p>
  
  <hr class=light>

  <p class=truncate>
   <small>

<?php
  // switch Nano / Banano rep accounts & explorer
  $repAccount = NODEMON_REP_ACCOUNT;
  $donAccount = NODEMON_DON_ACCOUNT;
  $repExplorer = 'ninja';

  if ($currency == "banano")
  {
    $repAccount = NODEMON_BAN_REP_ACCOUNT;
    $donAccount = NODEMON_BAN_DON_ACCOUNT;
    $repExplorer = 'banano';
  }
?>

   <?php echo currencyName($currency) ?> Representative: <a href="<?php echo getAccountUrl($repAccount, $repExplorer); ?>" target="_blank"><?php echo $repAccount; ?></a>
   </small>
   <button id="copyAccount" class="btn btn-sm btn-link btn-clipboard-light" data-clipboard-text="<?php echo $repAccount; ?>" title="Copy"><i class="fas fa-clipboard fa-lg"></i></button>
   <br>
   <small>
    Donations to <?php echo currencyName($currency); ?> Node Monitor: <a href="<?php echo getAccountUrl($donAccount, $blockExplorer); ?>" target="_blank"><?php echo $donAccount; ?></a>
   </small>
   <button id="copyAccount" class="btn btn-sm btn-link btn-clipboard-light" data-clipboard-text="<?php echo $donAccount; ?>" title="Copy"><i class="fas fa-clipboard fa-lg"></i></button>
  </p>
</footer>

</div><!-- /container -->

<script src="static/js/jquery-3.3.1.min.js?v=<?php echo PROJECT_VERSION; ?>"></script>
<script src="static/js/popper.min.js?v=<?php echo PROJECT_VERSION; ?>"></script>
<script src="static/js/bootstrap.min.js?v=<?php echo PROJECT_VERSION; ?>"></script>
<script src="static/js/handlebars-v4.0.11.js?v=<?php echo PROJECT_VERSION; ?>"></script>
<script src="static/js/main.js?v=<?php echo PROJECT_VERSION; ?>"></script>



</body>
</html>
