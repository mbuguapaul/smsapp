<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ url('/') }}">Home</a></li>
           
            <!-- //////////////////////////// -->
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" data-hover="dropdown" aria-expanded="false">contacts <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/contacts') }}">All</a></li>
                <li><a href="{{ url('/contacts/add') }}">Add contact</a></li>
                <li class="divider"></li>
                <li><a href="{{ url('/communities') }}">Communities</a></li>
                  <li><a href="{{ url('/communities/add') }}">Add Community</a></li>
               
              </ul>
            </li>
            <!-- //////////////// -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" data-hover="dropdown" aria-expanded="false">sms <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/smses/new') }}">New</a></li>
                <li><a href="{{ url('/smses/sent') }}">sent</a></li>
                <li><a href="{{ url('/smses/queued') }}">Queued</a></li>
               
              </ul>
            </li>
            <!-- /////////////// -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
           
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <br><br><br><br><br><br><br>