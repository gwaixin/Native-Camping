<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">NativeCamping</a>
    </div>
    <ul class="nav navbar-nav">
      <li @if($title == 'home') class="active" @endif>
        <a href="/">Home</a>
      </li>
      <li @if($title == 'register') class="active" @endif>
        <a href="/register">register</a>
      </li>
      <li @if($title == 'about') class="active" @endif>
        <a href="/about">about</a>
      </li> 
      <li @if($title == 'contact') class="active" @endif>
        <a href="/contact">contact</a>
      </li> 
    </ul>
  </div>
</nav>