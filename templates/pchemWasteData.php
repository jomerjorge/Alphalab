<?php
require("../lib/core.php");
require("../functions/login_functions.php");
require("../functions/checkLogState.php");

checkLogState();

?>

<div class="toolbar_pw">
  <div class="form-inline">
    <div class="outer_pw">
      <div class="input-group">
        <input list="state_search_pw" type="text" class="form-control input-sm" name="search_rwt" id="search_rwt" placeholder="RWT/RWWT NO. . ">
          <datalist id="state_search_pw">
            <option value="Completed">
            <option value="for Checking">
            <option value="Hold">
          </datalist>
        <span class="input-group-btn">
          <button type="button" class="btn btn-sm btn-primary" id="searchRWT_pw" onclick="searchRWT()"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
        </span>
      </div>
    </div> 

    <button type="button" class="btn btn-default btn-sm btn-success" id="addFilter_pw">
      <span class="fa fa-filter" aria-hidden="true"></span> Apply Date Filter 
    </button>

    <div class="inner_pw is-hidden">
      <div id="divA_pw">
       <select style="width:140px" class="form-control input-sm" id="fsa" name="fsa" required="">
          <option value="" disabled selected hidden>< Submitted By ></option>
          <option value="Reiner">Reiner</option>
          <option value="Geoffrey">Geoffrey</option>
          <option value="Edgar A.">Edgar A.</option>
          <option value="J.A">J.A</option>
          <option value="Raul">Raul</option>
          <option value="Dexter">Dexter</option>
          <option value="Reserve(FSA)">Reserve(FSA)</option>
          <option value="Walk-In Client">Walk-In Client</option>
        </select>&nbsp
  <div class="input-group">
    <input size="12" type="text" class="form-control input-sm" id="From" name="From" placeholder="From date"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
  </div> <strong>--</strong>
  <div class="input-group">
    <input size="12" type="text" class="form-control input-sm" id="to" name="to" placeholder="To date"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
  </div>
      </div>

      <div id="divB_pw">
        <button type="button" class="btn btn-primary btn-sm" id="range_pw" name="range_pw" 
                onclick="range_PW()"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
      </div>

    </div>
 </div>
</div>


<!-- <div class="col-sm-4">
    <div class="form-group">
        <div class="input-group">
            <input list="state_search" type="text" class="form-control input-sm" name="search_rwt" id="search_rwt" title="Input RWT/RWWT No." placeholder="RWT/RWWT NO. . ">
            <datalist id="state_search">
              <option value="Ongoing">
              <option value="Hold">
            </datalist>
            <span class="input-group-btn">
              <button type="button" class="btn btn-sm btn-default" onclick="searchRWT()"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
        </div> 
      </div>
    </div> -->


    <div class="pull-right">
      <h5>Record(s) Found: <b><span id="datafound_rwt"></span></b></h5>
    </div>

<div class="tableFixHead" id="testreqTable" >
        <table class="table table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="10%">Company Name</th>
              <th width="7%">Address</th>
              <th width="2%">Status</th>
              <th width="3%">Date Received</th>
              <th width="3%">RWWT/RWT No.</th>
              <th width="5%">FSA</th>
              <!-- <th width="5%">Date Completed</th>
              <th width="5%">Date Printed</th> -->
              <th width="1%">Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

<!-- VIEW PCHEM & WASTE RESULTS -->
  <div class="modal modal-wide fade" id="modalPW" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title" id="modalPW">Test Records</span>
            <span id="compName"></span>
        </div>
        <div class="modal-body"> 
          <!-- OLD LABEL INSERTED HERE -->
          <form method="post" id="update_pw">
            <div class="pull-right" align="left">
                <button type="submit" name="multiple_update_pw" id="multiple_update_pw" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button>
            </div>
            <!-- Update Status -->
            <div class="form-inline">

              <div class="input-group">
                <input type="text" class="form-control input-sm" name="search_source" id="search_source" placeholder="Search.." autocomplete="off">
                <span class="input-group-btn">
                <button type="button" class="btn btn-sm btn-primary" id="ssclick" onclick="searchBySource();"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                </span>
              </div> &nbsp &nbsp &nbsp &nbsp

              <b>Status: </b> &nbsp
              <div class="input-group">
                <select class="form-control input-sm" id="state" name="state" >
                  <option value="Ongoing" <?php if($_SESSION['usertype'] == 'LAB-CHEM-USER' ||
                                                   $_SESSION['usertype'] == 'LAB-CHEM-HEAD' ||
                                                   $_SESSION['usertype'] == 'USER-DES' ) echo 'style="display:none"'; ?>>Ongoing</option>
                  <option value="Hold" <?php if($_SESSION['usertype'] == 'USER-DES' ) echo 'style="display:none"'; ?>>Hold</option>
                  <option value="for Checking" <?php if($_SESSION['usertype'] == 'LAB-CHEM-HEAD' ||
                                                   $_SESSION['usertype'] == 'USER-DES') echo 'style="display:none"'; ?>>for Checking</option>
                  <option value="Completed" <?php if($_SESSION['usertype'] == 'LAB-CHEM-USER' ||
                                                   $_SESSION['usertype'] == 'USER-DES') echo 'style="display:none"'; ?>>Completed</option>
                  <option value="Printed" <?php if($_SESSION['usertype'] == 'LAB-CHEM-USER' ||
                                                   $_SESSION['usertype'] == 'LAB-CHEM-HEAD') echo 'style="display:none"'; ?>>Printed</option>
                </select>
                <input type="hidden" name="date_com_pw" id="date_com_pw">
                <input type="hidden" name="date_prnt_pw" id="date_prnt_pw">
                <span class="input-group-btn">
                  <input type="hidden" name="hiddenClientid" id="hiddenClientid">
                  <button type="button" class="btn btn-sm btn-primary" id="statebtn" onclick="Upstate()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                </span>
              </div> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp

              <select class="form-control input-sm" id="chemAnalyst_ddlist" name="chemAnalyst_ddlist">
              </select>

            </div>
            <!-- Update Status End -->
            <br/>
          <label class="alert-danger note_pw">Note: Please select Analyst before placing data.</label>
          <div class="tableFixHead">
            <table id="pwTable" class="table table-bordered">
              <thead>
                <tr>
                  <th width="1%"><input type="checkbox" class="checkAll" id="checkAll" name="checkAll" /></th>
                  <th width="8%">Sample Desc.</th>
                  <th width="12%">Test Parameters</th>
                  <th width="12%">Method</th>
                  <th width="5%">Test Results</th>
                  <th width="8%">Analyst</th>
                  <!-- <th width="5%">Date Encoded</th> -->
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          </form>
        </div>
        <div class="modal-footer">
              <input type="hidden" id="hiddenViewPchemWaste" />
              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
              <span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- END PCHEM & WASTE MODAL -->
</div>


<script type="text/javascript" src="script/fsa_analyst_ddlist.js"></script>
<script type="text/javascript" src="script/fixedHeader.js"></script>
<script type="text/javascript" src="script/datepickerFromTo.js"></script> 

  <script type="text/javascript">

$("#search_source").keyup(function(event) {   // shortcut for enter when searching
    if (event.keyCode === 13) {         // 13 = enter 
        $("#ssclick").click();
    }
});

//slide navigation    
$('#addFilter_pw').on('click', function() {
  animateDiv_pw();
})

function animateDiv_pw () {
  $('.inner_pw').toggleClass('visible');
  $('.inner_pw').animate({
    width: 'toggle',
  },350);


$("#search_rwt").val("");
$("#fsa").val("");
$.datepicker._clearDate('#From');
$.datepicker._clearDate('#to');
$("#testreqTable tbody").html("");
$("#datafound_rwt").html("");

  $('.outer_pw').toggleClass('visible');
  $('.outer_pw').animate({
    width: 'toggle',
  },350);
}
//slide navigation end


// filter search
function range_PW(){

    var date_start = $('#From').val();
    var date_end = $('#to').val();
    var txt_pw = $('#fsa').val();
    if(date_start != '' && date_end != '' && txt_pw != null)
    {
      $.ajax({
        url:"/alphalab/api/PchemWasteResultview/filterSearch_pw.php",  
        method:"GET",  
        dataType: "json",
        data:{
          search:txt_pw,
          From:date_start, 
          to:date_end
        },  
      success: function(data) {
        fetch_dataTBL(data);
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
}
// filter search end

// search by status/rwt/rwwt
  function searchRWT(){
    check_session();
    var rwt = $('#search_rwt').val();

    if (rwt.length > 2) {

    $.ajax({ 
      url:"/alphalab/api/PchemWasteResultview/pw_searchRWT.php",  
      method:"GET",  
      dataType: "json",
      data:{
      search_rwt:rwt
      },  
      success: function(data) {
        fetch_dataTBL(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
      }  
    }); 
    } else {
        swal("Invalid Input! ");
    }
  }

// fetch index
show_data();
function show_data(){
    check_session();
    $.ajax({ 
      url:"/alphalab/api/PchemWasteResultview/index.php",  
      method:"GET",  
      dataType: "json",
      
      success: function(data) {
        fetch_dataTBL(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
      }  
    }); 
    
  }
//fetch index end


// search by status/rwt/rwwt end

// fetch data
  function fetch_dataTBL(data){
    if (data.success) {
          $("div.tableFixHead").scrollTop(0); // to return to top when click search
          var dataArr = data.success.data;
          var html = "";
          testRequestList = dataArr;
          datafound = data.success.datafound;
          list = dataArr; // to select the specific client when viewing View Records Tab

          for (var i = 0; i < dataArr.length; i++){

          var sampling_date = new Date(dataArr[i].date_rcvd); // sampling date
          var date_today = new Date(); // date today example
          var date_diff =  Math.floor((Date.UTC(date_today.getFullYear(), date_today.getMonth(), date_today.getDate()) - Date.UTC(sampling_date.getFullYear(), sampling_date.getMonth(), sampling_date.getDate()) ) /(1000 * 60 * 60 * 24));


              html += "<tr>";
              html += "<td>" + dataArr[i].company_name + " - " + dataArr[i].client_name + "</td>";
              html += "<td>" + dataArr[i].add_city + " " + dataArr[i].add_prov + "</td>";
              html += "<td>" + dataArr[i].state + "</td>";
              html += "<td>" + dataArr[i].date_rcvd + "</td>";

// CONDITIONS FOR HOLD AND DATE DIFFERENCE
        // if (dataArr[i].state == 'Hold'){
        //  html += '<td> <label class="label label-danger">' + dataArr[i].state + '</label></td>';

        //   if(date_diff == 6 && (dataArr[i].test_cat == 'MICRO & PCHEM' || dataArr[i].test_cat == 'PCHEM' || 
        //                         dataArr[i].test_cat == 'SPECIAL(PCHEM)' || dataArr[i].test_cat == 'POOL' || 
        //                         dataArr[i].test_cat == 'DIALYSIS'))
        //   {  // 5 DAYS of pchem (non-working days not counted)
        //        html += "<td> <label class='label label-warning'>" + dataArr[i].date_rcvd + " | " + 'Priority' + "</label></td>";
        //   } else if(date_diff > 6 && (dataArr[i].test_cat == 'MICRO & PCHEM' || dataArr[i].test_cat == 'PCHEM' || 
        //                               dataArr[i].test_cat == 'SPECIAL(PCHEM)' || dataArr[i].test_cat == 'POOL' || 
        //                               dataArr[i].test_cat == 'DIALYSIS'))
        //   { // MORE THAN 5 DAYS of pchem (non-working days not counted)
        //       html += "<td> <label class='label label-danger'>" + dataArr[i].date_rcvd + " | " + 'High Priority' + "</label></td>";
        //   } else if(date_diff == 8 && (dataArr[i].test_cat == 'WASTE' || 
        //                                dataArr[i].test_cat == 'WASTE & COLIFORM' || 
        //                                dataArr[i].test_cat == 'SPECIAL(WASTE)' || 
        //                                dataArr[i].test_cat == 'SPECIAL(WASTE) & COLIFORM'))
        //   { //5 DAYS of waste (non-working days not counted)
        //       html += "<td> <label class='label label-danger'>" + dataArr[i].date_rcvd + " | " + 'High Priority' + "</label></td>";
        //   } else if(date_diff > 8 && (dataArr[i].test_cat == 'WASTE' || 
        //                               dataArr[i].test_cat == 'WASTE & COLIFORM' || 
        //                               dataArr[i].test_cat == 'SPECIAL(WASTE)' || 
        //                               dataArr[i].test_cat == 'SPECIAL(WASTE) & COLIFORM'))
        //   { // MORE THAN 5 DAYS of waste (non-working days not counted)
        //       html += "<td> <label class='label label-danger'>" + dataArr[i].date_rcvd + " | " + 'High Priority' + "</label></td>";
        //   } else {
        //          html += "<td>" + dataArr[i].date_rcvd + "</td>";
        //   }

        // } else if(dataArr[i].state == 'Printed' || dataArr[i].state == 'Completed') {
        //    html += "<td>" + dataArr[i].state + "</td>";
        //    html += "<td>" + dataArr[i].date_rcvd + "</td>";
        // } 
        // else {     // IF THE STATUS IS ONGOING and for Checking
        //   html += "<td>" + dataArr[i].state + "</td>";  
        //   if(date_diff == 6 && (dataArr[i].test_cat == 'MICRO & PCHEM' || dataArr[i].test_cat == 'PCHEM' || 
        //                         dataArr[i].test_cat == 'SPECIAL(PCHEM)' || dataArr[i].test_cat == 'POOL' || 
        //                         dataArr[i].test_cat == 'DIALYSIS'))
        //   {  // 5 DAYS of pchem (non-working days not counted)
        //       html += "<td> <label class='label label-warning'>" + dataArr[i].date_rcvd + " | " + 'Priority' + "</label></td>";
        //   } else if(date_diff > 6 && (dataArr[i].test_cat == 'MICRO & PCHEM' || dataArr[i].test_cat == 'PCHEM' || 
        //                               dataArr[i].test_cat == 'SPECIAL(PCHEM)' || dataArr[i].test_cat == 'POOL' || 
        //                               dataArr[i].test_cat == 'DIALYSIS'))
        //   { // MORE THAN 5 DAYS of pchem (non-working days not counted)
        //       html += "<td> <label class='label label-danger'>" + dataArr[i].date_rcvd + " | " + 'High Priority' + "</label></td>";
        //   } else if(date_diff == 8 && (dataArr[i].test_cat == 'WASTE' || 
        //                                dataArr[i].test_cat == 'WASTE & COLIFORM' || 
        //                                dataArr[i].test_cat == 'SPECIAL(WASTE)' || 
        //                                dataArr[i].test_cat == 'SPECIAL(WASTE) & COLIFORM'))
        //   { //  5 DAYS of waste
        //       html += "<td> <label class='label label-danger'>" + dataArr[i].date_rcvd + " | " + 'High Priority' + "</label></td>";
        //   } else if(date_diff > 8 && (dataArr[i].test_cat == 'WASTE' || 
        //                               dataArr[i].test_cat == 'WASTE & COLIFORM' || 
        //                               dataArr[i].test_cat == 'SPECIAL(WASTE)' || 
        //                               dataArr[i].test_cat == 'SPECIAL(WASTE) & COLIFORM'))
        //   { // MORE THAN 5 DAYS of waste (non-working days not counted)
        //       html += "<td> <label class='label label-danger'>" + dataArr[i].date_rcvd + " | " + 'High Priority' + "</label></td>";
        //   } else {
        //          html += "<td>" + dataArr[i].date_rcvd + "</td>";
        //   }

        // }
// CONDITIONS OF HOLD AND DATE DIFFERENCE END

              html += "<td class='center_rwt'>" + dataArr[i].rwt_num + "</td>";
              html += "<td>" + dataArr[i].fsa + "</td>";
              // html += "<td>" + dataArr[i].date_com_pw + "</td>";
              // html += "<td>" + dataArr[i].date_prnt_pw + "</td>"; 
              html += "<td>" + "<button type='button' class='btn btn-xs btn-primary' id='pwbtn' onclick='fetch_data(" + i + ")'><i class='fa fa-folder-open' aria-hidden='true'></i> Parameters</button>" + "</td>";          
                  
              html += "</tr>";
          }
          $("#testreqTable tbody").html(html);
          $("#datafound_rwt").html(datafound);
          console.log(dataArr);
          console.log("DATA FOUND: " + datafound);
        }
        else{
          html += "<td colspan='7'>" + "No record found." + "</td>";
          $("#testreqTable tbody").html(html);
          $("#datafound_rwt").html(0);
        }
  }
// fetch data end


  function searchBySource(){
     $("div.tableFixHead").scrollTop(0); // to return to top when click search
     check_session();
     var source = $('#search_source').val();
     var req_id = pw_id;
     
    $.ajax({ 
      url:"/alphalab/api/PchemWasteResultinsert/search.php",  
      method:"GET",  
      dataType: "json",
      data:{
      description:source,
      req_id:req_id
      },  
      success: function(response) {
        
        var html = '';
        pwList = response;
          for(var count = 0; count < response.length; count++)
            {
            html += '<tr>';
            html += '<td><input type="checkbox" id="' + response[count].pw_id 
                 +  '" data-sample_labelpw="' + response[count].sample_labelpw 
                 +  '" data-water_despw="' + response[count].water_despw 
                 +  '" data-sam_pointp="' + response[count].sam_pointp 
                 +  '" data-pw_param="' + response[count].pw_param  
                 +  '" data-pw_met="' + response[count].pw_met 
                 +  '" data-pw_result="' + response[count].pw_result 
                 +  '" data-pw_analyst="' + response[count].pw_analyst 
                 +  '" data-pw_date_enc="' + response[count].pw_date_enc
                 +  '" data-req_id="' + response[count].req_id
                 +  '" class="check_box" /></td>';

            html += '<td>' + response[count].water_despw + " "
                           + response[count].sample_labelpw + " "
                           + response[count].sam_pointp + '</td>';
            html += '<td>' + response[count].pw_param + '</td>';
            html += '<td>' + response[count].pw_met + '</td>';
            html += '<td>' + response[count].pw_result + '</td>';
            html += '<td>' + response[count].pw_analyst + '</td>'; 
            // html += '<td>' + response[count].pw_date_enc + '</td>';
            html += '</tr>';  
            }
          $("#pwTable tbody").html(html);
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
      }  
    }); 
    
  }


    function fetch_data(i){

      // connected to request id
      var item = testRequestList[i];
      pw_id = item.req_id; // id for request
      client_id = item.client_id; // use to update status
      state = item.state;
      date_com_pw = item.date_com_pw; // use to update status
      date_prnt_pw = item.date_prnt_pw;
      $('#search_source').val(''); // to clear search textbox
      $("span#compName").html(''); // to clear the title company name when no data showed
      $("#state").val(state);
      $("#hiddenViewPchemWaste").val(i);
      $("#modalPW").modal("show");
      $('#checkAll').prop('checked',false);
      $("span#modalPW").html("<b>" + item.rwt_num + "</b>");// Set Title to Bootstrap modal title
      console.log("client_id: " + client_id);
     
        // request id end
        $.ajax({
          url:"/alphalab/api/PchemWasteResultinsert/index.php?req_id=" + pw_id,
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
                 +  '" data-sample_labelpw="' + response[count].sample_labelpw 
                 +  '" data-water_despw="' + response[count].water_despw 
                 +  '" data-sam_pointp="' + response[count].sam_pointp 
                 +  '" data-pw_param="' + response[count].pw_param 
                 +  '" data-pw_met="' + response[count].pw_met 
                 +  '" data-pw_result="' + response[count].pw_result 
                 +  '" data-pw_analyst="' + response[count].pw_analyst
                 +  '" data-pw_date_enc="' + response[count].pw_date_enc 
                 +  '" data-req_id="' + response[count].req_id
                 +  '" class="check_box" /></td>';

            html += '<td>' + response[count].water_despw + " "
                           + response[count].sample_labelpw + " "
                           + response[count].sam_pointp + '</td>';
            html += '<td>' + response[count].pw_param + '</td>';
            html += '<td>' + response[count].pw_met + '</td>';
            html += '<td>' + response[count].pw_result + '</td>';
            html += '<td>' + response[count].pw_analyst + '</td>';
            // html += '<td>' + response[count].pw_date_enc + '</td>';
            html += '</tr>';

            $("span#compName").html(response[count].company_name); // to show company name next to rwt
            }
            $("#pwTable tbody").html(html);

            console.log("PW ID: " + pw_id);
          }
        });
    }

function getDate(){
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ':' + today.getMinutes();
    var datetime_enc_pw = date + ' / ' + time;
    document.getElementById("date_com_pw").value = datetime_enc_pw;
  } 

//update status end
function Upstate(){

      var data = {};
      data["req_id"] = pw_id;
      data["state"] = $('#state').val();

      if(document.getElementById('state').value == "Completed")
      {
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ':' + today.getMinutes();
        var pw_datetime_enc = date + ' / ' + time;
        data["date_com_pw"] = pw_datetime_enc;
      }
      else{
        data["date_com_pw"] = date_com_pw;
      }

      if(document.getElementById('state').value == "Printed")
      {
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ':' + today.getMinutes();
        var pw_datetime_prnt = date + ' / ' + time;
        data["date_prnt_pw"] = pw_datetime_prnt;
      }
      else{
        data["date_prnt_pw"] = date_prnt_pw;
      }

      data["client_id"] = client_id;

          $.ajax({
              type:'POST',
              url: "/alphalab/api/testrequest/statusUpdate.php",
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
                $("#modalPW").modal("hide");
                
                // to determine where func to go then refresh
                if($('#search_rwt').val() != ""){
                   searchRWT($("#search_rwt").val());
                }
                else if($('#From').val() != '' && $('#to').val() != '' && $('#fsa').val() != null ){
                   range_PW(); 
                }
                else {
                   show_data();
                }
               
              }
          }); 
           return false;  
    }
//update status end


//select all
  $(document).ready(function(){
    $('#checkAll').on('click',function(){
      var status = this.checked;
      var html = '';
      $('.check_box').each(function(){
        this.checked = status;


        if(this.checked)
        {
          html = '<td><input type="checkbox" id="'+$(this).attr('id') 
               + '" data-sample_labelpw="'+$(this).data('sample_labelpw') 
               + '" data-water_despw="'+$(this).data('water_despw') 
               + '" data-sam_pointp="'+$(this).data('sam_pointp')
               + '" data-pw_param="'+$(this).data('pw_param') 
               + '" data-pw_met="'+$(this).data('pw_met') 
               + '" data-pw_result="'+$(this).data('pw_result') 
               + '" data-pw_analyst="'+$(this).data('pw_analyst')
               + '" data-pw_date_enc="'+$(this).data('pw_date_enc') 
               + '" class="check_box" checked /></td>';

          html += '<td>' + $(this).data("water_despw") + " "
                         + $(this).data("sample_labelpw") + " " 
                         + $(this).data("sam_pointp") + '</td>';
          html += '<td>' + $(this).data("pw_param") + '</td>';
          html += '<td><input list="pw_met" type="text" autocomplete="off" name="pw_met[]" id="pw_met_' 
               + $(this).attr('id')
               + '" class="form-control input-sm" required><datalist id="pw_met"><option value="Ascorbic Acid Method, SMEWW 4500-P E">Ascorbic Acid Method, SMEWW 4500-P E</option><option value="Azide Modification, Dilution Technique(SMEWW 5210B)">Azide Modification, Dilution Technique(SMEWW 5210B)</option><option value="Azide Modification, Initial DO(SMEWW 5210B)">Azide Modification, Initial DO(SMEWW 5210B)</option><option value="Chloroform Extraction, SMEWW 5540C">Chloroform Extraction, SMEWW 5540C</option><option value="Closed Reflux Dichromate(SMEWW 5220C)">Closed Reflux Dichromate(SMEWW 5220C)</option><option value="Colorimetric(SMEWW 4500-PC)">Colorimetric(SMEWW 4500-PC)</option><option value="Colorimetric, SMEWW 3500-CrB">Colorimetric, SMEWW 3500-CrB</option><option value="Colorimetry(SMEWW 4500- SiO2)">Colorimetry(SMEWW 4500- SiO2)</option><option value="Direct Flame AAS,  SMEWW 3500_Al">Direct Flame AAS, SMEWW 3500_Al</option><option value="Direct Flame AAS, SMEWW 3500_Ba">Direct Flame AAS, SMEWW 3500_Ba</option><option value="Direct Flame AAS, SMEWW 3111 C">Direct Flame AAS, SMEWW 3111 C</option><option value="Direct Flame AAS, SMEWW 3111B">Direct Flame AAS, SMEWW 3111B</option><option value="Direct Nitrous Oxide-Acetylene FAAS, SMEWW 3111 D">Direct Nitrous Oxide-Acetylene FAAS, SMEWW 3111 D</option><option value="EDTA Titration(SMEWW Part 2340C)">EDTA Titration(SMEWW Part 2340C)</option><option value="EDTA Titration(SMEWW Part 3500Ca B)">EDTA Titration(SMEWW Part 3500Ca B)</option><option value="Electrometric(SMEWW Part 2510B)">Electrometric(SMEWW Part 2510B)</option><option value="Electrometric(SMEWW Part 4500-H+)">Electrometric(SMEWW Part 4500-H+)</option><option value="Electrometric Method(SMEWW 2520)">Electrometric Method(SMEWW 2520)</option><option value="Electrometric Method(SMEWW 2550)">Electrometric Method(SMEWW 2550)</option><option value="Gravimetric(SMEWW Part 2540)">Gravimetric (SMEWW Part 2540)</option><option value="Gravimetric(SMEWW Part 2540B)">Gravimetric(SMEWW Part 2540B)</option><option value="Gravimetric(SMEWW Part 2540C)">Gravimetric(SMEWW Part 2540C)</option><option value="Hydride Generation AAS, SMEWW 3114B">Hydride Generation AAS, SMEWW 3114B</option><option value="Hydride Generation/FAAS, SMEWW 3114B">Hydride Generation/FAAS, SMEWW 3114B</option><option value="Hydride Generation/FAAS, SMEWW 3114C">Hydride Generation/FAAS, SMEWW 3114C</option><option value="Iodometric Method, SMEWW 4500 Cl- B">Iodometric Method, SMEWW 4500 Cl- B</option><option value="Ion-Selective Electrode Method, SMEWW 4500-F-C">Ion-Selective Electrode Method, SMEWW 4500-F-C</option><option value="Liquid-liquid, Gravimetric Partition(SMEWW 5520B)">Liquid-liquid, Gravimetric Partition(SMEWW 5520B)</option><option value="Nitrate Electrode Method, SMEWW 4500-NO3-D">Nitrate Electrode Method, SMEWW 4500-NO3-D</option><option value="Photometric">Photometric</option><option value="Photometric(Analogous to SMEWW 4500-CN- E)">Photometric(Analogous to SMEWW 4500-CN- E)</option><option value="Photometric(Diazotization)">Photometric(Diazotization)</option><option value="Photometric(Dimethylglyoxime)">Photometric(Dimethylglyoxime)</option><option value="Photometric(Nephelometric Method, SMEWW 2130B)">Photometric(Nephelometric Method, SMEWW 2130B)</option><option value="Photometric(similar to SMEWW 4500 S2)">Photometric(similar to SMEWW 4500 S2)</option><option value="Selective Electrode Method, SMEWW 4500-NH3D">Selective Electrode Method, SMEWW 4500-NH3D</option><option value="Titrimetric(SMEWW Part 3500-Mg)">Titrimetric (SMEWW Part 3500-Mg)</option><option value="Titrimetric(Argentometric SMEWW part 4500 Cl-)">Titrimetric(Argentometric SMEWW part 4500 Cl-)</option><option value="Titrimetric(SMEWW 2310 B)">Titrimetric(SMEWW 2310 B)</option><option value="Titrimetric(SMEWW 2320 B)">Titrimetric(SMEWW 2320 B)</option><option value="TSS Dried at 103-105oC(SMEWW 2540D)">TSS Dried at 103-105oC(SMEWW 2540D)</option><option value="Visual Comparison(SMEWW 2120B)">Visual Comparison(SMEWW 2120B)</option><option value="Eriochrome Cyanine R Method SMEWW 3500-Al B">Eriochrome Cyanine R Method SMEWW 3500-Al B</option><option value="Turbidimetric Method SMEWW 4500-SO₄²⁻ E">Turbidimetric Method SMEWW 4500-SO₄²⁻ E</option><option value="Calculation Method SMEWW 3500-Mg B">Calculation Method SMEWW 3500-Mg B</option><option value="Conductivity SMEWW 2510 B">Conductivity SMEWW 2510 B</option><option value="Gravimetric (SMEWW 4500-SO42- D)">Gravimetric (SMEWW 4500-SO42- D)</option><option value="Electrometric Method">Electrometric Method</option><option value="Conductometric Method">Conductometric Method</option>><option value="DPD Colorimetric Method, SMEWW 4500 Cl- G">DPD Colorimetric Method, SMEWW 4500 Cl- G</option><option value="ICP Method, SMEWW 3120 B">ICP Method, SMEWW 3120 B</option><option value="Cold Vapor Analysis, SMEWW 3112B">Cold Vapor Analysis, SMEWW 3112B</option><option value="SMEWW 2710 F">SMEWW 2710 F</option></datalist></td>';
          html += '<td><input type="text" name="pw_result[]" class="form-control input-sm" autocomplete="off" required value="'
               + $(this).data('pw_result') + '" /></td>';
          html += '<td><input type="text" name="pw_analyst[]" id="pw_analyst_' 
               + $(this).attr('id')
               + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst" required><input type="hidden" name="pw_date_enc[]" value="' 
               + $(this).data('pw_date_enc')
               + '"/><input type="hidden" name="req_id[]" value="' + pw_id + '"><input type="hidden" name="hidden_id[]" value="' + $(this).attr('id')+ '" /></td>';

        }else{
          html = '<td><input type="checkbox" id="' + $(this).attr('id')
               + '" data-sample_labelpw="'+$(this).data('sample_labelpw') 
               + '" data-water_despw="'+$(this).data('water_despw') 
               + '" data-sam_pointp="'+$(this).data('sam_pointp') 
               + '" data-pw_param="'+$(this).data('pw_param')  
               + '" data-pw_met="'+$(this).data('pw_met') 
               + '" data-pw_result="'+$(this).data('pw_result')
               + '" data-pw_analyst="'+$(this).data('pw_analyst')
               + '" data-pw_date_enc="'+$(this).data('pw_date_enc')
               + '" class="check_box" /></td>';

          html += '<td>' + $(this).data("water_despw") + " "
                         + $(this).data("sample_labelpw") + " " 
                         + $(this).data("sam_pointp") + '</td>';
          html += '<td>' + $(this).data('pw_param') + '</td>';     
          html += '<td>' + $(this).data('pw_met') + '</td>';   
          html += '<td>' + $(this).data('pw_result') + '</td>';
          html += '<td>' + $(this).data('pw_analyst') + '</td>'; 
          // html += '<td>' + $(this).data('pw_date_enc') + '</td>';
        }
        $(this).closest('tr').html(html);
        $('#pw_met_'+$(this).attr('id')+'').val($(this).data('pw_met'));

        if(document.getElementById('chemAnalyst_ddlist').value == "")
        {
          $('#pw_analyst_'+$(this).attr('id')+'').val($(this).data('pw_analyst'));
        }else{
          $('#pw_analyst_'+$(this).attr('id')+'').val($('#chemAnalyst_ddlist').val());
        }
        console.log(pw_id);
        
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
  $(document).on('click', '.check_box', function(){
    var html = '';
    if(this.checked)
    {
      html = '<td><input type="checkbox" id="'+$(this).attr('id') 
           + '" data-sample_labelpw="'+$(this).data('sample_labelpw') 
           + '" data-water_despw="'+$(this).data('water_despw') 
           + '" data-sam_pointp="'+$(this).data('sam_pointp') 
           + '" data-pw_param="'+$(this).data('pw_param') 
           + '" data-pw_met="'+$(this).data('pw_met') 
           + '" data-pw_result="'+$(this).data('pw_result') 
           + '" data-pw_analyst="'+$(this).data('pw_analyst')
           + '" data-pw_date_enc="'+$(this).data('pw_date_enc') 
           + '" class="check_box" checked /></td>';

      html += '<td>' + $(this).data("water_despw") + " "
                     + $(this).data("sample_labelpw") + " " 
                     + $(this).data("sam_pointp") + '</td>';
      html += '<td>' + $(this).data("pw_param") + '</td>';
      html += '<td><input list="pw_met" type="text" autocomplete="off" name="pw_met[]" id="pw_met_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" required><datalist id="pw_met"><option value="Ascorbic Acid Method, SMEWW 4500-P E">Ascorbic Acid Method, SMEWW 4500-P E</option><option value="Azide Modification, Dilution Technique(SMEWW 5210B)">Azide Modification, Dilution Technique(SMEWW 5210B)</option><option value="Azide Modification, Initial DO(SMEWW 5210B)">Azide Modification, Initial DO(SMEWW 5210B)</option><option value="Chloroform Extraction, SMEWW 5540C">Chloroform Extraction, SMEWW 5540C</option><option value="Closed Reflux Dichromate(SMEWW 5220C)">Closed Reflux Dichromate(SMEWW 5220C)</option><option value="Colorimetric(SMEWW 4500-PC)">Colorimetric(SMEWW 4500-PC)</option><option value="Colorimetric, SMEWW 3500-CrB">Colorimetric, SMEWW 3500-CrB</option><option value="Colorimetry(SMEWW 4500- SiO2)">Colorimetry(SMEWW 4500- SiO2)</option><option value="Direct Flame AAS, SMEWW 3500_Al">Direct Flame AAS, SMEWW 3500_Al</option><option value="Direct Flame AAS, SMEWW 3500_Ba">Direct Flame AAS, SMEWW 3500_Ba</option><option value="Direct Flame AAS, SMEWW 3111 C">Direct Flame AAS, SMEWW 3111 C</option><option value="Direct Flame AAS, SMEWW 3111B">Direct Flame AAS, SMEWW 3111B</option><option value="Direct Nitrous Oxide-Acetylene FAAS, SMEWW 3111 D">Direct Nitrous Oxide-Acetylene FAAS, SMEWW 3111 D</option><option value="EDTA Titration(SMEWW Part 2340C)">EDTA Titration(SMEWW Part 2340C)</option><option value="EDTA Titration(SMEWW Part 3500Ca B)">EDTA Titration(SMEWW Part 3500Ca B)</option><option value="Electrometric(SMEWW Part 2510B)">Electrometric(SMEWW Part 2510B)</option><option value="Electrometric(SMEWW Part 4500-H+)">Electrometric(SMEWW Part 4500-H+)</option><option value="Electrometric Method(SMEWW 2520)">Electrometric Method(SMEWW 2520)</option><option value="Electrometric Method(SMEWW 2550)">Electrometric Method(SMEWW 2550)</option><option value="Gravimetric(SMEWW Part 2540)">Gravimetric(SMEWW Part 2540)</option><option value="Gravimetric(SMEWW Part 2540B)">Gravimetric(SMEWW Part 2540B)</option><option value="Gravimetric(SMEWW Part 2540C)">Gravimetric(SMEWW Part 2540C)</option><option value="Hydride Generation AAS, SMEWW 3114B">Hydride Generation AAS, SMEWW 3114B</option><option value="Hydride Generation/FAAS, SMEWW 3114B">Hydride Generation/FAAS, SMEWW 3114B</option><option value="Hydride Generation/FAAS, SMEWW 3114C">Hydride Generation/FAAS, SMEWW 3114C</option><option value="Iodometric Method, SMEWW 4500 Cl- B">Iodometric Method, SMEWW 4500 Cl- B</option><option value="Ion-Selective Electrode Method, SMEWW 4500-F-C">Ion-Selective Electrode Method, SMEWW 4500-F-C</option><option value="Liquid-liquid, Gravimetric Partition(SMEWW 5520B)">Liquid-liquid, Gravimetric Partition(SMEWW 5520B)</option><option value="Nitrate Electrode Method, SMEWW 4500-NO3-D">Nitrate Electrode Method, SMEWW 4500-NO3-D</option><option value="Photometric">Photometric</option><option value="Photometric(Analogous to SMEWW 4500-CN- E)">Photometric(Analogous to SMEWW 4500-CN- E)</option><option value="Photometric(Diazotization)">Photometric(Diazotization)</option><option value="Photometric(Dimethylglyoxime)">Photometric(Dimethylglyoxime)</option><option value="Photometric(Nephelometric Method, SMEWW 2130B)">Photometric(Nephelometric Method, SMEWW 2130B)</option><option value="Photometric(similar to SMEWW 4500 S2)">Photometric(similar to SMEWW 4500 S2)</option><option value="Selective Electrode Method, SMEWW 4500-NH3D">Selective Electrode Method, SMEWW 4500-NH3D</option><option value="Titrimetric(SMEWW Part 3500-Mg)">Titrimetric(SMEWW Part 3500-Mg)</option><option value="Titrimetric(Argentometric SMEWW part 4500 Cl-)">Titrimetric(Argentometric SMEWW part 4500 Cl-)</option><option value="Titrimetric(SMEWW 2310 B)">Titrimetric(SMEWW 2310 B)</option><option value="Titrimetric(SMEWW 2320 B)">Titrimetric(SMEWW 2320 B)</option><option value="TSS Dried at 103-105oC(SMEWW 2540D)">TSS Dried at 103-105oC(SMEWW 2540D)</option><option value="Visual Comparison(SMEWW 2120B)">Visual Comparison(SMEWW 2120B)</option><option value="Eriochrome Cyanine R Method SMEWW 3500-Al B">Eriochrome Cyanine R Method SMEWW 3500-Al B</option><option value="Turbidimetric Method SMEWW 4500-SO₄²⁻ E">Turbidimetric Method SMEWW 4500-SO₄²⁻ E</option><option value="Calculation Method SMEWW 3500-Mg B">Calculation Method SMEWW 3500-Mg B</option><option value="Conductivity SMEWW 2510 B">Conductivity SMEWW 2510 B</option><option value="Gravimetric (SMEWW 4500-SO42- D)">Gravimetric (SMEWW 4500-SO42- D)</option><option value="Electrometric Method">Electrometric Method</option><option value="Conductometric Method">Conductometric Method</option>><option value="DPD Colorimetric Method, SMEWW 4500-Cl G">DPD Colorimetric Method, SMEWW 4500-Cl G</option><option value="ICP Method, SMEWW 3120 B">ICP Method, SMEWW 3120 B</option><option value="Cold Vapor Analysis, SMEWW 3112B">Cold Vapor Analysis, SMEWW 3112B</option><option value="SMEWW 2710 F">SMEWW 2710 F</option></datalist></td>';
      html += '<td><input type="text" name="pw_result[]" class="form-control input-sm" autocomplete="off" required value="'
           + $(this).data('pw_result') + '" /></td>';
      html += '<td><input type="text" name="pw_analyst[]" id="pw_analyst_' 
           + $(this).attr('id')
           + '" class="form-control input-sm" onkeypress="return false;" onKeyDown="preventBackspace();" autocomplete="off" placeholder="Please Select Analyst" required><input type="hidden" name="pw_date_enc[]" value="' 
           + $(this).data('pw_date_enc')
           + '"/><input type="hidden" name="req_id[]" value="' + pw_id + '"><input type="hidden" name="hidden_id[]" value="' + $(this).attr('id') + '" /></td>';

    }else{
      html = '<td><input type="checkbox" id="' + $(this).attr('id')
           + '" data-sample_labelpw="'+$(this).data('sample_labelpw') 
           + '" data-water_despw="'+$(this).data('water_despw')
           + '" data-sam_pointp="'+$(this).data('sam_pointp')  
           + '" data-pw_param="'+$(this).data('pw_param')  
           + '" data-pw_met="'+$(this).data('pw_met') 
           + '" data-pw_result="'+$(this).data('pw_result')
           + '" data-pw_analyst="'+$(this).data('pw_analyst')
           + '" data-pw_date_enc="'+$(this).data('pw_date_enc')
           + '" class="check_box" /></td>';

      html += '<td>' + $(this).data("water_despw") + " "
                     + $(this).data("sample_labelpw") + " " 
                     + $(this).data("sam_pointp") + '</td>';
      html += '<td>' + $(this).data('pw_param') + '</td>';     
      html += '<td>' + $(this).data('pw_met') + '</td>';   
      html += '<td>' + $(this).data('pw_result') + '</td>';
      html += '<td>' + $(this).data('pw_analyst') + '</td>';
      // html += '<td>' + $(this).data('pw_date_enc') + '</td>'; 
    }
    $(this).closest('tr').html(html);
    $('#pw_met_'+$(this).attr('id')+'').val($(this).data('pw_met'));

    if(document.getElementById('chemAnalyst_ddlist').value == "")
        {
          $('#pw_analyst_'+$(this).attr('id')+'').val($(this).data('pw_analyst'));
        }else{
          $('#pw_analyst_'+$(this).attr('id')+'').val($('#chemAnalyst_ddlist').val());
        }

    console.log(pw_id);  

    if($('.check_box:checked').length == $('.check_box').length){
            $('#checkAll').prop('checked',true);
        }else{
            $('#checkAll').prop('checked',false);
        }
  });
// individual select


  $('#update_pw').on('submit', function(event){
      event.preventDefault();

      if($('.check_box:checked').length > 0)
      {
            $.ajax({
                url:"/alphalab/api/PchemWasteResultinsert/multiple_update.php",
                method:"POST",
                data:$('#update_pw').serialize(),
             
                success:function()
                {
                    clr_pw();
                    $('#checkAll').prop('checked',false); 
                    swal("Updated Successfully!");
                    console.log($('#update_pw').serialize());
                    fetch_data($("#hiddenViewPchemWaste").val());
                }
            });
          return false;
      }else{
              swal("Select Item First!");
          }
          return false;
  });

  function clr_pw() {
    $("#search_source").val("");
    $('#chemAnalyst_ddlist').val("");
  }

</script>