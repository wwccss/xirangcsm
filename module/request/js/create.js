function switchProduct(productID)
{
  link = createLink('request', 'create', 'productID=' + productID);
  location.href = link;
}
