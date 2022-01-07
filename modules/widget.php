<?php if ($nanoNodeAccount): ?>
<?php if ($widgetType == 'qr'): ?>

<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=nano:<?php echo $nanoNodeAccount; ?>&choe=UTF-8" style="max-width:250px; display:block; margin: 0 0 0 auto;" />

<?php elseif($widgetType == 'natricon'): ?>

<img src="https://natricon.com/api/v1/nano?address=<?php echo $nanoNodeAccount; ?>" style="max-width:250px; display:block; margin: 0 0 0 auto;" />

<?php elseif($widgetType == 'monkey'): ?>

<img src="https://monkey.banano.cc/api/v1/monkey/<?php echo $nanoNodeAccount; ?>?svc=nanonodemonitor" style="max-width:250px; display:block; margin: 0 0 0 auto;" />

<?php endif; ?>
<?php endif; ?>
