$(document).ready(function () {
  $("#list").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/movelist.html");
  });

  $("#products").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/products.html");
  });

  $("#clients").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/clients.html");
  });

  $("#sucursales").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/sucursales.html");
  });

  $("#credit-collection").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/credit-collection.html");
  });

  $("#corte-caja").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/cash-cut.html");
  });

  $("#salida-caja").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/cash-out.html");
  });

  $("#stock").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/edit-stock.html");
  });

  $("#users").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/users.html");
  });

  $("#quoter").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/quoter.html");
  });

  $("#items_input").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/input-products.html");
  });

  $("#list2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/movelist.html");
  });

  $("#products2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/products.html");
  });

  $("#clients2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/clients.html");
  });

  $("#credit-collection2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/credit-collection.html");
  });

  $("#stock2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/edit-stock.html");
  });

  $("#users2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/users.html");
  });

  $("#quoter2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/quoter.html");
  });

  $("#items_input2").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/input-products.html");
  });

  $("#rep_invoice").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_invoice.html");
  });

  $("#rep_merc_c_inv").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_merc_c_inv.html");
  });

  $("#rep_merc_s_inv").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_merc_s_inv.html");
  });

  $("#rep_merc_c_cost").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/rep_merc_c_cost.html");
  });

  $("#min-stocks").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/send_min_stocks.html");
  });

  $("#send-inv-clients").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/send_client_inv.html");
  });

  $("#permisos").on("click", function(event)
  {
    event.preventDefault();
    $('#content').load("views/permisos.html");
  });

  $("#index").on("click", function(event)
  {
    event.preventDefault();
    location.reload();
  });
});
