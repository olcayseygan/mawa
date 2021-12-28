<?php

Router::get("/", FilmController::class, "index");
Router::get("/{film}", FilmController::class, "show");

Router::get("/job/most-watched-films", JobController::class, "most_watched_films");
