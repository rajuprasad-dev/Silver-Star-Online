<style>
  @media (max-width: 768px) {
    .hide-small {
      display: none;
    }

  }

  @media (min-width: 768px) {
    .hide-large {
      display: none;
    }

  }
</style>
<style>
  input {
    border: none;
    outline: none;
  }

  /* Media query for screens with a maximum width of 767 pixels (typical for mobile screens) */
  @media only screen and (max-width: 767px) {

    /* Styles for mobile screens (using only row class) */
    #myDiv {

      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }
  }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between px-5" style="top:0px;">
  <div class="col" id="myDiv">
    <div class="justify-content-between row">

      <div class="row hide-small" style="width:25vw;">
        <div>
          <form class="form-inline" action="" method="post">
            <button class="btn  my-2 my-sm-0" type="submit"><img src="images/search-symbol.png" alt="Cart"
                height="20"></button>
            <input class="form-control mr-sm-2" type="text" placeholder="Search" name="product_name" aria-label="Search"
              style="border: none;">
          </form>

        </div>
      </div>
      <div class="row">
        <a class="navbar-brand align-items-center d-flex" href="index.php">
          <img src="images/silver-star.png" alt="Logo" height="35">  &nbsp; SILVER STAR
        </a>
      </div>



      <div class="row hide-small justify-content-end" style="width:25vw;">
        <div>
          <a class="navbar-brand " href="account.php">
            <img src="images/user.png" alt="Cart" height="30">
          </a>
        </div>
        <div>
          <a class="navbar-brand " href="cart.php">
            <img src="images/shopping-cart.png" alt="Cart" height="30">
          </a>
        </div>
      </div>
    </div>
    <div class="justify-content-between row py-2">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link custom-link" href="index.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link custom-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link custom-link" href="about-us.php">About Us</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link custom-link" href="contact-us.php">Contact Us</a>
          </li>
          <!-- <li class="nav-item active">
            <a class="nav-link custom-link" href="#products">Products</a>
          </li> -->
        </ul>
      </div>
    </div>
  </div>
</nav>
<div class="sticky-buttons-icons icon-width">
    <center>
      <a href="https://www.instagram.com/skinks.tattoo/" class="instagram" style="color:inherit;"><i
          class="fa fa-whatsapp" style="color:white;"></i></a>
      <!-- <a href="https://www.facebook.com/getinkstattoostudio/" class="facebook" style="color:inherit;"><i
          class="fa fa-facebook" style="color:white;"></i></a> -->
      <!-- <a href="https://www.youtube.com/channel/UCCAwfef58ZEjiUA_nEHLeRA" class="youtube" style="color:inherit;"><i
          class="fa fa-youtube" style="color:white;"></i></a> -->
    </center>

  </div>