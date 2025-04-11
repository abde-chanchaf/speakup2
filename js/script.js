
//   method POST
  $('#chatForm').on('submit', function(e) {
e.preventDefault(); 
    $.ajax({
      url: '../php/send.php',
      type: 'POST',
      data: $(this).serialize(),
      success:function(res) {
        console.log(res);
      } ,
      error: function(error) {
        $('#message').html('<div class="alert alert-danger" role="alert">'+error+'</div>');
      }
    });

  });
