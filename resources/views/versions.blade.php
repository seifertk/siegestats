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
                <div class="panel-body">
                    <h3>Version 1.1</h3> 
                    <p>Opening Paragraph Stuff: 
                    </p></br>
                    <ul>
                        <li>Update Item</li>
                        <li>Another Update Item</li>
                    </ul></br>
                    <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem 
                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an 
                    unknown printer took a galley of type and scrambled it to make a type specimen book. 
                    It has survived not only five centuries, but also the leap into electronic 
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with 
                    the release of Letraset sheets containing Lorem Ipsum passages, and more recently with 
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                </div>
                <hr/>
                <div class="panel-body">
                    <h3>Version 1.0</h3> 
                    <p>Welcome to Siege Stats v1.0! We have added new functionality to our site! The 
                        following has been added: 
                    </p></br>
                    <ul>
                        <li>Register Page</li>
                        <li>Login Page</li>
                        <li>Versions Page</li>
                        <li>Player Lookup Functionality</li>
                        <li>Style update</li>
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