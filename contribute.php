<?php
// include required files
require_once __DIR__.'/modules/includes.php';

include 'modules/header.php';
?>


<h2>Contribute</h2>
<p>
  If you want to contribute to Nano Node Monitor and further improve it, your help is very welcome. Have a look at its <a href="https://github.com/NanoTools/nanoNodeMonitor" target="_blank">GitHub page</a>, browse through open issues, check out the source code, create a branch, develop features, fix some bugs, and open pull requests. Development follows the standard <a href="https://guides.github.com/introduction/flow/" target="_blank">GitHub Flow</a> method.  
</p>

<h2>Donate</h2>

<p>
  Donations support the efforts of the Nano community to further decentralize the Nano network by running representative nodes.
</p>
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

<div id="bb-button"></div>

<div id="donateMessage" class="alert alert-dismissible alert-success" style="display:none;">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Thanks!</strong> Your support helps a lot!
</div>

<script>
init.push(function(){
  $( "#bbAmountNode" ).keyup(updateBrainButton);
  updateBrainButton();
});

function updateBrainButton() {
  $('#bb-button').empty();
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
};

</script>

<script src="https://brainblocks.io/brainblocks.min.js"></script>
<!--- add the footer -->
<?php include 'modules/footer.php'; ?>