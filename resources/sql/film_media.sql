SELECT media.*
FROM media
    INNER JOIN film_media ON media.id = film_media.media_id
WHERE film_media.film_id = :film_id