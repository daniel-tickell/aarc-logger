$(document).ready(function(){
  $.ajax({
    url: "stats/bands.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var band = [];
      var contacts = [];

      for(var i in data) {
        band.push(data[i].band);
        contacts.push(data[i].contacts);
      }

      var chartdata = {
        labels: band,
        datasets : [
          {
            label: 'Bands',
            data: contacts,
            backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
          }
        ]
      };

      var ctx = $("#bands");

      var barGraph = new Chart(ctx, {
        type: 'pie',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
