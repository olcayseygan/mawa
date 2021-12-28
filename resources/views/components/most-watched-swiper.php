<div class="swiper most-watched-swiper">
    <div class="swiper-wrapper">
        <?php foreach ($most_watched_films as $film) : ?>
            <?= view("components.most-watched-swiper-slide", ["film" => $film]) ?>
        <?php endforeach ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>