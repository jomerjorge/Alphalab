    function checkAvailability() {
          $("#loaderIconRWT").show();
          $("#rwt-availability-status").show(); // to show again the status after cycle
          var data = {};
                data["test_cat"] = $('#test_cat').val();
                data["rwt_num"] = $('#rwt_num').val();
            
            $.ajax({
                    url: "/alphalab/api/testrequest/check_availability.php",
                    data: data,
                    type: "POST",
                success:function(data){
                    console.log(data);
                    // setTimeout(function(){
                        $("#loaderIconRWT").hide();
                    // }, 500);  
                    // setTimeout(function(){
                       $("#rwt-availability-status").html(data);
                       $("#rwt-availability-status").show(); // to show again the status after cycle
                     // }, 1000); 

                   }
          });
      }

    $(function() {
        $('#rwt_num').on('focus', function() {
           $('#rwt-availability-status').fadeOut(100, function() {
                $(this).html(""); //reset the label after fadeout / to clear last status
            });
        });
    })


  function category(){
        if (document.getElementById("test_cat").value === "MICRO") {
            $("#rwt_num").attr('minlength','6');
            $("#rwt_num").attr('maxlength','6');
            document.getElementById("micro_count").disabled = false;
            document.getElementById("pchem_count").disabled = true;
            document.getElementById("waste_count").disabled = true;
            document.getElementById("rwt_num").disabled = false;
            $("#state").val("Ongoing");
            clrcount();

        } else if (document.getElementById("test_cat").value === "MICRO & PCHEM" || 
                   document.getElementById("test_cat").value === "MICRO with Special Test" || 
                   document.getElementById("test_cat").value === "POOL") {
            $("#rwt_num").attr('minlength','6');
            $("#rwt_num").attr('maxlength','6');
            document.getElementById("micro_count").disabled = false;
            document.getElementById("pchem_count").disabled = false;
            document.getElementById("waste_count").disabled = true;
            document.getElementById("rwt_num").disabled = false;
            $("#state").val("Ongoing");
            clrcount();

        } else if (document.getElementById("test_cat").value === "PCHEM" || 
                   document.getElementById("test_cat").value === "SPECIAL(PCHEM)" || 
                   document.getElementById("test_cat").value === "DIALYSIS") {
            $("#rwt_num").attr('minlength','6');
            $("#rwt_num").attr('maxlength','6');
            document.getElementById("pchem_count").disabled = false;
            document.getElementById("micro_count").disabled = true;
            document.getElementById("waste_count").disabled = true;
            document.getElementById("rwt_num").disabled = false;
            $("#state").val("Ongoing");
            // $("#rwt_num").val("");
           
            clrcount();

        } else if (document.getElementById("test_cat").value === "COLIFORM(Waste)") {
            document.getElementById("micro_count").disabled = false;
            document.getElementById("pchem_count").disabled = true;
            document.getElementById("waste_count").disabled = true;
            document.getElementById("rwt_num").disabled = false;
            $("#state").val("Ongoing");
            $("#rwt_num").attr('maxlength','4');
            $("#rwt_num").attr('minlength','4');
            clrcount();

        } else if (document.getElementById("test_cat").value === "WASTE & COLIFORM" ||
                   document.getElementById("test_cat").value === "SPECIAL(WASTE) & COLIFORM") {
            document.getElementById("waste_count").disabled = false;
            document.getElementById("micro_count").disabled = false;
            document.getElementById("pchem_count").disabled = true;
            document.getElementById("rwt_num").disabled = false;
            $("#state").val("Ongoing");
            $("#rwt_num").attr('maxlength','4');
            $("#rwt_num").attr('minlength','4');
            clrcount();

        } else { //FOR WASTE ONLY
            document.getElementById("waste_count").disabled = false;
            document.getElementById("micro_count").disabled = true;
            document.getElementById("pchem_count").disabled = true;
            document.getElementById("rwt_num").disabled = false;
            $("#state").val("Ongoing");
            $("#rwt_num").attr('maxlength','4');
            $("#rwt_num").attr('minlength','4');
            clrcount();
        }

  }

  function clrcount(){
            $("#micro_count").val("");
            $("#pchem_count").val("");
            $("#waste_count").val("");
  }

  function disSaveBtn(){
            document.getElementById('rwtSaveBtn').disabled = true;
  }
