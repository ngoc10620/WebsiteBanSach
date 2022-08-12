<?php
include '../template/connection.php';
$title = 'Doanh thu';
include '../template/tpl_header.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.0.0/buttons.bootstrap4.min.css" integrity="sha512-hzvGZ3Tzqtdzskup1j2g/yc+vOTahFsuXp6X6E7xEel55qInqFQ6RzR+OzUc5SQ9UjdARmEP0g2LDcXA5x6jVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.5/responsive.bootstrap4.min.css" integrity="sha512-Yy2EzOvLO8+Vs9hwepJPuaRWpwWZ/pamfO4lqi6t9gyQ9DhQ1k3cBRa+UERT/dPzIN/RHZAkraw6Azs4pI0jNg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?php echo $title; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="../index.php">Thống kê</a></li>
						<li class="breadcrumb-item active"><?php echo $title; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
            <!-- Bar chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Biểu đồ doanh thu
                </h3>
              </div>
              <div class="card-body">
              <form id="selectyear">
                <label for="year">Năm</label>
                <select name="year" id="year" onchange="drawGraph();">
                  <option value="2022">2022</option>
                  <option value="2021">2021</option>
                </select>
              </form>
                <div id="bar-chart" style="height: 300px;"></div>
                <div class="revenue" style="margin-top:20px;">
                  <h5 id="totalYear"></h4>
                  <h5 id="totalMonth"></h4>
                  <div class="listorder" style="margin-top:20px;">
                  <h4 id="List" style="display:none;"></h4>
                    <table class="table table-bordered table-striped projects" id="TableDonHang" width="100%" style="display:none;">
                      <thead>
                        <tr>
                          <th>STT</th>
                          <th>Mã đơn hàng</th>
                          <th>Ngày lập hóa đơn</th>
                          <th>Tổng tiền</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr style="display:none;"></tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>STT</th>
                          <th>Mã đơn hàng</th>
                          <th>Ngày lập hóa đơn</th>
                          <th>Tổng tiền</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card-body-->
		</div>
	</section>
</div>
  <!-- FLOT CHARTS -->
  <script src="../../plugins/flot/jquery.flot.js"></script>
  <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
  <script src="../../plugins/flot/plugins/jquery.flot.resize.js"></script>
  <script src="../../js/jquery.mousewheel.js"></script>
  <!-- Datatables -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-responsive/2.2.7/dataTables.responsive.min.js" integrity="sha512-4ecidd7I1XWwmLVzfLUN0sA0t2It86ti4qwPAzXW7B0/yIScpiOj7uyvFgu/ieGTEFjO5Ho98RZIqt75+ZZhdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.2.7/responsive.bootstrap4.min.js" integrity="sha512-OiHNq9acGP68tNJIr1ctDsYv7c2kuEVo2XmB78fh4I+3Wi0gFtZl4lOi9XIGn1f1SHGcXGhn/3VHVXm7CYBFNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Datatable Button -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.0.0/js/dataTables.buttons.min.js" integrity="sha512-PvgN2o+U/CTkCfOHqtSjTECpgUSY5kZm+VoMF4LN0M2QL8U9qGMrD+YGtpwyKUvhZ6jWNkk5Ldvtd4nucAtkow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.0.0/buttons.bootstrap4.min.js" integrity="sha512-AijsNe5rDJjziesLO1SWgD0hmRWkETKzOCfEOoqt4l6Rpwfi1JC1WxLDV7eeSniCpRRPup2l+UnruRCA12ChVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js" integrity="sha512-xQBQYt9UcgblF6aCMrwU1NkVA7HCXaSN2oq0so80KO+y68M+n64FOcqgav4igHe6D5ObBLIf68DWv+gfBowczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js" integrity="sha512-Yf733gmgLgGUo+VfWq4r5HAEaxftvuTes86bKvwTpqOY3oH0hHKtX/9FfKYUcpaxeBJxeXvcN4EY3J6fnmc9cA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.min.js" integrity="sha512-BDZ+kFMtxV2ljEa7OWUu0wuay/PAsJ2yeRsBegaSgdUhqIno33xmD9v3m+a2M3Bdn5xbtJtsJ9sSULmNBjCgYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.0.0/js/buttons.print.min.js" integrity="sha512-UthH9WkvNUixebk8yKEFm3Sy+Rm8GbuvxiIMCDs9Cepl+YxhY+LUijPFZshcW7+PHa/HcSFLfSX3fGq1AcglWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.0.0/js/buttons.html5.min.js" integrity="sha512-33SxAOPhjjpLMmMGKqLwH2QNDmdxf038OFOq+fOI8p8ghCiOvfv3Bs2wqoj50USQkWBLpvy7+CzT5AHTZWGoNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <!-- Datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/vi.min.js" integrity="sha512-LvYVj/X6QpABcaqJBqgfOkSjuXv81bLz+rpz0BQoEbamtLkUF2xhPNwtI/xrokAuaNEQAMMA1/YhbeykYzNKWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function drawGraph(){
    $.ajax({
      url : 'data_doanhthu.php',
      type : 'POST',
      dataType : 'json',
      data: {year: $('#year').val()},
      success : function(data){
        const month = [1,2,3,4,5,6,7,8,9,10,11,12];
        let listMonth = [];
        month.forEach((e) => {
          listMonth.push({month:e, total: 0})
        })
        if(data.length != 0){
          data.forEach((e) => {
            listMonth.find((m) => m.month == e.month).total = e.total;
          })
        }
        var bar_data = {
          data : [[1,listMonth[0].total], [2,listMonth[1].total], [3,listMonth[2].total], [4,listMonth[3].total], [5,listMonth[4].total], [6,listMonth[5].total],[7,listMonth[6].total],[8,listMonth[7].total],[9,listMonth[8].total],[10,listMonth[9].total],[11,listMonth[10].total],[12,listMonth[11].total]],
          // bars: { show: true }
        };
        $.plot('#bar-chart', [bar_data], {
          grid  : {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor  : '#f3f3f3',
            hoverable: true,
            clickable: true
          },
          series: {
            bars: {
              show: true,  align: 'center',
            }
          },
          colors: ['#3c8dbc'],
          xaxis : {
            ticks: [[1,'1'], [2,'2'], [3,'3'], [4,'4'], [5,'5'], [6,'6'],[7,'7'],[8,'8'],[9,'9'],[10,'10'],[11,'11'],[12,'12']]
          }
        });
        $('.listorder').css("display","none");
        $('#totalMonth').html('');
        $("#bar-chart").bind("plotclick", function (event, pos, item) {
              if (item) {
                // alert("clicked");
                $('.listorder').css("display","");
                $('tbody').html('<tr style="display:none;"></tr>');
                getOrder(item.dataIndex);
              }
            });
          var total = 0;
        listMonth.forEach(function(item){
          total += Number(item.total);
        });
        total_year = String(total).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        $('#totalYear').html('Tổng doanh thu theo năm ' + $('#year').val() + ': <span style="color:red;font-weight:bold;">' + total_year +' đ</span>');
        
      }
    });
  };
  function getOrder(index){
    var month = index+1;
    $.ajax({
      url : 'getMonth.php',
      type : 'POST',
      dataType : 'json',
      data: {year: $('#year').val(),
              month: month},
      success : function(data){
        var stt =[];
        var id=[];
        var date=[];
        var total=[];
        var totalMonth = 0;
        for(var i in data){
          totalMonth += Number(data[i].total);
        }
        total_month = String(totalMonth).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
				$('#totalMonth').html('Tổng doanh thu tháng ' + month + ': <span style="color:red;font-weight:bold;">' + total_month +' đ</span>');
        $("#TableDonHang").css("display", "");
        $("#List").css("display", "");
        $("#List").html("Danh sách hóa đơn tháng " + month +"/" + $('#year').val());
        // $("table tbody").find('tr').each(function(){
        //             $(this).remove();
        //     });
        $.each (data, function (key, item){
          orderPrice = String(item['total']).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
          $('tbody tr:last').after('<tr><td>'+item['stt']+'</td><td><a href="../quanly/DHdetail.php?MaDH='+item['id']+'">'+item['id']+'</a></td><td id="date">'+item['date']+'</td><td>'+orderPrice+'đ</td></tr>');
        });
      }
    });
  };
	$(function(){
    $( "select" ).change(drawGraph());
	});

  
</script>
<?php include '../template/tpl_footer.php';?>