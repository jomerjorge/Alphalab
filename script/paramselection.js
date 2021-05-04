//pchem
function newpchem()
{
  var arr = ['Color(Apparent)', 'Turbidity', 'pH  @ 25 ºC',
             'Nitrate(as NO3-Nitrogen)', 'Chlorine(Residual)', 'Cadmium', 
             'Arsenic', 'Lead', 'Total Dissolved Solids'];
    $('select#p_param').val(arr);
    $("#pchembtn span").text("NORMAL PCHEM");
    document.getElementById("pchembtn").style.background='#80ffaa';
}

function oldLag()
{
  var arr = ['Color(Apparent)', 'Turbidity', 'pH  @ 25 ºC', 'Chlorides', 
             'Total Hardness as CaCO3', 'Iron-Total', 'Manganese', 'Nitrate(as NO3-Nitrogen)',  
             'Fluoride', 'Copper as Dissolved', 'Lead', 'Arsenic', 'Total Dissolved Solids'];
    $('select#p_param').val(arr);
    $("#pchembtn span").text("Old Laguna");
    document.getElementById("pchembtn").style.background='#80ffaa';
}

function nwrb()
{
  var arr = ['Color(Apparent)', 'Turbidity', 'pH  @ 25 ºC', 'Chlorides', 'Total Hardness as CaCO3', 
              'Iron-Total', 'Manganese', 'Copper as Dissolved', 'Lead', 'Total Dissolved Solids'];
    $('select#p_param').val(arr);
    $("#pchembtn span").text("NWRB");
    document.getElementById("pchembtn").style.background='#80ffaa';
}

function dialysis()
{
  var arr = ['Calcium', 'Nitrate(as NO3-Nitrogen)', 'Fluoride', 'Chlorine(Residual)', 'Sulfate', 'Copper as Dissolved',
             'Sodium', 'Selenium', 'Arsenic', 'Cadmium', 'Chromium, Total', 'Lead', 'Aluminum', 'Magnesium',
             'Potassium', 'Zinc', 'Silver', 'Barium', 'Mercury', 'Chloramines'];
    $('select#p_param').val(arr);
    $("#pchembtn span").text("Dialysis");
    document.getElementById("pchembtn").style.background='#80ffaa';
}

function mtp()
{
  var arr = ['Color(Apparent)', 'Turbidity', 'Total Hardness as CaCO3', 'Alkalinity', 
              'Iron-Total', 'Salinity', 'Conductivity', 'Total Dissolved Solids', 'Manganese'];
    $('select#p_param').val(arr);
    $("#pchembtn span").text("MTP");
    document.getElementById("pchembtn").style.background='#80ffaa';
}

function sysDes()
{
  var arr = ['Color(Apparent)', 'Turbidity', 'pH  @ 25 ºC', 'Chlorides', 
             'Total Hardness as CaCO3', 'Iron-Total', 'Manganese', 'Nitrate(as NO3-Nitrogen)',  
             'Fluoride', 'Lead', 'Arsenic', 'Cadmium', 'Total Dissolved Solids', 'Sulfate',
             'Calcium', 'Magnesium', 'Sodium', 'Silica'];
    $('select#p_param').val(arr);
    $("#pchembtn span").text("System Designed");
    document.getElementById("pchembtn").style.background='#80ffaa';
}

function pool()
{
  var arr = ['Chlorine(Residual)', 'pH  @ 25 ºC', 'Alkalinity'];
    $('select#p_param').val(arr);
    $("#pchembtn span").text("Pool");
    document.getElementById("pchembtn").style.background='#80ffaa';
}
//pchem end

//waste
function waste()
{
  var arr = ['pH  @ 25 ºC', 'Color(Waste)', 'COD', 'BOD', 'Oil & Grease', 'Total Suspended Solids'];
    $('select#w_param').val(arr);
    $("#wastebtn span").text("6 PARAMS");
    document.getElementById("wastebtn").style.background='#80ffaa';
}

function cpip()
{
  var arr = ['pH  @ 25 ºC', 'BOD', 'Oil & Grease', 'Surfactants(MBAS as LAS, MW = 348.48 g/mole)',
             'Phosphate as PO4-P', 'Ammonia as NH3-N', 'Nitrate(as NO3-Nitrogen)'];
    $('select#w_param').val(arr);
    $("#wastebtn span").text("CPIP (Companies)");
    document.getElementById("wastebtn").style.background='#80ffaa';
}

function span()
{
  var arr = ['pH  @ 25 ºC', 'Color(Waste)', 'COD', 'BOD', 'Oil & Grease', 'Total Suspended Solids',
             'Surfactants(MBAS as LAS, MW = 348.48 g/mole)', 'Phosphate as PO4-P', 'Ammonia as NH3-N', 'Nitrate(as NO3-Nitrogen)'];
    $('select#w_param').val(arr);
    $("#wastebtn span").text("with SPAN");
    document.getElementById("wastebtn").style.background='#80ffaa';
}

function industry()
{
  var arr = ['pH  @ 25 ºC', 'BOD', 'Oil & Grease', 'Surfactants(MBAS as LAS, MW = 348.48 g/mole)',
             'Phosphate as PO4-P', 'Ammonia as NH3-N', 'Nitrate(as NO3-Nitrogen)'];
    $('select#w_param').val(arr);
    $("#wastebtn span").text("Industrial");
    document.getElementById("wastebtn").style.background='#80ffaa';
}
//waste end



function clearSelected(){
    var elements = document.getElementById("p_param").options;
  
    for(var i = 0; i < elements.length; i++){
      if(elements[i].selected)
        elements[i].selected = false;
        resetAll();
        }
  }

function clearSelected_w(){
  var elements = document.getElementById("w_param").options;

  for(var i = 0; i < elements.length; i++){
    if(elements[i].selected)
      elements[i].selected = false;
      resetAll();
      }
}


function resetAll(){
        $("#pchembtn span").text("PCHEM");
        document.getElementById("pchembtn").style.background='#ebebe0';
        $("#wastebtn span").text("WASTE");
        document.getElementById("wastebtn").style.background='#ebebe0';
}

function resetpchem(){
        $("#pchembtn span").text("PCHEM");
        document.getElementById("pchembtn").style.background='#ebebe0';
}
function resetwaste(){
        $("#wastebtn span").text("WASTE");
        document.getElementById("wastebtn").style.background='#ebebe0';
}


      $(function() {
        $('#p_param').on('focus', function() {
              document.getElementById("pchembtn").style.background='#ebebe0';
              $("#pchembtn span").text("PCHEM");
         });
       })


      $(function() {
        $('#w_param').on('focus', function() {
              document.getElementById("wastebtn").style.background='#ebebe0';
              $("#wastebtn span").text("WASTE");
         });
       })