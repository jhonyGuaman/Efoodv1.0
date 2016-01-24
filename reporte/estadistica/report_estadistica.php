<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="plugins/chartjs/Chart.js-master/Chart.js"> </script>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>

    <title></title>
  </head>
  <body>
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Reporte de productos mas vendidos
          <div class="pull-right box-tools">
            <div class="form-group">
              <div class="input-group">
                <button class="btn btn-default pull-right" id="daterange-btn">
                  <i class="fa fa-calendar"></i> <span>Seleccione</span>
                  <i class="fa fa-caret-down"></i>
                </button>
              </div>
            </div>
          </div><!-- /. tools -->
        </h1>
      </div>
    </div><!-- /.row -->

    <canvas id="migrafico" width="400" height="400"></canvas>
    <script>
    $(function () {
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 Días': [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 Días': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
    function (start, end) {
      $('#daterange-btn span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
    }
    );
  });
    $(document).ready(function(){
      var ctx= $("#migrafico").get(0).getContext("2d");
      $.ajax({
        type:"POST",
        dataType:"json",
        url:'reporte/estadistica/datos.php',
        success:function(response){
          alert(response.sizes);
          var caldos=response.cantidad[1];
          var pla=response.platos[1];
          alert(caldos );
    var data = [
      {
          value: 3,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "casa"
      }

  ]
          var myBarChart = new Chart(ctx).Pie(data);

        }
      });
  });

    </script>

  </body>
</html>
