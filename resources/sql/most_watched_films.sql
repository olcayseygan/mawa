SELECT films.*,
    media.filename as filename
FROM films
    INNER JOIN media ON media.id = films.cover_media_id
ORDER BY rank