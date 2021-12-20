<?php view("layouts.master", ["slot" => function () use ($data) { ?>
    <?php foreach ($data as $item) : ?>
        <h1><?= $item["id"] ?></h1>
    <?php endforeach ?>
<?php }]) ?>