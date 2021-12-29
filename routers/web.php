<?php

Router::get("/", FilmController::class, "index");
Router::get("/film/{slug}", FilmController::class, "show");
Router::get("/category/{slug}", CategoryController::class, "show");

Router::get("/job/most-watched-films", JobController::class, "most_watched_films");
Router::get("/job/most-rated-films", JobController::class, "most_rated_films");
