<?php 

  use gaf\phpmvc\Application; 
  // echo '<pre>';
  // var_dump($title);
  // echo '</pre>';
  // exit;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->title;  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <style>
      /* Custom CSS */
      /* ... Existing CSS styles ... */
      @media (max-width: 768px) {
        /* Adjust styles for smaller screens */
        .navbar-nav {
          flex-direction: column;
        }
        .navbar-toggler {
          margin-left: auto;
          margin-right: 0;
        }
        .mvc-head {
          font-size: auto;
        }
      }
.navbar-brand {
  margin-right: auto;
}
.mynav-link {
    display: block;
    padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
    font-size: var(--bs-nav-link-font-size);
    font-weight: var(--bs-nav-link-font-weight);
    color: #8892b0;
    text-decoration: none;
    background: none;
    border: 0;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}
.mynav-link.active {
  color: #64FFDA;
}
.navbar-nav.ml-auto {
  margin-left: auto;
}
    .mr-1 {
      margin-right: 1rem;
    }
    .myprimary-color {
      color: #64FFDA;
    }
    .mysecondary-color {
      color: #ccd6f6;
    }
    .mytertiary-color {
      color: #8892b0;
    }
    .mytext-color {
      color: rgb(136, 146, 176);
    }
    .mycard-bg {
      background-color: #233554;
    }
    .my-btn {
      background-color: #64FFDA;
      color: #0a192f;
    }
    .my-btn:hover{
      background-color: #64FFDA;
      color: #0a192f;
    }
    .primary-btn {
      border-radius:4px;
      padding: 0 25px;
      border-color: #64FFDA;
    }
    .primary-btn:hover {
      color: #0a192f;
      background-color: #64FFDA;
    }
    
    .mycontainer {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
    }
    .welcome-content {
      margin-top: 4rem;
    }
    .my-fs-6 {
      font-size: 6rem;
    }
    .my-fs-5 {
      font-size: 5rem;
    }
    .my-fs-3 {
      margin-block-start: 0;
      font-size: 2rem;
      margin-left: 0;
    }
    .my-fs-2 {
      margin-block-start: 0;
      font-size: 1.5rem;
      margin-left: 0;
    }
    .align-left {
      text-align: left;
    }
    .ml-2 {
      margin-left: 2em;
    }
    .myborder-radius {
      border-radius: 10px;
    }
    .myborder {
      border: 1px solid #64FFDA;
      color: #ccd6f6;
      font-size: 1.5rem;
      padding-left: 10px;
    }
    input[type="text"]:focus,
    input[type="text"]:hover,
    input[type="email"]:focus, input[type="password"]:focus  {
      color: #64FFDA;
    }
    input[type="email"]:hover,input[type="password"]:hover {
      color: #64FFDA;
    }
    textarea:focus,
    textarea:focus::placeholder {
      color: #ccd6f6 !important;
    }
    
    .myalert-success {
      background-color:#ccd6f6;;
      color: #0a192f;
      font-size: 4rem;
    }
    </style>
  </head>
  <body style="background-color: #0a192f;">
    
    <nav class=" navbar mt-lg-2 m-lg-5 navbar-brand navbar-expand-lg navbar-transparent bg-transparent">
    <a class="navbar-brand" href="https://github.com/Gafour101"><img src="images/logo.png" alt="Github Profile" style="width: 100%; max-width: 75px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php if(Application::isGuest()): ?>
        <ul class="navbar-nav  ml-auto">
          <li class="nav-item mt-2 mr-1">
          <a class="mynav-link <?php echo $this->isPageActive('/') ? 'active' : ''; ?>" aria-current="page" href="/"><h4>Home</h4></a>
        </li>
        <li class="nav-item mt-2 mr-1">
          <a class="mynav-link <?php echo $this->isPageActive('/about') ? 'active' : ''; ?> " href="/about"><h4>About</h4></a>
        </li>
        <li class="nav-item mt-2 mr-1">
          <a class="mynav-link <?php echo $this->isPageActive('/contact') ? 'active' : ''; ?>" href="/contact"><h4>Contact</h4></a>
        </li>
        <li class="nav-item mt-2 mr-1">
          <a class="mynav-link mytertiary-color <?php echo $this->isPageActive('//register') ? 'active' : ''; ?>" href="/register"><h4>Register</h4></a>
        </li>
          <li class="nav-item active">
            <button type="button" href="/login" class="btn btn-outline-primary primary-btn pt-2 h-100"><a class="nav-link myprimary-color" aria-current="page" href="/login"><h4>Login</h4></a></button>
          </li>
        </ul> 
      <?php else: ?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
              <a class="mynav-link" aria-current="page" href="/profile">Profile</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="/logout">Welcome <?php echo Application::$app->user->getDisplayName(); ?>
                (Logout)
              </a>
            </li>
        </ul>
      <?php endif; ?>
    </div>
  
</nav>
    <div class="container">
      <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="m-lg-2 mt-0 my-fs-6 p-3 myalert myalert-success">
            <?php echo Application::$app->session->getFlash('success'); ?>
        </div>
      <?php endif; ?>
      
        {{content}}


    </div>
    

    
  </body>
</html>