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
        var value = $("#reason").val();
        $.ajax({
          type: "POST",
          url: "requestButton.php",
          data: { 
            'action': clickBtnValue,
            'reason': value
            }
        }).done(function( msg ) {
          alert( msg );
        });
        });
        $('#btnDelete').click(function() {
        var clickBtnValue = $(this).val();
        $.ajax({
          type: "POST",
          url: "requestButton.php",
          data: { 
            'delete': clickBtnValue,
            }
        }).done(function( msg ) {
          alert( msg );
        });
        });
    
});
