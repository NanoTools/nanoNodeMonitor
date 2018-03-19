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

      <p><?php echo getVersionInformation(); ?><br>
      Contributors: <a href="https://github.com/dbachm123">dbachm123</a>, <a href="https://github.com/BitDesert">BitDesert</a>, <a href="https://github.com/NiFNi">NiFNi</a></p>    
      
    </div>         
  </div>
</div>

<h2>Contribute</h2>
<p>
  If you want to contribute to Nano Node Monitor and further improve it, your help is very welcome. Have a look at its <a href="https://github.com/dbachm123/nanoNodeMonitor" target="_blank">GitHub page</a>, browse through open issues, check out the source code, create a branch, develop features, fix some bugs, and open pull requests. Development follows the standard <a href="https://guides.github.com/introduction/flow/" target="_blank">GitHub Flow</a> method.  
</p>

<h2>Donate</h2>

Donations support the efforts of the Nano community to further decentralize the Nano network by running representative nodes. 

<!-- donate to the maintainer -->      
<p>
Donate to the maintainer of this Nano node to help cover some of its costs. 
</p>

<div class="row">
  <div class="col-3">

    <div class="form-group">
      <div class="input-group mb-3">
        <input id="bbAmountNode" class="form-control" aria-label="Amount" type="text" value="0.1">
        <div class="input-group-append">
          <span class="input-group-text">NANO</span>
        </div>
      </div>
    </div>

  </div>
</div>

<button id="bbPaymentUrlNode" class="btn btn-secondary mb-3">Donate</button>

<div id="bb-button"></div>

<div id="donateMessage" class="alert alert-dismissible alert-success" style="display:none;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Thanks!</strong> Your support helps a lot!
</div>

<script>
init.push(function(){
  $('#bb-button').html();

  $('#bbPaymentUrlNode').click( function() {
    brainblocks.Button.render({
      // Pass in payment options
      payment: {
          destination: '<?php echo $nanoDonationAccount; ?>',
          currency:    'rai',
          amount:      $('#bbAmountNode').val() * 1000000
      },

      // Handle successful payments

      onPayment: function(data) {
        $('#donateMessage').show();
        console.log('Payment successful!', data.token);
      }

      }, '#bb-button');

  });
});
</script>

<script src="https://brainblocks.io/brainblocks.min.js"></script>
<!--- add the footer -->
<?php include 'modules/footer.php'; ?>