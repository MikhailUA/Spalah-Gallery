<div class="col-lg-6 col-lg-offset-3">

    <ul class="nav nav-pills gallery-nav">
        <li role="presentation" class="active"><a href="#"><?php echo UserSession::getInstance()->username; ?></a></li>
        <li role="presentation"><a href="/photo">Add Photo</a></li>
        <li role="presentation"><a href="/logout">Log Out</a></li>
    </ul>

    <div class="photos">

        <?php foreach ($photos as $photo): ?>

            <div class="photo">
                <!--<a href="/pictures/<?php /*echo $username */ ?>/<?php /*echo $photo['photoURI'] */ ?>">-->
                <a href="/user/<?php echo $username ?>/photo/<?php echo $photo['photoURI'] ?>">
                    <img src="/pictures/<?php echo $username ?>/<?php echo $photo['photoURI'] ?>"/></a>

                <p>
                    <?php echo Picture::formatDate($photo['date']) ?>
                </p>

                <p>
                    <?php echo $photo['description']; ?>
                </p>

                <hr/>
            </div>
        <?php endforeach ?>

        <nav>

            <ul class="pagination">
                <!--                                   <li>
                                                        <a href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>-->
                <?php $db->pagination($photosCount, $perPage); ?>
                <!--                                   <li>
                                                        <a href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>-->
            </ul>
        </nav>


    </div>
</div>

