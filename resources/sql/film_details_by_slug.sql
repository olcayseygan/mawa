SELECT films.*,
    poster_media.filename AS poster_filename,
    cover_media.filename AS cover_filename
FROM films
    INNER JOIN media AS poster_media ON films.poster_media_id = poster_media.id
    INNER JOIN media AS cover_media ON films.cover_media_id = cover_media.id
WHERE slug = :slug