<div class="category-container">
    <h1><a href="<?= url("category/%s", $category_slug ?? $category["slug"]) ?>"><?= $category_name ?? $category["name"] ?><span>Tümüne Gözat</span></a></h1>
    <?= view("components.category-swiper", ["items" => $items]) ?>
</div>