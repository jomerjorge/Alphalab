    //datepicker format
$(document).ready(function() {
    var dateFormat = "mm/dd/yy",

      From = $( "#From" )
        .datepicker({
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        From.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }
  });
//datepicker format