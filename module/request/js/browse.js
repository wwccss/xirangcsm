function assignedTo(id, assignedTo)
{
    $('#assigned').width(180);
    $('#assignedTo' + id).load(createLink('user', 'ajaxGetUser', 'requestID=' + id + '&assignedTo=' + assignedTo));
}
$(function()
{
    $('#' + browseType).addClass('active');
});
