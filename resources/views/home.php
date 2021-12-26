<?php view("layouts.master", [], function () use ($films) { ?>
    <?php foreach ($films as $film) : ?>
        <h1><?= $film->id ?></h1>
    <?php endforeach ?>
<?php }); ?>