function assignedTo(id, assignedTo)
{
  $('#assigned').width(150);
  $('#assignedTo' + id).load(createLink('user', 'ajaxGetUser', 'requestID=' + id + '&assignedTo=' + assignedTo));
}
