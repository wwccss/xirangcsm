function switchProduct(requestID, productID)
{
  link = createLink('request', 'edit', 'requestID=' + requestID + '&productID=' + productID);
  location.href = link;
}
