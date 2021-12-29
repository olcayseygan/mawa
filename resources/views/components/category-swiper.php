<div class="swiper category-swiper">
    <div class="swiper-wrapper">
        <?php foreach ($items as $item) : ?>
            <?= view("components.category-swiper-slide", ["item" => $item]) ?>
        <?php endforeach ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>