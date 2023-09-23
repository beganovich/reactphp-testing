<?php

require sprintf('%s/vendor/autoload.php', dirname(__DIR__, 1));

$context = new App\Context();
$faker = \Faker\Factory::create();

for ($i = 0; $i < 1000; $i++) {
    $query = $context->database->prepare(
        'INSERT INTO posts (title, content) VALUES (:title, :content)'
    );

    $query->bindValue(':title', $faker->sentence());
    $query->bindValue(':content', $faker->text());

    $result = $query->execute();

    dump($i);
}
