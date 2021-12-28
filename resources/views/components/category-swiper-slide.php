<?php
$url = url("#");
$image_url = asset("images/posters/%s", $item["filename"]);
?>

<div class="swiper-slide">
    <a href="<?= $url ?>"><img src="<?= $image_url ?>" alt="Poster"></a>
    <span><a href="<?= $url ?>"><?= $item["name"] ?></a></span>
</div>