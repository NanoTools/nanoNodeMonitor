var template;

// get the template
$.get('templates/index.hbs', function (data) {
    template=Handlebars.compile(data);

    // and get the first data
    updateStats();
}, 'html');

function updateStats(){
    // get the node information
    $.get('api.php')
    .done(function (apidata) {
        // update the content
        $('#content').html(template(apidata));
    })
    .fail(function (apidata) {
        // whoops! display the error
        $('#content').html(apidata.responseText);
        console.log('FAIL', apidata.responseText);
    })
    .always(function(){
        // wait till the next update
        setTimeout(updateStats, GLOBAL_REFRESH * 1000);
    });
}