$(document).ready(function() {

    // alert message showoff

    var alert = $('#alert');
    setTimeout(showOff, 6000);

    function showOff() {
        alert.hide();
    }
});
