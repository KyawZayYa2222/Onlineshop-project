$(document).ready(function(){
    // profile menu tab ------------/

    $('#personal_data_content').show();
    $('.menu-tab').click(function(event){
        $('.menu-tab').removeClass('menu-item-active');
        $(this).addClass('menu-item-active');
        $('.contents').hide();
        var menuTab = "#"+$(this).attr("id")+"_content";
        $(menuTab).show();
    });


    // custom payment radio button -------------/
    $('.payments').click(function() {
        $('.radio-label').removeClass("active-label");
        var parent = $(this).parent();
        $(parent).addClass("active-label");
    });


    // star rating ------------------//
    var stars = $('.star-btn');
    $('#s1Btn').click(function() {
        stars.css("color", "gray");
        $(this).css("color", "rgb(255, 179, 0)");
    });
    $('#s2Btn').click(function() {
        stars.css("color", "gray");
        $(this).add("#s1Btn").css("color", "rgb(255, 179, 0)");
    });
    $('#s3Btn').click(function() {
        stars.css("color", "gray");
        $(this).add("#s1Btn").add("#s2Btn").css("color", "rgb(255, 179, 0)");
    });
    $('#s4Btn').click(function() {
        stars.css("color", "gray");
        $(this).add("#s1Btn").add("#s2Btn").add("#s3Btn").css("color", "rgb(255, 179, 0)");
    });
    $('#s5Btn').click(function() {
        stars.css("color", "gray");
        $(this).add("#s1Btn").add("#s2Btn").add("#s3Btn").add("#s4Btn").css("color", "rgb(255, 179, 0)");
    });
});


// password hide show toggle -----------/
var oldPass = $('#old-pass');
var pass = $('#pass');
var confirmPass = $('#confirm-pass');

function clicker(event, inputTag) {
    var iconTag = event.target;
    passShowHide(inputTag, iconTag);
}

function passShowHide(inputTag, iconTag) {
    if (inputTag.prop('type') == "password") {
        inputTag.attr('type', "text");
        $(iconTag).removeClass().addClass('bi bi-eye-slash');
    } else {
        inputTag.attr('type', "password");
        $(iconTag).removeClass().addClass('bi bi-eye');
    };
};
