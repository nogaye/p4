@extends('_master')

@section('title')
    Generate Lorem Ipsum
@stop

@section('head')
   
@stop

@section('content')
    <h4>Lorem Ipsum Generator</h4>
                <p>
                    Lorem ipsum is a filler text commonly used to demonstrate the graphic elements 
                    of a document by replacing meaningful content with placeholder 
                    text.
                </p>
   
                <form method='GET' action='/loremipsum'>
   
            

                <p>
                   
                     <label for='number_of_lorem'> Number of paragraphs (Max 99)? </label>                    
                      <input type="number" min="1" max="99" required="required" name="number_of_lorem" id="number_of_lorem" value="<?php echo $number_of_lorem; ?>" />
                    </p>

                  <input type='submit' class="btn btn-lg btn-success" value='Generate Lorem Ipsum'/>
                  </form>

<hr/>

 @if ($number_of_lorem >0)
<h4>You have generated {{{ $number_of_lorem }}} paragraphs</h4>
@endif

{{
 
implode('<p>', $paragraphs);
}}
   

   
@stop

@section('footer')
   
@stop