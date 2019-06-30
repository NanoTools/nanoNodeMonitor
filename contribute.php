<?php
// include required files
require_once __DIR__.'/modules/includes.php';

include 'modules/header.php';
?>


<h3>Contribute to <?php echo currencyName($currency); ?> Node Monitor</h3>
<p>
  If you want to contribute to <?php echo currencyName($currency); ?> Node Monitor and further improve it, your help is very welcome. Have a look at its <a href="https://github.com/NanoTools/nanoNodeMonitor" target="_blank" rel="noopener">GitHub page</a>, browse through open issues, check out the source code, create a branch, develop features, fix some bugs, and open pull requests. Development follows the standard <a href="https://guides.github.com/introduction/flow/" target="_blank" rel="noopener">GitHub Flow</a> method.  
</p>

<br>

<h3>Donate to the Maintainer of This Node</h3>

<p>
  Donations support the efforts of the <?php echo currencyName($currency); ?> community to further decentralize the <?php echo currencyName($currency); ?> network by running representative nodes.
  Please consider donating to the maintainer of this <?php echo currencyName($currency); ?> node to help cover some of its costs. Simply scan the QR code with your wallet app.
</p>

<a href="nano:<?php echo $nanoNodeAccount; ?>">
  <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=nano:<?php echo $nanoNodeAccount; ?>&choe=UTF-8" 
  title="QR code for <?php echo $nanoNodeAccount; ?>"
  style="max-width:250px; display:block;" />
</a>
<br>
<!--- add the footer -->

<?php include 'modules/footer.php'; ?>
