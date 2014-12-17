<?php

class Mood extends Eloquent {

    # The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'created_at', 'updated_at');

    /**
    * Mood belongs to User
    * Define an inverse one-to-many relationship.
    */
	public function user() {

        return $this->belongsTo('User');

    }

    /**
    * Mood belong to mood type
    */
    public function mood_type() {

        return $this->belongsTo('MoodType');

    }



    /**
    * Search for current users moods 
    * @return Collection
    */
    public static function getUserMoods($userid) {

        # If there is a query, search the library with that query
        if($userid) {

            # Eager load tags and author
            $moods = Mood::with('user')
            ->whereHas('user', function($q) use($userid) {
                $q->where('name', '=', $userid);
            })       
            ->get();


        }
        # Otherwise, just fetch all moods
        else {
            # Eager load tags and author
            //$moods = Mood::with('tags','author')->get();
        }

        return $moods;
    }

  /**
    * Get all moods
    * @return Collection
    */
    public static function getAllMoods() {

            # Eager load tags and author
            $moods = Mood->where('user', function($q) use($userid) {
                $q->where('name', 'LIKE', "%$userid%");
            })       
            ->get();


       
        return $moods;
    }



    /**
    * Searches and returns any books added in the last 24 hours
    *
    * @return Collection
    */
    public static function getBooksAddedInTheLast24Hours() {

        # Timestamp of 24 hours ago
        $past_24_hours = strtotime('-1 day');

        # Convert to MySQL timestamp
        $past_24_hours = date('Y-m-d H:i:s', $past_24_hours);

        $books = Mood::where('created_at','>',$past_24_hours)->get();

        return $books;

    }


   

}