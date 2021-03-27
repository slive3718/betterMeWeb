
<script type="text/javascript" src="<?= base_url() ?>/assets/js/myProfile.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/myProfile.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
	  integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
		crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="node_modules/font-awesome-animation.min.css">



<main>
	<div id="device-bar-2">
	</div>
	<header>
		<div class="tb">
			
		<div><a style="font-weight: bold" class="btn btn-s btn-success rounded"
        href="<?= base_url().'user/homepage/'?>" >BetterMe</a></div>
			<div class="td" id="search-form">
                <form method="get" action="#">
                <input type="text" placeholder="Better Me Search">
                <button type="submit"><i class="material-icons">search</i></button>
                </form>
            </div> 
			<?php if(isset($user_info) && !empty($user_info)){
			foreach ($user_info as $val){
			//   print($val->getAllProfilePost->post_images->result());exit;
			$id = $this->session->userdata('id');
			$username = $val->username;
			$firstName = $val->first_name;
			$middleName = $val->middle_name;
			$lastName = $val->last_name;
			$email = $val->email;
			$dob = $val->dob;
			$pic_status = $val->user_picture_status;
			$sex = $val->sex;
			}
			}

			?>
			<div class="td" id="f-name-l"><span><a style="font-weight: bold" class="btn btn-s btn-success rounded"
			href="<?= base_url() . 'user/myProfile/' . $id ?>"><?= Ucfirst($firstName) ?></a></span>
			</div>
			<div class="td" id="i-links">
				<div class="tb">
					<div class="td" id="m-td">
						<div class="tb">
							<span class="td"><i class="fa fa-user"></i></span>
							<span class="td"><i class="fa fa-envelope"></i></span>
							<span class="td m-active"><i class="fa fa-bell"></i></span>
						</div>
					</div>
					<div class="td">
						<a href="#" id="p-link">
							<?php if (isset($pic_status)) { ?>
								<img src="<?= base_url() . './uploads/profilepic/profile' . $id ?>.jpg" class=""
									 style="height:35px;width:35px" alt="profile pic">
							<?php } else {
								?>
								<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
									 class="avatar img-circle img-thumbnail" style="height:35px;width:35px"
									 alt="profile pic">
								<?php
							} ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php
	if (isset($followedUsersDatas) && !empty($followedUsersDatas)){
	foreach ($followedUsersDatas as $followDatas) {
		 $followed_content = $followDatas->content;
		$followDatas->first_name;
		$followDatas->last_name;
//		print_r($followDatas->user_id);
		?>
	<div class="m-mrg card Regular shadow" style="width:80%;margin:auto" id="">
	<div>
		<div class="post card Regular shadow">
			<div class="tb">
				<a href="#" class="td p-p-pic">
						<img src="<?=base_url().'./uploads/profilepic/profile'.$followDatas->user_id.'.jpg'?>" class="" style="height:50px;width:50px" alt="profile pic">
				</a>
				<div class="td p-r-hdr">
					<div class="p-u-info">
						<a href="#"><?= $followDatas->first_name,' ',$followDatas->last_name?></a>
						 Shared a post
					</div>
					<div class="p-dt">
						<i class="fa fa-calendar"><?=$followDatas->date?></i>
						<span>Date</span>
					</div>
				</div>
<!--				<div class="dropdown dropleft">-->
<!--					<a class=" btn-m fa fa-cogs" href="#" role="button" id="dropdownMenuLink"-->
<!--					   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--					</a>-->
<!--					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">-->
<!--						<a class="dropdown-item" href="#">Remove</a>-->
<!--						<a class="dropdown-item" href="#">Edit</a>-->
<!--					</div>-->
<!--				</div>-->
			</div>
			<label class="tb " readonly>
				<?=	$followed_content ?>
			</label>
			<div class="d-flex justify-content-center">
				<a href="#" class="">
					<div class="container">
						<?php 	foreach ($followDatas->getImagePerPost as $followedImagePost) {
							?><img src = "<?= base_url() . './uploads/posts/' . $followedImagePost->image_name; ?>" style="width:300px" >
							<?php }?>
					</div>
			</div>
			</a>
			<div>
				<div class="p-acts">
					<div class="p-act like"><i class="fa fa-thumbs-up"></i><span>25</span></div>
					<div class="p-act comment btn-click"><i
								class="fa fa-comment"></i><span>1</span></div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php
	}
	}
	?>
	<div id="device-bar-2"><i class=""></i></div>
</main>
