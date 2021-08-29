<!DOCTYPE html>
<html>
<head>
  <title>Varge Attendance System</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<style type="text/css">
  #message{
    position: fixed;
    top: 56px;
    width: 100%;
  }
</style>
<body>
<div class="bg-light">
  <nav class="navbar navbar-light bg-dark">
    <div class="container">
      <a class="navbar-brand  text-light" href="#" >WebHR Solutions</a>
    </div>
  </nav>
  <div id="message">
    <div id="data">
      <li ></li>
    </div>
  </div>
  <div class="container bg-light text-center pt-5 mt-5">
    <h1>Scan Your QR Code</h1>
    <video id="preview" style="border-radius: 80px; "></video>
  </div>
</div>


<script type="text/javascript">
 $(document).ready(function(){
  $('#message').hide();
 });
</script>
<!-- instascaner -->
 <script type="text/javascript">
  let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
  scanner.addListener('scan', function (content) {
  // alert(content);
  document.getElementById("data").innerHTML = content;
  var inputData = content;
  // send data and check if it matches
    $.ajax({
          url: "ajax-check.php",
          type : "POST",
          data : {email: inputData},
          success: function(data) {
              document.getElementById("data").innerHTML = data;
              $("#message").fadeIn();
               $("#message").delay(5000).fadeOut("slow");
          }
        });
  });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
</body>
</html>