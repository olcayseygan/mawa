SELECT films.*,
    media.filename as filename
FROM films
    INNER JOIN film_media ON film_media.film_id = films.id
    INNER JOIN media ON media.id = film_media.media_id
WHERE film_media.place_at = 'poster'
GROUP BY films.id
ORDER BY rank