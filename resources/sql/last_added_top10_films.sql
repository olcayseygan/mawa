SELECT films.*,
    media.filename as filename
FROM films
    INNER JOIN media ON media.id = films.poster_media_id
ORDER BY created_at
LIMIT 10