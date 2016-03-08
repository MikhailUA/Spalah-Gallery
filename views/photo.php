<div class="col-lg-6 col-lg-offset-3" xmlns="http://www.w3.org/1999/html">

    <div class="form-group">
        <a href="/user/<?php echo $username; ?>/page/1" class="btn btn-primary">Back to Gallery</a>
        <a href="/deletePhoto/<?php echo $photo['photoId']; ?>" class="btn btn-danger pull-right">Delete Photo</a>

        <div class="clearfix"></div>
    </div>

    <div class="photo">

        <a href="/pictures/<?php echo $username; ?>/<?php echo $photo['photoURI'] ?>">
            <img src="/pictures/<?php echo $username; ?>/<?php echo $photo['photoURI'] ?>"/></a>

        <p>
            <?php echo $photo['description'] ?>
        </p>
        <p>

            <?php
                foreach ($photo['comments'] as $comment){
                echo $comment['name'].' '.$comment['createdAt']."</br>";
                echo $comment['text']."</br>";
            }
            ?>
        </p>
        <p>

            <form method="post">
                <input type="text" name='name'>
                <textarea name='text'></textarea>
                <input type="submit">
            </form>

        </p>

        <hr/>
    </div>

</div>