$("document").ready(function(){var t=$("#totalprice");$(".input-competition").click(function(){var i=+$(this).data("price"),e=+t.text(),a=$(this).data("target"),d="#edit-nicks-"+$(this).val();$(d).removeClass("hide"),$(this).is(":checked")&&$(a).modal(),$(this).is(":checked")||(i=-1*i,$(d).addClass("hide"));var c=(e+i).toFixed(2);t.text(c)}),$("#checkout-form").on("submit",function(t){$(".modal").is(":visible")&&(t.preventDefault(),$(".modal").modal("hide"))})});