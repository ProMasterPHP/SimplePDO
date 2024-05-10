<?php

use TurgunboyevUz\SPDO\Model\User;

require __DIR__.'/src/autoload.php';

//------------INSERT Statement------------
User::create([
    'name' => 'John',
    'email' => 'info@turgunboyev.uz',
    'password' => password_hash('12345', PASSWORD_BCRYPT),
]);


//------------SELECT Statement------------
$users = User::all(); // get all $users

$user = User::find(1); // get user by id

$user = User::where('email', 'info@turgunboyev.uz'); // get user by where clause
$count = $user->count(); //get rows count
$fetchData = $user->get(); //get fetched data


//------------UPDATE Statement------------
User::where('email', 'info@turgunboyev.uz')->update([
    'name'=>'Turgunboyev'
]);


//------------DELETE Statement------------
User::where('email', 'info@turgunboyev.uz')->delete();
?>