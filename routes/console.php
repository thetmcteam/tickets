<?php

Artisan::command('config:make', function () {
    copy(__DIR__.'/../.env.example', __DIR__.'/../.env');
})->describe('Create an environment configuration file.');
