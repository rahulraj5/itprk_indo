
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- /.box -->
        <?php $msg = "status changed"?>
        <div class="box">
          <div class="box-body">
            <div class="table-responsive">
              <h3 class="box-title" style="padding-bottom: 10px;"><i class="fa fa-question-circle"></i> All Products</h3>
                <div class="row">
                    <form >
                        <!-- <div class="col-md-12" style="margin-bottom: 16px;">
                            <div class="col-md-12">
                                <a href="<?php echo base_url().'shop/addproduct'?>" class="btn btn-success pull-right" >Add Product</a>
                            </div>
                        </div> -->
                    </form>
                </div>
                <table id="examples1" class="table table-striped table-condensed table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 20px;">S.NO</th>
                            <td>Product Id</td>
                            <th>Title</th>
                            <th>Unit Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>
                            <th>Fetured</th>
                            <th>Published</th>
                            <th>Best Seller</th>
                            <th>Total sales</th>
                            <th>Date</th>
                            <th class="disabled-sorting">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            foreach ($rows as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $value['product_reg_id']; ?></td>
                                        <td><a ><?php echo $value['name']; ?></a></td>
                                        <td><?php echo $value['unit_price']; ?></td>
                                        <td><?php echo $value['discount'] ."". (isset($value['discount_type']) && $value['discount_type'] == 1 ? '%' : ''); ?></td>
                                        <td><?php echo $value['quantity']; ?></td>
                                        <td>
                                          <?php if($value['featured_status'] == 1) { ?>
                                              <!-- <i class="fa fa-toggle-on"></i> -->
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="un_featured_status" href-status="0"><i class="fa fa-toggle-on"></i></a>
                                          <?php  } ?>
                                          <?php if($value['featured_status'] == 0) { ?>
                                              <!-- <i class="fa fa-toggle-off"></i> -->
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="featured_status" href-status="1"><i class="fa fa-toggle-off"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td>
                                          <?php if($value['status'] == 1) { ?>
                                              
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="un_pulish_status" href-status="0" ><i class="fa fa-toggle-on"></i></a>
                                          <?php  } ?>
                                          <?php if($value['status'] == 0) { ?>
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="pulish_status" href-status="0" ><i class="fa fa-toggle-off"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td>
                                          <?php if($value['bestseller_status'] == 1) { ?>
                                              <!-- <i class="fa fa-toggle-on"></i> -->
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="un_bestseller_status" href-status="0"><i class="fa fa-toggle-on"></i></a>
                                          <?php  } ?>
                                          <?php if($value['bestseller_status'] == 0) { ?>
                                              <!-- <i class="fa fa-toggle-off"></i> -->
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="bestseller_status" href-status="1"><i class="fa fa-toggle-off"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td><?php echo $value['num_of_sale']?></td>
                                        <td><?php echo $value['create_date']?></td>
                                        <td>
                                            <div class="dropdown">
                                              <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Select Action
                                              <span class="caret"></span></button>
                                              <ul class="dropdown-menu">
                                                <li><a href="<?php echo base_url().'admin/productdetail/'.$value['product_id']?>"  >View</a>
                                                </li>
                                              </ul>
                                            </div>
                                        </td>
                                    </tr>

                                <?php
                            }

                         ?>
                    </tbody>
                </table>
                <div class="pagination col-sm-12 text-right"><p><?php echo $links;?></p></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
  // $(".delete").click(function(e){
  //   var val = confirm("Sure you want to Delete Product ?");
  //   var id = $(this).attr("href-id");
  //   if(val){
  //     $.ajax({
  //       type: "POST",
  //       url: "<?php echo base_url();?>shop/change_status",
  //       data:{tablename:'product',id:id,status:3,whrcol:'product_id',whrstatuscol:'status',action:"Delete"},
  //       dataType:'json',
  //       success: function(response) {
  //         if (response.status == 1){
  //           $.notify(response.msg, "success");
  //           setTimeout(function(){location.reload()},1000);
  //         }else{
  //           $.notify(response.msg, "error");
  //         }
  //       }
  //     });
  //   }
  // });

  $(".pulish_status").click(function(e){
        var val = confirm("Sure you want to Publised Product ?");
        var id = $(this).attr("href-id");
        if(val){
          $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/change_status",
            data:{tablename:'product',id:id,status:1,whrcol:'product_id',whrstatuscol:'status',action:"Publised"},
            dataType:'json',
            success: function(response) {
              if (response.status == 1){
                $.notify(response.msg, "success");
                setTimeout(function(){location.reload()},1000);
              }else{
                $.notify(response.msg, "error");
              }
            }
          });
        }
  });
  
  $(".un_pulish_status").click(function(e){
      var val = confirm("Sure you want to Un Publised Product ?");
      var id = $(this).attr("href-id");
      if(val){
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>admin/change_status",
          data:{tablename:'product',id:id,status:0,whrcol:'product_id',whrstatuscol:'status',action:"Un Publised"},
          dataType:'json',
          success: function(response) {
            if (response.status == 1){
              $.notify(response.msg, "success");
              setTimeout(function(){location.reload()},1000);
            }else{
              $.notify(response.msg, "error");
            }
          }
        });
      }
  });

  $(".featured_status").click(function(e){
      var val = confirm("Sure you want to Featured Product ?");
      var id = $(this).attr("href-id");
      if(val){
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>admin/change_status",
          data:{tablename:'product',id:id,status:1,whrcol:'product_id',whrstatuscol:'featured_status',action:"Featured"},
          dataType:'json',
          success: function(response) {
            if (response.status == 1){
              $.notify(response.msg, "success");
              setTimeout(function(){location.reload()},1000);
            }else{
              $.notify(response.msg, "error");
            }
          }
        });
      }
  });

  $(".un_featured_status").click(function(e){
      var val = confirm("Sure you want to Un Featured Product ?");
      var id = $(this).attr("href-id");
      if(val){
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>admin/change_status",
          data:{tablename:'product',id:id,status:0,whrcol:'product_id',whrstatuscol:'featured_status',action:"Featured"},
          dataType:'json',
          success: function(response) {
            if (response.status == 1){
              $.notify(response.msg, "success");
              setTimeout(function(){location.reload()},1000);
            }else{
              $.notify(response.msg, "error");
            }
          }
        });
      }
  });

  $(".bestseller_status").click(function(e){
      var val = confirm("Sure you want to Best seller Product ?");
      var id = $(this).attr("href-id");
      if(val){
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>admin/change_status",
          data:{tablename:'product',id:id,status:1,whrcol:'product_id',whrstatuscol:'bestseller_status',action:"Best"},
          dataType:'json',
          success: function(response) {
            if (response.status == 1){
              $.notify(response.msg, "success");
              setTimeout(function(){location.reload()},1000);
            }else{
              $.notify(response.msg, "error");
            }
          }
        });
      }
  });

  $(".un_bestseller_status").click(function(e){
      var val = confirm("Sure you want to Undo Best seller Product ?");
      var id = $(this).attr("href-id");
      if(val){
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>admin/change_status",
          data:{tablename:'product',id:id,status:0,whrcol:'product_id',whrstatuscol:'bestseller_status',action:"Best"},
          dataType:'json',
          success: function(response) {
            if (response.status == 1){
              $.notify(response.msg, "success");
              setTimeout(function(){location.reload()},1000);
            }else{
              $.notify(response.msg, "error");
            }
          }
        });
      }
  });
</script>