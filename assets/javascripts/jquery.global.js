
$(document).ready(function(){
    
    // Clickble menu
    $('#leftmenu > li > a').click(function(){
        
        var el = $(this).parent();
        
        if (el.hasClass('active')) {
            return false;
        }
        
        var elFade = $('#leftmenu > li.active');
        
        if (!elFade.length) {
            el.find('ul').fadeIn(function(){
                el.addClass('active');
            });
        }
        
        $('#leftmenu > li.active ul').fadeOut(function(){
            
            $('#leftmenu > li.active').removeClass('active');
            
            el.find('ul').fadeIn(function(){
                el.addClass('active');
            });
        });
        
        return false;
    });
    
    $('#proposals .filter select[name="type"]').change(function(){
        
        var type = $(this).val();
        var inclusion = $('#proposals .filter input[name="inclusion"]').is(":checked") ? 1 : 0 ;
        filterProposition(type, inclusion);
        
    });
    
    $('#proposals .filter input[name="inclusion"]').change(function(){
        
        var inclusion = $(this).is(":checked") ? 1 : 0 ;
        filterProposition($('#proposals .filter select[name="type"]').val(), inclusion);
        
    });
    
    function filterProposition(type, inclusion) {
        $.getJSON('/async/getproposalsbytype', {
            limit: $('#proposals .filter select[name="limit"]').val(),
            offset : 0,
            type: type,
            inclusion: inclusion
        }, function(responce){
            
            var proposals = $(responce.proposals);
            $('#proposals .result span').html(responce.count);
            $('#proposals .items').html(proposals.hide().fadeIn());
            
            if (responce.count > $('#proposals .items .item').length) {
                $('#more_proposal a').show();
            } else {
                $('#more_proposal a').hide();
                
            }
            
        }, 'JSON');
    }
    
    $('#more_proposal a').click(function(){
        
        var el = $(this);
        
        el.find('span').addClass('loader');
        
        $.ajax({
            url: '/async/getproposals',
            type: "GET",
            data: {
                limit: $('#proposals .filter select[name="limit"]').val(),
                offset : $('#proposals .item').length,
                type : $('#proposals .filter select[name="type"]').val(),
                inclusion: $('#proposals .filter input[name="inclusion"]').is(":checked") ? 1 : 0
            },
            success: function(responce) {
                
                var proposal = $(responce);
                $('#proposals .items').append(proposal.hide().fadeIn());
                
                el.find('span').removeClass('loader');
                
                if ($('#proposals .item').length >= parseInt($('#proposals .filter .result span').html())) {
                    el.hide();
                }
            }
        });
        
        return false;
    });
    
    $('#subscribe a ').click(function(){
        
        var email = $('#subscribe input[name="subscribe"]').val();
        
        if (!email.length) {
            alert('Вы не указали Email для рассылки.');
            return false;
        }
        
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        
        if (!re.test(email)) {
            alert('Email введен не верно!');
            return false;
        }
        
        $.post('/async/setsubscribe', {
            'subscribe' : email
        }, function(responce){
            alert('Для активации учетной записи, пройдите, пожалуйста, по соответствующей ссылке из отправленного вам письма.');
            window.location.reload();
        }, 'json');
        
        return false;
    });
    
    var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
    ];
    
    $('#search input[name="text"]').autocomplete({
        source: '/async/searchproposal',
        minLength: 2,
        select: function( event, ui ) {
            console.log([event, ui]);
            window.location = '/proposal/' + ui.item.uri
        }
    });
    
});