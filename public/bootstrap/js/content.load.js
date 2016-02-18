/*$.ajaxSetup({
    cache: false,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});*/

$(function () {
    $(".page-link").click(function () {
        var content_id = $(this).attr('name');
        //window.alert(content_id);
        //$('#dev-dash-content').hide().load(content_id).fadeIn( "slow" );
        //$('#dev-dash-content').hide().load("pages/MyDashboard.html").fadeIn( "slow" );
        //$('#dev-dash-content').load(content_id);
        $('#dev-dash-content').hide().load(content_id).fadeIn("slow");
        return false;
    });
});

$(function () {
    $(".sub-page-link").click(function () {
        window.alert("came here");
        var content_id = $(this).attr('name');
        window.alert(content_id);
        $('#dev-dash-sub-content').hide().load(content_id).fadeIn("slow");
        return false;
    });
});

function loadOnButtonClick(relPath) {
    //window.alert(relPath);
    $('#dev-dash-sub-content').hide().load(relPath).fadeIn("slow");
}

function loadOnLinkClick(relPath) {
    //window.alert(relPath);
    $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: "GET", // GET or POST
        url: relPath, // the file to call
        success: function (response) { // on success..
            $('#dev-dash-sub-content').html(response); // update the DIV
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.status);
            console.log(jqXHR.responseText);
            console.log(textStatus, errorThrown);
            var warning_out = "<p class='bg-warning'>" + errorThrown + "</p>";
            $('#dev-dash-sub-content').html(jqXHR.responseText);
            //$('#dev-dash-content').html("Proceed with warnings");
        }
    });
    return false;
}