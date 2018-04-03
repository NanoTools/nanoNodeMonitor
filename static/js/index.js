var template;

init.push(function(){
  Handlebars.registerHelper('formatNumber', function (number, digits) {
    if (Number.isInteger(digits)) {
      return number.toLocaleString('en-US', {minimumFractionDigits: digits, maximumFractionDigits: digits});
    }

    return number.toLocaleString('en-US');
  });

  Handlebars.registerHelper('formatNano', function (number) {
    return number.toLocaleString('en-US', {minimumFractionDigits: GLOBAL_DIGITS, maximumFractionDigits: GLOBAL_DIGITS});
  });

  $.get('templates/index.hbs', function (data) {
    template=Handlebars.compile(data);

    setInterval(updateStats, GLOBAL_REFRESH * 1000);
    updateStats();
  }, 'html');
});

function updateStats(){
  $.get('api.php')
  .done(function (apidata) {
    $('#content').html(template(apidata));
    new ClipboardJS('#copyAccount');
  })
  .fail(function (apidata) {
    $('#content').html(apidata.responseText);
    console.log('FAIL', apidata.responseText);
  });
}