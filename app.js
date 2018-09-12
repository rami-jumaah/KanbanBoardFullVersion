$(document).ready(function() {
    $("#add").click(function() {
        var a = $('#input').val();
        if (a === "") {
            $('.must').text("** Don't be Lazy .. Write and do something.!! **")
            return false;

        } else {
            $('.todo').append('<div class="sticky col-md-4">' + a + "</div>");
            $('#input').val('');
            $('.must').text('');
            // $(".sticky").draggable();
            // $(".sticky").droppable();


        }

    });
});
$(".todo").on("click", ".sticky", function() {
    $('.inprogress').append('<div class="sticky col-md-4">' + $(this).text() + "</div > ");
    $(this).fadeOut();
});
$(".inprogress").on("click", ".sticky", function() {
    $('.done').append('<div class="sticky col-md-4">' + $(this).text() + "</div > ");
    $(this).fadeOut();
});
$(".done").on("click", ".sticky", function() {
    $(this).fadeOut(1000)
});
$("#input").keyup(function(event){
    if(event.keyCode == 13){
        $("#add").click();
    }
});
