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



}