SELECT films.*,
    media.filename
FROM films
    INNER JOIN media ON media.id = films.poster_media_id
WHERE films.id IN (
        SELECT film_categories.film_id
        FROM film_categories
        WHERE film_categories.category_id = :category_id
    )
LIMIT 10