SELECT categories.*
FROM categories
    INNER JOIN film_categories ON categories.id = film_categories.category_id
WHERE film_categories.film_id = :film_id