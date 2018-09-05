var template;

init.push(function(){
  Handlebars.registerHelper('formatNumber', function (number, digits) {
    if(typeof number === 'undefined'){
      return 0;
    }

    if (Number.isInteger(digits)) {
      return number.toLocaleString('en-US', {minimumFractionDigits: digits, maximumFractionDigits: digits});
    }
    return number.toLocaleString('en-US');
  });

  Handlebars.registerHelper('formatNano', function (number) {
    if(typeof number === 'undefined'){
      return 0;
    }

    return number.toLocaleString('en-US', {minimumFractionDigits: GLOBAL_DIGITS, maximumFractionDigits: GLOBAL_DIGITS});
  });

  $.get('templates/index.hbs', function (data) {
    template=Handlebars.compile(data);

    updateStats();
  }, 'html');
});

var lastRepAccount = '';

function updateStats(){
  $.get('api.php')
  .done(function (apidata) {
    $('#content').html(template(apidata));
    new ClipboardJS('#copyAccount');
    if (apidata.currency == 'banano' && lastRepAccount != apidata.repAccount) {
      $('#monkey')
          .attr('src', 'http://www.monkeygen.com/image?address=' + apidata.repAccount)
          .attr('title', 'monKey for ' + apidata.repAccount);
      lastRepAccount = apidata.repAccount;
    }
    setTimeout(updateStats, GLOBAL_REFRESH * 1000);
  })
  .fail(function (apidata) {
    $('#content').html(apidata.responseText);
    console.log('FAIL', apidata.responseText);
    setTimeout(updateStats, GLOBAL_REFRESH * 1000);
  });
}
