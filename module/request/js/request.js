function switchProduct(productID)
{
  link = createLink('request', 'request', 'productID=' + productID);
  location.href = link;
}
