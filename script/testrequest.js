			// TEST REQUEST SCRIPT
//View Records 
		function view(i){
			// connected to client id
			var item = list[i];
			req_id = item.id; // id for client
			$("#hiddenTestid").val(i);
			$("#hiddenClientid").val(req_id);
		    $("#modalReq").modal("show");
			document.getElementById("reqAddForm").style.display="none";
			$("span#modalReq").html("<b>" + item.company_name + "</b>" + "&nbsp &nbsp " + item.client_name + "<br/>" + item.add_city + " " + item.add_prov);// Set Title to Bootstrap modal title
            document.getElementById('addRequest').focus();
			$("#modalMicroWaste").scrollTop(0);
		    // client id end

		 $.getJSON("/alphalab/api/testrequest/index.php?client_id=" + req_id, function(response){
				$("#reqRec tbody").html("");
				var html = "";
				testRequestList = response;
				var i = 0;
				response.map(function(item)
				{
				var t_cat = item.test_cat;
		    	html += "<tr>";
				html += "<td>" + item.test_cat + "</td>"
				html += "<td>" + item.rwt_num + "</td>"
				html += "<td>" + item.date_rcvd + "</td>"
				html += "<td>" + item.date_sample + "</td>" 
				html += "<td class='center_num'>" + item.micro_count + "</td>" 
				html += "<td class='center_num'>" + item.pchem_count + "</td>" 
				html += "<td class='center_num'>" + item.waste_count + "</td>"
				html += "<td>" + item.fsa + "</td>"
				// html += "<td>" + item.state + "</td>"
				html += "<td>" + item.remarks + "</td>"

				if ((t_cat == "PCHEM") || (t_cat == "SPECIAL(PCHEM)") || (t_cat == "DIALYSIS"))
				{
					html += "<td>" + "<button class='btn btn-xs btn-primary' id='Upbtn' title='Update' onclick='edit_req(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" + " "
							   + "<button class='btn btn-xs pc_color' id='pbtn' title='Pchem' onclick='viewPchem(" + i + ")'>Pc</button>" + " "
							   + "<button class='btn btn-xs btn-danger' id='del' title='Delete' onclick='delete_req(" + i + ")'><span class='fa fa-trash-o' aria-hidden='true'></span></button>" + "</td>";
				    html += "</tr>";
				} else if (t_cat == "MICRO")
				{
					html += "<td>" + "<button class='btn btn-xs btn-primary' id='Upbtn' title='Update' onclick='edit_req(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" + " " 
							   + "<button class='btn btn-xs mc_color' id='mbtn' title='Micro Potable' onclick='viewMicro(" + i + ")'>Mp</button>" + " "
							   + "<button class='btn btn-xs btn-danger' id='del' title='Delete' onclick='delete_req(" + i + ")'><span class='fa fa-trash-o' aria-hidden='true'></span></button>" + "</td>";
				    html += "</tr>";
				} else if ((t_cat == "MICRO & PCHEM") || (t_cat == "MICRO with Special Test") || (t_cat == "POOL"))
				{
					html += "<td>" + "<button class='btn btn-xs btn-primary' id='Upbtn' title='Update' onclick='edit_req(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" + " " 
							   + "<button class='btn btn-xs mc_color' id='mbtn' title='Micro Potable' onclick='viewMicro(" + i + ")'>Mp</button>" + " " 
							   + "<button class='btn btn-xs pc_color' id='pbtn' title='Pchem' onclick='viewPchem(" + i + ")'>Pc</button>" + " "
							   + "<button class='btn btn-xs btn-danger' id='del' title='Delete' onclick='delete_req(" + i + ")'><span class='fa fa-trash-o' aria-hidden='true'></span></button>" + "</td>";
				    html += "</tr>";
				} else if ((t_cat == "WASTE") || (t_cat == "SPECIAL(WASTE)"))
				{
					html += "<td>" + "<button class='btn btn-xs btn-primary' id='Upbtn' title='Update' onclick='edit_req(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" + " "  
							   + "<button class='btn btn-xs ww_color' id='wbtn' title='Waste' onclick='viewWaste(" + i + ")'>Ww</button>" + " " 
							   + "<button class='btn btn-xs btn-danger' id='del' title='Delete' onclick='delete_req(" + i + ")'><span class='fa fa-trash-o' aria-hidden='true'></span></button>" + "</td>";
				    html += "</tr>";
				} else if (t_cat == "COLIFORM(Waste)")
				{
					html += "<td>" + "<button class='btn btn-xs btn-primary' id='Upbtn' title='Update' onclick='edit_req(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" + " " 
							   + "<button class='btn btn-xs ww_color' id='mwbtn' title='Micro Waste' onclick='viewMicroWaste(" + i + ")'>Mw</button>" + " "
							   + "<button class='btn btn-xs btn-danger' id='del' title='Delete' onclick='delete_req(" + i + ")'><span class='fa fa-trash-o' aria-hidden='true'></span></button>" + "</td>";
				    html += "</tr>";
				} else if ((t_cat == "WASTE & COLIFORM") || (t_cat == "SPECIAL(WASTE) & COLIFORM"))
				{
					html += "<td>" + "<button class='btn btn-xs btn-primary' id='Upbtn' title='Update' onclick='edit_req(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" + " "
							   + "<button class='btn btn-xs ww_color' id='mwbtn' title='Micro Waste' onclick='viewMicroWaste(" + i + ")'>Mw</button>" + " " 
							   + "<button class='btn btn-xs ww_color' id='wbtn' title='Waste' onclick='viewWaste(" + i + ")'>Ww</button>" + " " 
							   + "<button class='btn btn-xs btn-danger' id='del' title='Delete' onclick='delete_req(" + i + ")'><span class='fa fa-trash-o' aria-hidden='true'></span></button>" + "</td>";
				    html += "</tr>";
				} else {
					html += "<td>" + "<button class='btn btn-xs btn-primary' id='Upbtn' title='Update' onclick='edit_req(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" + " "
							   	   + "<button class='btn btn-xs btn-danger' id='del' title='Delete' onclick='delete_req(" + i + ")'><span class='fa fa-trash-o' aria-hidden='true'></span></button>" + "</td>";
				    html += "</tr>";
				}
				
				i++;
				}
				); //end of function(item)
				$("#reqRec tbody").html(html);
				console.log(req_id);

			});	

		}

//View Records End

	$('#addRequest').click(function() {
        $('#reqAddForm').slideDown();
        addRequest();
    });
         
    
    $('#CloseAddRequest').click(function() {
        $('#reqAddForm').slideUp();
    });
	

		
		function addRequest(){
			req_id = 0;
			document.getElementById("reqAddForm").style.display="block";
			testclearField();
			document.getElementById('rwtSaveBtn').disabled = false;
            document.getElementById("micro_count").disabled = true;
            document.getElementById("pchem_count").disabled = true;
            document.getElementById("waste_count").disabled = true;
            document.getElementById("rwt_num").disabled = true;
            $('#test_cat').focus();
		}


//Add request

		$("#reqAddForm").submit(function(e){
			e.preventDefault();

			var tc = $('#test_cat').val();;
			var rn = $('#rwt_num').val().length;
		
			console.log('rn length' + rn);
			console.log('tc' + tc);

			if(tc === 'MICRO' || tc === 'MICRO & PCHEM' || tc === 'PCHEM'){
				if( rn != 6){
				  swal('Invalid input of RWT/RWWT');
				  return false;
				  exit();
				}
				else{
					fetch();
					return false;
				}

			} else if(tc === 'COLIFORM(Waste)' || tc === 'WASTE & COLIFORM' || tc === 'WASTE'){
				if( rn != 4){
				  swal('Invalid input of RWT/RWWT');
				  return false;
				  exit();
				}
				else {
					fetch();
					return false;
				}
			} else {
				fetch();
				return false;
			}


		function fetch(){	
			var url = "/alphalab/api/testrequest/";
			var data = {};
			data["req_id"] = req_id;
			data["test_cat"] = $('#test_cat').val();
			data["rwt_num"] = $('#rwt_num').val();
			data["date_rcvd"] = $('#date_rcvd').val();
			data["date_sample"] = $('#date_sample').val();
			data["micro_count"] = $('#micro_count').val();
			data["pchem_count"] = $('#pchem_count').val();
			data["waste_count"] = $('#waste_count').val();
			data["fsa"] = $('#fsa').val();
			data["state"] = $('#state').val();
			data["remarks"] = $('#remarks_').val();
			data["client_id"] = $('#hiddenClientid').val();

			url += (req_id > 0 ? "update.php" : "new.php");

        	$.ajax({
	            type:'POST',
	            url: url,
	            dataType: "json",
	            data:data,
	            success:function(response){
	            	swal({
							  position: 'center',
							  type: 'success',
							  title: response.message,
							  showConfirmButton: false,
							  timer: 400
							});
	            	testclearField();
	                view($("#hiddenTestid").val());
	                addRequest();
					$('#remarks_').focus();
            	}
	        });	
	         return false;
		}

		});
//Add request end

//Update Client
		function edit_req(i){
			$('#reqAddForm').slideDown();
			document.getElementById("reqAddForm").style.display="block";
			$('#remarks_').focus();
			document.getElementById("rwt-availability-status").innerHTML = "";
			document.getElementById('rwtSaveBtn').disabled = false;
            document.getElementById("rwt_num").disabled = false;
			var item = testRequestList[i];
			req_id = item.req_id; //id for testrequest
			$("#test_cat").val(item.test_cat);
			$("#rwt_num").val(item.rwt_num);
			$("#date_rcvd").val(item.date_rcvd);
			$("#date_sample").val(item.date_sample);
			$("#micro_count").val(item.micro_count);

			if ($("#micro_count").val() < 1) {
				document.getElementById('micro_count').disabled = true;
			}else{
				document.getElementById('micro_count').disabled = false;
			}
			$("#pchem_count").val(item.pchem_count);
			if ($("#pchem_count").val() < 1) {
				document.getElementById('pchem_count').disabled = true;
			}else{
				document.getElementById('pchem_count').disabled = false;
			}
			$("#waste_count").val(item.waste_count);
			if ($("#waste_count").val() < 1) {
				document.getElementById('waste_count').disabled = true;
			}else{
				document.getElementById('waste_count').disabled = false;
			}
			
			$("#fsa").val(item.fsa);
			$("#remarks_").val(item.remarks);
		    console.log(req_id);
		}
//Update Client end
 
//clear field
		function testclearField(){
			document.getElementById("rwt-availability-status").innerHTML = "";
			$("#test_cat").val("");
			$("#rwt_num").val("");
			// $("#date_rcvd").val("");
			// $("#date_sample").val("");
			$("#micro_count").val("");
			$("#pchem_count").val("");
			$("#waste_count").val("");
			// $("#fsa").val("");
			$("#remarks_").val("");

		}
//clear field

// RWT field non-numeric disabler
function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
// RWT field non-numeric disabler


//Delete
	function delete_req(i){
			var item = testRequestList[i];
			req_id = item.req_id; // id for client
			var data = 	{};
			data["req_id"] = req_id;
			console.log(req_id);
	        	
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
				            url: "/alphalab/api/testrequest/delete.php",
				            dataType: "json",
				            data: data,
				            success:function(response){
			            	 	swal(
							      'Deleted!',
							      'Your file has been deleted.',
							      'success'
							    );
	                			view($("#hiddenTestid").val());
				                console.log(data);
			            	}
				        });
				        return false;
				  } 
				  return false;
				});
			}	
//end

// to copy date when click
$(function(){
    var $date_rcvd = $('#date_rcvd');
    var $date_sample = $('#date_sample');
    function onChange() {
        $date_sample.val($date_rcvd.val());
    };
    $('#date_rcvd')
        .change(onChange)
        .keyup(onChange);
});

			// TEST REQUEST SCRIPT END