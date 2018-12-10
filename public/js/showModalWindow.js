$(document).ready(function() {
    // Vary modal content based on trigger button
    $("#modalArt").on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        console.log( button.attr('href'));
        var target = button.attr('href');
        if (target) {
            $(this).load(target, function () {
                $(this).find('input:visible:first').focus();
            });
        }
    });
});