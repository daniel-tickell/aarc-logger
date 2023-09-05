$(document).ready(function(){
  $.ajax({
    url: "stats/grid.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var grid = [];
      var contacts = [];

      for(var i in data) {
        grid.push(data[i].grid);
        contacts.push(data[i].contacts);
      }

      var chartdata = {
        labels: grid,
        datasets : [
          {
            label: 'Grid Contacts',
            backgroundColor: 'rgba(42, 153, 23, 0.75)',
            borderColor: 'rgba(42, 153, 23, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: contacts
          }
        ]
      };

      var ctx = $("#grid");

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
