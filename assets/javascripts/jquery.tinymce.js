/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $('textarea#text').tinymce({
        // Location of TinyMCE script
        script_url : '/assets/javascripts/tinymce/tiny_mce.js',

        // General options
            
        theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
            
        mode : "textareas",
        convert_urls : false,
        invalid_elements : 'a',

        // Theme options
        theme_advanced_buttons1 : "undo, redo, |, bold, italic, underline, strikethrough, |, justifyleft, justifycenter, justifyright, justifyfull, styleselect, formatselect, fontselect, fontsizeselect, sub, sup, |, forecolor, backcolor",
        theme_advanced_buttons2 : "cut, copy, paste, pastetext, pasteword, removeformat, cleanup, |, search, replace, |, bullist, numlist, |, outdent, indent, blockquote, |, link, unlink, image, |, insertdate, inserttime, hr, |, charmap, emotions, iespell",
        theme_advanced_buttons3 : "tablecontrols, |, visualaid",
        theme_advanced_buttons4 : "styleprops, |, cite, abbr, acronym, del, ins, |, visualchars, nonbreaking, |, print, preview, |, fullscreen",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        // content_css : "css/content.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }//,
    //language : 'ru'
    });
});