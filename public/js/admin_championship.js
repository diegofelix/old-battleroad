$(document).ready(function(){$("#payment-filter").on("click","button",function(){var t=$(".status").slideUp(),n=$(this).data("status");"all"==n&&t.slideDown(),$(".status-"+n).slideDown()})});