<?php
$url = url("#");
$image_url = asset("images/posters/%s", $film["filename"]);
?>

<div class="swiper-slide">
    <a href="<?= $url ?>"><img src="<?= $image_url ?>" alt="Cover"></a>
    <div>
        <h1><a href=""><?= $film["name"] ?></a></h1>
        <h2>Filmlerde Bugün <span><?= $film["rank"] ?> Numara</span></h2>
        <p><?= substr($film["description"], 0, 200) ?>...</p>
        <a href="">Daha Fazla Bilgi</a>
    </div>
</div>