<div class="col-lg-6 col-lg-offset-3">

    <ul class="nav nav-pills gallery-nav">
        <li role="presentation" class="active"><a href="#"><?php echo $username; ?></a></li>
        <li role="presentation"><a href="/photo">Add Photo</a></li>
        <li role="presentation"><a href="/logout">Log Out</a></li>
    </ul>

    <div class="photos">

        <?php foreach ($photos as $photo): ?>

            <div class="photo">

                <a href="/user/<?php echo $photo['username']; ?>/photo/<?php echo $photo['photoId'] ?>">
                    <img src="/pictures/<?php echo $photo['username']; ?>/<?php echo $photo['photoURI'] ?>"/></a>

                <p>
                    <?php
                        echo $photo['SocialLinks']['FB'];
                        echo $photo['SocialLinks']['LN'];
                        echo $photo['SocialLinks']['VK'];
                    ?>
                </p>

                <p>
                    <?php echo $photo['date'] ?>
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
                <?php pagination($photosCount, $perPage); ?>
                <!--                                   <li>
                                                        <a href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>-->
            </ul>
        </nav>


    </div>
</div>

