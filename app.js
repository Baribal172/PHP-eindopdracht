$(document).ready(function(){
    $('#btnAccept').click(function() {
                var clickBtnValue = $(this).val();
        $.ajax({
          type: "POST",
          url: "requestButton.php",
          data: { 
            'action': clickBtnValue
            }
        }).done(function( msg ) {
          alert( msg );
        });
      });
      $('#btnDecline').click(function() {
        var clickBtnValue = $(this).val();
        $.ajax({
          type: "POST",
          url: "requestButton.php",
          data: { 
            'action': clickBtnValue
            }
        }).done(function( msg ) {
          alert( msg );
        });
        });
    
});
