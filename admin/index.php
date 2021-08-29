<?php

include('db.php');

session_start();

if(!isset($_SESSION["admin_id"]))
{
  header('location:login.php');
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>Manage Employees</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
          <button class="btn btn-primary mb-2"><a href="logout.php" id="logout">Logout</a></button>
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <button id="add-new-employee" class="btn btn-success">Add Employee</button>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>

  <!-- new employee model -->
  <div id="modal1">
    <div id="modal-form1">
      <h2 class="text-center">Add New Employee</h2>
      <table cellpadding="10px" width="100%">
        <tr>
          <td width='90px'>First Name</td>
          <td><input type='text' id='f_name' required="required" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input type='text' id='l_name' required="required" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type='text' id='email' required="required" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><input type='text' id='address' required="required" ></td>
        </tr>
        <tr>
          <td>Phone</td>
          <td><input type='text' id='phone' required autocomplete="off"></td>
        </tr>
        <tr>
          <td></td>
          <td class="text-center"><input class="btn btn-success" type='submit' id='submitAdd' value='Save'></td>
        </tr>
      </table>
      <div id="close-btn1">X</div>
    </div>
  </div>

  <!-- edit empolyee model -->
  <div id="modal">
    <div id="modal-form">
      <h2 class="text-center">Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "ajax-load.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load

    //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var studentId = $(this).data("id");
        var element = this;

        $.ajax({
          url: "ajax-delete.php",
          type : "POST",
          data : {id : studentId},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

    //Show Modal Box
    $(document).on("click",".edit-btn", function(){
      $("#modal").fadeIn();
      var studentId = $(this).data("eid");

      $.ajax({
        url: "load-update-form.php",
        type: "POST",
        data: {id: studentId },
        success: function(data) {
          $("#modal-form table").html(data);
        }
      })
    });

    //Hide Modal Box
    $("#close-btn").on("click",function(){
      $("#modal").fadeOut();
    });

    //Save Update Form
      $(document).on("click","#edit-submit", function(){
        var stuId = $("#edit-id").val();
        var fname = $("#edit-fname").val();
        var lname = $("#edit-lname").val();
        var email = $("#edit-email").val();
        var address = $("#edit-address").val();
        var phone = $("#edit-phone").val();

        $.ajax({
          url: "ajax-update-form.php",
          type : "POST",
          data : {id: stuId, first_name: fname, last_name: lname, eemail: email, eaddress: address, ephone: phone},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });

    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "ajax-live-search.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#table-data").html(data);
         }
       });
     });
     $('#add-new-employee').on('click',function(){
      $("#modal1").fadeIn();
     });
      //Hide Modalq Box
    $("#close-btn1").on("click",function(){
      $("#modal1").fadeOut();
    });
    //save new employee form
     $(document).on("click","#submitAdd", function(){
        var fname = $("#f_name").val();
        var lname = $("#l_name").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var phone = $("#phone").val();
        $.ajax({
          url: "ajax-insert.php",
          type : "POST",
          data : {first_name: fname, last_name: lname, eemail: email, eaddress: address, ephone: phone},
          success: function(data) {
            if(data == 1){
              $("#modal1").fadeOut();
              loadTable();
            }
          }
        });
      });

  });
</script>
</body>
</html>

<?php } ?>