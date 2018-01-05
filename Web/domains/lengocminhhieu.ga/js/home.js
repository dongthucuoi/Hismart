$( document ).ready(function() {
// Start jquery///////////////

  // var tinhtrang = $("#filter-tinhtrang").val();
  // var yeucau = $("#filter-yeucau").val();
  var tinhtrang="1";
  var yeucau="all";
  $("#filter-tinhtrang").val(tinhtrang);
  $("#filter-yeucau").val(yeucau);
      // alert(tinhtrang+"---"+yeucau);
  $.get("list-ban.php",{tinhtrang:tinhtrang,yeucau:yeucau},function(data){
      // alert(data);
      $("#list_ban").html(data);
  });

  setInterval(function(){
    // this will run after every 5 seconds
    var tinhtrang = $("#filter-tinhtrang").val();
    var yeucau = $("#filter-yeucau").val();
    // alert(tinhtrang+"---"+yeucau);
    $.get("list-ban.php",{tinhtrang:tinhtrang,yeucau:yeucau},function(data){
        // alert(data);
        $("#list_ban").html(data);
    });
  }, 5000);

  $( "#filter-tinhtrang, #filter-yeucau" ).change(function() {
      // alert( "Handler for .change() called." );
      var tinhtrang = $("#filter-tinhtrang").val();
      var yeucau = $("#filter-yeucau").val();
      if(tinhtrang=="0"){
        $("#filter-yeucau").val("all");
        $("#filter-yeucau").prop('disabled', 'disabled');
      }
      else {
        $('#filter-yeucau').prop('disabled', false);
      }
      // alert(year);

      $.get("list-ban.php",{tinhtrang:tinhtrang,yeucau:yeucau},function(data){
          // alert(data);
          $("#list_ban").html(data);
      })
  });








});
