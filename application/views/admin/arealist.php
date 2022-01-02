
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header"><h1>Area <small>List</small></h1></section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header col-md-6" style="float: left;">
            <h3 class="box-title">
                <a href="<?php echo base_url();?>admin/addarea" class="btn btn-primary pull-right">Add New Area</a>
            </h3>
          </div>
          <div class="box-header" style="float: right">
          </div>
          <div class="clearfix"></div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="categorytable" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>S.no.</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php $count = 1; 
                  if(!empty($area_data)){
                    foreach ($area_data as $getdata) { 
                  ?>
                    <tr>
                      <td><?php echo $count; ?></td><td><?php  echo (!empty($getdata['area_name'])?$getdata['area_name']:'none'); ?></td>
                      <td><?php if($getdata['status']==0){echo "Deactive";}
                                if($getdata['status']==1){echo "Active";}
                          ?>
                      </td>
                      <td>
                        <a href="<?php echo base_url() ?>admin/addarea/<?php echo  $getdata['area_id']; ?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 

                        <?php if($getdata['status'] == 0){ ?>
                          <a href="javascript:void(0)" href-data="<?php echo  $getdata['area_id']; ?>" class="activearea" title="Change status"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                        <?php } if($getdata['status'] == 1){?>
                          <a href="javascript:void(0)" href-data="<?php echo  $getdata['area_id']; ?>" class="deactive" title="Change status"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                        <?php } ?>
                          <a href="javascript:void(0)" href-data="<?php echo  $getdata['area_id']; ?>" class="delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td> 
                    </tr>
                <?php $count++; 
                  }
                }
                ?>  
              </tbody>
            </table>
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
<!-- /.content-wrapper -->
<script type="text/javascript">
  $(function () {

    $('#categorytable').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": true,

      "ordering": true,

      "info": true,

      "autoWidth": false

    });
  });
  $(".delete").click(function(e){
    var val = confirm("Sure you want to Delete Area ?");
    var id = $(this).attr("href-data");
    if(val){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>admin/change_status",
        data:{tablename:'area',id:id,status:3,whrcol:'area_id',whrstatuscol:'status',action:"Delete"},
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
        var val = confirm("Sure you want to Deaactive Area ?");
        //e.preventDefault(); 
        var id = $(this).attr("href-data");
        //alert(href);
        //var btn = this;
        if(val){
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>admin/change_status",
              data:{tablename:'area',id:id,status:0,whrcol:'area_id',whrstatuscol:'status',action:"Deactive"},
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
  $(".activearea").click(function(e){
    var val = confirm("Sure you want to active Area ?");
    var id = $(this).attr("href-data");
    if(val){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>admin/change_status",
        data:{tablename:'area',id:id,status:1,whrcol:'area_id',whrstatuscol:'status',action:"Active"},
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
