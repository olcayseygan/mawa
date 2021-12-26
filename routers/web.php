<?php

Router::get("/", "FilmController", "index");
Router::get("/{film}", "FilmController", "show");
