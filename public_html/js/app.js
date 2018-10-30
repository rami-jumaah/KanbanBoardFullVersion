
var postData = function (data) {
    return fetch('api.php', {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json; charset=utf-8",
        },
        redirect: "follow",
        referrer: "no-referrer",
        body: JSON.stringify(data), // body data type must match "Content-Type" header
    }).then(function () {});
};

$(function() {
    if ($('#tasks').length) {
        userTasks = $('#tasks').data('tasks');
        for (userTask of userTasks) {
            $(userTask.state).append('<div class="sticky col-md-4">' + userTask.content + "</div > ");
        }
    }
    $("#add").on( "click" , function() {
        var content = $('#input').val();
        if (content === "") {
            $('.must').text("** Don't be Lazy .. Write and do something.!! **");
            return false;
        } else {
            postData({ content, state: '.todo' }).then(function () {
                location.reload();
            });

            $('.todo').append('<div class="sticky col-md-4">' + content + "</div>");
            $('#input').val('');
            $('.must').text('');
        }
    });
});
$(".todo").on("click", ".sticky", function() {
    var content = $(this).text();
    postData({ content, state: '.inprogress' });
    $('.inprogress').append('<div class="sticky col-md-4">' + content + "</div > ");
    $(this).fadeOut();
});
$(".inprogress").on("click", ".sticky", function() {
    var content = $(this).text();
    postData({ content, state: '.done' });
    $('.done').append('<div class="sticky col-md-4">' + content + "</div > ");
    $(this).fadeOut();
});
$(".done").on("click", ".sticky", function() {
    var content = $(this).text();
    postData({ content, state: 'delete' });
    $(this).fadeOut(1000)
});
$("#input").on("keyup" , function(event){
    if(event.keyCode === 13){
        $("#add").trigger("click");
    }
});