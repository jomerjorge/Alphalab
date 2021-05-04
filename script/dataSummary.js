
 $.getJSON("/alphalab/api/dataSummary/", function(response){
	$("#dataSummaryTable tbody").html("");
	var html = "";
	testRequestList = response;	
	response.map(function(item)
	{
	   var month = new Array();
		  month[0] = "January";
		  month[1] = "February";
		  month[2] = "March";
		  month[3] = "April";
		  month[4] = "May";
		  month[5] = "June";
		  month[6] = "July";
		  month[7] = "August";
		  month[8] = "September";
		  month[9] = "October";
		  month[10] = "November";
		  month[11] = "December";

		var d = new Date(item.date_rcvd);
		var m = month[d.getMonth(item.date_rcvd)];

		html += "<tr>";
		html += "<td>" + item.company_name + "(" + item.client_name + ")" + "</td>"
		if(m == month[0])
		{
			html += "<td>" + item.micro_count + "</td>"
		}else if(m == month[1])
		{
			html += "<td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[2])
		{
			html += "<td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[3])
		{
			html += "<td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[4])
		{
			html += "<td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[5])
		{
			html += "<td></td><td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[6])
		{
			html += "<td></td><td></td><td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[7])
		{
			html += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[8])
		{
			html += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[9])
		{
			html += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else if(m == month[10])
		{
			html += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}else
		{
			html += "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>" + item.micro_count + "</td>"
		}

		html += "</tr>";
	}
	);
	$("#dataSummaryTable tbody").html(html);
});	
//View -> end