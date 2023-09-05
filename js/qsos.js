$(document).ready(function(){
  $.ajax({
    url: "stats/qsos.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var call_sign = [];
      var contacts = [];

      for(var i in data) {
        call_sign.push(data[i].call_sign);
        contacts.push(data[i].contacts);
      }

      var chartdata = {
        labels: call_sign,
        datasets : [
          {
            label: 'Callsign Contacts',
            backgroundColor: 'rgba(16, 122, 179, 0.75)',
            borderColor: 'rgba(16, 122, 179, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: contacts
          }
        ]
      };

      var ctx = $("#callsign");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
