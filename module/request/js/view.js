function switchFAQ(requestID, editReplyID, faqID)
{
    link = createLink('request', 'view', 'requestID=' + requestID + '&editReplyID=' + editReplyID + '&viewType=reply&faqID=' + faqID);
    location.href = link;
}
function showReply()
{
    $('#replyDiv').show();
    window.scrollTo(0, document.body.scrollHeight);
}

$(document).ready(function()
{
   if(viewType == 'reply')
   {
        $('#replyDiv').show();
   }
   else
   {
        $('#replyDiv').hide();
   }
   $("#doubtButton").click(function()
   {
        $("#doubt").toggle();
   });
   $("#valuateButton").click(function()
   {
        $("#valuate").toggle();
   });
});
