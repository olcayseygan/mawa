<?php
$url = url("film/%s", $film["slug"]);
$image_url = asset("images/posters/%s", $film["filename"]);
?>

<div class="film-poster">
    <a href="<?= $url ?>"><img src="<?= $image_url ?>" alt="Poster"></a>
    <span><a href="<?= $url ?>"><?= $film["name"] ?></a></span>
</div>