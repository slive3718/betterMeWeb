

	<?php if ($this->session->flashdata('msgsuccess')) {
		echo ' <div class="btn success"> ' . $this->session->flashdata('msgsuccess') . ' <div class="btn success"> ';
	} ?>
	<?php if ($this->session->flashdata('msgwarn')) {
		?>
		<div class="btn success"> <?php echo ' <div class="btn btn-warning">' . $this->session->flashdata('msgsuccess');
			echo $this->session->flashdata('msgwarn');
			?>    </div> <?php } ?>
	</div>

<?php $post_type = "DietPlan";
?>
<div class="container-fluid border card shadow"
	 style="width:80%;margin-top:30px;padding-top:20px;padding-bottom: 20px;">
	<div class="row">
		<button style="margin-left:20px" class="btn btn-sm btn-success"
				onclick="document.location='<?= base_url() . 'admin/addDietPlan/' . $post_type ?>'">Add Diet Plan
		</button>
		<div class="col-md-12 table-responsive">
			<table id="myTable" class="table table-bordered table-striped text-center">
				<thead>
				<tr>
					<th scope="col"> Title</th>
					<th scope="col"> Post Content</th>
					<th scope="col"> Date Posted</th>
					<th scope="col"> Image</th>
					<th scope="col" style="border-right: 0px solid #ddd;"> Option</th>
					<th scope="col"style="border-left: 0px solid #ddd; border-right: 0px solid #ddd;"> </th>
				</tr>
				</thead>
				<?php
				if (isset($rows)) {
					foreach ($rows as $row){

				$post_id = $row->post_id;
				$post_title = $row->post_title;
				$post_content = $row->post_content;
				$date_posted = $row->date_posted;
				$routine_count = $row->routine_count;
				$routine_format = $row->routine_format;
				$post_user_id = $row->post_user_id;
				$post_type = $row->post_type;

				$type_of_diet = $row->type_of_diet;
				?>
				<tbody>
				<tr>
					<td class="font-weight-bold"> <?= $post_title ?></td>
					<td><?php if (strlen($post_content) > 50) {
							$firstdesc = substr($post_content, 0, 150);
							echo $firstdesc . '<a href="' . base_url('admin/viewFullDiet/' . $post_id) . '">...see more </a>';
						} else {
							echo $post_content;
						} ?>
					</td>
					<td><?= $date_posted ?></td>
					<td>

						<?php foreach ($row->images as $images) {
							?>
							<img class="" src="<?= base_url() . 'uploads/posts/' . $images->image_name ?>"
								 alt="Card image cap" style="width:40px;height:40px">
						<?php } ?>
					</td>
					<td><a href="<?= base_url() . 'admin/edit_Diet/' . $post_id ?>"
						   class="btn  btn-sm btn-primary"><span class="fa fa-edit"></span>Edit</a></td>
					<td>
						<button data-sessions-id="<?=$post_id?>" class="archive btn btn-danger btn-sm" id="archive"><span class="fa fa-trash-o"></span>Delete
						</button>
					</td>
				</tr>
				<?php }
				} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script>
	$(document).ready(function () {
		$('#myTable').DataTable();
	});

	$(document).ready(function () {
		$('#myTable').on('click', '#archive', function () {
			var sessionId = $(this).data('sessions-id');
			console.log(sessionId);
			alertify.confirm("Are you sure you want to delete this Diet Plan?", function (e) {
				if (e) {
					$.post("<?=base_url()?>admin/archive_post/", {"sessionId": sessionId}, function (response) {
						if (response == "success") {
							alertify.success('Diet Plan Archived!');
							window.setTimeout(function(){location.reload()},2000)
						}
					});
				}
			});
		})
	});
</script>



