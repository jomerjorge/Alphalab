			// TEST REQUEST SCRIPT
		function viewMicro(i){
			// connected to request id
			var item = testRequestList[i];
		    micro_id = item.req_id; // id for request
		    add_st = item.add_st;
		    add_city = item.add_city;
		    add_prov = item.add_prov;
		    $("#save").show();
			document.getElementById("save").disabled = false;
   			$("#updatebtn").hide();
		    microclrfld();
			$("#hiddenViewMicroid").val(i);
			$("#hiddenMicroid").val(micro_id);
		    $("#modalMicro").modal("show");
		    micro_count = item.micro_count;
		    test_cat = item.test_cat;
		    $("#_microId").val(micro_id);
            document.getElementById('sample_label').focus();
		    fetchMicroData();
		    console.log("micro count from test request " + micro_count);
		    document.getElementById("sam_place").value = add_st + " " + add_city + " " + add_prov;

		    $("span#modalMicro").html("<b>" + item.rwt_num + "</b><br/>" + item.company_name);// Set Title to Bootstrap modal title

		    $("span#cc_remarks").html(item.c_remarks)	
		    
		     // request id end
			$.getJSON("/alphalab/api/microResult/index.php?req_id=" + micro_id, function(response){
				$("#microTable tbody").html("");
				var html = "";
				microList = response; //para nd mag-undefined
				var i = 0;
				response.map(function(item)
				{
		    		html += "<tr>";
					html += "<td>" + item.sam_param + "</td>"
					html += "<td>" + item.sam_place + "</td>"  
					html += "<td>" + item.water_des + " " + item.sample_label + " " + item.sam_point + "</td>"
					// html += "<td>" + item.tc_potable + "</td>" 
					// html += "<td>" + item.thc_potable + "</td>" 
					// html += "<td>" + item.hpc_result + "</td>" 
					// html += "<td>" + item.ec_result + "</td>"

					// to highlight the failed total coliform results in micro
		            if (item.tc_potable != "<1.1" && item.tc_potable != "N/A") {
		              html += "<td class='failed_color'>" + item.tc_potable + "</td>";
		            }else {
		              html += "<td>" + item.tc_potable + "</td>";
		            }

		            // to highlight the failed thermotolerant coliform results in micro
		             if (item.thc_potable != "<1.1" && item.thc_potable != "N/A") {
		              html += "<td class='failed_color'>" + item.thc_potable + "</td>";
		            }else {
		              html += "<td>" + item.thc_potable + "</td>";
		            }

		            // to highlight the failed results in micro (included dialysis)
		            if(item.sam_param == 'Dialysis' && (item.hpc_result >= 200 || item.hpc_result == ">6500") ) {
		              html += '<td class="failed_color">' + item.hpc_result + '</td>';
		            }else if (item.sam_param != 'Dialysis' && (item.hpc_result >= 500 || item.hpc_result == ">6500") ) {
		              html += '<td class="failed_color">' + item.hpc_result + '</td>';
		            }else{
		              html += '<td>' + item.hpc_result + '</td>';
		            }

		            // to highlight the failed results in e-coli
		            if (item.ec_result == "Positive") {
		              html += '<td class="failed_color">' + item.ec_result + '</td>';
		            }else {
		              html += "<td>" + item.ec_result + "</td>";
		            }
		            
					html += "<td>" + item.micro_analyst + "</td>"
					

		            // to highlight the hold, Ongoing, Done and Printed results
	                if (item.remarks == 'Hold'){
	                       html += '<td><label class="label label-danger">' + item.remarks + '</label></td>';
	                }else if(item.remarks == 'Ongoing'){
	                       html += '<td><label class="label label-info">' + item.remarks + '</label></td>';
	                }else {
	                     html += '<td><label class="label label-success">' + item.remarks + '</label></td>';
	                }


					html += "<td>" + "<button class='btn btn-xs btn-primary' onclick='update_micro(" + i + ")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>" + " "
								   + "<button class='btn btn-xs btn-danger' onclick='delete_micro(" + i + ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>" + "</td>";
					html += "</tr>";
					i++;
				}
				); //end of function(item)
				$("#microTable tbody").html(html);
			});	
		}
//View Records End

	$("#microForm").submit(function(e){
		e.preventDefault();
		fetchMicroData(); // add this func to double check
		var sam_param = $('#sam_param').val();
	    if (micro_count > datafound) {
		  var data = {};

			data["sam_param"] = $('#sam_param').val();
			data["sample_label"] = $('#sample_label').val();
			data["water_des"] = $('#water_des').val();
			data["sam_point"] = $('#sam_point').val();
			data["sam_place"] = $('#sam_place').val();

			if(sam_param == 'TThH' || sam_param == 'Ice Analysis' || sam_param == 'Dialysis')
			{
				data["ec_result"] = document.getElementById("ec_result").value='N/A';
				data["tc_potable"] = document.getElementById("tc_potable").value='';
				data["thc_potable"] = document.getElementById("thc_potable").value='';
				data["hpc_result"] = document.getElementById("hpc_result").value='';
			}else if (sam_param == 'TTh') {
				data["hpc_result"] = document.getElementById("hpc_result").value='N/A';
				data["ec_result"] = document.getElementById("ec_result").value='N/A';
				data["tc_potable"] = document.getElementById("tc_potable").value='';
				data["thc_potable"] = document.getElementById("thc_potable").value='';
			}else if (sam_param == 'TTh/E') {
				data["hpc_result"] = document.getElementById("hpc_result").value='N/A';
				data["tc_potable"] = document.getElementById("tc_potable").value='';
				data["thc_potable"] = document.getElementById("thc_potable").value='';
				data["ec_result"] = document.getElementById("ec_result").value='';
			}else if (sam_param == 'HPC') {
				data["tc_potable"] = document.getElementById("tc_potable").value='N/A';
				data["thc_potable"] = document.getElementById("thc_potable").value='N/A';
				data["ec_result"] = document.getElementById("ec_result").value='N/A';
				data["hpc_result"] = document.getElementById("hpc_result").value='';
			}else if (sam_param == 'EC') {
				data["tc_potable"] = document.getElementById("tc_potable").value='N/A';
				data["thc_potable"] = document.getElementById("thc_potable").value='N/A';
				data["hpc_result"] = document.getElementById("hpc_result").value='N/A';
				data["ec_result"] = document.getElementById("ec_result").value='';
			}else if (sam_param == 'HPC/E') {
				data["tc_potable"] = document.getElementById("tc_potable").value='N/A';
				data["thc_potable"] = document.getElementById("thc_potable").value='N/A';
				data["hpc_result"] = document.getElementById("hpc_result").value='';
				data["ec_result"] = document.getElementById("ec_result").value='';
			}else{
				data["tc_potable"] = document.getElementById("tc_potable").value='';
				data["thc_potable"] = document.getElementById("thc_potable").value='';
				data["hpc_result"] = document.getElementById("hpc_result").value='';
				data["ec_result"] = document.getElementById("ec_result").value='';
			}
	
			data["tc_waste"] = document.getElementById("tc_waste").value='N/A';
			data["fc_waste"] = document.getElementById("fc_waste").value='N/A';
			data["remarks"] = $('#remarks').val();
			data["req_id"] = $('#hiddenMicroid').val();	

	        	$.ajax({
		            type:'POST',
		            url: '/alphalab/api/microResult/new.php',
		            dataType: "json",
		            data: data,
		            success:function(response){
		                microclrfld();
		                viewMicro($("#hiddenViewMicroid").val());
		                console.log(data);
	            	},
		            error: function() { 
	                	document.getElementById('water_des').style.borderColor = "#ff0000";
		                swal("Data already Exist!").then(function(){
						document.getElementById('water_des').focus();
						});
	                },
		        });
		        return false; // very important!!

			} else {
				swal("Micro limit exceeded!");
			}
			 return false; // very important!!

			
		});

function microclrfld(){
		$("#sample_label").val("");
		$("#water_des").val("");
		$("#sam_point").val("");
    	document.getElementById('water_des').style.borderColor = "";
}



function fetchMicroData(){
     var req_id = $("#_microId").val();
    $.ajax({
      url:"/alphalab/api/microResult/countMicro.php",
      method:"GET",  
      dataType:"json",
      data: {
        req_id:req_id
      },
      success: function(data){
        console.log(data);
        if (data.success) {
           datafound = data.success.datafound;
           console.log("Micro Data from database " + datafound);
          
        }
        else {
        	datafound = 0;
        }
      }
    });
  }


//Update
function update_micro(i)
{
	var item = microList[i];
	micro_id = item.micro_id; //id for micro
	$("#updatebtn").show();
	$("#save").hide();
	document.getElementById("save").disabled = true;

	$("#sam_param").val(item.sam_param);
	$("#sample_label").val(item.sample_label);
	$("#water_des").val(item.water_des);
	$("#sam_point").val(item.sam_point);
	$("#sam_place").val(item.sam_place);
	$('#tc_potable').val(item.tc_potable);
	$('#thc_potable').val(item.thc_potable);
	$('#hpc_result').val(item.hpc_result);
	$('#ec_result').val(item.ec_result);

	console.log("tambo " + item.thc_potable);	

	  $("#updatebtn").click(function () {
		  var sam_param = $('#sam_param').val();
		  var data = {};
	      data["micro_id"] = micro_id;
	      data["sam_param"] = $('#sam_param').val();
	      data["sample_label"] = $('#sample_label').val();
	      data["water_des"] = $('#water_des').val();
	      data["sam_point"] = $('#sam_point').val();
	      data["sam_place"] = $('#sam_place').val();
		  data["req_id"] = $('#hiddenMicroid').val();

			if(sam_param == 'HPC' || sam_param == 'HPC/E' || sam_param == 'EC')
			{
				data["tc_potable"] = document.getElementById("tc_potable").value='N/A';
				data["thc_potable"] = document.getElementById("thc_potable").value='N/A';
			}
			else{
				data["tc_potable"] = $('#tc_potable').val();
				data["thc_potable"] = $('#thc_potable').val();
			}

			if(sam_param == 'TTh' || sam_param == 'TTh/E' || sam_param == 'EC')
			{
				data["hpc_result"] = document.getElementById("hpc_result").value='N/A';
			}
			else{
				data["hpc_result"] = $('#hpc_result').val();
			}

			if(sam_param == 'TThH/E' || sam_param == 'TTh/E' || sam_param == 'EC' || sam_param == 'HPC/E')
			{
				data["ec_result"] = document.getElementById("ec_result").value='';
			}
			else{
				data["ec_result"] = $('#ec_result').val();
			}


          $.ajax({
              type:'POST',
              url: "/alphalab/api/microResult/update.php",
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
                $("#save").show();
   				$("#updatebtn").hide();
                viewMicro($("#hiddenViewMicroid").val());
              }
          }); 
           return false; 
	  });

}



//Delete
	function delete_micro(i){
			var item = microList[i];
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
				            url: "/alphalab/api/microResult/delete.php",
				            dataType: "json",
				            data: data,
				            success:function(response){
			            	 	swal(
							      'Deleted!',
							      'Your file has been deleted.',
							      'success'
							    );
			                	viewMicro($("#hiddenViewMicroid").val());
				                console.log(data);
			            	}
				        });
				        return false;
				  } 
				  return false;
				});
			}	
//end


// if(sam_param == 'HPC' || sam_param == 'HPC/E' || sam_param == 'EC')
// {
// 	data["tc_potable"] = document.getElementById("tc_potable").value='N/A';
// 	data["thc_potable"] = document.getElementById("thc_potable").value='N/A';
// }else{
// 	data["tc_potable"] = $('#tc_potable').val();
// 	data["thc_potable"] = $('#thc_potable').val();
// }

// if(sam_param == 'TTh' || sam_param == 'TTh/E' || sam_param == 'EC')
// {
// 	data["hpc_result"] = document.getElementById("hpc_result").value='N/A';
// }else{
// 	data["hpc_result"] = $('#hpc_result').val();
// }

// if(sam_param == 'TThH/E' || sam_param == 'TTh/E' || sam_param == 'EC' || sam_param == 'HPC/E')
// {
// 	data["ec_result"] = document.getElementById("ec_result").value='';
// }else{
// 	data["ec_result"] = $('#ec_result').val();
// }