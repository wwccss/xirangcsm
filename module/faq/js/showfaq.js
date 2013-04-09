function switchProduct(productID)
{
  link = createLink('faq', 'showFAQ', 'productID=' + productID);
  location.href = link;
}
$(function(){
     $('#sidenav').width($('#sidenav').width()); 
     $('#sidenav').affix({ offset: { top: 90 } });
});
