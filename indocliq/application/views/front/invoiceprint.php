<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo getWebOptionValue('site_title');?> | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>backend_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>backend_assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>backend_assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>backend_assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Invoice
          <small><?php echo (isset($orderdata) ? $orderdata['invoice_no']: ''); ?></small>
        </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="<?php echo base_url()?>shop"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url()?>shop/orderhistory">Orderhistory</a></li>
          <li class="active">Invoice</li>
        </ol> -->
      </section>
      <?php 
        $shop_data = $this->Common_model->getSingleRecordById('shops',array('shop_id' => $orderdata['seller_id']));

        $shippingifo = json_decode($orderdata['shipping_address'],true);
      ?>
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> <?php echo getWebOptionValue('site_title');?>
              <small class="pull-right">Date: <?php echo dateformatedmy($orderdata['create_date']); ?></small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong><?php echo $shop_data['shop_name'];?></strong><br>
              <?php echo $shop_data['shop_address'];?><br>
              Phone: <?php echo base64_decode($shop_data['mobile_no']); ?><br>
              Email: <?php echo $shop_data['email']; ?>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            To
            <address>
              <strong><?php echo $shippingifo['name']; ?></strong><br>
              <?php echo $shippingifo['address']; ?><br>
              <?php echo $shippingifo['postal_code']; ?><br>
              Phone: <?php echo $shippingifo['phone']; ?><br>
              Email: <?php echo $shippingifo['email']; ?>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice NO. <?php echo (isset($orderdata) ? $orderdata['invoice_no']: ''); ?></b><br>
            <br>
            <b>Payment status:</b> <?php echo $orderdata['payment_status']; ?><br>
            <b>Deliery status:</b> <?php echo $orderdata['delivery_status_name']; ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>S.NO</th>
                <th class="product-name">Product</th>
                <th class="product-name">Variations</th>
                <th class="product-price d-lg-table-cell">MRP </th>
                <th class="product-price d-lg-table-cell">Discount</th>
                <th class="product-price d-lg-table-cell">Price</th>
                <th class="product-quanity d-md-table-cell">QTY</th>
                <th class="product-total">Total</th>
                <th class="product-remove"></th>
              </tr>
              </thead>
              <tbody>
              <?php 
                $spdata = json_decode($orderdata['prduct_details'],true);
                $subtotal = array();
                $s = 1;
              ?>
                <?php if(isset($spdata) && !empty($spdata)){ 
                        $pi = 0;
                ?>
                <?php foreach($spdata as $key=>$spdataarray){ 
                    $product= $this->Common_model->getSingleRecordById("product",array('product_id'=>$spdataarray['id']));
                    $product_variation = json_decode($spdataarray['variations'],true);
                    // print_r($product_variation);
                ?>
                    <tr class="cart-item">
                        <td class="product-image">
                          <?php echo $s; ?>
                        </td>

                        <td class="product-name">
                            <span class="pr-4 d-block"><?php echo $spdataarray['name']; ?></span>
                        </td>

                        <td class="product-name">
                          <?php if(isset($spdataarray['color']) && !empty($spdataarray['color'])){?>
                                <p><span class="pr-4 d-block"></span> <span><?php echo " COLOR : ".getcolornamebyid($spdataarray['color']); ?></span></p>
                          <?php }?>
                          <?php if(isset($product_variation) && !empty($product_variation)){ 
                                  foreach($product_variation as $kv=>$product_variation_array){
                                    foreach($product_variation_array as $kv2=>$product_variation_array2)
                            ?>
                              <p><span class="pr-4 d-block"></span> <span><?php echo $kv2 ." : ".$product_variation_array2; ?></span></p>
                            <?php } } ?>
                        </td>

                        <td class="product-price d-lg-table-cell">
                            <span class="pr-3 d-block"><?php echo $spdataarray['mrp_price']; ?></span>
                        </td>
                        <td class="product-price d-lg-table-cell">
                            <span class="pr-3 d-block"><?php echo $spdataarray['discount'] . (isset($spdataarray['discount_type']) && $spdataarray['discount_type'] == 1 ? '%' :'' ); ?></span>
                        </td>
                        <td class="product-price d-lg-table-cell">
                            <span class="pr-3 d-block"><?php echo $spdataarray['price']; ?></span>
                        </td>
                        <td class="product-quantity  d-md-table-cell"><span class="pr-3 d-block"><?php echo $spdataarray['quantity']?></span>
                        </td>
                        <td class="product-total">
                            <span><?php echo $spdataarray['subtotal_price'];?></span>
                        </td>
                        <td class="product-remove">
                            <a href="#" onclick="removeFromCartView(event,<?php echo $key; ?>" class="text-right pl-4">
                                <i class="la la-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php $subtotal[] = $spdataarray['subtotal_price'];
                      $discount_amount[] = $spdataarray['discount_amount'];
                      $s++; 
                } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead">Payment Methods: <b><?php echo $orderdata['payment_type']; ?></b></p>
          </div>
          <!-- /.col -->
          <div class="col-xs-6">
            <!-- <p class="lead">Amount Due 2/22/2014</p> -->

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td><?php echo CURRENCY ." ".array_sum($subtotal); ?></td>
                </tr>
                
                <tr>
                  <th>Coupon Discount</th>
                  <td><?php echo CURRENCY ." ".$orderdata['coupon_discount']; ?></td>
                </tr>
                <tr>
                  <th>Shipping Charge</th>
                  <td><?php echo CURRENCY ." ".$orderdata['shipping_charge']; ?></td> 
                </tr>
                <tr>
                  <th>Total:</th>
                  <td><?php echo CURRENCY ." ".$orderdata['grand_total']; ?></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-xs-12">
            <a href="javascript:void(0)" target="_blank" class="btn btn-default printinvoice"><i class="fa fa-print"></i> Print</a>
          </div>
        </div>
      </section>
      <!-- /.content -->
      <div class="clearfix"></div>
  </div>
</body>
</html>
<!-- <script type="text/javascript">
  $('a.printinvoice').click(function(){
             window.print();
             return false;
  });
</script> -->