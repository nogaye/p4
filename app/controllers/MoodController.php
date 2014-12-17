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
	$mood = new Mood();

		 //$mood = Mood::firstOrNew(array('lat' => $data->lat, 'lng' => $data->lng ));
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

/*
public function addExpense(){
    $expense = new Expense;
    $data = Input::all();
    $isAjax = Request::ajax();

    if ($expense->isValid($data)) {
        $expense->fill($data);
        $expense->save();
        //Recargar la tabla gastos
        if($isAjax) {
            // Return your success JSON here
        } else {
            return Redirect::to('expense/index')->with('success', 'El gasto ha sido agregado correctamente.');
        }
    }

    if($isAjax) {
        // Return your fail JSON here
    } else {
        return Redirect::back()->withInput()->withErrors($expense->errors);
    }
}


*/




	/**
	* Display all books
	* @return View
	*/
	public function getIndexbooks() {

		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');

		$query  = Input::get('query');

		$books = Book::search($query);

		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('book_index')
				->with('books', $books)
				->with('query', $query);
		}
		# JSON
		elseif($format == 'json') {
			return Response::json($books);
		}
		# PDF (Coming soon)
		elseif($format == 'pdf') {
			return "This is the pdf (Coming soon).";
		}


	}

/**
	* Used as an example for something you might want to set up a cron job for
	*/
	public function getDigest() {

		$books = Book::getBooksAddedInTheLast24Hours();

		$users = User::all();

		$recipients = Book::sendDigests($users,$books);

		$results = 'Book digest sent to: '.$recipients;

		Log::info($results);

		return $results;

	}


	/**
	* Process the searchform
	* @return View
	*/
	public function getSearch() {

		return View::make('book_search');

	}

	/**
	* Show the "Add a book form"
	* @return View
	*/
	public function getCreate() {

		$authors = Author::getIdNamePair();

    	return View::make('book_add')->with('authors',$authors);

	}


	


	/**
	* Show the "Edit a book form"
	* @return View
	*/
	public function getEdit($id) {

		try {
		    $book    = Book::findOrFail($id);
		    $authors = Author::getIdNamePair();
		}
		catch(exception $e) {
		    return Redirect::to('/book')->with('flash_message', 'Book not found');
		}

    	return View::make('book_edit')
    		->with('book', $book)
    		->with('authors', $authors);

	}


	/**
	* Process the "Edit a book form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $book = Book::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/book')->with('flash_message', 'Book not found');
	    }

	    # http://laravel.com/docs/4.2/eloquent#mass-assignment
	    $book->fill(Input::all());
	    $book->save();

	   	return Redirect::action('BookController@getIndex')->with('flash_message','Your changes have been saved.');

	}


	/**
	* Process book deletion
	*
	* @return Redirect
	*/
	public function postDelete() {

		try {
	        $book = Book::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/book/')->with('flash_message', 'Could not delete book - not found.');
	    }

	    Book::destroy(Input::get('id'));

	    return Redirect::to('/book/')->with('flash_message', 'Book deleted.');

	}


	/**
	* Process a book search
	* Called w/ Ajax
	*/
	public function postSearch() {

		if(Request::ajax()) {

			$query  = Input::get('query');

			# We're demoing two possible return formats: JSON or HTML
			$format = Input::get('format');

			# Do the actual query
	        $books  = Book::search($query);

	        # If the request is for JSON, just send the books back as JSON
	        if($format == 'json') {
		        return Response::json($books);
	        }
	        # Otherwise, loop through the results building the HTML View we'll return
	        elseif($format == 'html') {

		        $results = '';
				foreach($books as $book) {
					# Created a "stub" of a view called book_search_result.php; all it is is a stub of code to display a book
					# For each book, we'll add a new stub to the results
					$results .= View::make('book_search_result')->with('book', $book)->render();
				}

				# Return the HTML/View to JavaScript...
				return $results;
			}
		}
	}



}