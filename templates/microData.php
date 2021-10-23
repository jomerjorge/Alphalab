<?php
require("../lib/core.php");
require("../functions/login_functions.php");
require("../functions/checkLogState.php");

checkLogState();

?>
<div id="overlay">

<div class="toolbar">
  <div class="form-inline">
    <div class="outer">
      <div class="input-group">
        <input list="state_search_m" type="text" class="form-control input-sm" name="search_text_m" id="search_text_m" placeholder="RWT NO. . " >
          <datalist id="state_search_m">
            <option value="Ongoing">
            <option value="Hold">
            <option value="for Checking">
            <option value="Done">
          </datalist>
        <span class="input-group-btn">
          <button type="button" class="btn btn-sm btn-primary" id="searchRWT" onclick="searchRWT()"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
        </span>
      </div>
    </div> 

    <button type="button" class="btn btn-success btn-sm" id="addFilter">
      <span class="fa fa-filter" aria-hidden="true"></span> Apply Date Filter 
    </button>

    <div class="inner is-hidden">
      <div id="divA">

       <select style="width:140px" class="form-control input-sm" id="fsa" name="fsa" required="">
       </select>&nbsp

  <div class="input-group">
    <input size="12" type="text" class="form-control input-sm" id="From" name="From" placeholder="From date"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
  </div> <strong>--</strong>
  <div class="input-group">
    <input size="12" type="text" class="form-control input-sm" id="to" name="to" placeholder="To date"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
  </div>
      </div>

      <div id="divB">
        <button type="button" class="btn btn-primary btn-sm" id="range_m" name="range_m"><i class="fa fa-filter" aria-hidden="true"></i> Filter Search</button>
      </div>

    </div>
 </div>
</div>
<br>
<br>

<form method="post" id="update_form">
  <div class="form-inline">
    <select class="form-control input-sm" id="sel_tc_m" name="sel_tc_m"
      <?php if($_SESSION['usertype'] == 'USER-DES') echo 'style="display:none"';?>>
      <option value="" style="color: #E6E6E6">TC-Potable</option>
      <option value="&lt;1.1">&lt;1.1</option>
      <option value="1.1">1.1</option>
      <option value="2.6">2.6</option>
      <option value="4.6">4.6</option>
      <option value="8.0">8.0</option>
      <option value="&gt;8.0">&gt;8.0</option>
    </select>

    <select class="form-control input-sm" id="sel_thc_m" name="sel_thc_m"
      <?php if($_SESSION['usertype'] == 'USER-DES') echo 'style="display:none"';?>>
      <option value="" style="color: #E6E6E6">ThC-Potable</option>
      <option value="&lt;1.1">&lt;1.1</option>
      <option value="1.1">1.1</option>
      <option value="2.6">2.6</option>
      <option value="4.6">4.6</option>
      <option value="8.0">8.0</option>
      <option value="&gt;8.0">&gt;8.0</option>
    </select>

    <select class="form-control input-sm" id="sel_hpc_m" name="sel_hpc_m"
      <?php if($_SESSION['usertype'] == 'USER-DES') echo 'style="display:none"';?>>
      <option value="" style="color: #E6E6E6">HPC</option>
      <option value="&lt;1">&lt;1</option>
    </select>

    <select class="form-control input-sm" id="microAnalyst_ddlist" name="microAnalyst_ddlist"
      <?php if($_SESSION['usertype'] == 'USER-DES') echo 'style="display:none"';?>>
    </select>

    <select class="form-control input-sm" id="sel_remarks_m" name="sel_remarks_m">
      <option value="" style="color: #E6E6E6">Remarks</option>
      <option value="Hold" 
            <?php if($_SESSION['usertype'] == 'USER-DES') 
                     echo 'style="display:none"'; ?>>Hold</option>
      <option value="for Checking" 
            <?php if($_SESSION['usertype'] == 'USER-DES') 
                     echo 'style="display:none"'; ?>>for Checking</option>
      <option value="Done" 
            <?php if($_SESSION['usertype'] == 'LAB-MICRO-USER' ||
                     $_SESSION['usertype'] == 'USER-DES') 
                     echo 'style="display:none"'; ?>>Done</option>
      <option value="Printed" 
            <?php if($_SESSION['usertype'] == 'LAB-MICRO-HEAD' || 
                     $_SESSION['usertype'] == 'LAB-MICRO-USER') 
                     echo 'style="display:none"'; ?>>Printed</option>
    </select>

    &nbsp&nbsp&nbspRecord(s) Found: &nbsp <b><span id="datafound_m"></span></b>
    <button type="submit" name="multiple_update" id="multiple_update" class="btn btn-success btn-sm pull-right" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button>
<br>
<br>
<label class="alert-danger note_mc">Note: Please select Analyst before placing data.</label>
   </div>  

      
      
      <div class="tableFixHead" id="microResultTable">
          <table id="microResultTable" class="table table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
                <th width="1%"><input type="checkbox" id="checkAll"></th>
                <th width="2%">Date Received</th>
                <th width="1%">Sample Type</th>
                <th width="1%">RWT No.</th>
                <th width="5%">Source of Sample</th>
                <th width="4%">TC-P</th>
                <th width="4%">ThC-P</th>
                <th width="3%">HPC</th>
                <th width="3%">EC</th>
                <th width="5%">FSA</th>
                <th width="8%">Analyst</th>
                <th width="3%">Remarks</th>
             <!--    <th width="3%">Date Encoded</th>
                <th width="3%">Date Printed</th> -->
            </tr>
          </thead>
          <tbody>
          </tbody>
          </table>
      </div>
    </form>

</div>
<div id="update-loader"><img src="image/v-loader.gif" alt="Loading.."/></div>

<script type="text/javascript" src="script/fsa_analyst_ddlist.js"></script>
<script type="text/javascript" src="script/datepickerFromTo.js"></script> 
<script type="text/javascript" src="script/fixedHeader.js"></script>

<script type="text/javascript">
    
//slide navigation    
$('#addFilter').on('click', function() {
  animateDiv();
})

// $(document).keyup(function(e) {
//   if (e.keyCode === 27 && $('.inner').hasClass('visible')) { // 27 = esc keyboard
//     animateDiv();
//   }
// })

function animateDiv () {
  $('.inner').toggleClass('visible');
  $('.inner').animate({
    width: 'toggle',
  },350);


$("#search_text_m").val("");
$("#fsa").val("");
$.datepicker._clearDate('#From');
$.datepicker._clearDate('#to');
$("#microResultTable tbody").html("");
document.getElementById("checkAll").checked = false;
$("#datafound_m").html("");


   $('.outer').toggleClass('visible');
  $('.outer').animate({
    width: 'toggle',
  },350);
}
//slide navigation end

    // to show hold results (default)
    show_hold();
    function show_hold() {
      $("#search_text_m").val("Hold");
      $.ajax({
            url:"/alphalab/api/inputMicroResult/",  
            method:"GET",  
            dataType: "json",
            success:function(data){
            console.log(data);
            fetch_data(data);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
          }
          });
    }



//fetch data
function fetch_data(data){
  if (data.success) {
          $("div.tableFixHead").scrollTop(0); // to return to top when click search
          var dataArr = data.success.data;
          var html = "";
          datafound = data.success.datafound;
          // to select the specific client when viewing View Records Tab
          list = dataArr; 
          for (var i = 0; i < dataArr.length; i++){
                html += '<tr>';
                html += '<td><input type="checkbox" id="' + dataArr[i].micro_id 
                     +  '" data-date_rcvd="' + dataArr[i].date_rcvd 
                     +  '" data-sam_param="' + dataArr[i].sam_param 
                     +  '" data-rwt_num="' + dataArr[i].rwt_num 
                     +  '" data-water_des="' + dataArr[i].water_des 
                     +  '" data-sample_label="' + dataArr[i].sample_label 
                     +  '" data-sam_point="' + dataArr[i].sam_point 
                     +  '" data-tc_potable="' + dataArr[i].tc_potable 
                     +  '" data-thc_potable="' + dataArr[i].thc_potable 
                     +  '" data-hpc_result="' + dataArr[i].hpc_result 
                     +  '" data-ec_result="' + dataArr[i].ec_result
                     +  '" data-fsa="' + dataArr[i].fsa 
                     +  '" data-micro_analyst="' + dataArr[i].micro_analyst 
                     +  '" data-remarks="' + dataArr[i].remarks 
                     +  '" data-mc_date_enc="' + dataArr[i].mc_date_enc 
                     +  '" data-mc_date_prnt="' + dataArr[i].mc_date_prnt 
                     +  '" class="check_boxMicro" /></td>';

                html += '<td>' + dataArr[i].date_rcvd + '</td>';
                html += '<td>' + dataArr[i].sam_param + '</td>';
                html += '<td>' + dataArr[i].rwt_num + '</td>';
                html += '<td>' + dataArr[i].water_des + " "
                               + dataArr[i].sample_label + " "
                               + dataArr[i].sam_point  + '</td>';

                // html += '<td>' + dataArr[i].tc_potable + '</td>';
                // html += '<td>' + dataArr[i].thc_potable + '</td>';
                // html += '<td>' + dataArr[i].hpc_result + '</td>';
                // html += '<td>' + dataArr[i].ec_result + '</td>';

            // to highlight the failed total coliform results in micro
            if (dataArr[i].tc_potable != "<1.1" && dataArr[i].tc_potable != "N/A") {
              html += "<td class='failed_color'>" + dataArr[i].tc_potable + "</td>";
            }else {
              html += "<td>" + dataArr[i].tc_potable + "</td>";
            }

            // to highlight the failed thermotolerant coliform results in micro
             if (dataArr[i].thc_potable != "<1.1" && dataArr[i].thc_potable != "N/A") {
              html += "<td class='failed_color'>" + dataArr[i].thc_potable + "</td>";
            }else {
              html += "<td>" + dataArr[i].thc_potable + "</td>";
            }

            // to highlight the failed results in micro (included dialysis)
            if(dataArr[i].sam_param == 'Dialysis' && (dataArr[i].hpc_result >= 200 || dataArr[i].hpc_result == ">6500") ) {
              html += '<td class="failed_color">' + dataArr[i].hpc_result + '</td>';
            }else if (dataArr[i].sam_param != 'Dialysis' && (dataArr[i].hpc_result >= 500 || dataArr[i].hpc_result == ">6500") ) {
              html += '<td class="failed_color">' + dataArr[i].hpc_result + '</td>';
            }else{
              html += '<td>' + dataArr[i].hpc_result + '</td>';
            }

            // to highlight the failed results in e-coli
            if (dataArr[i].ec_result == "Positive") {
              html += '<td class="failed_color">' + dataArr[i].ec_result + '</td>';
            }else {
              html += "<td>" + dataArr[i].ec_result + "</td>";
            }


                html += '<td>' + dataArr[i].fsa + '</td>';
                html += '<td>' + dataArr[i].micro_analyst + '</td>';

                 // // to highlight the hold results
                 // if (dataArr[i].remarks == 'Hold'){
                 //   html += '<td class="remarks_color">' + dataArr[i].remarks + '</td>';
                 // } else {  
                 //   html += '<td>' + dataArr[i].remarks + '</td>';
                 // }

                // to highlight the hold, Ongoing, Done and Printed results
                if (dataArr[i].remarks == 'Hold'){
                       html += '<td><label class="label label-danger">' + dataArr[i].remarks + '</label></td>';
                }else if(dataArr[i].remarks == 'Ongoing'){
                       html += '<td><label class="label label-info">' + dataArr[i].remarks + '</label></td>';
                }else {
                     html += '<td><label class="label label-success">' + dataArr[i].remarks + '</label></td>';
                }

                // html += '<td>' + dataArr[i].mc_date_enc + '</td>';
                // html += '<td>' + dataArr[i].mc_date_prnt + '</td></tr>';
            }
          $("#microResultTable tbody").html(html);
          $("#datafound_m").html(datafound);
        }
         else{
           html += "<td colspan='14'>" + "No record found." + "</td>";
           $("#microResultTable tbody").html(html);
           $("#datafound_m").html(0);
        }
}
//fetch data


// filter search
$(document).ready(function(){
  $('#range_m').click(function(){
    var date_start = $('#From').val();
    var date_end = $('#to').val();
    var txt = $('#fsa').val();
    if(date_start != '' && date_end != '' && txt != '')
    {
      $.ajax({
        url:"/alphalab/api/inputMicroResult/filterSearch_micro.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt,
          From:date_start, 
          to:date_end
        },
        success:function(data){
        console.log(data);
        fetch_data(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
      });
    }
    else
    {
      swal("Please fill all fields");
    }
  });
})
// filter search end


//show data after update
    function show_data(){
      var date_start = $('#From').val();
      var date_end = $('#to').val();
      var txt = $('#search_text_m').val();
      var txt2 = $('#fsa').val();
     
      if (txt2 != "" && date_start !="" && date_end != "") {

      $.ajax({
        url:"/alphalab/api/inputMicroResult/filterSearch_micro.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt2,
          From:date_start, 
          to:date_end
        },
        success:function(data){
        console.log(data);
        fetch_data(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
      });
  } else {
    $.ajax({
        url:"/alphalab/api/inputMicroResult/singleSearch_micro.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt
        },
        success:function(data){
        console.log(data);
        fetch_data(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
      });

  }

}
//show data after update end


//search rwt only
 function searchRWT(){
      check_session();
      var txt = $('#search_text_m').val();
      if (txt != "") {
      $.ajax({

        url:"/alphalab/api/inputMicroResult/singleSearch_micro.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt
        },
        success:function(data){
        console.log(data);
        fetch_data(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
      });
    }else{
      swal("Please enter RWT number.");
    }
 }
//search rwt only end


// ===================================================================================== searching end



//select all chkbox
$(document).ready(function(){
  $('#checkAll').on('click',function(){
    var status = this.checked;
    var html = '';
          <?php
            $usertp = $_SESSION['usertype'];
          ?>
    var usertp = '<?php echo $usertp; ?>';
    console.log(usertp);
    $('.check_boxMicro').each(function(){
      this.checked = status;

      if(this.checked)
      {
        html = '<td><input type="checkbox" id="'+$(this).attr('id') 
             + '" data-date_rcvd="'+$(this).data('date_rcvd') 
             + '" data-sam_param="'+$(this).data('sam_param') 
             + '" data-rwt_num="'+$(this).data('rwt_num') 
             + '" data-water_des="'+$(this).data('water_des') 
             + '" data-sample_label="'+$(this).data('sample_label') 
             + '" data-sam_point="'+$(this).data('sam_point') 
             + '" data-tc_potable="'+$(this).data('tc_potable') 
             + '" data-thc_potable="'+$(this).data('thc_potable') 
             + '" data-hpc_result="'+$(this).data('hpc_result') 
             + '" data-ec_result="'+$(this).data('ec_result') 
             + '" data-fsa="'+$(this).data('fsa') 
             + '" data-micro_analyst="'+$(this).data('micro_analyst') 
             + '" data-remarks="'+$(this).data('remarks') 
             + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
             + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt') 
             + '" class="check_boxMicro" checked /></td>';

        html += '<td>'+ $(this).data("date_rcvd") + '</td>';
        html += '<td>'+ $(this).data("sam_param") + '</td>';
        html += '<td>'+ $(this).data("rwt_num") + '</td>';
        html += '<td>'+ $(this).data("water_des") + " "
                      + $(this).data("sample_label") + " " 
                      + $(this).data("sam_point") + '</td>';

      if($(this).data('tc_potable') == 'N/A')
      {
        html += '<td><input type="text" name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><select name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"><option value="&lt;1.1">&lt;1.1</option><option value="1.1">1.1</option><option value="2.6">2.6</option><option value="4.6">4.6</option><option value="8.0">8.0</option><option value="&gt;8.0">&gt;8.0</option></select></td>';
      }

      if($(this).data('thc_potable') == 'N/A')
      {
        html += '<td><input type="text" name="thc_potable[]" id="thc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="thc_potable[]" id="thc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="thc_potable[]" id="thc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><select name="thc_potable[]" id="thc_potable_' 
           + $(this).attr('id')
           + '" class="form-control input-sm"><option value="&lt;1.1">&lt;1.1</option><option value="1.1">1.1</option><option value="2.6">2.6</option><option value="4.6">4.6</option><option value="8.0">8.0</option><option value="&gt;8.0">&gt;8.0</option></select></td>';
      }

      if($(this).data('hpc_result') == 'N/A')
      {
        html += '<td><input type="text" name="hpc_result[]" id="hpc_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="hpc_result[]" id="hpc_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="hpc_result[]" id="hpc_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><input type="text" autocomplete="off" name="hpc_result[]" id="hpc_result_' 
           + $(this).attr('id')
           + '" class="form-control input-sm"></td>';
      }

      if($(this).data('ec_result') == 'N/A')
      {
        html += '<td><input type="text" name="ec_result[]" id="ec_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="ec_result[]" id="ec_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="ec_result[]" id="ec_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><select name="ec_result[]" id="ec_result_' 
           + $(this).attr('id')
           + '" class="form-control input-sm"><option value="Positive">Positive</option><option value="Negative">Negative</option></select></td>';
      }

      html += '<td>'+ $(this).data('fsa') + '</td>';

      if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="micro_analyst[]" id="micro_analyst_' 
             + $(this).attr('id')
             + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst"></td>';
      }
      // note: can't put with required attri. Name of analyst will not be added
      else
      {
        html += '<td><input type="text" name="micro_analyst[]" id="micro_analyst_' 
             + $(this).attr('id')
             + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst" required></td>';
      }

      if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><select name="remarks[]" id="remarks_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" required><option value="Ongoing" style="display:none">Ongoing</option><option value="Done" style="display:none">Done</option><option value="Hold" style="display:none">Hold</option><option value="Printed" style="display:none">Printed</option><option value="for Checking" style="display:none"  >for Checking</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="hidden_id[]" value="'
           + $(this).attr('id') + '" /></td>';
      }
      else if(usertp == 'USER-DES')
      {
        html += '<td><select name="remarks[]" id="remarks_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" required><option value="Ongoing" style="display:none">Ongoing</option><option value="Done" style="display:none">Done</option><option value="Hold" style="display:none">Hold</option><option value="Printed" style="display:none">Printed</option><option value="for Checking" style="display:none"  >for Checking</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_'
           + $(this).attr('id')
           + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="hidden_id[]" value="'
           + $(this).attr('id') + '" /></td>';
      }
      else
      {
        html += '<td><select name="remarks[]" id="remarks_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" required><option value="Ongoing">Ongoing</option><option value="Hold">Hold</option><option value="for Checking">for Checking</option><option value="Done">Done</option><option value="Printed">Printed</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="hidden_id[]" value="'
           + $(this).attr('id') + '" /></td>';
      }

    }
    else
    {
      html = '<td><input type="checkbox" id="' + $(this).attr('id')
           + '" data-date_rcvd="'+$(this).data('date_rcvd') 
           + '" data-sam_param="'+$(this).data('sam_param') 
           + '" data-rwt_num="'+$(this).data('rwt_num') 
           + '" data-water_des="'+$(this).data('water_des') 
           + '" data-sample_label="'+$(this).data('sample_label') 
           + '" data-sam_point="'+$(this).data('sam_point')
           + '" data-tc_potable="'+$(this).data('tc_potable') 
           + '" data-thc_potable="'+$(this).data('thc_potable') 
           + '" data-hpc_result="'+$(this).data('hpc_result') 
           + '" data-ec_result="'+$(this).data('ec_result') 
           + '" data-fsa="'+$(this).data('fsa') 
           + '" data-micro_analyst="'+$(this).data('micro_analyst') 
           + '" data-remarks="'+$(this).data('remarks') 
           + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
           + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt') 
           + '" class="check_boxMicro" /></td>';

      html += '<td>' + $(this).data('date_rcvd') + '</td>';
      html += '<td>' + $(this).data('sam_param') + '</td>';
      html += '<td>' + $(this).data('rwt_num') + '</td>';
      html += '<td>'+ $(this).data("water_des") + " "
                    + $(this).data("sample_label") + " " 
                    + $(this).data("sam_point") + '</td>';

      // to highlight the failed total coliform results in micro when unchecked
      if ($(this).data('tc_potable') != "<1.1" && $(this).data('tc_potable') != "N/A")
      {
        html += "<td class='failed_color'>" + $(this).data('tc_potable') + "</td>";
      }
      else{
        html += "<td>" + $(this).data('tc_potable') + "</td>";
      }    

      // to highlight the failed thermotolerant coliform results in micro when unchecked
      if ($(this).data('thc_potable') != "<1.1" && $(this).data('thc_potable') != "N/A")
      {
        html += "<td class='failed_color'>" + $(this).data('thc_potable') + "</td>";
      }
      else {
        html += "<td>" + $(this).data('thc_potable') + "</td>";
      }

      // to highlight the failed results in micro (included dialysis) when unchecked
      if($(this).data('sam_param') == 'Dialysis' && ($(this).data('hpc_result') >= 200 || $(this).data('hpc_result') == ">6500"))
      {
        html += '<td class="failed_color">' + $(this).data('hpc_result') + '</td>';
      }else if ($(this).data('sam_param') != 'Dialysis' && ($(this).data('hpc_result') >= 500 || $(this).data('hpc_result') == ">6500")) 
      {
        html += '<td class="failed_color">' + $(this).data('hpc_result') + '</td>';
      }
      else{
        html += '<td>' + $(this).data('hpc_result') + '</td>';
      }

      // to highlight the failed results in e-coli when unchecked
      if ($(this).data('ec_result') == "Positive")
      {
        html += '<td class="failed_color">' + $(this).data('ec_result') + '</td>';
      }
      else{
        html += '<td>' + $(this).data('ec_result') + '</td>';
      }

      html += '<td>' + $(this).data('fsa') + '</td>';
      html += '<td>' + $(this).data('micro_analyst') + '</td>'; 
      
     // to get back the color (red) when unchecked the checkbox
     if ($(this).data('remarks') == 'Hold')
     {
       html += '<td><label class="label label-danger">' + $(this).data('remarks') + '<label></td>';
     }
     else if($(this).data('remarks') == 'Ongoing')
     {
        html += '<td><label class="label label-info">' + $(this).data('remarks') + '<label></td>';
     }
     else 
     {
        html += '<td><label class="label label-success">' + $(this).data('remarks') + '<label></td>';
     }

  }
  $(this).closest('tr').html(html);
    // conditions for remarks cell and textbox
    if(document.getElementById('sel_tc_m').value == "" || $(this).data('tc_potable') == 'N/A')
    {
      $('#tc_potable_'+$(this).attr('id')+'').val($(this).data('tc_potable'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#tc_potable_'+$(this).attr('id')+'').val($(this).data('tc_potable'));
    }
    else
    {
      $('#tc_potable_'+$(this).attr('id')+'').val($('#sel_tc_m').val());
    }

    if(document.getElementById('sel_thc_m').value == "" || $(this).data('thc_potable') == 'N/A')
    {
      $('#thc_potable_'+$(this).attr('id')+'').val($(this).data('thc_potable'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#thc_potable_'+$(this).attr('id')+'').val($(this).data('thc_potable'));
    }
    else
    {
      $('#thc_potable_'+$(this).attr('id')+'').val($('#sel_thc_m').val());
    }
    
    if(document.getElementById('sel_hpc_m').value == "" || $(this).data('hpc_result') == 'N/A')
    {
      $('#hpc_result_'+$(this).attr('id')+'').val($(this).data('hpc_result'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#hpc_result_'+$(this).attr('id')+'').val($(this).data('hpc_result'));
    }
    else
    {
      $('#hpc_result_'+$(this).attr('id')+'').val($('#sel_hpc_m').val());
    }

    if($(this).data('ec_result') == 'N/A')
    { 
      $('#ec_result_'+$(this).attr('id')+'').val($(this).data('ec_result'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#ec_result_'+$(this).attr('id')+'').val($(this).data('ec_result'));
    }
    else
    {
      $('#ec_result_'+$(this).attr('id')+'').val($(this).data('ec_result'));
    }
    
    if(document.getElementById('microAnalyst_ddlist').value == "")
    {
      $('#micro_analyst_'+$(this).attr('id')+'').val($(this).data('micro_analyst'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#micro_analyst_'+$(this).attr('id')+'').val($(this).data('micro_analyst'));
    }
    else
    {
      $('#micro_analyst_'+$(this).attr('id')+'').val($('#microAnalyst_ddlist').val());
    }
    
    // condtion on remarks
    if(document.getElementById('sel_remarks_m').value == "")
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Hold" && $(this).data('remarks') == "Printed" && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "Hold" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "for Checking")
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Done" && $(this).data('remarks') == "Printed" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "for Checking" && $(this).data('remarks') == "Printed" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "Ongoing" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else
    {
      $('#remarks_'+$(this).attr('id')+'').val($('#sel_remarks_m').val());
    }    

    //get date and time for done
    if(document.getElementById('sel_remarks_m').value == "Hold" || document.getElementById('sel_remarks_m').value == "Done")
    {
      var today = new Date();
      var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
      var time = today.getHours() + ':' + today.getMinutes();
      var datetime_enc = date + ' / ' + time;
      $('#mc_date_enc_'+$(this).attr('id')+'').val(datetime_enc);
    }
    else
    {
      $('#mc_date_enc_'+$(this).attr('id')+'').val($(this).data('mc_date_enc'));
    }

    //get date and time for printed
    if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "Done")
    {
      var today = new Date();
      var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
      var time = today.getHours() + ':' + today.getMinutes();
      var datetime_prnt = date + ' / ' + time;
      $('#mc_date_prnt_'+$(this).attr('id')+'').val(datetime_prnt);
    }
    else
    {
      $('#mc_date_prnt_'+$(this).attr('id')+'').val($(this).data('mc_date_prnt'));
    }
        });
    });
});
//select all chkbox end


function preventBackspace(e) {
        var evt = e || window.event;
        if (evt) {
            var keyCode = evt.charCode || evt.keyCode;
            if (keyCode === 8) {
                if (evt.preventDefault) {
                    evt.preventDefault();
                } else {
                    evt.returnValue = false;
                }
            }
        }
    }

// individual select chkbox end
$(document).on('click', '.check_boxMicro', function(){
    var html = '';
          <?php
            $usertp = $_SESSION['usertype'];
          ?>
    var usertp = '<?php echo $usertp; ?>';

    if(this.checked)
    {
        html = '<td><input type="checkbox" id="'+$(this).attr('id') 
             + '" data-date_rcvd="'+$(this).data('date_rcvd') 
             + '" data-sam_param="'+$(this).data('sam_param') 
             + '" data-rwt_num="'+$(this).data('rwt_num') 
             + '" data-water_des="'+$(this).data('water_des') 
             + '" data-sample_label="'+$(this).data('sample_label') 
             + '" data-sam_point="'+$(this).data('sam_point') 
             + '" data-tc_potable="'+$(this).data('tc_potable') 
             + '" data-thc_potable="'+$(this).data('thc_potable') 
             + '" data-hpc_result="'+$(this).data('hpc_result') 
             + '" data-ec_result="'+$(this).data('ec_result') 
             + '" data-fsa="'+$(this).data('fsa') 
             + '" data-micro_analyst="'+$(this).data('micro_analyst') 
             + '" data-remarks="'+$(this).data('remarks') 
             + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
             + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt') 
             + '" class="check_boxMicro" checked /></td>';

      html += '<td>'+ $(this).data("date_rcvd") + '</td>';
      html += '<td>'+ $(this).data("sam_param") + '</td>';
      html += '<td>'+ $(this).data("rwt_num") + '</td>';
      html += '<td>'+ $(this).data("water_des") + " "
                    + $(this).data("sample_label") + " " 
                    + $(this).data("sam_point") + '</td>';

      if($(this).data('tc_potable') == 'N/A')
      {
        html += '<td><input type="text" name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><select name="tc_potable[]" id="tc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm" required><option value="&lt;1.1">&lt;1.1</option><option value="1.1">1.1</option><option value="2.6">2.6</option><option value="4.6">4.6</option><option value="8.0">8.0</option><option value="&gt;8.0">&gt;8.0</option></select></td>';
      }

      if($(this).data('thc_potable') == 'N/A')
      {
        html += '<td><input type="text" name="thc_potable[]" id="thc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="thc_potable[]" id="thc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="thc_potable[]" id="thc_potable_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><select name="thc_potable[]" id="thc_potable_' 
           + $(this).attr('id')
           + '" class="form-control input-sm"><option value="&lt;1.1">&lt;1.1</option><option value="1.1">1.1</option><option value="2.6">2.6</option><option value="4.6">4.6</option><option value="8.0">8.0</option><option value="&gt;8.0">&gt;8.0</option></select></td>';
      }

      if($(this).data('hpc_result') == 'N/A')
      {
        html += '<td><input type="text" name="hpc_result[]" id="hpc_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="hpc_result[]" id="hpc_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="hpc_result[]" id="hpc_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><input type="text" autocomplete="off" name="hpc_result[]" id="hpc_result_' 
           + $(this).attr('id')
           + '" class="form-control input-sm"></td>';
      }

      if($(this).data('ec_result') == 'N/A')
      {
        html += '<td><input type="text" name="ec_result[]" id="ec_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="ec_result[]" id="ec_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      // disabled cells for Encoder User
      else if(($(this).data('remarks') == 'Printed' || $(this).data('remarks') == 'Hold' || $(this).data('remarks') == 'for Checking' || $(this).data('remarks') == 'Done' || $(this).data('remarks') == 'Ongoing') && usertp == 'USER-DES')
      {
        html += '<td><input type="text" name="ec_result[]" id="ec_result_' 
             + $(this).attr('id')
             + '" class="form-control input-sm"></td>';
      }
      else
      {
        html += '<td><select name="ec_result[]" id="ec_result_' 
           + $(this).attr('id')
           + '" class="form-control input-sm"><option value="Positive">Positive</option><option value="Negative">Negative</option></select></td>';
      }

      html += '<td>'+ $(this).data('fsa') + '</td>';

      if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><input type="text" name="micro_analyst[]" id="micro_analyst_' 
             + $(this).attr('id')
             + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst"></td>';
      }
      // note: can't put with required attri. Name of analyst will not be added
      else
      {
        html += '<td><input type="text" name="micro_analyst[]" id="micro_analyst_' 
             + $(this).attr('id')
             + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst" required></td>';
      }

      if($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
      {
        html += '<td><select name="remarks[]" id="remarks_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" required><option value="Ongoing" style="display:none">Ongoing</option><option value="Done" style="display:none">Done</option><option value="Hold" style="display:none">Hold</option><option value="Printed" style="display:none">Printed</option><option value="for Checking" style="display:none"  >for Checking</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="hidden_id[]" value="'
           + $(this).attr('id') + '" /></td>';
      }
      else if(usertp == 'USER-DES')
      {
        html += '<td><select name="remarks[]" id="remarks_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" required><option value="Ongoing" style="display:none">Ongoing</option><option value="Done" style="display:none">Done</option><option value="Hold" style="display:none">Hold</option><option value="Printed" style="display:none">Printed</option><option value="for Checking" style="display:none"  >for Checking</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_'
           + $(this).attr('id')
           + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="hidden_id[]" value="'
           + $(this).attr('id') + '" /></td>';
      }
      else
      {
        html += '<td><select name="remarks[]" id="remarks_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" required><option value="Ongoing">Ongoing</option><option value="Hold">Hold</option><option value="for Checking">for Checking</option><option value="Done">Done</option><option value="Printed">Printed</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
           + $(this).attr('id')
           + '"/><input type="hidden" name="hidden_id[]" value="'
           + $(this).attr('id') + '" /></td>';
      }
    }
    else
    {
        html = '<td><input type="checkbox" id="' + $(this).attr('id')
             + '" data-date_rcvd="'+$(this).data('date_rcvd') 
             + '" data-sam_param="'+$(this).data('sam_param')
             + '" data-rwt_num="'+$(this).data('rwt_num') 
             + '" data-water_des="'+$(this).data('water_des') 
             + '" data-sample_label="'+$(this).data('sample_label') 
             + '" data-sam_point="'+$(this).data('sam_point')
             + '" data-tc_potable="'+$(this).data('tc_potable') 
             + '" data-thc_potable="'+$(this).data('thc_potable') 
             + '" data-hpc_result="'+$(this).data('hpc_result') 
             + '" data-ec_result="'+$(this).data('ec_result') 
             + '" data-fsa="'+$(this).data('fsa') 
             + '" data-micro_analyst="'+$(this).data('micro_analyst') 
             + '" data-remarks="'+$(this).data('remarks') 
             + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
             + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt') 
             + '" class="check_boxMicro" /></td>';

        html += '<td>' + $(this).data('date_rcvd') + '</td>';
        html += '<td>' + $(this).data('sam_param') + '</td>';
        html += '<td>' + $(this).data('rwt_num') + '</td>';
        html += '<td>' + $(this).data("water_des") + " "
                       + $(this).data("sample_label") + " " 
                       + $(this).data("sam_point") + '</td>';

      // to highlight the failed total coliform results in micro when unchecked
      if ($(this).data('tc_potable') != "<1.1" && $(this).data('tc_potable') != "N/A")
      {
        html += "<td class='failed_color'>" + $(this).data('tc_potable') + "</td>";
      }
      else{
        html += "<td>" + $(this).data('tc_potable') + "</td>";
      }    

      // to highlight the failed thermotolerant coliform results in micro when unchecked
      if ($(this).data('thc_potable') != "<1.1" && $(this).data('thc_potable') != "N/A")
      {
        html += "<td class='failed_color'>" + $(this).data('thc_potable') + "</td>";
      }
      else {
        html += "<td>" + $(this).data('thc_potable') + "</td>";
      }

      // to highlight the failed results in micro (included dialysis) when unchecked
      if($(this).data('sam_param') == 'Dialysis' && ($(this).data('hpc_result') >= 200 || $(this).data('hpc_result') == ">6500"))
      {
        html += '<td class="failed_color">' + $(this).data('hpc_result') + '</td>';
      }else if ($(this).data('sam_param') != 'Dialysis' && ($(this).data('hpc_result') >= 500 || $(this).data('hpc_result') == ">6500")) 
      {
        html += '<td class="failed_color">' + $(this).data('hpc_result') + '</td>';
      }
      else{
        html += '<td>' + $(this).data('hpc_result') + '</td>';
      }

      // to highlight the failed results in e-coli when unchecked
      if ($(this).data('ec_result') == "Positive")
      {
        html += '<td class="failed_color">' + $(this).data('ec_result') + '</td>';
      }
      else{
        html += '<td>' + $(this).data('ec_result') + '</td>';
      }

      html += '<td>' + $(this).data('fsa') + '</td>';
      html += '<td>' + $(this).data('micro_analyst') + '</td>'; 
      
     // to get back the color (red) when unchecked the checkbox
     if ($(this).data('remarks') == 'Hold')
     {
       html += '<td><label class="label label-danger">' + $(this).data('remarks') + '<label></td>';
     }
     else if($(this).data('remarks') == 'Ongoing')
     {
        html += '<td><label class="label label-info">' + $(this).data('remarks') + '<label></td>';
     }
     else 
     {
        html += '<td><label class="label label-success">' + $(this).data('remarks') + '<label></td>';
     }   
    }
    $(this).closest('tr').html(html);            


    if(document.getElementById('sel_tc_m').value == "" || $(this).data('tc_potable') == 'N/A')
    {
      $('#tc_potable_'+$(this).attr('id')+'').val($(this).data('tc_potable'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#tc_potable_'+$(this).attr('id')+'').val($(this).data('tc_potable'));
    }
    else
    {
      $('#tc_potable_'+$(this).attr('id')+'').val($('#sel_tc_m').val());
    }

    if(document.getElementById('sel_thc_m').value == "" || $(this).data('thc_potable') == 'N/A')
    {
      $('#thc_potable_'+$(this).attr('id')+'').val($(this).data('thc_potable'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#thc_potable_'+$(this).attr('id')+'').val($(this).data('thc_potable'));
    }
    else
    {
      $('#thc_potable_'+$(this).attr('id')+'').val($('#sel_thc_m').val());
    }
    
    if(document.getElementById('sel_hpc_m').value == "" || $(this).data('hpc_result') == 'N/A')
    {
      $('#hpc_result_'+$(this).attr('id')+'').val($(this).data('hpc_result'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#hpc_result_'+$(this).attr('id')+'').val($(this).data('hpc_result'));
    }
    else
    {
      $('#hpc_result_'+$(this).attr('id')+'').val($('#sel_hpc_m').val());
    }

    if($(this).data('ec_result') == 'N/A')
    { 
      $('#ec_result_'+$(this).attr('id')+'').val($(this).data('ec_result'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#ec_result_'+$(this).attr('id')+'').val($(this).data('ec_result'));
    }
    else
    {
      $('#ec_result_'+$(this).attr('id')+'').val($(this).data('ec_result'));
    }
    
    if(document.getElementById('microAnalyst_ddlist').value == "")
    {
      $('#micro_analyst_'+$(this).attr('id')+'').val($(this).data('micro_analyst'));
    }
    else if ($(this).data('remarks') == 'Printed' && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#micro_analyst_'+$(this).attr('id')+'').val($(this).data('micro_analyst'));
    }
    else
    {
      $('#micro_analyst_'+$(this).attr('id')+'').val($('#microAnalyst_ddlist').val());
    }
    
    // condtion on remarks
    if(document.getElementById('sel_remarks_m').value == "")
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Hold" && $(this).data('remarks') == "Printed" && (usertp == 'LAB-MICRO-HEAD' || usertp == 'LAB-MICRO-USER'))
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "Hold" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "for Checking")
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Done" && $(this).data('remarks') == "Printed" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "for Checking" && $(this).data('remarks') == "Printed" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "Ongoing" )
    {
      $('#remarks_'+$(this).attr('id')+'').val($(this).data('remarks'));
    }
    else
    {
      $('#remarks_'+$(this).attr('id')+'').val($('#sel_remarks_m').val());
    } 

    if(document.getElementById('sel_remarks_m').value == "Hold" || document.getElementById('sel_remarks_m').value == "Done")
    {
      var today = new Date();
      var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
      var time = today.getHours() + ':' + today.getMinutes();
      var datetime_enc = date + ' / ' + time;
      $('#mc_date_enc_'+$(this).attr('id')+'').val(datetime_enc);
    }
    else
    {
      $('#mc_date_enc_'+$(this).attr('id')+'').val($(this).data('mc_date_enc'));
    }

    if(document.getElementById('sel_remarks_m').value == "Printed" && $(this).data('remarks') == "Done")
    {
      var today = new Date();
      var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
      var time = today.getHours() + ':' + today.getMinutes();
      var datetime_prnt = date + ' / ' + time;
      $('#mc_date_prnt_'+$(this).attr('id')+'').val(datetime_prnt);
    }
    else
    {
      $('#mc_date_prnt_'+$(this).attr('id')+'').val($(this).data('mc_date_prnt'));
    }

    if($('.check_boxMicro:checked').length == $('.check_boxMicro').length)
    {
          $('#checkAll').prop('checked',true);
    }else{
          $('#checkAll').prop('checked',false);
    }
});
// individual select chkbox end

//update btn
      $('#update_form').on('submit', function(event){
          event.preventDefault();
          
         
          if($('.check_boxMicro:checked').length > 0)
          { 
              $("#overlay").addClass("disabledbutton"); // for loader disabled background/buttons
              $("#update-loader").show();               // show loader
              $.ajax({
                  url:"/alphalab/api/inputMicroResult/multiple_update.php",
                  method:"POST",
                  data:$('#update_form').serialize(),
               
                  success:function()
                  {
                      $("#update-loader").hide();                   // hide loader
                      $("#overlay").removeClass("disabledbutton");  // enable background/buttons again
                     
                      $('#checkAll').prop('checked',false);
                      clrfldm();
                      swal("Updated Successfully!");
                      show_data();

                  }
              });
              return false;
          }
          else{
              swal("Select Item First!");
          }
          return false;
      });
//update btn end

function clrfldm(){
    $('#sel_remarks_m').val("");
    $('#microAnalyst_ddlist').val("");
    $('#sel_tc_m').val("");
    $('#sel_thc_m').val("");
    $('#sel_hpc_m').val("");
}

 </script>