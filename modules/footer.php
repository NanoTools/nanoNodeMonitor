<footer id="footer">
  <p><?php echo getVersionInformation(); ?><br>
  Source available on <a href="<?php echo PROJECT_URL; ?>" target="_blank">GitHub</a>.</p>
  <br>
  <p class=small>Made by <a href="https://github.com/NanoTools" target="_blank">Nano Tools</a>.</p>
  <p class=small>Donations: <a href="<?php echo getAccountUrl(NODEMON_DON_ACCOUNT, $blockExplorer); ?>" target="_blank"><?php echo NODEMON_DON_ACCOUNT; ?></a></p>
</footer>

</div><!-- /container -->

<script src="static/js/jquery-3.3.1.min.js"></script>
<script src="static/js/popper.min.js"></script>
<script src="static/js/bootstrap.min.js"></script>
<script src="static/js/handlebars-v4.0.11.js"></script>
<script src="static/js/main.js?v=<?php echo PROJECT_VERSION; ?>"></script>

</body>
</html>