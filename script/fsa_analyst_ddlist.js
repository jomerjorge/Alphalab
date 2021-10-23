// note: Only for search function.

// for FSA dropdownlist
$(document).ready(function(){

 load_fsa_data();

 function load_fsa_data()
 {
  var html_code = '';
  $.getJSON('/alphalab/api/fsa/ddlist.php', function(data){
   // remove disabled selected hidden for export in excel coz it can't read.
   html_code += '<option value="" style="color: #E6E6E6" >< Submitted by ></option>'; // to show select with no value

   $.each(data, function(key, value){
      html_code += '<option value="' + value.fsa_name + '">' + value.fsa_name + '</option>';
   });
   $('#fsa').html(html_code);
  });
 }
});


// for ASSIGNED FSA dropdownlist
$(document).ready(function(){

 load_fsa_data();

 function load_fsa_data()
 {
  var html_code = '';
  $.getJSON('/alphalab/api/fsa/ddlist.php', function(data){
   // remove disabled selected hidden for export in excel coz it can't read.
   html_code += '<option value="" style="color: #E6E6E6" >< Select FSA ></option>'; // to show select with no value

   $.each(data, function(key, value){
      html_code += '<option value="' + value.fsa_name + '">' + value.fsa_name + '</option>';
   });
   $('#ass_fsa').html(html_code);
  });
 }
});



// for Chem Analyst dropdownlist
$(document).ready(function(){

 load_chemAnalyst_data();

 function load_chemAnalyst_data()
 {
  var html_code = '';
  $.getJSON('/alphalab/api/analyst/ddlist_pw.php', function(data){

   // remove disabled selected hidden for export in excel coz it can't read.
   html_code += '<option value="" style="color: #E6E6E6" >< Select Analyst ></option>'; // to show select with no value

   $.each(data, function(key, value){
      html_code += '<option value="' + value.analyst_name + '">' + value.analyst_name + '</option>';
   });
   $('#chemAnalyst_ddlist').html(html_code);
  });
 }
});

$(document).ready(function(){

 load_chemAnalyst_data_inac();

 function load_chemAnalyst_data_inac()
 {
  var html_code = '';
  $.getJSON('/alphalab/api/analyst/ddlist_pw_inac.php', function(data){

   // remove disabled selected hidden for export in excel coz it can't read.
   html_code += '<option value="" style="color: #E6E6E6" >< Select Analyst ></option>'; // to show select with no value

   $.each(data, function(key, value){
      html_code += '<option value="' + value.analyst_name + '">' + value.analyst_name + '</option>';
   });
   $('#chemAnalyst_ddlist_inac').html(html_code);
  });
 }
});


// for Micro Analyst dropdownlist
$(document).ready(function(){

 load_microAnalyst_data();

 function load_microAnalyst_data()
 {
  var html_code = '';
  $.getJSON('/alphalab/api/analyst/ddlist_mc.php', function(data){

   // remove disabled selected hidden for export in excel coz it can't read.
   html_code += '<option value="" style="color: #E6E6E6" >< Select Analyst ></option>'; // to show select with no value

   $.each(data, function(key, value){
      html_code += '<option value="' + value.analyst_name + '">' + value.analyst_name + '</option>';
   });
   $('#microAnalyst_ddlist').html(html_code);
  });
 }
});