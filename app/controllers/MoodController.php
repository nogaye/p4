<?php

class MoodController extends \BaseController {


/**
*
*/
public function __construct() {

# Make sure BaseController construct gets called

$this->beforeFilter('auth', array('except' => ['getIndex','getDigest']));

}




/**
* Show my moods form, get the loged in users moods
* @return View
*/
public function getUserMoods() {

if (Auth::check())
{


$user_id = Auth::user()->id;
$moods = Mood::where('user_id', '=', $user_id) ->get();


return View::make('moods')->with('moods', $moods);
}

}

/**
* Get all moods on page load
* @return View
*/
public function getMoods() {

$moods = Mood::all();


$response = array(
'status' => 'success',
'msg' => 'Mood saved successfully',
'moods' => $moods  );

return Response::json( $response );

}


/**
* Process the "Add mood form"
* @return Redirect
*/
public function postCreate() {

$data = Input::all();




# Instantiate the mood model
//$mood = new Mood();

$mood = Mood::firstOrNew(array('lat' => $data['lat'], 'lng' =>$data['lng'] ));
// $moods = Mood.where('lat', '=', $data->lat)->where('lng', '=', $data->lng)->get();

$mood_type = MoodType::where('name','=',$data['mood'])->first();

$mood->mood_type_id = 1;// mood_type->id;
$mood->mood = $data['mood'];
$mood->lat  = $data['lat'];
$mood->lng  = $data['lng'];

if (Auth::check())
{

$mood->user_id = Auth::user()->id;
}
else
{
//Use anonymous user id
$mood->user_id  = 1;
}

$mood->save();


$response = array(
'status' => 'success',
'msg' => 'Mood saved successfully',
'data' => $mood  );

return Response::json( $response );



}

/**
	* Show edit mood screen
	* @return View
	*/
	public function getEdit($id) {

		try {
		    $mood    = Mood::findOrFail($id);
		}
		catch(exception $e) {
		    return Redirect::to('/moods')->with('flash_message', 'Mood not found');
		}

    	return View::make('moods')
    		->with('moods', $mood);

	}


	/**
	* Edit mood
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $mood = Mood::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/moods')->with('flash_message', 'Mood not found');
	    }

	    # http://laravel.com/docs/4.2/eloquent#mass-assignment
	    $mood->fill(Input::all());
	    $mood->save();

	    return Redirect::to('/moods')->with('flash_message', 'Your changes have been saved');


	}


	/**
	* Delete mood
	*
	* @return Redirect
	*/
	public function getDelete($id) {

		try {
	        $mood = Mood::findOrFail($id);
	    }
	    catch(exception $e) {
	        return Redirect::to('/mymood')->with('flash_message', 'Could not delete mood. Mood not found.');
	    }

	    Mood::destroy($id);

	    return Redirect::to('/mymood')->with('flash_message', 'Mood deleted.');

	}


}

