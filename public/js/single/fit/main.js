console.log('Enhanced FIT');

$(function(){

    var contentDom = $('#fit_details_contentHtmlText');
    var pTag = contentDom.find('p');
    var  div;
    while(pTag.length){
        div=document.createElement('div');

        div.innerHTML = pTag[0].innerHTML;
        pTag[0].parentNode.replaceChild(div, pTag[0]);
        var dummy = $('<br/>');
        dummy.insertAfter($(div));
        pTag = contentDom.find('p');
    }

console.log('contentDom', contentDom[0].innerHTML);

    var fit_details =  $('#fit_details');
    var copyText = ( fit_details.text().replace('{{$contentText}}', contentDom[0].innerText));
    console.log('copyText', copyText);
    $('#fit_details').val(copyText);

    new Clipboard('#btn-copy-text', {
        text: function(trigger) {
            return $('#fit_details').val();
        }
    });


});