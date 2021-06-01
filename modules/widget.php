<?php if ($currency == 'nano'): ?>

<img id="monkey" src="https://natricon.com/api/v1/nano?address=<?php echo $nanoNodeAccount; ?>&choe=UTF-8"
title="QR code for <?php echo $nanoNodeAccount; ?>"
style="max-width:250px; display:block; margin: 0 0 0 auto;" />

<?php elseif($currency == 'banano'): ?>

<img id="monkey" src="https://bananomonkeys.herokuapp.com/image?address=<?php echo $nanoNodeAccount; ?>" 
title="monKey for <?php echo $nanoNodeAccount; ?>"
style="max-width:250px; display:block; margin: 0 0 0 auto;" />

<?php endif; ?>
