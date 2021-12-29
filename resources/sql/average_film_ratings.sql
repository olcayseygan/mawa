UPDATE films
SET films.rating =(
        SELECT AVG(rating)
        FROM film_ratings
        WHERE film_ratings.film_id = films.id
    )