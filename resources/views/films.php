<?php view("layouts.master", [], function () use ($most_watched_films, $most_rated_films, $last_added_films, $categories) { ?>
    <?= view("components.most-watched-swiper", ["most_watched_films" => $most_watched_films]) ?>
    <div class="category-list">
        <?= view("components.category-container", ["category_slug" => "en-cok-begeni-alanlar", "category_name" => "En Çok Beğeni Alanlar", "items" => $most_rated_films]) ?>
        <?= view("components.category-container", ["category_slug" => "en-son-eklenenler", "category_name" => "En Son Eklenenler", "items" => $last_added_films]) ?>
        <?php foreach ($categories as $category) : ?>
            <?= view("components.category-container", ["category" => $category, "items" => $category["films"]]) ?>
        <?php endforeach ?>
    </div>
<?php }); ?>