function switchProduct(productID)
{
  link = createLink('category', 'manage', 'productID=' + productID);
  location.href = link;
}
