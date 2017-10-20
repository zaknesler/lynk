<?php

use Faker\Generator as Faker;

$factory->define(App\Link::class, function (Faker $faker) {
    return [
        'url' => 'https://example.com',
        'code' => 'example',
        'has_custom_code' => true,
    ];
});
