<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return View::make('index');
});


/*
|--------------------------------------------------------------------------
| Load lorem ipsum page
|--------------------------------------------------------------------------
|
| Thsi code loads the lorem ipsum page after reading the page queries
|
Route::get('/loremipsum', function()
{
    
    $number_of_lorem   = Input::get('number_of_lorem'); 

if($number_of_lorem <=0 || $number_of_lorem >99)
    {
        $number_of_lorem = 0;
    }

if($number_of_lorem == '')
{
    $number_of_lorem = 0;
}

     $generator = new Badcow\LoremIpsum\Generator();
     $paragraphs = $generator->getParagraphs($number_of_lorem);
    return View::make('loremipsum')->with('number_of_lorem', $number_of_lorem)->with('paragraphs', $paragraphs);
});

*/

/*
|--------------------------------------------------------------------------
| Load the user page
|--------------------------------------------------------------------------
|
| Loads the user page and reads the page queries
|


Route::get('/users', function()
{
   $number_of_users   = Input::get('number_of_users'); 
    $include_address = Input::get('include_address'); 
     $include_profile = Input::get('include_profile'); 

if($number_of_users <=0 || $number_of_users >99)
    {
        $number_of_users = 0;
    }

if($number_of_users == '')
{
    $number_of_users = 0;
}
if($include_address == '')
{
    $include_address = false;
}
if($include_profile == '')
{
    $include_profile = false;
}
    $faker = Faker\Factory::create();

     return View::make('users')
     ->with('include_profile', $include_profile)
     ->with('include_address', $include_address)
     ->with('faker', $faker)
        ->with('number_of_users', $number_of_users);
});


*/




/**
* User
* (Explicit Routing)
*/
Route::get('/signup','UserController@getSignup' );
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', 'UserController@postSignup' );
Route::post('/login', 'UserController@postLogin' );
Route::get('/logout', 'UserController@getLogout' );


/**
* Mood
* (Explicit Routing)
*/
Route::get('/mymood', 'MoodController@getUserMoods');
Route::get('/mood', 'MoodController@getMoods');

//Route::get('/mood/edit/{id}', 'MoodController@getEdit');
//Route::post('/mood/edit', 'MoodController@postEdit');

//Route::get('/mood/create', 'MoodController@getCreate');
Route::post('/mood/create', 'MoodController@postCreate');

//Route::post('/mood/delete', 'MoodController@postDelete');

//Route::get('/mood/digest', 'MoodController@getDigest');

## Ajax examples
//Route::get('/mood/search', 'MoodController@getSearch');
//Route::post('/mood/search', 'MoodController@postSearch');

/**
* Debug
*/
Route::get('debug', 'DebugController@getIndex');








