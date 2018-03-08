var template;

$.get('templates/index.hbs', function (data) {
    template=Handlebars.compile(data);

    setInterval(updateStats, GLOBAL_REFRESH * 1000);
    updateStats();
}, 'html');

function updateStats(){
    $.get('modules/api.php')
    .done(function (apidata) {
        $('#content').html(template(apidata));
    })
    .fail(function (apidata) {
        $('#content').html(apidata.responseText);
        console.log('FAIL', apidata.responseText);
    });
}