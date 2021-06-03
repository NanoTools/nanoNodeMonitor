<?php if ($currency == 'nano' && $nanoNodeAccount): ?>

<img id="monkey" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=xrb:<?php echo $nanoNodeAccount; ?>&choe=UTF-8" 
title="QR code for <?php echo $nanoNodeAccount; ?>"
style="max-width:250px; display:block; margin: 0 0 0 auto;" />

<?php elseif($currency == 'banano' && $nanoNodeAccount): ?>

<img id="monkey" src="https://bananomonkeys.herokuapp.com/image?address=<?php echo $nanoNodeAccount; ?>" 
title="monKey for <?php echo $nanoNodeAccount; ?>"
style="max-width:250px; display:block; margin: 0 0 0 auto;" />

<?php endif; ?>