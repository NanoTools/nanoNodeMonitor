<footer id="footer">
  <p><?php echo getVersionInformation(); ?><br>
  GitHub: <a href="<?php echo PROJECT_URL; ?>" target="_blank">Source</a> | <a href="<?php echo PROJECT_URL . '/wiki'; ?>" target="_blank">Wiki</a> | <a href="<?php echo PROJECT_URL . '/wiki/API-Description'; ?>" target="_blank">API</a></p>
  <br>
  <p class=small>Made by <a href="https://github.com/NanoTools" target="_blank">Nano Tools</a>.
  <br>
  Donations to Nano Node Monitor: <a href="<?php echo getAccountUrl(NODEMON_DON_ACCOUNT, $blockExplorer); ?>" target="_blank"><?php echo NODEMON_DON_ACCOUNT; ?></a>
  <button id="copyAccount" class="btn btn-sm btn-link btn-clipboard-light" data-clipboard-text="<?php echo NODEMON_DON_ACCOUNT; ?>" title="Copy"><i class="fas fa-clipboard fa-lg"></i></button>
  </p>
</footer>

</div><!-- /container -->

<script src="static/js/jquery-3.3.1.min.js"></script>
<script src="static/js/popper.min.js"></script>
<script src="static/js/bootstrap.min.js"></script>
<script src="static/js/handlebars-v4.0.11.js"></script>
<script src="static/js/main.js?v=<?php echo PROJECT_VERSION; ?>"></script>

</body>
</html>
