<?php view("layouts.master", [], function () use ($film, $categories, $gallery) { ?>
    <div class="film-details">
        <div>
            <img src="<?= asset("images/posters/%s", $film["poster_filename"]) ?>">
            <div>
                <h1><?= $film["name"] ?></h1>
                <ul>
                    <?php foreach ($categories as $category) : ?>
                        <li><a href="<?= url("category/%s", $category["slug"]) ?>"><?= $category["name"] ?></a></li>
                    <?php endforeach ?>
                </ul>
                <p><?= $film["description"] ?></p>
            </div>
        </div>
        <div>
            <ul>
                <?php foreach ($gallery as $media) : ?>
                    <li><img src="<?= url("images/covers/%s", $media["filename"]) ?>" alt=""></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
<?php }); ?>