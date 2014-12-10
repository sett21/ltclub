$(document).ready(function(){

    $('html').click(function () {
        $("#aeroplist_dep").fadeOut(100);
        $("#aeroplist_arr").fadeOut(100);
        $("#aeroplist_dep_2").fadeOut(100);
        $("#aeroplist_arr_2").fadeOut(100);
    });

    $('#dep_0').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_dep" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_dep").html(list);
                    $("#aeroplist_dep").show();
                }
                else{
                    $("#aeroplist_dep").html('');
                    $("#aeroplist_dep").hide();   
                }

                $('.aeropitem_dep').click(function (event) {
                    stopEvent(event);
                    $("#form_value_dep_0").val($(this).attr('id'));
                    $("#dep_0").val($(this).text());
                    $("#aeroplist_dep").html('');
                    $("#aeroplist_dep").hide();
                });

            });
        }
    });

    $('#arr_0').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_arr" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_arr").html(list);
                    $("#aeroplist_arr").show();
                }
                else{
                    $("#aeroplist_arr").html('');
                    $("#aeroplist_arr").hide();   
                }

                $('.aeropitem_arr').click(function (event) {
                    stopEvent(event);
                    $("#form_value_arr_0").val($(this).attr('id'));
                    $("#arr_0").val($(this).text());
                    $("#aeroplist_arr").html('');
                    $("#aeroplist_arr").hide();
                });

            });
        }
    });

    $('#dep_0').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#arr_0').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#FULL_DATE_0').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#FULL_DATE_1').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#dep_1').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#arr_1').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#FULL_DATE_2').click(function () {
        $(this).css('border', '1px solid #bbb');
    });    

    $('#dep_2_1').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#arr_2_1').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#dep_2_2').click(function () {
        $(this).css('border', '1px solid #bbb');
    });

    $('#arr_2_2').click(function () {
        $(this).css('border', '1px solid #bbb');
    });    

    $('#FULL_DATE_3').click(function () {
        $(this).css('border', '1px solid #bbb');
    });  

    $('#FULL_DATE_4').click(function () {
        $(this).css('border', '1px solid #bbb');
    });  

    $('#dep_1').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_dep_2" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_dep_2").html(list);
                    $("#aeroplist_dep_2").show();
                }
                else{
                    $("#aeroplist_dep_2").html('');
                    $("#aeroplist_dep_2").hide();   
                }

                $('.aeropitem_dep_2').click(function (event) {
                    stopEvent(event);
                    $("#form_value_dep_1").val($(this).attr('id'));
                    $("#dep_1").val($(this).text());
                    $("#aeroplist_dep_2").html('');
                    $("#aeroplist_dep_2").hide();
                });

            });
        }
    });

    $('#arr_1').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_arr_2" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_arr_2").html(list);
                    $("#aeroplist_arr_2").show();
                }
                else{
                    $("#aeroplist_arr_2").html('');
                    $("#aeroplist_arr_2").hide();   
                }

                $('.aeropitem_arr_2').click(function (event) {
                    stopEvent(event);
                    $("#form_value_arr_1").val($(this).attr('id'));
                    $("#arr_1").val($(this).text());
                    $("#aeroplist_arr_2").html('');
                    $("#aeroplist_arr_2").hide();
                });

            });
        }
    });    


    $('#dep_2_1').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_dep_2_1" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_dep_3_1").html(list);
                    $("#aeroplist_dep_3_1").show();
                }
                else{
                    $("#aeroplist_dep_3_1").html('');
                    $("#aeroplist_dep_3_1").hide();   
                }

                $('.aeropitem_dep_2_1').click(function (event) {
                    stopEvent(event);
                    $("#form_value_dep_2_1").val($(this).attr('id'));
                    $("#dep_2_1").val($(this).text());
                    $("#aeroplist_dep_3_1").html('');
                    $("#aeroplist_dep_3_1").hide();
                });

            });
        }
    });

    $('#arr_2_1').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_arr_2_1" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_arr_3_1").html(list);
                    $("#aeroplist_arr_3_1").show();
                }
                else{
                    $("#aeroplist_arr_3_1").html('');
                    $("#aeroplist_arr_3_1").hide();   
                }

                $('.aeropitem_arr_2_1').click(function (event) {
                    stopEvent(event);
                    $("#form_value_arr_2_1").val($(this).attr('id'));
                    $("#arr_2_1").val($(this).text());
                    $("#aeroplist_arr_3_1").html('');
                    $("#aeroplist_arr_3_1").hide();
                });

            });
        }
    }); 

    $('#dep_2_2').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_dep_2_2" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_dep_3_2").html(list);
                    $("#aeroplist_dep_3_2").show();
                }
                else{
                    $("#aeroplist_dep_3_2").html('');
                    $("#aeroplist_dep_3_2").hide();   
                }

                $('.aeropitem_dep_2_2').click(function (event) {
                    stopEvent(event);
                    $("#form_value_dep_2_2").val($(this).attr('id'));
                    $("#dep_2_2").val($(this).text());
                    $("#aeroplist_dep_3_2").html('');
                    $("#aeroplist_dep_3_2").hide();
                });

            });
        }
    });


    $('#arr_2_2').keyup(function () {
        if($(this).val().length > 2){
            $.post( "/avia/getcity/", { city: $(this).val() }).done(function( data ) 
            {
                var aeroports = jQuery.parseJSON(data);
                if(aeroports.length > 0){
                    var list = '';
                    for(var i=0; i<aeroports.length; i++){
                        list = list + '<div class="aeropitem_arr_2_2" id="'+aeroports[i][0]+'">'+aeroports[i][1]+' '+aeroports[i][2]+' ('+aeroports[i][0]+')</div>';
                    }
                    $("#aeroplist_arr_3_2").html(list);
                    $("#aeroplist_arr_3_2").show();
                }
                else{
                    $("#aeroplist_arr_3_2").html('');
                    $("#aeroplist_arr_3_2").hide();   
                }

                $('.aeropitem_arr_2_2').click(function (event) {
                    stopEvent(event);
                    $("#form_value_arr_2_2").val($(this).attr('id'));
                    $("#arr_2_2").val($(this).text());
                    $("#aeroplist_arr_3_2").html('');
                    $("#aeroplist_arr_3_2").hide();
                });

            });
        }
    }); 

});



function stopEvent(e) {
    var ieVersion = /*@cc_on (function() {switch(@_jscript_version) {case 1.0: return 3; case 3.0: return 4; case 5.0: return 5; case 5.1: return 5; case 5.5: return 5.5; case 5.6: return 6; case 5.7: return 7; case 5.8: return 8; case 9: return 9; case 10: return 10;}})() || @*/ 0;

    if(ieVersion != 9){
        if(!e) var e = window.event;

        //e.cancelBubble is supported by IE -
        // this will kill the bubbling process.
        e.cancelBubble = true;
        e.returnValue = false;

        //e.stopPropagation works only in Firefox.
        if ( e.stopPropagation ) e.stopPropagation();
        if ( e.preventDefault ) e.preventDefault();
    }
    
    if(ieVersion == 9){
        if(e !== null) {
            if(e.stopPropagation) e.stopPropagation()
        } 
    }

    return false;
}


function chek_avia_form(form){
    if(form == 'rt')
    {
       if(
            $("#form_value_dep_0").val() == '' ||
            $("#form_value_arr_0").val() == '' ||
            $("#FULL_DATE_0").val() == '' ||
            $("#FULL_DATE_1").val() == ''
        ){

            if($("#form_value_dep_0").val() == '')
                $("#dep_0").css('border', '1px solid red');

            if($("#form_value_arr_0").val() == '')
                $("#arr_0").css('border', '1px solid red');

            if($("#FULL_DATE_0").val() == '')
                $("#FULL_DATE_0").css('border', '1px solid red');

            if($("#FULL_DATE_1").val() == '')
                $("#FULL_DATE_1").css('border', '1px solid red');

            return false;
        }
        else
            return true;
    }

    if(form == 'ow')
    {
       if(
            $("#form_value_dep_1").val() == '' ||
            $("#form_value_arr_1").val() == '' ||
            $("#FULL_DATE_2").val() == ''
        ){

            if($("#form_value_dep_1").val() == '')
                $("#dep_1").css('border', '1px solid red');

            if($("#form_value_arr_1").val() == '')
                $("#arr_1").css('border', '1px solid red');

            if($("#FULL_DATE_2").val() == '')
                $("#FULL_DATE_2").css('border', '1px solid red');

            return false;
        }
        else
            return true;
    }

    if(form == 'oj')
    {
       if(
            $("#form_value_dep_2_1").val() == '' ||
            $("#form_value_dep_2_2").val() == '' ||
            $("#form_value_arr_2_1").val() == '' ||
            $("#form_value_arr_2_1").val() == '' ||
            $("#FULL_DATE_3").val() == '' ||
            $("#FULL_DATE_4").val() == ''
        ){

            if($("#form_value_dep_2_1").val() == '')
                $("#dep_2_1").css('border', '1px solid red');

            if($("#form_value_dep_2_2").val() == '')
                $("#dep_2_2").css('border', '1px solid red');

            if($("#form_value_arr_2_1").val() == '')
                $("#arr_2_1").css('border', '1px solid red');

            if($("#form_value_arr_2_2").val() == '')
                $("#arr_2_2").css('border', '1px solid red');

            if($("#FULL_DATE_3").val() == '')
                $("#FULL_DATE_3").css('border', '1px solid red');

            if($("#FULL_DATE_4").val() == '')
                $("#FULL_DATE_4").css('border', '1px solid red');

            return false;
        }
        else
            return true;
    }

}