<div class="content-wrapper">

  <section class="content-header">

    <h1> <img src="<?php echo base_url().'common_assets/images/shop.png';?>" style="width: 30px"> All Vendors<small></small></h1>

  </section>

  <section class="content">

    <div class="row">

    <div class="col-xs-12">

      <div class="box">

        <div class="box-header col-md-6" style="float: left;">

          <h3 class="box-title"><a href="<?php echo base_url();?>admin/addShop" class="btn btn-primary">Add New Vendor</a></h3>

        </div>

        <?php if($this->session->flashdata('addshop_success')){ 

         echo '<div class="alert alert-success alert-dismissible">

          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button><h4><i class="fa fa-spinner fa-spin"></i>'.$this->session->flashdata('addshop_success').'</h4></div>';

        echo '<meta http-equiv="refresh" content="2;url='.base_url('admin/shoplist').'">';

        } ?> 

        <div class="box-header col-md-6" style="float: right"></div>

        <div class="clearfix"></div>

        <div class="box-body table-responsive">

          <table id="customertable" class="table table-bordered table-hover">

            <thead>

              <tr>

                <th>S.no.</th>

                <th>Shop ID</th>

                <th>shop</th>

                <th>Owner</th>

                <th>Registration Date</th>

                <th>Featured</th>

                <th>Status</th>

                <th>Action</th>                

              </tr>

            </thead>

            <tbody>

              <?php $count = 1; 

                if(!empty($shop_data)){

                  foreach ($shop_data as $getdata) { 

              ?>

              <tr>

                <td><?php echo $count; ?></td>

                <td><?php  echo (!empty($getdata['shop_reg_id'])?$getdata['shop_reg_id']:'none'); ?></td>

                <td><?php  echo (!empty($getdata['shop_name'])?$getdata['shop_name']:'none'); ?></td>

                <td><?php  echo (!empty($getdata['owner_name'])?$getdata['owner_name']:'none'); ?></td>

                <td><?php  echo (!empty($getdata['create_date'])?$getdata['create_date']:'none'); ?></td>

                <td>

                  <?php if($getdata['featured_status'] == 1){ ?>

                      <a href="javascript:void(0)" href-id="<?php echo $getdata['shop_id']?>" class="un_featured_status" href-status="0"><i class="fa fa-toggle-on"></i></a>

                  <?php  } ?>

                  <?php if($getdata['featured_status'] == 0){ ?>

                      <a href="javascript:void(0)" href-id="<?php echo $getdata['shop_id']?>" class="featured_status" href-status="1"><i class="fa fa-toggle-off"></i></a>

                  <?php } ?>

                </td>

                <td><?php if($getdata['status']==0){echo '<button type="button" class="btn btn-warning">Deactive</button>';}

                          if($getdata['status']==1){echo '<button type="button" class="btn btn-success">Active</button>';}

                      ?>

                </td>



                <td>

                  <a href="<?php echo base_url() ?>admin/shopdetail/<?php echo  $getdata['shop_id']; ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i></a>

                  &nbsp;

                  <a href="<?php echo base_url() ?>admin/addShop/<?php echo  $getdata['shop_id']; ?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 

                  &nbsp;

                  <?php if($getdata['status']==0){?>

                    <a href="javascript:void(0)" href-data="<?php echo  $getdata['shop_id']; ?>" class="shopactive" title="Change status"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>

                  &nbsp;    

                  <?php } if($getdata['status']==1){?>

                    <a href="javascript:void(0)" href-data="<?php echo  $getdata['shop_id']; ?>" class="deactive" title="Change status"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>

                  &nbsp;

                  <?php }?>

                    <a href="javascript:void(0)" href-data="<?php echo  $getdata['shop_id']; ?>" class="deleteshop" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                </td>

              </tr>



             <?php $count++; } } ?>  

            </tbody>

          </table>

        </div>

        <!-- /.box-body -->

      </div>

    </div>

    </div>

  </section>

</div>

<script type="text/javascript">

  $(function () {



    $('#customertable').DataTable({



      "paging": true,



      "lengthChange": false,



      "searching": true,



      "ordering": true,



      "info": true,



      "autoWidth": false



    });

  });

  $(".deleteshop").click(function(e){

    var val = confirm("Sure you want to Delete Shop ?");

    var id = $(this).attr("href-data");

    if(val){

      $.ajax({

        type: "POST",

        url: "<?php echo base_url();?>admin/deleteRecord",

        data:{table:'shops',id:id,status:3,colwhr:'shop_id',whrstatuscol:'status',action:"Delete"},

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

        var val = confirm("Sure you want to Deaactive Shop ?");

        //e.preventDefault(); 

        var id = $(this).attr("href-data");

        //alert(href);

        //var btn = this;

        if(val){

            $.ajax({

              type: "POST",

              url: "<?php echo base_url();?>admin/change_status",

              data:{tablename:'shops',id:id,status:0,whrcol:'shop_id',whrstatuscol:'status',action:"Deactive"},

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

  $(".shopactive").click(function(e){

    var val = confirm("Sure you want to active Shop ?");

    var id = $(this).attr("href-data");

    if(val){

      $.ajax({

        type: "POST",

        url: "<?php echo base_url();?>admin/change_status",

        data:{tablename:'shops',id:id,status:1,whrcol:'shop_id',whrstatuscol:'status',action:"Active"},

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

            data:{tablename:'shops',id:id,status:1,whrcol:'shop_id',whrstatuscol:'featured_status',action:"Featured"},

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

        var val = confirm("Sure you want to Un Featured Shop ?");

        var id = $(this).attr("href-id");

        if(val){

          $.ajax({

            type: "POST",

            url: "<?php echo base_url();?>admin/change_status",

            data:{tablename:'shops',id:id,status:0,whrcol:'shop_id',whrstatuscol:'featured_status',action:"Featured"},

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