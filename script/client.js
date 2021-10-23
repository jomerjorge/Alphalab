              // CLIENT SCRIPT
$('#addFilter_cd').on('click', function() {
  animateDV_cd();
})

  function animateDV_cd () {
  $('.inner_cd').toggleClass('visible');
  $('.inner_cd').animate({
    width: 'toggle',
  },350);

$("#search").val("");
$("#searchBy_add").val("");
$("#searchBy_rwt").val("");
$("#clientTable tbody").html("");
$("#recFound").html("");
$("#totalrecord").html("");
$("#page").html("");
document.getElementById('navigation_c').style.visibility = 'hidden';

   $('.outer_cd').toggleClass('visible');
  $('.outer_cd').animate({
    width: 'toggle',
  },350);
}


$(document).keyup(function(event) {
    if (event.keyCode === 113) {   // focust on serch 113 = f2
      $("#search").val("");
        $("#search").focus();
    }
});


$("#search, #searchBy_add").keyup(function(event) {   // shortcut for enter when searching
    if (event.keyCode === 13) {         // 13 = enter 
        $("#sClick").click();
    }
});


 function searchClient(){
  $("div.tableFixHead").scrollTop(0); // to return to top when click search
  page = 1;
  document.getElementById('navigation_c').style.visibility = 'visible';
    check_session();
    var descr = $("#search").val();
  var search_add = $("#searchBy_add").val();
    if(descr != "" || search_add != "")
    {
      $.ajax({
        url:"/alphalab/api/clients/search.php",  
        method:"GET",  
        dataType: "json",
        data:{
          description:descr,
          desc_add:search_add
        },
        success:function(data){
        console.log(data);
        if (data.success) {
          var dataArr = data.success.data;
          totalrecord = data.success.totalrecord;
          var html = "";
          datafound = data.success.datafound;
          pagenum = Math.floor((datafound / pagelimit) + 1); // to get the quotient without decimals
          // to select the specific client when viewing View Records Tab
          list = dataArr; 
          for (var i = 0; i < dataArr.length; i++){
            html += "<tr>";
            html += "<td>" + dataArr[i].id_num + "</td>";
            html += "<td>" + dataArr[i].company_name + "</td>";
            html += "<td>" + dataArr[i].client_name + "</td>";
            html += "<td>" + dataArr[i].add_st + " " + dataArr[i].add_city + " " + dataArr[i].add_prov + "</td>";
            html += "<td>" + dataArr[i].contact + "</td>";
            html += "<td>" + dataArr[i].email_add + "</td>";
            html += "<td>" + dataArr[i].business_style + "</td>";
            html += "<td>" + dataArr[i].c_remarks + "</td>";
            html += "<td>" + dataArr[i].ass_fsa + "</td>";
            if (dataArr[i].c_status == 'Inactive')
            {
              html += '<td><label class="label label-danger">' + dataArr[i].c_status + '</label></td>';
            }
            else if (dataArr[i].c_status == 'Per Call')
            {
              html += '<td><label class="label label-warning">' + dataArr[i].c_status + '</label></td>';
            }
            else{
              html += '<td><label class="label label-success">' + dataArr[i].c_status + '</label></td>';
            }
            html += "<td>" + "<button class='btn btn-xs btn-primary' title='Update' onclick='edit(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" 
               + " "
               + "<button class='btn btn-xs btn-primary' title='View Records' onclick='view(" + i + ")'><span class='fa fa-folder-open-o' aria-hidden='true'></span> Rec.</button>" + "</td>";
            html += "</tr>";
           }
          $("#clientTable tbody").html(html);
          console.log(data);
          $("#recFound").html(datafound);
          $("#totalrecord").html(totalrecord);
          $("#page").html(page);
          $("#pagenum").html(pagenum);

        }
         else{
           datafound = 0;  // to reset the paging at 0, :log at f12
           html += "<td colspan='10'>" + "No record(s) found." + "</td>";
           $("#clientTable tbody").html(html);
           $("#totalrecord").html(0);
           $("#recFound").html(0);
           $("#page").html(0);
           $("#pagenum").html(0);
        }
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
      swal("Please fill in the search field");
    document.getElementById('search').focus();
    }
  };



  //page buttons
    page = 1;
    pagelimit = 30;
    datafound = 0;
  
  // to show datas in clients data home
  // fetchData();

  $(".prev-btn").on("click", function(){
    if (page > 1) { 
      page--;
    fetchData();
    $("div.tableFixHead").scrollTop(0);
    }
    console.log("Prev Page: " + page);
  });

  $(".next-btn").on("click", function(){
    if (page * pagelimit < datafound) {
    page++;
    fetchData();
     $("div.tableFixHead").scrollTop(0);
    }
    console.log("Next Page: " + page);
  });
  
  // fetch data
  function fetchData(){
     var descr = $("#search").val();
   var search_add = $("#searchBy_add").val();
    
    $.ajax({
      url:"/alphalab/api/clients/search.php",
      method:"GET",  
      dataType:"json",
      data: {
        page:page,
        pagelimit:pagelimit,
        description:descr,
        desc_add:search_add
       
      },
      success:function(data){
        console.log(data);
        if (data.success) {
          var dataArr = data.success.data;
          totalrecord = data.success.totalrecord;
          var html = "";
          datafound = data.success.datafound;
          pagenum = Math.floor((datafound / pagelimit) + 1); // to get the quotient without decimals
          // to select the specific client when viewing View Records Tab
          list = dataArr; 
          for (var i = 0; i < dataArr.length; i++){
            html += "<tr>";
            html += "<td>" + dataArr[i].id_num + "</td>";
            html += "<td>" + dataArr[i].company_name + "</td>";
            html += "<td>" + dataArr[i].client_name + "</td>";
            html += "<td>" + dataArr[i].add_st + " " + dataArr[i].add_city + " " + dataArr[i].add_prov + "</td>";
            html += "<td>" + dataArr[i].contact + "</td>";
            html += "<td>" + dataArr[i].email_add + "</td>";
            html += "<td>" + dataArr[i].business_style + "</td>";
            html += "<td>" + dataArr[i].c_remarks + "</td>";
            html += "<td>" + dataArr[i].ass_fsa + "</td>";
            if (dataArr[i].c_status == 'Inactive')
            {
              html += '<td><label class="label label-danger">' + dataArr[i].c_status + '</label></td>';
            }
            else if (dataArr[i].c_status == 'Per Call')
            {
              html += '<td><label class="label label-warning">' + dataArr[i].c_status + '</label></td>';
            }
            else{
              html += '<td><label class="label label-success">' + dataArr[i].c_status + '</label></td>';
            }
            html += "<td>" + "<button class='btn btn-xs btn-primary' title='Update' onclick='edit(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" 
               + " "
               + "<button class='btn btn-xs btn-primary' title='View Records' onclick='view(" + i + ")'><span class='fa fa-folder-open-o' aria-hidden='true'></span> Records</button>" + "</td>";
            html += "</tr>";
           }
          $("#clientTable tbody").html(html);
          console.log(data);
          $("#recFound").html(datafound);
          $("#totalrecord").html(totalrecord);
          $("#page").html(page);
          $("#pagenum").html(pagenum);

        }
         else{
           datafound = 0;  // to reset the paging at 0, :log at f12
           html += "<td colspan='7'>" + "No record(s) found." + "</td>";
           $("#clientTable tbody").html(html);
           $("#totalrecord").html(0);
           $("#recFound").html(0);
           $("#page").html(1);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
    });
  }
  //to delete
// });


//SEARCH BY COMPANY END

//SEARCH BY RWT/RWWT
    function searchBy_rwt(){
      check_session();
      var description = $("#searchBy_rwt").val();
      if (description != "") {
      $("#clientTable tbody").html("");
      $.getJSON("/alphalab/api/clients/searchBy_rwt.php?description=" + description, function(response){

      if (response != "") {
        var html = "";
        list = response;
        var i = 0;
        response.map(function(item){
          html += "<tr>";
          html += "<td>" + item.id_num + "</td>";
          html += "<td>" + item.company_name + "</td>";
          html += "<td>" + item.client_name + "</td>";
          html += "<td>" + item.add_st + " " + item.add_city + " " + item.add_prov + "</td>";
          html += "<td>" + item.contact + "</td>";
          html += "<td>" + item.email_add + "</td>";
          html += "<td>" + item.business_style + "</td>";
          html += "<td>" + item.c_remarks + "</td>";
          html += "<td>" + item.ass_fsa + "</td>";
          if (item.c_status == 'Inactive')
          {
            html += '<td><label class="label label-danger">' + item.c_status + '</label></td>';
          }
          else if (item.c_status == 'Per Call')
          {
            html += '<td><label class="label label-warning">' + item.c_status + '</label></td>';
          }
          else{
            html += '<td><label class="label label-success">' + item.c_status + '</label></td>';
          }
          html += "<td>" + "<button class='btn btn-xs btn-primary' title='Update' onclick='edit(" + i + ")'><span class='fa fa-pencil-square-o' aria-hidden='true'></span></button>" 
                 + " "
                 + "<button class='btn btn-xs btn-primary' title='View Records' onclick='view(" + i + ")'><span class='fa fa-folder-open-o' aria-hidden='true'></span> Records</button>" + "</td>";     
          html += "</tr>";
          i++;
        });
        $("#clientTable tbody").html(html);
        console.log(response);
      }

        else{
          var html;
          html += "<td colspan='10>" + "No record found." + "</td>";
                $("#clientTable tbody").html(html);
        }

      });
    }
    else
    {
      swal("Please fill in the search field");
      document.getElementById('searchBy_rwt').focus();
    }
    }
//SEARCH BY RWT/RWWT END

//Add client
    function add_client()
    {
      check_session();
        id = 0;
        clearField();
        document.getElementById('gLCId').style.display = "block";
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $("#clientmodalForm").modal("show"); // show bootstrap modal
        $("span#clientmodalForm").text("NEW CLIENT");// Set Title to Bootstrap modal title
      document.getElementById('clientIdSaveBtn').disabled = false;
      getLastClientId();  
      console.log("Client ID fo Add " + id);  
      document.getElementById('company_name').focus();  
    }

    $("#cForm").submit(function(e){
      e.preventDefault();
      var url = "/alphalab/api/clients/";
      var data = {};
      data["id"] = id;
      data["id_num"] = $('#id_num').val();
      data["company_name"] = $('#company_name').val();
      data["client_name"] = $('#client_name').val();
      data["add_st"] = $('#add_st').val();
      data["add_city"] = $('#add_city').val();
      data["add_prov"] = $('#add_prov').val();
      data["contact"] = $('#contact').val();
      data["email_add"] = $('#email_add').val();
      data["business_style"] = $('#business_style').val();
      data["c_remarks"] = $('#c_remarks').val();
      data["ass_fsa"] = $('#ass_fsa').val();
      data["c_status"] = $('#c_status').val();

        url += (id > 0 ? "update.php" : "new.php");

              $.ajax({
                  type:'POST',
                  url: url,
                  dataType: "json",
                  data:data,
                  success:function(response){                    
                    // to add
                    searchClient();
                    fetchData();
                    $("#clientmodalForm").modal("hide");
                    clearField();
                    getLastClientId();
                    swal("Client", response.message, "success");
                    console.log("page : " + page);
                    },
                  error: function() { 
                      document.getElementById('company_name').style.borderColor = "#ff0000";
                      swal("Data already Exist!").then(function(){
                      document.getElementById('company_name').focus();
              });
                    },
                       
              });
               return false;
      });


    function dsabled_submitBtn(){
      document.getElementById('clientIdSaveBtn').disabled = true;
    }

//Update Client
    function edit(i){
      var item = list[i];
      id = item.id; //client id 
      document.getElementById('id-availability-status').style.display = "none";
      document.getElementById('gLCId').style.display = "none";
      document.getElementById('company_name').style.removeProperty('border');
      document.getElementById('clientIdSaveBtn').disabled = false;
      document.getElementById('c_remarks').focus();  
      $("#id_num").val(item.id_num);
      $("#company_name").val(item.company_name);
      $("#client_name").val(item.client_name);
      $("#add_st").val(item.add_st);
      $("#add_city").val(item.add_city);
      $("#add_prov").val(item.add_prov);
      $("#contact").val(item.contact);
      $("#email_add").val(item.email_add);
      $("#business_style").val(item.business_style);
      $("#c_remarks").val(item.c_remarks);
      $("#ass_fsa").val(item.ass_fsa);
      $("#c_status").val(item.c_status);
      $("#clientmodalForm").modal("show");
      $("span#clientmodalForm").text("UPDATE CLIENT");// Set Title to Bootstrap modal title
      console.log("Client ID fo Edit " + id);
    }
//Update Client end

//clear field
    function clearField(){
      $("#id_num").val("");
      $("#company_name").val("");
      $("#client_name").val("");
      $("#add_st").val("");
      $("#add_city").val("");
      $("#add_prov").val("");
      $("#contact").val("");
      $("#email_add").val("");
      $("#business_style").val("");
      $("#c_remarks").val("");
      $("#ass_fsa").val("");
      $("#c_status").val("");
      document.getElementById("id-availability-status").innerHTML = ""; 
      document.getElementById('company_name').style.removeProperty('border');
    }
//clear field

function getLastClientId(){
  $.ajax({  
        url:"/alphalab/api/clients/getLastClientId.php",  
        method:"GET",  
        dataType: "json",
        success: function(data) {
        console.log(data);
      $("#getLastClientId").html(data);

      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }  
            }); 
  }

    // CLIENT SCRIPT END
