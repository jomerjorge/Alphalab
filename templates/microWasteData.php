<?php
require("../lib/core.php");
require("../functions/login_functions.php");
require("../functions/checkLogState.php");

checkLogState();

?>
<div id="overlay">

<div class="toolbar_mw">
  <div class="form-inline">
    <div class="outer_mw">
      <div class="input-group">
        <input list="state_search_m" type="text" class="form-control input-sm" name="search_text_mw" id="search_text_mw" placeholder="RWWT NO. . ">
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

    <button type="button" class="btn btn-default btn-sm btn-success" id="addFilter_mw">
      <span class="fa fa-filter" aria-hidden="true"></span> Apply Date Filter  
    </button>

    <div class="inner_mw is-hidden">
      <div id="divA_mw">
       <select style="width:140px" class="form-control input-sm" id="fsa" name="fsa" required="">
       </select>&nbsp
  <div class="input-group">
    <input size="12" type="text" class="form-control input-sm" id="From" name="From" placeholder="From date"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
  </div> <strong>--</strong>
  <div class="input-group">
    <input size="12" type="text" class="form-control input-sm" id="to" name="to" placeholder="To date"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
  </div>
      </div>

      <div id="divB_mw">
        <button type="button" class="btn btn-primary btn-sm" id="range_mw" name="range_mw"><i class="fa fa-filter" aria-hidden="true"></i> Filter Search</button>
      </div>
    </div>
 </div>
</div>
<br>
<br>

<form method="post" id="update_form">

  <div class="form-inline">

    <select class="form-control input-sm" id="microAnalyst_ddlist" name="microAnalyst_ddlist">
    </select>

    <select class="form-control input-sm" id="sel_remarks_w" name="sel_remarks_w">
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

    &nbsp&nbsp&nbspRecord(s) Found: &nbsp <b><span id="datafound_mw"></span></b>
    <button type="submit" name="multiple_update" id="multiple_update" class="btn btn-success btn-sm pull-right" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button>

    <br>
    <br>
  </div>  
      
      <label class="alert-danger note_mw">Note: Please select Analyst before placing data.</label>
      <div class="tableFixHead" id="microWasteResultTable">
          <table class="table table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
                <th width="1%"><input type="checkbox" id="checkAllWaste"></th>
                <th width="3%">Date Received</th>
                <th width="2%">RWWT No.</th>
                <th width="9%">Source of Sample</th>
                <th width="2%">TC-W</th>
                <th width="2%">FC-W</th>
                <th width="7%">FSA</th>
                <th width="7%">Analyst</th>
                <th width="2%">Remarks</th>
                <!-- <th width="3%">Date Encoded</th>
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
    
$('#addFilter_mw').on('click', function() {
  animateDV_mw();
})

// $(document).keyup(function(e) {
//   if (e.keyCode === 27 && $('.inner_mw').hasClass('visible')) { // 27 = esc keyboard
//     animateDV_mw();
//   }
// })

function animateDV_mw () {
  $('.inner_mw').toggleClass('visible');
  $('.inner_mw').animate({
    width: 'toggle',
  },350);


$("#search_text_mw").val("");
$("#fsa").val("");
$.datepicker._clearDate('#From');
$.datepicker._clearDate('#to');
$("#microWasteResultTable tbody").html("");
document.getElementById("checkAllWaste").checked = false;
$("#datafound_mw").html("");


   $('.outer_mw').toggleClass('visible');
  $('.outer_mw').animate({
    width: 'toggle',
  },350);
}

//fetch data
function fetch_data_mw(data){
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
                     +  '" data-rwt_num="' + dataArr[i].rwt_num 
                     +  '" data-water_des="' + dataArr[i].water_des 
                     +  '" data-sample_label="' + dataArr[i].sample_label 
                     +  '" data-tc_waste="' + dataArr[i].tc_waste 
                     +  '" data-fc_waste="' + dataArr[i].fc_waste 
                     +  '" data-fsa="' + dataArr[i].fsa 
                     +  '" data-micro_analyst_mw="' + dataArr[i].micro_analyst 
                     +  '" data-remarks_mw="' + dataArr[i].remarks
                     +  '" data-mc_date_enc="' + dataArr[i].mc_date_enc 
                     +  '" data-mc_date_prnt="' + dataArr[i].mc_date_prnt  
                     +  '" class="check_boxMicroWaste" /></td>';

                html += '<td>' + dataArr[i].date_rcvd + '</td>';
                html += '<td>' + dataArr[i].rwt_num + '</td>';
                html += '<td>' + dataArr[i].water_des + " " + dataArr[i].sample_label + '</td>';
                html += '<td>' + dataArr[i].tc_waste + '</td>';
                html += '<td>' + dataArr[i].fc_waste + '</td>';
                html += '<td>' + dataArr[i].fsa + '</td>';
                html += '<td>' + dataArr[i].micro_analyst + '</td>';

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
          $("#microWasteResultTable tbody").html(html);
          $("#datafound_mw").html(datafound);

        }
         else{
           html += "<td colspan='13'>" + "No record found." + "</td>";
           $("#microWasteResultTable tbody").html(html);
           $("#datafound_mw").html(0);
        }
}
//fetch data


$(document).ready(function(){
  $('#range_mw').click(function(){
    var date_start = $('#From').val();
    var date_end = $('#to').val();
    var txt = $('#fsa').val();
    if(date_start != '' && date_end != '' && txt != '')
    {
      $.ajax({
        url:"/alphalab/api/inputMicroWasteResult/filterSearch_microWaste.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt,
          From:date_start, 
          to:date_end
        },
        success:function(data){
        console.log(data);
        fetch_data_mw(data);
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
      swal("Please fill all field");
    }
  });
})

    function show_data(){
      var date_start = $('#From').val();
      var date_end = $('#to').val();
      var txt = $('#search_text_mw').val();
      var txt2 = $('#fsa').val();
     
      if (txt2 != "" && date_start !="" && date_end != "") {

      $.ajax({
        url:"/alphalab/api/inputMicroWasteResult/filterSearch_microWaste.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt2,
          From:date_start, 
          to:date_end
        },
        success:function(data){
        console.log(data);
        fetch_data_mw(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
      });
  } else {
    $.ajax({
        url:"/alphalab/api/inputMicroWasteResult/singleSearch_microWaste.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt
        },
        success:function(data){
        console.log(data);
        fetch_data_mw(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
      });

  }

      }
    

 function searchRWT(){
      check_session();
      var txt = $('#search_text_mw').val();
      if (txt != "") {
      $.ajax({
        url:"/alphalab/api/inputMicroWasteResult/singleSearch_microWaste.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt
        },
        success:function(data){
        console.log(data);
        fetch_data_mw(data);
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


// ============================================= end


//select all
    $(document).ready(function(){
      $('#checkAllWaste').on('click',function(){
        var status = this.checked;
        var html = '';
            $('.check_boxMicroWaste').each(function(){
              this.checked = status;
              if(this.checked)
              {
                  html = '<td><input type="checkbox" id="'+$(this).attr('id') 
                       + '" data-date_rcvd="'+$(this).data('date_rcvd') 
                       + '" data-rwt_num="'+$(this).data('rwt_num') 
                       + '" data-water_des="'+$(this).data('water_des') 
                       + '" data-sample_label="'+$(this).data('sample_label') 
                       + '" data-tc_waste="'+$(this).data('tc_waste') 
                       + '" data-fc_waste="'+$(this).data('fc_waste') 
                       + '" data-fsa="'+$(this).data('fsa') 
                       + '" data-micro_analyst_mw="'+$(this).data('micro_analyst_mw') 
                       + '" data-remarks_mw="'+$(this).data('remarks_mw') 
                       + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
                       + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt') 
                       + '" class="check_boxMicroWaste" checked /></td>';

                  html += '<td>'+ $(this).data("date_rcvd") + '</td>';
                  html += '<td>'+ $(this).data("rwt_num") + '</td>';
                  html += '<td>'+ $(this).data("water_des") + " " + $(this).data("sample_label") + '</td>';

                  if($(this).data('tc_waste') == 'N/A')
                  {
                    html += '<td><input type="text" name="tc_waste[]" id="tc_waste_' 
                         + $(this).attr('id')
                         + '" class="form-control input-sm" readonly></td>';
                  }else{
                    html += '<td><input type="text" autocomplete="off" name="tc_waste[]" id="tc_waste_' 
                       + $(this).attr('id')
                       + '" class="form-control input-sm" required></td>';
                  }

                  if($(this).data('fc_waste') == 'N/A')
                  {
                    html += '<td><input type="text" name="fc_waste[]" id="fc_waste_' 
                         + $(this).attr('id')
                         + '" class="form-control input-sm" readonly></td>';
                  }else{
                    html += '<td><input type="text" name="fc_waste[]" id="fc_waste_' 
                         + $(this).attr('id')
                         + '" class="form-control input-sm" required></td>';
                  }

                  html += '<td>'+ $(this).data('fsa') + '</td>';
                  html += '<td><input type="text" name="micro_analyst_mw[]" id="micro_analyst_mw_' 
                       + $(this).attr('id')
                       + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst" required></td>';
                  html += '<td><select name="remarks_mw[]" id="remarks_mw_' 
                       + $(this).attr('id')
                       + '" class="form-control input-sm" required><option value="Ongoing" style="display:none">Ongoing</option><option value="Done" style="display:none">Done</option><option value="Hold">Hold</option><option value="Printed" style="display:none">Printed</option><option value="for Checking">for Checking</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_' 
                       + $(this).attr('id')
                       + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
                       + $(this).attr('id')
                       + '"/></td><input type="hidden" name="hidden_id[]" value="'
                       + $(this).attr('id') + '"/></td>';
              }else{
                  html = '<td><input type="checkbox" id="' + $(this).attr('id')
                       + '" data-date_rcvd="'+$(this).data('date_rcvd') 
                       + '" data-rwt_num="'+$(this).data('rwt_num') 
                       + '" data-water_des="'+$(this).data('water_des') 
                       + '" data-sample_label="'+$(this).data('sample_label')
                       + '" data-tc_waste="'+$(this).data('tc_waste') 
                       + '" data-fc_waste="'+$(this).data('fc_waste')
                       + '" data-fsa="'+$(this).data('fsa') 
                       + '" data-micro_analyst_mw="'+$(this).data('micro_analyst_mw') 
                       + '" data-remarks_mw="'+$(this).data('remarks_mw')
                       + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
                       + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt')  
                       + '" class="check_boxMicroWaste" /></td>';

                  html += '<td>' + $(this).data('date_rcvd') + '</td>';
                  html += '<td>' + $(this).data('rwt_num') + '</td>';
                  html += '<td>' + $(this).data('water_des') + " " + $(this).data('sample_label') + '</td>';
                  html += '<td>' + $(this).data('tc_waste') + '</td>';     
                  html += '<td>' + $(this).data('fc_waste') + '</td>';
                  html += '<td>' + $(this).data('fsa') + '</td>';
                  html += '<td>' + $(this).data('micro_analyst_mw') + '</td>'; 

                 // to get back the color (red) when unchecked the checkbox
                 if ($(this).data('remarks_mw') == 'Hold'){
                   html += '<td><label class="label label-danger">' + $(this).data('remarks_mw') + '<label></td>';
                 }else if($(this).data('remarks_mw') == 'Ongoing'){
                    html += '<td><label class="label label-info">' + $(this).data('remarks_mw') + '<label></td>';
                 }else {
                    html += '<td><label class="label label-success">' + $(this).data('remarks_mw') + '<label></td>';
                 }

                }
                $(this).closest('tr').html(html);
                $('#tc_waste_'+$(this).attr('id')+'').val($(this).data('tc_waste'));
                $('#fc_waste_'+$(this).attr('id')+'').val($(this).data('fc_waste'));


              if(document.getElementById('microAnalyst_ddlist').value == "")
              {
                $('#micro_analyst_mw_'+$(this).attr('id')+'').val($(this).data('micro_analyst_mw'));
              }else{
                $('#micro_analyst_mw_'+$(this).attr('id')+'').val($('#microAnalyst_ddlist').val());
              }

              if(document.getElementById('sel_remarks_w').value == "")
              {
                $('#remarks_mw_'+$(this).attr('id')+'').val($(this).data('remarks_mw'));
              }else{
                $('#remarks_mw_'+$(this).attr('id')+'').val($('#sel_remarks_w').val());
              }

              if(document.getElementById('sel_remarks_w').value == "Hold" || document.getElementById('sel_remarks_w').value == "Done")
              {
                var todayw = new Date();
                var datew = todayw.getFullYear() + '-' + (todayw.getMonth() + 1) + '-' + todayw.getDate();
                var timew = todayw.getHours() + ':' + todayw.getMinutes();
                var datetime_enc_w = datew + ' / ' + timew;
                $('#mc_date_enc_'+$(this).attr('id')+'').val(datetime_enc_w);
              }
              else{
                $('#mc_date_enc_'+$(this).attr('id')+'').val($(this).data('mc_date_enc'));
              }

              if(document.getElementById('sel_remarks_w').value == "Printed" && $(this).data('remarks_mw') == "Done")
              {
                var todayw = new Date();
                var datew = todayw.getFullYear() + '-' + (todayw.getMonth() + 1) + '-' + todayw.getDate();
                var timew = todayw.getHours() + ':' + todayw.getMinutes();
                var datetime_prnt_w = datew + ' / ' + timew;
                $('#mc_date_prnt_'+$(this).attr('id')+'').val(datetime_prnt_w);
              }
              else{
                $('#mc_date_prnt_'+$(this).attr('id')+'').val($(this).data('mc_date_prnt'));
              }
            });
        });
    });
//select all

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

// individual select
    $(document).on('click', '.check_boxMicroWaste', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" id="'+$(this).attr('id') 
                 + '" data-date_rcvd="'+$(this).data('date_rcvd') 
                 + '" data-rwt_num="'+$(this).data('rwt_num') 
                 + '" data-water_des="'+$(this).data('water_des') 
                 + '" data-sample_label="'+$(this).data('sample_label') 
                 + '" data-tc_waste="'+$(this).data('tc_waste') 
                 + '" data-fc_waste="'+$(this).data('fc_waste') 
                 + '" data-fsa="'+$(this).data('fsa') 
                 + '" data-micro_analyst_mw="'+$(this).data('micro_analyst_mw') 
                 + '" data-remarks_mw="'+$(this).data('remarks_mw')
                 + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
                 + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt')  
                 + '" class="check_boxMicroWaste" checked /></td>';

          html += '<td>'+ $(this).data("date_rcvd") + '</td>';
          html += '<td>'+ $(this).data("rwt_num") + '</td>';
          html += '<td>'+ $(this).data("water_des") + " " + $(this).data("sample_label") + '</td>';
          
          if($(this).data('tc_waste') == 'N/A')
          {
            html += '<td><input type="text" name="tc_waste[]" id="tc_waste_' 
                 + $(this).attr('id')
                 + '" class="form-control input-sm" readonly></td>';
          }else{
            html += '<td><input type="text" autocomplete="off" name="tc_waste[]" id="tc_waste_' 
               + $(this).attr('id')
               + '" class="form-control input-sm" required></td>';
          }

          if($(this).data('fc_waste') == 'N/A')
          {
            html += '<td><input type="text" name="fc_waste[]" id="fc_waste_' 
                 + $(this).attr('id')
                 + '" class="form-control input-sm" readonly></td>';
          }else{
            html += '<td><input type="text" name="fc_waste[]" id="fc_waste_' 
                 + $(this).attr('id')
                 + '" class="form-control input-sm" required></td>';
          }

          html += '<td>'+ $(this).data('fsa') + '</td>';
          html += '<td><input type="text" name="micro_analyst_mw[]" id="micro_analyst_mw_' 
               + $(this).attr('id')
               + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst" required></td>';
          html += '<td><select name="remarks_mw[]" id="remarks_mw_' 
               + $(this).attr('id')
               + '" class="form-control input-sm" required><option value="Ongoing" style="display:none">Ongoing</option><option value="Done" style="display:none">Done</option><option value="Hold">Hold</option><option value="Printed" style="display:none">Printed</option><option value="for Checking">for Checking</option></select><input type="hidden" name="mc_date_enc[]" id="mc_date_enc_' 
               + $(this).attr('id')
               + '"/><input type="hidden" name="mc_date_prnt[]" id="mc_date_prnt_' 
               + $(this).attr('id')
               + '"/><input type="hidden" name="hidden_id[]" value="'
               + $(this).attr('id')+'" /></td>';
        }
        else
        {
            html = '<td><input type="checkbox" id="' + $(this).attr('id')
                 + '" data-date_rcvd="'+$(this).data('date_rcvd') 
                 + '" data-rwt_num="'+$(this).data('rwt_num') 
                 + '" data-water_des="'+$(this).data('water_des') 
                 + '" data-sample_label="'+$(this).data('sample_label') 
                 + '" data-tc_waste="'+$(this).data('tc_waste') 
                 + '" data-fc_waste="'+$(this).data('fc_waste')
                 + '" data-fsa="'+$(this).data('fsa') 
                 + '" data-micro_analyst_mw="'+$(this).data('micro_analyst_mw') 
                 + '" data-remarks_mw="'+$(this).data('remarks_mw')
                 + '" data-mc_date_enc="'+$(this).data('mc_date_enc') 
                 + '" data-mc_date_prnt="'+$(this).data('mc_date_prnt') 
                 + '" class="check_boxMicroWaste" /></td>';

            html += '<td>' + $(this).data('date_rcvd') + '</td>';
            html += '<td>' + $(this).data('rwt_num') + '</td>';
            html += '<td>' + $(this).data('water_des') + " " + $(this).data('sample_label') + '</td>';
            html += '<td>' + $(this).data('tc_waste') + '</td>';     
            html += '<td>' + $(this).data('fc_waste') + '</td>';
            html += '<td>' + $(this).data('fsa') + '</td>';
            html += '<td>' + $(this).data('micro_analyst_mw') + '</td>'; 

             // to get back the color (red) when unchecked the checkbox
             if ($(this).data('remarks_mw') == 'Hold'){
               html += '<td><label class="label label-danger">' + $(this).data('remarks_mw') + '<label></td>';
             }else if($(this).data('remarks_mw') == 'Ongoing'){
                html += '<td><label class="label label-info">' + $(this).data('remarks_mw') + '<label></td>';
             }else {
                html += '<td><label class="label label-success">' + $(this).data('remarks_mw') + '<label></td>';
             }
     
            // html += '<td>' + $(this).data('mc_date_enc') + '</td>';
            // html += '<td>' + $(this).data('mc_date_prnt') + '</td>'; 
        }
        $(this).closest('tr').html(html);
        $('#tc_waste_'+$(this).attr('id')+'').val($(this).data('tc_waste'));
        $('#fc_waste_'+$(this).attr('id')+'').val($(this).data('fc_waste'));

        if(document.getElementById('microAnalyst_ddlist').value == "")
        {
          $('#micro_analyst_mw_'+$(this).attr('id')+'').val($(this).data('micro_analyst_mw'));
        }else{
          $('#micro_analyst_mw_'+$(this).attr('id')+'').val($('#microAnalyst_ddlist').val());
        }

        if(document.getElementById('sel_remarks_w').value == "")
        {
          $('#remarks_mw_'+$(this).attr('id')+'').val($(this).data('remarks_mw'));
        }else{
          $('#remarks_mw_'+$(this).attr('id')+'').val($('#sel_remarks_w').val());
        }

        if(document.getElementById('sel_remarks_w').value == "Hold" || document.getElementById('sel_remarks_w').value == "Done")
        {
          var today = new Date();
          var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
          var time = today.getHours() + ':' + today.getMinutes();
          var datetime_enc_w = date + ' / ' + time;
          $('#mc_date_enc_'+$(this).attr('id')+'').val(datetime_enc_w);
        }
        else{
          $('#mc_date_enc_'+$(this).attr('id')+'').val($(this).data('mc_date_enc'));
        }

        if(document.getElementById('sel_remarks_w').value == "Printed" && $(this).data('remarks_mw') == "Done")
        {
          var today = new Date();
          var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
          var time = today.getHours() + ':' + today.getMinutes();
          var datetime_prnt_w = date + ' / ' + time;
          $('#mc_date_prnt_'+$(this).attr('id')+'').val(datetime_prnt_w);
        }
        else{
          $('#mc_date_prnt_'+$(this).attr('id')+'').val($(this).data('mc_date_prnt'));
        }

        if($('.check_boxMicroWaste:checked').length == $('.check_boxMicroWaste').length){
              $('#checkAllWaste').prop('checked',true);
          }else{
              $('#checkAllWaste').prop('checked',false);
          }
    });
// individual select


      $('#update_form').on('submit', function(event){
          event.preventDefault();

          if($('.check_boxMicroWaste:checked').length > 0)
          {
              $("#overlay").addClass("disabledbutton"); // for loader disabled background/buttons
              $("#update-loader").show();               // show loader
              $.ajax({
                  url:"/alphalab/api/inputMicroWasteResult/multiple_update_mw.php",
                  method:"POST",
                  data:$('#update_form').serialize(),
               
                  success:function()
                  {
                      $("#update-loader").hide();                   // hide loader
                      $("#overlay").removeClass("disabledbutton");  // enable background/buttons again

                      $('#checkAllWaste').prop('checked',false);
                      clrfldmw();
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


function clrfldmw(){
    $('#sel_remarks_w').val("");
    $('#microAnalyst_ddlist').val("");
    $('#sel_fc_w').val("");
    $('#sel_tc_w').val("");
}


    
  </script>