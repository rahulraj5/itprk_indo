<style type="text/css">
	.btn-default.active{
		color: #fff !important;
		background-color: #005551 !important;
	}
</style>
<ul class="nav nav-tabs">
  <li><a href="<?php echo base_url();?>shop/profile" class="btn btn-default btn-flat margin <?php echo (checkTabActive(array("profile"))) ? "active" : ""; ?>"><i class="fa fa-user"></i> Edit Profile</a></li>
  <li><a href="<?php echo base_url();?>shop/changePassword" class="btn btn-default btn-flat margin <?php echo (checkTabActive(array("changePassword"))) ? "active" : ""; ?>"><i class="fa fa-sitemap"></i> Change Password</a></li>
   <li><a href="<?php echo base_url();?>shop/coupon" class="btn btn-default btn-flat margin <?php echo (checkTabActive(array("coupon"))) ? "active" : ""; ?>"><i class="fa fa-gift"></i> Coupon</a></li>
</ul>