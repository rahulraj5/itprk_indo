<style type="text/css">
  .fa-toggle-on{
    color: #00a65a;
    font-size: 24px;
  }
  .fa-toggle-off{
    font-size: 24px;
  }
</style>
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
                        <div class="col-md-12" style="margin-bottom: 16px;">
                            <div class="col-md-12">
                                <a href="<?php echo base_url().'shop/addproduct'?>" class="btn btn-success pull-right" >Add Product</a>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="examples1" class="table table-striped table-condensed table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 20px;">S.NO</th>
                            <td>Product Code</td>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Unit Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>

                            <th>Fetured</th>
                            <th>Published</th>
                            <th>Stock Clearance</th>
                            <th>Total sales</th>
                            <th>Date</th><th class="disabled-sorting">Actions</th>
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
                                        <td><?php  echo (!empty($value['main_image'])?'<img src='.base_url().'uploads/product_images/'.$value['main_image'].' style="width:50px;height:50px">':'none'); ?></td>
                                        <td><?php echo $value['unit_price']; ?></td>
                                        <td><?php echo $value['discount'] ."". (isset($value['discount_type']) && $value['discount_type'] == 1 ? '%' : ''); ?></td>
                                        <td><?php echo $value['quantity']; ?></td>
                                        <td>
                                          <?php if($value['featured_status'] == 1) { ?>
                                              <i class="fa fa-toggle-on"></i>
                                          <?php  } ?>
                                          <?php if($value['featured_status'] == 0) { ?>
                                              <i class="fa fa-toggle-off"></i>
                                          <?php } ?>
                                        </td>
                                        <td>
                                          <?php if($value['status'] == 1) { ?>
                                              <i class="fa fa-toggle-on"></i>
                                          <?php  } ?>
                                          <?php if($value['status'] == 0) { ?>
                                              <i class="fa fa-toggle-off"></i>
                                          <?php } ?>
                                        </td>
                                        <td>
                                          <?php if($value['clearance_status'] == 1) { ?>
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="remove_clearance_status" href-status="0" ><i class="fa fa-toggle-on"></i></a>
                                          <?php  } ?>
                                          <?php if($value['clearance_status'] == 0) { ?>
                                              <a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>" class="clearance_status" href-status="1" ><i class="fa fa-toggle-off"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td><?php echo $value['num_of_sale']?></td>
                                        <td><?php echo $value['create_date']?></td>
                                        <!--<td>-->
                                        <!--    <div class="dropdown">-->
                                        <!--      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Select Action-->
                                        <!--      <span class="caret"></span></button>-->
                                        <!--      <ul class="dropdown-menu">-->
                                        <!--        <li><a href="<?php echo base_url().'shop/addproduct/'.$value['product_id']?>"  >Edit</a>-->
                                        <!--        </li>-->
                                        <!--        <li><a href="javascript:void(0)" href-id="<?php echo $value['product_id']?>"  class="delete" >Delete</a>-->
                                        <!--        </li>-->
                                        <!--      </ul>-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        <td>
                                          <!--<a href="<?php echo base_url() ?>admin/shopdetail/<?php echo  $value['product_id']; ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i></a>-->
                                          <!--&nbsp;-->
                                          <a href="<?php echo base_url().'shop/addproduct/'.$value['product_id']?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                          &nbsp;
                                          <?php if($value['status']==0){?>
                                            <a href="javascript:void(0)" href-data="<?php echo  $value['product_id']; ?>" class="productactive" title="Change status"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                                          &nbsp;    
                                          <?php } if($value['status']==1){?>
                                            <a href="javascript:void(0)" href-data="<?php echo  $value['product_id']; ?>" class="deactive" title="Change status"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                                          &nbsp;
                                          <?php }?>
                                            <a href="javascript:void(0)" href-data="<?php echo $value['product_id']?>" class="delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
//   $(".delete").click(function(e){
//     var val = confirm("Sure you want to Delete Product ?");
//     var id = $(this).attr("href-id");
//     if(val){
//       $.ajax({
//         type: "POST",
//         url: "<?php echo base_url();?>shop/change_status",
//         data:{tablename:'product',id:id,status:3,whrcol:'product_id',whrstatuscol:'status',action:"Delete"},
//         dataType:'json',
//         success: function(response) {
//           if (response.status == 1){
//             $.notify(response.msg, "success");
//             setTimeout(function(){location.reload()},1000);
//           }else{
//             $.notify(response.msg, "error");
//           }
//         }
//       });
//     }
//   });

  $(".clearance_status").click(function(e){
        var val = confirm("Sure you want to Add In Stock clearacne ?");
        var id = $(this).attr("href-id");
        if(val){
          $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>shop/change_status",
            data:{tablename:'product',id:id,status:1,whrcol:'product_id',whrstatuscol:'clearance_status',action:"Stock clearacne"},
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

  $(".remove_clearance_status").click(function(e){
        var val = confirm("Sure you want to Remove From Stock clearacne ?");
        var id = $(this).attr("href-id");
        if(val){
          $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>shop/change_status",
            data:{tablename:'product',id:id,status:0,whrcol:'product_id',whrstatuscol:'clearance_status',action:"Stock clearacne"},
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

  $(function () {

    $('#examples1').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": true,

      "ordering": true,

      "info": true,

      "autoWidth": false

    });
  });
  $(".delete").click(function(e){
    var val = confirm("Sure you want to Delete Product ?");
    var id = $(this).attr("href-data");
    if(val){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>shop/change_status",
        data:{tablename:'product',id:id,status:3,whrcol:'product_id',whrstatuscol:'status',action:"Delete"},
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
  $(".deactive").click(function(e){
        var val = confirm("Sure you want to Deaactive Product ?");
        //e.preventDefault(); 
        var id = $(this).attr("href-data");
        //alert(href);
        //var btn = this;
        if(val){
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>shop/change_status",
              data:{tablename:'product',id:id,status:0,whrcol:'product_id',whrstatuscol:'status',action:"Deactive"},
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
  $(".productactive").click(function(e){
    var val = confirm("Sure you want to active Product ?");
    var id = $(this).attr("href-data");
    if(val){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>shop/change_status",
        data:{tablename:'product',id:id,status:1,whrcol:'product_id',whrstatuscol:'status',action:"Active"},
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
            url: "<?php echo base_url();?>shop/change_status",
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
            url: "<?php echo base_url();?>shop/change_status",
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

</script>