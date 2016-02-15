<div class="col-lg-6 col-lg-offset-3">

    <ul class="nav nav-pills gallery-nav">
        <li role="presentation" class="active"><a href="#"><?php echo UserSession::getInstance()->username;?></a></li>
        <li role="presentation"><a href="/photo">Add Photo</a></li>
        <li role="presentation"><a href="/logout">Log Out</a></li>
    </ul>

    <div class="photos">

        <?php foreach($photos as $photo): ?>

            <div class="photo">
                <a href="/pictures/<?php echo $username ?>/<?php echo $photo['photoURI'] ?>"><img src="/pictures/<?php echo $username ?>/<?php echo $photo['photoURI'] ?>" /></a>

                <p>
                    <?php echo $photo['description']; ?>
                </p>

                <hr />
            </div>



        <?php endforeach ?>





    </div>
</div>

