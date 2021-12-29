<?php view("layouts.master", [], function () use ($category, $films) { ?>
    <div class="category-details">
        <h1><?= $category["name"] ?></h1>
        <div>
            <?php foreach ($films as $film) : ?>
                <div>
                    <?= view("components.film-poster", ["film" => $film]) ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php }); ?>