			// TEST REQUEST SCRIPT
		function viewMicroWaste(i){
			// connected to request id
			var item = testRequestList[i];
		    micro_id = item.req_id; // id for request
		    add_st = item.add_st;
		    add_city = item.add_city;
		    add_prov = item.add_prov;
		    microWasteclrfld();
		    $("#updatebtnw").hide();
			$("#savew").show();
			$("#hiddenViewMicroWasteid").val(i); // for viewing micro waste
			$("#hiddenMicroWasteid").val(micro_id); //for every row in micro waste
		    $("#modalMicroWaste").modal("show");
		    micro_count = item.micro_count;
		    test_cat = item.test_cat;
		    $("#_microWasteId").val(micro_id);
		    console.log(micro_id);
		    // document.getElementById("microWasteForm").style.display="block";
            document.getElementById('sample_label_mw').focus();
		    fetchMicroWasteData();
		    console.log(item.test_cat);
		    document.getElementById("sam_place_mw").value = add_st + " " + add_city + " " + add_prov;
		    $("span#modalMicroWaste").html("<b>" + item.rwt_num + "</b><br/>" + item.company_name);// Set Title to Bootstrap modal title		
		   //  // request id end
		    // if (test_cat != "MICRO" && test_cat != "MICRO & PCHEM" && test_cat != "PCHEM" && test_cat != "WASTE"){ 
		 	$.getJSON("/alphalab/api/microWasteResult/index.php?req_id=" + micro_id, function(response){
				$("#microWasteTable tbody").html("");
				var html = "";
				microWasteList = response; //para hindi mag-undefined
				var i = 0;
				response.map(function(item)
				{
		    		html += "<tr>";
					html += "<td>" + item.sam_param + "</td>"
					html += "<td>" + item.sam_place + "</td>" 
					html += "<td>" + item.water_des + " " + item.sample_label + "</td>"
					html += "<td>" + item.tc_waste + "</td>" 
					html += "<td>" + item.fc_waste + "</td>"
					html += "<td>" + item.micro_analyst + "</td>"
					html += "<td>" + item.remarks + "</td>"
					html += "<td>" + "<button class='btn btn-xs btn-primary' onclick='update_microwaste(" + i + ")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>" + " "
								   + "<button class='btn btn-xs btn-danger' onclick='delete_microWaste(" + i + ")'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</button>" + "</td>";
					html += "</tr>";
					i++;
				}
				); //end of function(item)
				$("#microWasteTable tbody").html(html);
			});	
		 // } else {
		 // 	document.getElementById("microWasteForm").style.display="none";
		 // 	var html;
		 // 	 html += "<td colspan='12'>" + "No record found." + "</td>";
   //           $("#microWasteTable tbody").html(html);
		 // }
		}
//View Records End

	$("#microWasteForm").submit(function(e){
		e.preventDefault();
		fetchMicroWasteData(); // add this func to double check
	    var sam_param_mw = $('#sam_param_w').val();
	    if (micro_count > datafound) {
		  var data = {};
		  console.log(sam_param_mw);

			data["sam_param"] = $('#sam_param_w').val();
			data["sample_label"] = $('#sample_label_mw').val();
			data["water_des"] = $('#water_des_mw').val();
			data["sam_place"] = $('#sam_place_mw').val();
			// data["tc_waste"] = $('#tc_waste_mw').val();
			// data["fc_waste"] = $('#fc_waste_mw').val();

			if(sam_param_mw == 'Fecal Coliform')
			{
				data["tc_waste"] = document.getElementById("tc_waste_mw").value='N/A';
				data["fc_waste"] = document.getElementById("fc_waste_mw").value='';
			}else if (sam_param_mw == 'Total Coliform') {
				data["tc_waste"] = document.getElementById("tc_waste_mw").value='';
				data["fc_waste"] = document.getElementById("fc_waste_mw").value='N/A';
			}else{
				data["tc_waste"] = document.getElementById("tc_waste_mw").value='';
				data["fc_waste"] = document.getElementById("fc_waste_mw").value='';
			}	

			data["tc_potable"] = document.getElementById("tc_potable_mw").value='N/A';
			data["thc_potable"] = document.getElementById("thc_potable_mw").value='N/A';
			data["hpc_result"] = document.getElementById("hpc_result_mw").value='N/A';
			data["ec_result"] = document.getElementById("ec_result_mw").value='N/A';
			// data["tc_potable"] = $('#tc_potable_mw').val();
			// data["thc_potable"] = $('#thc_potable_mw').val();
			// data["hpc_result"] = $('#hpc_result_mw').val();
			// data["ec_result"] = $('#ec_result_mw').val();
			data["remarks"] = $('#remarks_mw').val();
			data["req_id"] = $('#hiddenMicroWasteid').val();	

	        	$.ajax({
		            type:'POST',
		            url: '/alphalab/api/microWasteResult/new.php',
		            dataType: "json",
		            data: data,
		            success:function(response){
		                // swal("Request", response.message, "success");
		                microWasteclrfld();
		                viewMicroWaste($("#hiddenViewMicroWasteid").val());
		                console.log(data);
	            	},
		            error: function() { 
	                	document.getElementById('water_des_mw').style.borderColor = "#ff0000";
		                swal("Data already Exist!").then(function(){
						document.getElementById('water_des_mw').focus();
						});
	                },
		        });
		        return false; // very important!!

			} else {
				swal("Micro Waste limit exceeded!");
			}
			 return false; // very important!!

			
		});


function microWasteclrfld(){
		$("#sample_label_mw").val("");
		$("#water_des_mw").val("");
	    document.getElementById('water_des_mw').style.borderColor = "";
}



function fetchMicroWasteData(){
     var req_id = $("#_microWasteId").val();
    $.ajax({
      url:"/alphalab/api/microWasteResult/countMicroWaste.php",
      method:"GET",  
      dataType:"json",
      data: {
        req_id:req_id
      },
      success: function(data){
        console.log(data);
        if (data.success) {
           datafound = data.success.datafound;
           console.log("Micro Waste Data from database " + datafound);

        }
        else {
        	datafound = 0;
        }
      }
    });
  }


//Update
function update_microwaste(i)
{
	var item = microWasteList[i];
	micro_id = item.micro_id; //id for micro

	$("#updatebtnw").show();
	$("#savew").hide();

	$("#sam_param_w").val(item.sam_param);
	$("#sample_label_mw").val(item.sample_label);
	$("#water_des_mw").val(item.water_des);
	$("#sam_place_mw").val(item.sam_place);	

	  $("#updatebtnw").click(function () {
		  var sam_param_mw = $('#sam_param_w').val();
		  console.log(sam_param_mw);
		  var data = {};
	      data["micro_id"] = micro_id;
		  data["sam_param"] = $('#sam_param_w').val();
	      data["sample_label"] = $('#sample_label_mw').val();
	      data["water_des"] = $('#water_des_mw').val();
	      data["sam_place"] = $('#sam_place_mw').val();

		if(sam_param_mw == 'Fecal Coliform')
		{
			data["tc_waste"] = document.getElementById("tc_waste_mw").value='N/A';
			data["fc_waste"] = document.getElementById("fc_waste_mw").value='';
		}else if (sam_param_mw == 'Total Coliform') {
			data["tc_waste"] = document.getElementById("tc_waste_mw").value='';
			data["fc_waste"] = document.getElementById("fc_waste_mw").value='N/A';
		}else{
			data["fc_waste"] = document.getElementById("fc_waste_mw").value='';
			data["tc_waste"] = document.getElementById("tc_waste_mw").value='';
		}	

	      data["req_id"] = $('#hiddenMicroWasteid').val();

          $.ajax({
              type:'POST',
              url: "/alphalab/api/microWasteResult/update.php",
              dataType: "json",
              data:data,
              success:function(response){
                swal({
                position: 'center',
                type: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              });	   
                $("#savew").show();
   				$("#updatebtnw").hide();
                viewMicroWaste($("#hiddenViewMicroWasteid").val());
              }
          }); 
           return false; 
	  });

}


//Delete
	function delete_microWaste(i){
			var item = microWasteList[i];
			micro_id = item.micro_id; //id for micro
			var data = 	{};
			data["micro_id"] = micro_id;
			console.log(micro_id);
	        	
	        swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				})
				.then((result) => {
				  if (result.value) {
			        	$.ajax({
				            type:'POST',
				            url: "/alphalab/api/microWasteResult/delete.php",
				            dataType: "json",
				            data: data,
				            success:function(response){
				            	swal(
							      'Deleted!',
							      'Your file has been deleted.',
							      'success'
							    );
			                	viewMicroWaste($("#hiddenViewMicroWasteid").val());
				                console.log(data);
			            	}
				        });
				        return false;
				  }
				  return false;
				});
			}	
//end
