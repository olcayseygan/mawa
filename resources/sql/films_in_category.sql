SELECT films.*,
    media.filename
FROM films
    INNER JOIN media ON media.id = films.poster_media_id
    INNER JOIN film_categories ON films.id = film_categories.film_id
WHERE film_categories.category_id = :id