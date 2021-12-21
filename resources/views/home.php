<?php view("layouts.master", [], function () use ($data) { ?>
    <?php foreach ($data as $item) : ?>
        <h1><?= $item["id"] ?></h1>
    <?php endforeach ?>
<?php }); ?>