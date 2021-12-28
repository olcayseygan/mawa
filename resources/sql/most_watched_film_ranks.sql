UPDATE films
    INNER JOIN (
        SELECT @rank := @rank + 1 AS rank,
            watchers.*
        FROM (
                SELECT film_id,
                    SUM(watched_time) as total_watched_time
                FROM film_watchers
                GROUP BY film_id
                ORDER BY total_watched_time DESC
            ) watchers
            JOIN (
                SELECT @rank := 0
            ) rank
    ) AS ranks ON films.id = ranks.film_id
SET films.rank = ranks.rank;