<?php view("layouts.master", [], function () use ($films) { ?>
    <div class="owl-carousel film-category">
        <?php foreach ($films as $film) : ?>
            <?= view("components.film-card", ["film" => $film]) ?>
        <?php endforeach ?>
    </div>
<?php }); ?>