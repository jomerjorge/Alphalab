//View Records 
 function viewPchem(i){
			// connected to request id
	var item = testRequestList[i];
	pw_id = item.req_id; // id for request
    pchemclrfld();
	$("#hiddenViewPchem").val(i);
	$("#hiddenPchemid").val(pw_id);
    $("#modalPchem").modal("show");
	document.getElementById("pchemForm").style.display="none"; // need to
    document.getElementById('addPchem').focus();
    pchem_count = item.pchem_count;
    $("#_pchemId").val(pw_id);
	fetchPchemData();
    console.log("Pchem count from test request " + item.pchem_count);
    $("span#modalPchem").html("<b>" + item.rwt_num + "</b><br/>" + item.company_name);
    $("span#cc_remarks_pc").html(item.c_remarks)  
    // request id end

    $('#delAllpchem').prop('checked',false); 
    // request id end
        $.ajax({
          url:"/alphalab/api/pchemResult/index.php?req_id=" + pw_id,
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
               +  '" data-water_desp="' + response[count].water_despw 
		  		     +  '" data-sample_labelp="' + response[count].sample_labelpw
		  		     +  '" data-sam_pointp="' + response[count].sam_pointp 
		  		     +  '" data-p_param="' + response[count].pw_param 
		  		     +  '" data-p_met="' + response[count].pw_met 
		  		     +  '" data-p_result="' + response[count].pw_result 
		  		     +  '" data-p_analyst="' + response[count].pw_analyst 
		             +  '" data-req_id="' + response[count].req_id
		  		     +  '" class="del_pc" /></td>';

		        html += '<td>' + response[count].water_despw + " "
      		        			   + response[count].sample_labelpw + " "
      		        			   + response[count].sam_pointp + '</td>';
		        html += '<td>' + response[count].pw_param + '</td>';
		        html += '<td>' + response[count].pw_met + '</td>';
		        html += '<td>' + response[count].pw_result + '</td>';
		        html += '<td>' + response[count].pw_analyst + '</td>';
		    }
		    $("#pchemTable tbody").html(html);
		    console.log(pw_id);
          }
        });
		}

//View Records End

	function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
    document.getElementById("pchemTable").style.marginLeft = "300px";
		document.getElementById("mySidenav").style.backgroundColor = "#EDEDED";
	}

	function closeNav() {
		pchemclrfld();
		resetpchem();
		document.getElementById("pchemForm").style.display="none";
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("pchemTable").style.marginLeft= "0";
		document.getElementById("mySidenav").style.backgroundColor = "";
	}

	$('#modalPchem').on('hidden.bs.modal', function (e) { //activate code when modal close
   		closeNav();
	})

//Add request
		function addPchem()
		{
			openNav();
		  pchemclrfld();
			document.getElementById("pchemForm").style.display="block";
			document.getElementById('sample_label_p').focus();
		}



	$("#pchemForm").submit(function(e){
		e.preventDefault();
  	var data = {};
    data["water_despw"] = $('#water_desp').val();
		data["sample_labelpw"] = $('#sample_label_p').val();
		data["sam_pointp"] = $('#sam_point_p').val();
		data["pw_param"] = $('#p_param').val();
		data["req_id"] = $('#hiddenPchemid').val();
 
        	$.ajax({
	            type:'POST',
	            url: "/alphalab/api/pchemResult/new.php",
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
	            	pchemclrfld();
	                viewPchem($("#hiddenViewPchem").val());
	                document.getElementById("pchemForm").style.display="block";
	                console.log(data);
            	},
	            error: function() { 
                	document.getElementById('water_desp').style.borderColor = "#ff0000";
	                swal("Data already Exist!").then(function(){
                  $('#sample_labelpw').focus();
					});
                },
	        });
		 return false; // very important!!
		});
//Add request end

function fetchPchemData(){
     var req_id = $("#_pchemId").val();
    $.ajax({
      url:"/alphalab/api/pchemResult/countPchem.php",
      method:"GET",  
      dataType:"json",
      data: {
        req_id:req_id
      },
      success: function(data){
        console.log(data);
        if (data.success) {
           datafound = data.success.datafound;
           console.log("Pchem Data from database " + datafound);
        }
        else {
        	datafound = 0;
        }
      }
    });
  }


//clear field
		function pchemclrfld(){
			$("#sample_label_p").val("");
			$("#water_desp").val("");
			$("#sam_point_p").val("");
			// $("#p_param").val("");
	    document.getElementById("pchembtn").style.background='#ebebe0';
	    document.getElementById('water_desp').style.borderColor = "";
		}
//clear field


//View -> end

//select all (MULTIPLE DELETE AND UPDATE IN ONE CHECKBOX)
$(document).ready(function(){
  $('#delAllpchem').on('click',function(){
    var pchem_status = this.checked;
    var html = '';
        $('.del_pc').each(function(){
          this.checked = pchem_status;
          if(this.checked)
          {
            html = '<td><input type="checkbox" id="'+$(this).attr('id')  
                 + '" data-water_desp="'+$(this).data('water_desp')
                 + '" data-sample_labelp="'+$(this).data('sample_labelp') 
                 + '" data-sam_pointp="'+$(this).data('sam_pointp') 
                 + '" data-p_param="'+$(this).data('p_param') 
                 + '" data-p_met="'+$(this).data('p_met') 
                 + '" data-p_result="'+$(this).data('p_result') 
                 + '" data-p_analyst="'+$(this).data('p_analyst') 
                 + '" data-req_id="'+$(this).data('req_id') 
                 + '" class="del_pc" checked /></td>';

            html += '<td><select name="water_desp[]" id="water_desp_' 
                 + $(this).attr('id')
                 + '" class="form-control input-sm"><option value="Purified">Purified</option><option value="Mineral">Mineral</option><option value="Alkaline">Alkaline</option><option value="Raw">Raw</option><option value="Pi">Pi</option><option value="Swimming Pool">Swimming Pool</option><option value="">&lt; Select &gt;</option></select>'
                 +" "
                 + '<input list="sample_labelp" type="text" autocomplete="off" name="sample_labelp[]" id="sample_labelp_' 
                 + $(this).attr('id')
                 + '" class="form-control input-sm"><datalist id="sample_labelp"><option value="Deep Well">Deep Well</option><option value="Water District">Water District</option><option value="Plant">Plant</option><option value="Spring Developed">Spring Developed</option><option value="Space Pure Plant">Space Pure Plant</option><option value="Product Spout">Product Spout</option><option value="Not Specified">Not Specified</option></datalist>'
                 + " "
                 + '<input list="sam_pointp" type="text" autocomplete="off" name="sam_pointp[]" id="sam_pointp_' 
                 + $(this).attr('id')
                 + '" class="form-control input-sm"><datalist id="sam_pointp"><option value="Product Spout">Product Spout</option><option value="Pump">Pump</option><option value="Tank">Tank</option><option value="Faucet">Faucet</option></datalist></td>';
            html += '<td>' + $(this).data('p_param') + '</td>';    
            html += '<td>' + $(this).data('p_met') + '</td>';    
            html += '<td>' + $(this).data('p_result') + '</td>';
            html += '<td>' + $(this).data('p_analyst') + '</td><input type="hidden" name="req_id[]" value="' + pw_id + '"><input type="hidden" name="hidden_pchem[]" value="'
                 + $(this).attr('id')+ '" /></td>';
    		$(this).closest('tr').addClass('removeRow');
          }else
          {
              html = '<td><input type="checkbox" id="' + $(this).attr('id') 
                   + '" data-water_desp="'+$(this).data('water_desp')
                   + '" data-sample_labelp="'+$(this).data('sample_labelp') 
                   + '" data-sam_pointp="'+$(this).data('sam_pointp') 
                   + '" data-p_param="'+$(this).data('p_param')  
                   + '" data-p_met="'+$(this).data('p_met') 
                   + '" data-p_result="'+$(this).data('p_result')
                   + '" data-p_analyst="'+$(this).data('p_analyst')
                   + '" data-req_id"'+$(this).data('req_id')
                     + '" class="del_pc" /></td>';

            html += '<td>' + $(this).data('water_desp') + " "
                   			   + $(this).data('sample_labelp') + " "
                  			   + $(this).data('sam_pointp') + '</td>';
            html += '<td>' + $(this).data('p_param') + '</td>';     
            html += '<td>' + $(this).data('p_met') + '</td>';    
            html += '<td>' + $(this).data('p_result') + '</td>';
            html += '<td>' + $(this).data('p_analyst') + '</td>';	                   
    		$(this).closest('tr').removeClass('removeRow'); 
          }
          $(this).closest('tr').html(html);
          // to retain the value when update
	      $('#water_desp_'+$(this).attr('id')+'').val($(this).data('water_desp'));
	      $('#sample_labelp_'+$(this).attr('id')+'').val($(this).data('sample_labelp'));
	      $('#sam_pointp_'+$(this).attr('id')+'').val($(this).data('sam_pointp'));
        });
    });
});
//select all

// individual select (MULTIPLE DELETE AND UPDATE IN ONE CHECKBOX)
$(document).on('click', '.del_pc', function(){
  var html = '';
  if(this.checked)
  {
    html = '<td><input type="checkbox" id="'+$(this).attr('id')  
         + '" data-water_desp="'+$(this).data('water_desp')
         + '" data-sample_labelp="'+$(this).data('sample_labelp') 
         + '" data-sam_pointp="'+$(this).data('sam_pointp') 
         + '" data-p_param="'+$(this).data('p_param') 
         + '" data-p_met="'+$(this).data('p_met') 
         + '" data-p_result="'+$(this).data('p_result') 
         + '" data-p_analyst="'+$(this).data('p_analyst') 
         + '" data-req_id="'+$(this).data('req_id') 
         + '" class="del_pc" checked /></td>';

    html += '<td><select name="water_desp[]" id="water_desp_' 
         + $(this).attr('id')
         + '" class="form-control input-sm"><option value="Purified">Purified</option><option value="Mineral">Mineral</option><option value="Alkaline">Alkaline</option><option value="Raw">Raw</option><option value="Pi">Pi</option><option value="Swimming Pool">Swimming Pool</option><option value="">&lt; Select &gt;</option></select>'
         + " "
         + '<input list="sample_labelp" type="text" autocomplete="off" name="sample_labelp[]" id="sample_labelp_' 
         + $(this).attr('id')
         + '" class="form-control input-sm"><datalist id="sample_labelp"><option value="Deep Well">Deep Well</option><option value="Water District">Water District</option><option value="Plant">Plant</option><option value="Spring Developed">Spring Developed</option><option value="Space Pure Plant">Space Pure Plant</option><option value="Product Spout">Product Spout</option><option value="Not Specified">Not Specified</option></datalist>'
         + " "
         + '<input list="sam_pointp" type="text" autocomplete="off" name="sam_pointp[]" id="sam_pointp_' 
         + $(this).attr('id')
         + '" class="form-control input-sm"><datalist id="sam_pointp"><option value="Product Spout">Product Spout</option><option value="Pump">Pump</option><option value="Tank">Tank</option><option value="Faucet">Faucet</option></datalist></td>';
    html += '<td>' + $(this).data('p_param') + '</td>';   
    html += '<td>' + $(this).data('p_met') + '</td>';     
    html += '<td>' + $(this).data('p_result') + '</td>';
    html += '<td>' + $(this).data('p_analyst') + '</td><input type="hidden" name="req_id[]" value="' + pw_id + '"><input type="hidden" name="hidden_pchem[]" value="'
                 + $(this).attr('id')+ '" /></td>';
	$(this).closest('tr').addClass('removeRow');
  }
  else
  {
  	html = '<td><input type="checkbox" id="' + $(this).attr('id') 
           + '" data-water_desp="'+$(this).data('water_desp')
           + '" data-sample_labelp="'+$(this).data('sample_labelp') 
           + '" data-sam_pointp="'+$(this).data('sam_pointp') 
           + '" data-p_param="'+$(this).data('p_param')  
           + '" data-p_met="'+$(this).data('p_met') 
           + '" data-p_result="'+$(this).data('p_result')
           + '" data-p_analyst="'+$(this).data('p_analyst')
           + '" data-req_id"'+$(this).data('req_id')
             + '" class="del_pc" /></td>';

    html += '<td>' + $(this).data('water_desp') + " "
           			   + $(this).data('sample_labelp') + " "
          			   + $(this).data('sam_pointp') + '</td>';
    html += '<td>' + $(this).data('p_param') + '</td>';     
    html += '<td>' + $(this).data('p_met') + '</td>';    
    html += '<td>' + $(this).data('p_result') + '</td>';
    html += '<td>' + $(this).data('p_analyst') + '</td>';	                   
	$(this).closest('tr').removeClass('removeRow');   
  }
  $(this).closest('tr').html(html);
  // to retain the value when update
  $('#water_desp_'+$(this).attr('id')+'').val($(this).data('water_desp'));
  $('#sample_labelp_'+$(this).attr('id')+'').val($(this).data('sample_labelp'));
  $('#sam_pointp_'+$(this).attr('id')+'').val($(this).data('sam_pointp'));

  if($('.del_pc:checked').length == $('.del_pc').length){
          $('#delAllpchem').prop('checked',true);
      }else{
          $('#delAllpchem').prop('checked',false);
      }
});
// individual select

//update descriptions
$('#up_pchem_mul').click(function() {
      event.preventDefault();

	if($('.del_pc:checked').length > 0)
	{
		$.ajax({
		      url: "/alphalab/api/pchemResult/update.php",
              method:"POST",
		      data:$('#updelpchem').serialize(),
		      success:function(response){
		        swal({
		        position: 'center',
		        type: 'success',
		        title: response.message,
		        showConfirmButton: false,
		        timer: 1500
		      });	   
              	viewPchem($("#hiddenViewPchem").val());
              	closeNav();
		      }
	      }); 
	      return false;
	  }
      else{
          swal("Select Item First!");
      }
      return false;
	});
//update end


//Delete
$('#del_pchem_mul').click(function() {
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
		      if($('.del_pc:checked').length > 0)
		      {
		          $.ajax({
		              url:"/alphalab/api/pchemResult/delete.php",
		              method:"POST",
		              data:$('#updelpchem').serialize(),
		              success:function()
		              {	
	              		  swal(
						      'Deleted!',
						      'Your file has been deleted.',
						      'success'
					      );
		                  $('#delAllpchem').prop('checked',false); 
		                  console.log($('#updelpchem').serialize());
		                  viewPchem($("#hiddenViewPchem").val());
		                  document.getElementById("pchemForm").style.display="block";
		                  openNav();
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