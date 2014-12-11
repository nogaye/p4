@extends('_master')

@section('title')
    Developer's Best Friend
@stop

@section('head')
   
@stop

@section('content')

 <h4>Random User Generator</h4>
                 <p>
                    The random username generator generate a list of random usernames.
                </p>


<hr/>


                 <form method='GET' action='/users'>
                <p>
                   
                     <label for='number_of_users'> Number of users (Max 99)? </label>                    
                      <input type="number" min="1" max="99" required="required" name="number_of_users"  id="number_of_users" value="<?php echo $number_of_users; ?>" />
<br/>
                       <label for='include_address'> Include Address </label> 
                      <input type="checkbox" name="include_address" id="include_address" <?php if($include_address == true) { echo "checked=\"checked\"";} ?> />
                      <br/>
                       <label for='include_profile'> Include Profile </label> 
                      <input type="checkbox" name="include_profile" id="include_profile" <?php if($include_profile == true) { echo "checked=\"checked\"";} ?> />
                  </p>

                 <input type='submit' class="btn btn-lg btn-success" value='Generate Random Users'/>
                  </form>

                  <div>

                    <hr/>
  
   @if ($number_of_users >0)
    <h4>You have generated {{{ $number_of_users }}} users</h4>
     @endif

      @for ($i=0; $i < $number_of_users; $i++) 

        <p>
           <b> {{$i+1}}: {{ $faker->name }} </b>
          @if ($include_address == true)
           <br/>
           Address: {{ $faker->address }}
           @endif
           
            @if ($include_profile == true)
           <br/>
           Profile: {{ $faker->text }}
           @endif
           <br/>
    </p>

@endfor  

  
                  </div>
           
        
@stop

@section('footer')
   
@stop