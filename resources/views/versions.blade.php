@extends ('master')

@section('title', 'Versions')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel semi-transparent transparent">
                <div class="header">
                    <img src="{{asset('img/tab_image.png')}}" alt="Logo">
                    <h1>Developer Notes</h1>
                </div>
                <hr/>

                <!--Version 0.2-->
                <div class="panel-body">
                    <h3>Version 0.2</h3> - <h4>October 19th, 2017</h4>
                    <p>Say hello to Siege Stats v0.2! We have added new and exciting functionality to our site! The 
                        following has been added: 
                    </p></br>
                    <ul>
                        <li>Elegant Player Profile Page</li>
                        <li>Compare Player Stats</li>
                        <li>Access Any Players Profile Page</li>
                        <li>Recover Account</li>
                        <li>Account Registration Confirmation</li>
                        <li>R6 News And Updates Page</li>
                    </ul></br>
                    <p>
                        Players are now able to view the stats of every Rainbow Six Siege™ player, including themselves. 
                        Whether it be for fun or competitive reasons, all relevant stats can now be seen to help the player 
                        understand their strengths and weaknesses. Siege Stat users can now recover their account in case 
                        they have forgotten their password and all new users will receive a confirmation email upon a successful 
                        registration. We have also added a Rainbow Six Siege™ "News and Updates" page that will show the user 
                        the latest changes and annoucements regarding the game.
                    </p>
                </div>

                <!--Version 0.1-->
                <div class="panel-body">
                    <h3>Version 0.1</h3> - <h4>September 28th, 2017</h4>
                    <p>Welcome to Siege Stats v0.1! We have added new functionality to our site! The 
                        following has been added: 
                    </p></br>
                    <ul>
                        <li>Register Page</li>
                        <li>Login Page</li>
                        <li>Versions Page</li>
                        <li>Player Lookup Functionality</li>
                        <li>Style Update</li>
                    </ul></br>
                    <p>
                        Players are now able to register their own account to Siege Stats. They can also input 
                        user names to search for themselves, their friends and foes online to find more about all 
                        of their Rainbow Six Siege™ statistics. The update also brings in a new updated look for the 
                        site. To find any new changes made to Siege Stats, you can consult the developer notes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection