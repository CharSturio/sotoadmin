$(document).ready(function () {
  $("#list").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/movelist.php");
  });

  $("#products").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/products.php");
  });

  $("#clients").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/clients.php");
  });

  $("#sucursales").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/branches.php");
  });

  $("#credit-collection").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/credit-collection.php");
  });

  $("#corte-caja").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/cash-cut.php");
  });

  $("#salida-caja").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/cash-out.php");
  });

  $("#stock").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/edit-stock.php");
  });

  $("#users").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/users.php");
  });

  $("#send-products").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/send-products.php");
  });

  $("#quoter").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/quoter.php");
  });

  $("#transferlist").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/transferlist.php");
  });

  $("#items_input").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/input-products.php");
  });

  $("#list2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/movelist.php");
  });

  $("#products2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/products.php");
  });

  $("#clients2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/clients.php");
  });

  $("#credit-collection2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/credit-collection.php");
  });

  $("#stock2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/edit-stock.php");
  });

  $("#users2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/users.php");
  });

  $("#quoter2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/quoter.php");
  });

  $("#items_input2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/input-products.php");
  });

  $("#rep_invoice").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_invoice.php");
  });

  $("#rep_merc_c_inv").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_merc_c_inv.php");
  });

  $("#rep_merc_s_inv").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_merc_s_inv.php");
  });

  $("#rep_merc_c_cost").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_merc_c_cost.php");
  });

  $("#min-stocks").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/send_min_stocks.php");
  });

  $("#send-inv-clients").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/send_client_inv.php");
  });

  $("#permisos").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/permissions.php");
  });

  $("#index").on("click", function(event)
  {
    event.preventDefault();
    location.reload();
  });
});
