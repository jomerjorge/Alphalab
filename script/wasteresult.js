//View Records 
		function viewWaste(i){
			// connected to request id
			var item = testRequestList[i];
			pw_id = item.req_id; // id for request
		    wasteclrfld();
			$("#hiddenViewWaste").val(i);
			$("#hiddenWasteid").val(pw_id);
		    $("#modalWaste").modal("show");
			document.getElementById("wasteForm").style.display="none";
		    waste_count = item.waste_count;
		    $("#_wasteId").val(pw_id);
		    // document.getElementById("addWaste").style.display="block";
		    // document.getElementById("del_waste_mul").style.display="block";
		    // document.getElementById("delAllwaste").style.display="block";
    		document.getElementById('addWaste').focus();
			fetchWasteData();
		    console.log("Waste count from test request " + item.waste_count);
		    $("span#modalWaste").html("<b>" + item.rwt_num + "</b><br/>" + item.company_name);
 			$('#delAllwaste').prop('checked',false);    
		    // if (waste_count != 0){
		    // request id end
		        $.ajax({
		          url:"/alphalab/api/wasteresult/index.php?req_id=" + pw_id,
		          method:"GET",
		          dataType:"json",
		          success:function(response)
		          {
		            var html = '';
		            pwList = response;
		            for(var count = 0; count < response.length; count++)
		            {
			            html += '<tr>';
			            html += '<td><input type="checkbox" id="' + response[count].pw_id 
		          		     +  '" data-sample_labelw="' + response[count].sample_labelpw 
				  		     +  '" data-water_desw="' + response[count].water_despw 
				  		     +  '" data-w_param="' + response[count].pw_param 
				  		     +  '" data-w_met="' + response[count].pw_met 
				  		     +  '" data-w_result="' + response[count].pw_result 
				  		     +  '" data-w_analyst="' + response[count].pw_analyst 
			                 +  '" data-req_id="' + response[count].req_id
				  		     +  '" class="del_waste" /></td>';

			            html += '<td>' + response[count].water_despw + " " + response[count].sample_labelpw + '</td>';
			            html += '<td>' + response[count].pw_param + '</td>';
			            html += '<td>' + response[count].pw_met + '</td>';
			            html += '<td>' + response[count].pw_result + '</td>';
			            html += '<td>' + response[count].pw_analyst + '</td>';
		            }
		            $("#wasteTable tbody").html(html);
		            console.log(pw_id);
		          }
		        });
		   //      } else {
		   //      	document.getElementById("del_waste_mul").style.display="none";
		   //       	document.getElementById("delAllwaste").style.display="none";
				 //  	document.getElementById("addPchem").style.display="none";
				 // 	document.getElementById("addWaste").style.display="none";
				 // 	var html;
				 // 	 html += "<td colspan='5'>" + "No record found." + "</td>";
		   //           $("#wasteTable tbody").html(html);
				 // }

		}

//View Records End

function openNav_w() {
	    document.getElementById("mySidenav_w").style.width = "300px";
	    document.getElementById("wasteTable").style.marginLeft = "300px";
		document.getElementById("mySidenav_w").style.backgroundColor = "#EDEDED";
	}

	function closeNav_w() {
		wasteclrfld();
		resetwaste();
		document.getElementById("wasteForm").style.display="none";
	    document.getElementById("mySidenav_w").style.width = "0";
	    document.getElementById("wasteTable").style.marginLeft= "0";
		document.getElementById("mySidenav_w").style.backgroundColor = "";
	}

	$('#modalWaste').on('hidden.bs.modal', function (e) { //activate code when modal close
   		closeNav_w();
	})

//Add request
		function addWaste()
		{
			openNav_w();
		    wasteclrfld();
			document.getElementById("wasteForm").style.display="block";
            document.getElementById('sample_labelw').focus();
		}

	$("#wasteForm").submit(function(e){
		e.preventDefault();
 
	    // if (waste_count > datafound) {
		  var data = {};
 
			data["sample_labelpw"] = $('#sample_labelw').val();
			data["water_despw"] = $('#water_desw').val();
			data["pw_param"] = $('#w_param').val();
			data["req_id"] = $('#hiddenWasteid').val();	
 
	        	$.ajax({
		            type:'POST',
		            url: "/alphalab/api/wasteresult/new.php",
		            dataType: "json",
		            data: data,
		            success:function(response){
		            	swal({
							  position: 'center',
							  type: 'success',
							  title: 'Parameter(s) has been added',
							  showConfirmButton: false,
							  timer: 1500
							});
		            	wasteclrfld();
		                viewWaste($("#hiddenViewWaste").val());
		                document.getElementById("wasteForm").style.display="block";
		                console.log(data);
	            	},
		            error: function() { 
	                	document.getElementById('water_desw').style.borderColor = "#ff0000";
		                swal("Data already Exist!").then(function(){
                  		$('#sample_labelpw').focus();
						});
	                },
		        });
		        return false;	
			// } else {
			// 	swal("Waste limit exceeded!");
			// }
			 return false; // very important!!
		});
//Add request end


function fetchWasteData(){
     var req_id = $("#_wasteId").val();
    $.ajax({
      url:"/alphalab/api/wasteresult/countWaste.php",
      method:"GET",  
      dataType:"json",
      data: {
        req_id:req_id
      },
      success: function(data){
        console.log(data);
        if (data.success) {
           datafound = data.success.datafound;
           console.log("Waste Data from database " + datafound);
        }
        else {
        	datafound = 0;
        }
      }
    });
  }


//clear field
		function wasteclrfld(){
			$("#sample_labelw").val("");
			$("#water_desw").val("");
			// $("#w_param").val("");
		    document.getElementById("wastebtn").style.background='#ebebe0';
        	document.getElementById('water_desw').style.borderColor = "";

		}
//clear field

//View -> end

//select all
    $(document).ready(function(){
      $('#delAllwaste').on('click',function(){
        var waste_status = this.checked;
        var html = '';
            $('.del_waste').each(function(){
              this.checked = waste_status;
              if(this.checked)
              {
                html = '<td><input type="checkbox" id="'+$(this).attr('id') 
                     + '" data-sample_labelw="'+$(this).data('sample_labelw') 
                     + '" data-water_desw="'+$(this).data('water_desw') 
                     + '" data-w_param="'+$(this).data('w_param') 
                     + '" data-w_met="'+$(this).data('w_met') 
                     + '" data-w_result="'+$(this).data('w_result') 
                     + '" data-w_analyst="'+$(this).data('w_analyst') 
                     + '" data-req_id="'+$(this).data('req_id') 
                     + '" class="del_waste" checked /></td><input type="hidden" name="hidden_waste[]" value="'
                     + $(this).attr('id')+ '" /></td>';

                html += '<td>' + $(this).data('water_desw') + " " + $(this).data('sample_labelw') + '</td>';
                html += '<td>' + $(this).data('w_param') + '</td>';    
                html += '<td>' + $(this).data('w_met') + '</td>';   
                html += '<td>' + $(this).data('w_result') + '</td>';
                html += '<td>' + $(this).data('w_analyst') + '</td>';
        		$(this).closest('tr').addClass('removeRow');
              }else
              {
	              html = '<td><input type="checkbox" id="' + $(this).attr('id')
	                   + '" data-sample_labelw="'+$(this).data('sample_labelw') 
	                   + '" data-water_desw="'+$(this).data('water_desw') 
	                   + '" data-w_param="'+$(this).data('w_param')  
	                   + '" data-w_met="'+$(this).data('w_met') 
	                   + '" data-w_result="'+$(this).data('w_result')
	                   + '" data-w_analyst="'+$(this).data('w_analyst')
	                   + '" data-req_id"'+$(this).data('req_id')
	                     + '" class="del_waste" /></td>';

                html += '<td>' + $(this).data('water_desw') + " " + $(this).data('sample_labelw') + '</td>';
                html += '<td>' + $(this).data('w_param') + '</td>';     
                html += '<td>' + $(this).data('w_met') + '</td>';  
                html += '<td>' + $(this).data('w_result') + '</td>';
                html += '<td>' + $(this).data('w_analyst') + '</td>';	                   
        		$(this).closest('tr').removeClass('removeRow'); 
              }
              $(this).closest('tr').html(html);
            });
        });
    });
//select all

// individual select
  $(document).on('click', '.del_waste', function(){
      var html = '';
      if(this.checked)
      {
        html = '<td><input type="checkbox" id="'+$(this).attr('id') 
             + '" data-sample_labelw="'+$(this).data('sample_labelw') 
             + '" data-water_desw="'+$(this).data('water_desw') 
             + '" data-w_param="'+$(this).data('w_param')  
             + '" data-w_met="'+$(this).data('w_met') 
             + '" data-w_result="'+$(this).data('w_result') 
             + '" data-w_analyst="'+$(this).data('w_analyst') 
             + '" data-req_id="'+$(this).data('req_id') 
             + '" class="del_waste" checked /></td>';

        html += '<td>' + $(this).data('water_desw') + " " + $(this).data('sample_labelw') + '</td>';
        html += '<td>' + $(this).data('w_param') + '</td>';     
        html += '<td>' + $(this).data('w_met') + '</td>';   
        html += '<td>' + $(this).data('w_result') + '</td>';
        html += '<td>' + $(this).data('w_analyst') + '</td><input type="hidden" name="hidden_waste[]" value="'
                       + $(this).attr('id')+ '" /></td>';
		$(this).closest('tr').addClass('removeRow');
      }
      else
      {
      	html = '<td><input type="checkbox" id="' + $(this).attr('id')
	           + '" data-sample_labelw="'+$(this).data('sample_labelw') 
	           + '" data-water_desw="'+$(this).data('water_desw') 
	           + '" data-w_param="'+$(this).data('w_param')  
	           + '" data-w_met="'+$(this).data('w_met') 
	           + '" data-w_result="'+$(this).data('w_result')
	           + '" data-w_analyst="'+$(this).data('w_analyst')
	           + '" data-req_id"'+$(this).data('req_id')
	             + '" class="del_waste" /></td>';

	    html += '<td>' + $(this).data('water_desw') + " " + $(this).data('sample_labelw') + '</td>';
	    html += '<td>' + $(this).data('w_param') + '</td>';    
	    html += '<td>' + $(this).data('w_met') + '</td>';    
	    html += '<td>' + $(this).data('w_result') + '</td>';
	    html += '<td>' + $(this).data('w_analyst') + '</td>';	                   
		$(this).closest('tr').removeClass('removeRow');   
      }
      $(this).closest('tr').html(html);

      if($('.del_waste:checked').length == $('.del_waste').length){
              $('#delAllwaste').prop('checked',true);
          }else{
              $('#delAllwaste').prop('checked',false);
          }
  });
// individual select

//Delete
  $('#delete_waste').on('submit', function(event){
      event.preventDefault();

    	swal({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {
			      if($('.del_waste:checked').length > 0)
			      {
			          $.ajax({
			              url:"/alphalab/api/wasteresult/delete.php",
			              method:"POST",
			              data:$('#delete_waste').serialize(),
			              success:function()
			              {		
			              	 swal(
							      'Deleted!',
							      'Your file has been deleted.',
							      'success'
						      );
			                  $('#delAllwaste').prop('checked',false); 
			                  console.log($('#delete_waste').serialize());
			                  viewWaste($("#hiddenViewWaste").val());
			                  document.getElementById("wasteForm").style.display="block";
			                  openNav_w();
			              }
			          });  
			          return false;
				  } 
				  else {	
	              		swal("Select Item First!");       
				  }  
				  return false;
	      }  
	      return false;
	  });  
	});
//Delete