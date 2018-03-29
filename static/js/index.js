var template;

init.push(function(){
    $.get('templates/index.hbs', function (data) {
        template=Handlebars.compile(data);

        updateStats();
    }, 'html');
});

function updateStats(){
    $.get('api.php')
    .done(function (apidata) {
        $('#content').html(template(apidata));
        new ClipboardJS('#copyAccount');
        setTimeout(updateStats, GLOBAL_REFRESH * 1000);
    })
    .fail(function (apidata) {
        $('#content').html(apidata.responseText);
        console.log('FAIL', apidata.responseText);
        setTimeout(updateStats, GLOBAL_REFRESH * 1000);
    });
}