<?php
class JobController extends Controller {
    public function most_watched_films() {
        $job = new Job("* * * * *");
        $job->run("most_watched_films", MostWatchedFilmsJob::class);
        return "Executed!";
    }
}
