$(document).ready(function(){
  $.ajax({
    url: "stats/grid_dest.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var dst_grid = [];
      var contacts = [];

      for(var i in data) {
        dst_grid.push(data[i].dst_grid);
        contacts.push(data[i].contacts);
      }

      var chartdata = {
        labels: dst_grid,
        datasets : [
          {
            label: 'Grid Contacts (Destination)',
            backgroundColor: 'rgba(144, 16, 179, 0.75)',
            borderColor: 'rgba(144, 16, 179 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: contacts
          }
        ]
      };

      var ctx = $("#grid_dest");

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
