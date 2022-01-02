<!-- Content Wrapper. Contains page content -->
<style type="text/css">
.pt-10{
    padding-top: 10px;
}
.pb-10{
    padding-bottom: 10px;
}
.inner-div{
	background-color: white;
	box-shadow: 1px 1px 3px 0px #ccc;
	padding: 8px 15px;
	border-radius: 7.5px;
	transition: all 500ms ease 0s;
	margin: 5px;
}
.inner-div:hover{
	transform: scale(1.1,1.1);
}
.pt-50{
	padding-top: 50px;
}
.inner-div p{
	color: #c5c5c5;
}
.inner-div h4{
	color: #717175;
	font-weight: 600;
	font-size: 20px;
}
.text-d p{
	font-size: 16px;
	padding: 10px;
	color: #262b36;
	font-weight: bold;
}
.pt-15{
	padding-top: 15px;
}
.sec-right-video{
	background-color: white;
	padding: 30px 20px;
	box-shadow: 1px 1px 3px 0px #ccc;
	border-right: 10px;
}
.box.latestNews {
    border-radius: 7px;
    border: none;
}
.refer{
	background-color: #898fff;
	padding: 6px;
}
.refer p{
	color: white;
	font-size: 20px;
}
.refers{
	margin-top: 10px;
	border:1px dashed #ccc;
}
.refers .panel-body{
    padding: 50px 0px 122px 0px;
}
.sub_heading{
	font-size: 25px;
	padding-bottom: 15px;
}
.form-group .copytarget{
	padding: 10px 10px;
	background-color: white;
	box-shadow: 1px 1px 3px 0px #ccc;
}
.btn-cls-learn{
	padding-top: 15px;
}
.amount_detail{
	padding: 20px;
	margin-top: 20px;
	background-color: white;
	box-shadow: 1px 1px 3px 0px #ccc;

}


.panel-green .panel-heading {
    background-color: #5cb85c;
    border-color: #5cb85c;
    color: #fff;
}
.home-page .fast-view-panel {
    height: 130px;
}
.panel-yellow .panel-heading {
    background-color: #f0ad4e;
    border-color: #f0ad4e;
    color: #fff;
}
.panel-red .panel-heading {
    background-color: #d9534f;
    border-color: #d9534f;
    color: #fff;
}

</style>
<script src="<?php echo base_url();?>backend_assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>backend_assets/highcharts/data.js"></script>
<script src="<?php echo base_url();?>backend_assets/highcharts/drilldown.js"></script>
<div class="content-wrapper" style="background-color: #fff8f1;" >
  <section class="top_sec pt-50 p10">
    <div class="row">
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-clock-o fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <div style="font-size: 16px;"><?= date('d.m.Y'); ?></div>
                                <div style="font-size: 16px;"><?= date('H:i:s'); ?></div>
                            </div>
                            <div>Last login</div>
                        </div>
                    </div>
                </div>
                <a>
                    <div class="panel-footer">
                        <span class="pull-left">Last login Details</span>
                        <span class="pull-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>

                <!-- <a href="<?= base_url('admin/adminusers') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a> -->
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="col-xs-3">
                            
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="huge"><?php echo $pd =  $this->Common_model->getRecordCount('orders',array('status'=>1,'delivery_status'=>5));?></div>
                            <div>Cancel Orders</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/cancelorders') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="col-xs-3">
                            
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="huge"><?php echo $pd =  $this->Common_model->getRecordCount('orders',array('status'=>1,'delivery_status'=>1));?></div>
                            <div>New Orders</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/neworders') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="col-xs-3">
                            
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="huge"><?php echo $pd =  $this->Common_model->getRecordCount('orders',array('status'=>1));?></div>
                            <div>Total Orders</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/orderhistory') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $pd =  $this->Common_model->getRecordCount('orders',array('status'=>1,'delivery_status'=>4));?></div>
                            <div>Pending Product</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/productlist?status=0') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart - Orders By Month</h3>
                </div>
                <div class="panel-body">
                    <div id="container-by-month" style="min-width: 310px; height: 400px; margin: 0 auto;">

                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->

<script>
    
    /*
     * Chart for orders by mount/year 
     */
    $(function () {
    Highcharts.chart('container-by-month', {
    title: {
    text: 'Monthly Orders',
            x: - 20
    },
            subtitle: {
            text: 'Source: Orders table',
                    x: - 20
            },
            xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
            title: {
            text: 'Orders'
            },
                    plotLines: [{
                    value: 0,
                            width: 1,
                            color: '#808080'
                    }]
            },
            tooltip: {
            valueSuffix: ' Orders'
            },
            legend: {
            layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
            },
            series: [
<?php foreach ($ordersByMonth['years'] as $year) { ?>
                {
                name: '<?= $year ?>',
                        data: [<?= implode(',', $ordersByMonth['orders'][$year]) ?>]
                },
<?php } ?>
            ]
    });
    });
</script>
