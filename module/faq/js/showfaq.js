function switchProduct(productID)
{
  link = createLink('faq', 'showFAQ', 'productID=' + productID);
  location.href = link;
}
