<?php $post_type="DietPlan";

?>
  <center>
                    <?php if ($this->session->flashdata('msgsuccess')){
                      echo ' <div class="btn success"> '. $this->session->flashdata('msgsuccess') .' <div class="btn success"> ';
                    } ?>
             
               
                    <?php if ($this->session->flashdata('msgwarn')){
                          ?>    <div class="btn success"> <?php echo ' <div class="btn btn-warning">'. $this->session->flashdata('msgsuccess');
                        echo $this->session->flashdata('msgwarn');
                        ?>    </div> <?php    }?>
                </div>
                    </center>


<?php
if (isset($rows)) {
    foreach($rows as $row){
      $image_name=$row['post_image_name'];
        $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_content = $row['post_content'];
    $date_posted = $row['date_posted'];
    $routine_count = $row['routine_count'];
    $routine_format = $row['routine_format'];
    $post_user_id = $row['post_user_id'];
    $post_type = $row['post_type'];
    $image_id = $row['image_id'];
    $activity_type = $row['activity_type'];
?>

<center>
    <?php
            if ($this->session->flashdata('msgsuccess')) {
                echo $this->session->flashdata('msgsuccess');
            }

        if ($this->session->flashdata('msgwarn')) {
            echo $this->session->flashdata('msgwarn');
        }
        if ($this->session->flashdata('msgerror')) {
            echo $this->session->flashdata('msgerror');
        } ?>

<div class="" >
    <div class="card" style="width: 50rem;">
  <img class="card-img-top" style="height:500px" src="<?=base_url().'uploads/images/'.$image_name?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?= $post_title ?></h5>
    <p class="card-text"><?php if(isset($post_content)){
        echo $post_content;
    }
?>
</p>
    <a href="<?= base_url().'admin/edit_Diet/'.$post_id?>" class="btn  btn-sm btn-primary">Edit</a>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
 Delete
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
        <button type="button" class="btn btn-primary" onclick="<?= base_url().'admin/editPosts/'.$post_id?>">Confirm</button>
      </div>
    </div>
  </div>
</div>
    



  </div>

  
</div>

</div>



    <?php
}  
}?>

    <!-- <div class="card border-danger" style="width: 18rem;"> <img
    class="card-img-top" src="..." alt="Card image cap"> <div class="card-body"> <h5
    class="card-title">Card title</h5> <p class="card-text">Some quick example text
    to build on the card title and make up the bulk of the card's content.</p> <a
    href="#" class="btn btn-primary">Go somewhere</a> </div> </div> -->

    <script></script>