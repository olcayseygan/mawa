<?php view("layouts.master", [], function () use ($most_watched_films, $categories) { ?>
    <?= view("components.most-watched-swiper", ["most_watched_films" => $most_watched_films]) ?>
    <div class="category-list">
        <?php foreach ($categories as $category) : ?>
            <?= view("components.category-container", ["category_name" => $category["name"], "items" => $category["films"]]) ?>
        <?php endforeach ?>
    </div>
<?php }); ?>