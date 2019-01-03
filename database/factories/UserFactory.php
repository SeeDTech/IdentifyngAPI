<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Idholder::class, function (Faker\Generator $faker) {
    static $password;

    return [
		'first_name' => $faker->name,
		'last_name' => $faker->name,
		'middle_name' => $faker->name,
		'gender' => $faker->randomElement(['Female', 'Male']),
		'email' => $faker->unique()->safeEmail,
		'image' => md5(uniqid()).'.jpg',
		'address' => $faker->text,
		'qrcode' => str_random(10),
		'bvn' => $faker->isbn10,
		'phone' => $faker->e164PhoneNumber,
		'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});

$factory->define(App\Models\Idprovider::class, function (Faker\Generator $faker) {
	return [
		'subscription_id' => factory(\App\Models\Subscription::class)->create()->id,
		'name' => $faker->word(),
		'phone' => $faker->e164PhoneNumber,
		'code' => $faker->word,
		'image' => md5(uniqid()).'.jpg',
	];
});

// $factory->define(App\Models\Subscription::class, function (Faker\Generator $faker) {
// 	return [
// 		'sub_type' => $faker->word,
// 		'amount' => 'NGN ' . (string) $faker->randomFloat(2, 200, 500),
// 	];
// });

// $factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
// 	return [
// 		'title' => $faker->sentence(3),
// 		'price' => 'NGN ' . (string) $faker->randomFloat(2, 200, 500),
// 	];
// });
