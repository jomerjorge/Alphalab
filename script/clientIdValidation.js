 function clientIdValidation() {

          $("#loaderIcon").show();
          var data = {};
                data["id_num"] = $('#id_num').val();
            
            $.ajax({ 
                    url: "/alphalab/api/clients/clientIdValidation.php",
                    data: data,
                    type: "POST",
                success:function(data){
                    console.log(data);
                        $("#loaderIcon").hide();
                       $("#id-availability-status").html(data);
                       $("#id-availability-status").show(); // to show again the status after cycle
                   }
          });

      }

    $(function() {
        $('#id_num').on('focus', function() {
           $('#id-availability-status').fadeOut(100, function() {
                $(this).html(""); //reset the label after fadeout / to clear last status
            });

        });
    })