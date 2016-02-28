<div class="col-lg-6 col-lg-offset-3">

    <div class="form-group">
        <a href="/user/<?php echo $username; ?>" class="btn btn-primary">Back to Gallery</a>
        <a href="/deletePhoto/<?php echo $photo['photoURI']; ?>" class="btn btn-danger pull-right">Delete Photo</a>

        <div class="clearfix"></div>
    </div>

    <div class="photo">
        <a href="/user/<?php echo $username; ?>/photo/<?php echo $photo['photoURI'] ?> ">
            <img src="/pictures/<?php echo $username; ?>/<?php echo $photo['photoURI'] ?>"/></a>

        <p>
            <?php echo $photo['description'] ?>
        </p>

        <hr/>
    </div>

</div>