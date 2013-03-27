function switchProduct(productID)
{
  link = createLink('faq', 'manage', 'productID=' + productID);
  location.href = link;
}
