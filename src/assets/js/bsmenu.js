/* Modified version of https://github.com/theel0ja/bsmenu/blob/3b264eac5adfad47acada2e8634974a84576745f/bsmenu.js */
$(document).ready(function () {
  var url = window.location;
  $('ul.nav li a[href="' + url + '"]').addClass('active');
  $('ul.nav li a').filter(function () {
    return this.href == url;
  }).addClass('active');
});