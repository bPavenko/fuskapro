<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'activated' => true,
        'created_at' => $faker->dateTime,
        'deleted_at' => null,
        'email' => $faker->email,
        'first_name' => $faker->firstName,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'last_login_at' => $faker->dateTime,
        'last_name' => $faker->lastName,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'updated_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'email_verified_at' => $faker->dateTime,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'surname' => $faker->lastName,
        'phone' => $faker->sentence,
        'city' => $faker->sentence,
        'type_id' => $faker->randomNumber(5),
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\TaskCategory::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'parent_id' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Section::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\TaskSection::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'name' => $faker->firstName,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Order::class, static function (Faker\Generator $faker) {
    return [
        'section_id' => $faker->randomNumber(5),
        'category_id' => $faker->randomNumber(5),
        'short_description' => $faker->sentence,
        'full_description' => $faker->sentence,
        'execution_date' => $faker->date(),
        'start_execution_time' => $faker->dateTime,
        'end_execution_time' => $faker->dateTime,
        'price' => $faker->randomNumber(5),
        'by_user' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Order::class, static function (Faker\Generator $faker) {
    return [
        'section_id' => $faker->randomNumber(5),
        'category_id' => $faker->randomNumber(5),
        'short_description' => $faker->sentence,
        'full_description' => $faker->sentence,
        'execution_date' => $faker->date(),
        'start_execution_time' => $faker->dateTime,
        'end_execution_time' => $faker->dateTime,
        'price' => $faker->randomNumber(5),
        'by_user' => $faker->randomNumber(5),
        'price_negotiable' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\FooterTitle::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\FooterLink::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'footer_title_id' => $faker->randomNumber(5),
        'link' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Price::class, static function (Faker\Generator $faker) {
    return [
        'service' => $faker->sentence,
        'cost' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
