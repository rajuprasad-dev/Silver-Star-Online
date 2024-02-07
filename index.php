<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>
<style>
    /* Custom CSS for controlling the image size */
    .carousel-control-prev img,
    .carousel-control-next img {
        width: 8vw;
        /* Set the desired width */
        height: auto;
        /* Automatically adjust the height to maintain the aspect ratio */
    }

    button:focus {
        outline: none;
    }

    @media only screen and (max-width: 767px) {

        /* Styles for mobile screens (using only row class) */
        #categories {
            display: flex;
            flex-direction: column;
        }
    }

    .image-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: -50px;
    }

    @media (min-width: 768px) {

        .icon-width {
            width: 8vw;
        }

    }

    @media (max-width: 767px) {

        .icon-width {
            width: 10vw;
        }

    }

    .facebook {
        background: #3B5998;
        color: white;
    }


    .instagram {
        background: #25D366;
        color: white;
    }



    .youtube {
        background: #bb0000;
        color: white;
    }


    .sticky-buttons-icons {
        z-index: 999;
        position: fixed;
        top: 50%;
        width: auto;
        background-color: white;
        /* Adjust as needed */
        padding: 0px;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        /* Optional: Add a shadow for visual separation */
    }

    .sticky-buttons-icons a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 15px;
    }
    }

    /* Styles for screens up to 768px (Mobile) */
    @media screen and (min-width: 768px) {


        .sticky-buttons-icons {
            z-index: 999;
            position: fixed;
            top: 50%;
            width: auto;
            background-color: white;
            /* Adjust as needed */
            padding: 0px;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            /* Optional: Add a shadow for visual separation */
        }

        .sticky-buttons-icons a {
            display: block;
            text-align: center;
            padding: 16px;
            transition: all 0.3s ease;
            color: white;
            font-size: 20px;
        }
    }
</style>

<body>

    <?php include "navbar.php" ?>
    <!-- myCarousel -->
    <div>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <!--<ol class="carousel-indicators">-->
            <!--  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
            <!--  <li data-target="#myCarousel" data-slide-to="1"></li>-->
            <!--  <li data-target="#myCarousel" data-slide-to="2"></li>-->

            <!--</ol>-->
            <?php include "backend-of-frontend/slider-li.php" ?>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php include "backend-of-frontend/slider.php" ?>
            </div>


            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <!-- <span class="sr-only">Previous</span> -->
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <!-- <span class="sr-only">Next</span> -->
            </a>
        </div>
    </div>

    <div class=" mx-5 my-5 text-center">
        <h1 class="mx-5 my-5">Latest Beauty</h1>
        <div class="row text-center">
            <?php
            if (isset($_POST['product_name'])) {
                include "backend-of-frontend/fetch-latest-beauty-with-search.php";

            } else {

                include "backend-of-frontend/fetch-latest-beauty.php";
            }
            ?>

            <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
        <div class="card" onmouseover="changeImage(this, 'images/earings2.jpg')"
          onmouseout="restoreImage(this, 'images/earings.jpg')">
          <img src="images/earings.jpg" alt="Card 2 Image" style="height:350px;">
          <div class="card-body text-left">
            <button type="button" class="btn-dinnis px-3 py-3" style="position:absolute;top:295px;"><a
                style="color:inherit;text-decoration:none;" class="custom-link px-2 py-2">Add To Cart</a></button>
            <h5 class="card-text2-dinnis mt-4"><b class="custom-link">Card 1</b></h5>
            <p class="card-text2-dinnis"><span class="custom-link">Clothing, Women</span></p>
            <p class="card-text2-dinnis mt-3"><span class="custom-link">Rs 250</span></p>
          </div>
        </div>
      </div>
    -->




        </div>
    </div>



    <div class="container px-5 py-5" id="products">
        <div class="row pt-5" id="categories">
            <div class="col px-5 py-5">
                <?php include "backend-of-frontend/fetch-categories-part1.php" ?>
                <!-- <div class="col-md-12 mb-5">
          <a style="color:black;" href="index.php">
            <img src="images/section-image3.png" class="img-fluid" alt="Image 3">
          </a>
        </div> -->

            </div>
            <div class="col px-5 py-5">
                <!-- <div class="col-md-12 mb-5">
          <a style="color:black;" href="index.php">
            <img src="images/section-image11.png" class="img-fluid" alt="Image 2">
          </a>
        </div> -->
                <?php include "backend-of-frontend/fetch-categories-part2.php" ?>

            </div>
        </div>
    </div>



    <div class="mx-5 my-5">
        <div id="myUniqueCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myUniqueCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myUniqueCarousel" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slider2image1.png" class="d-block w-100" alt="Los Angeles">
                    <div class="carousel-caption">

                    </div>
                </div>

                <div class="carousel-item">
                    <img src="images/slider2image2.png" class="d-block w-100" alt="Chicago">
                    <div class="carousel-caption">
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myUniqueCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#myUniqueCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    <div style="margin-bottom:100px;margin-top:100px;" class="text-center">
        <h1>NEW COLLECTION</h1>
        <div id="myUniqueCarousel2" class="carousel slide mt-4" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myUniqueCarousel2" data-slide-to="0" class="active"></li>
                <li data-target="#myUniqueCarousel2" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row text-center justify-content-around">
                        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-2">
              <div class="card ">
                <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg"
                  alt="Card 1 Image" style="height:200px;">
                <button type="button" class="btn-dinnis px-3 py-3" style="position:absolute;top:295px;"><a
                    style="color:inherit;text-decoration:none;" class="custom-link px-2 py-2">Add To Cart</a></button>
                <div class="card-body text-center">
                  <h5 class="card-text2-dinnis mt-4"><b>Card 1</b></h5>
                  <p class="card-text2-dinnis">Clothing, Women</p>
                  <p class="card-text2-dinnis mt-3">250 rs</p>
                </div>
              </div>
            </div> -->
                        <?php include "backend-of-frontend/fetch-new-collection.php" ?>

                    </div>
                </div>

                <div class="carousel-item">

                    <div class="row text-center justify-content-around">

                        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-2 ">
              <div class="card">
                <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg"
                  alt="Card 2 Image" style="height:200px;">
                <div class="card-body text-center">
                  <button type="button" class="btn-dinnis px-3 py-3" style="position:absolute;top:295px;"><a
                      style="color:inherit;text-decoration:none;" class="custom-link px-2 py-2">Add To Cart</a></button>
                  <h5 class="card-text2-dinnis mt-4"><b>Card 1</b></h5>
                  <p class="card-text2-dinnis">Clothing, Women</p>
                  <p class="card-text2-dinnis mt-3">250 rs</p>
                </div>
              </div>
            </div> -->
                        <?php include "backend-of-frontend/fetch-new-collection-offset5.php" ?>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myUniqueCarousel2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#myUniqueCarousel2" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 text-center mt-4">
                <img src="images/elsa.jpg" alt="Image 1" class="img-fluid">
                <p style="position:absolute;top:15%;left:10%;color:white;font-size:1.5rem;">ELSA PARTY JEWELLERY</p>
                <p style="position:absolute;top:25%;left:10%;color:white;font-size:1.2rem;">welcome to the website</p>
                <button class="white-button custom-link" style="position:absolute;top:75%;left:10%;color:black;">Shop
                    Now</button>
            </div>
            <div class="col-md-6 text-center mt-4">
                <img src="images/euphoria.jpg" alt="Image 2" class="img-fluid">
                <div style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);">
                    <p style="font-size:3rem;color:white;">Euphoria</p>
                    <button class="black-button custom-link">Shop More</button>
                </div>

            </div>
        </div>
    </div>




    <section class="background-section text-center px-5 py-5 mt-5">
        <h1 class="mb-5">KIND WORDS</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card px-5 py-5">
                        <div class="card-body">
                            <div class="mb-5 text-left">
                                <img src="images/5star.png" size="30">
                                <p class="text-black">Some text for Card 1.</p>
                            </div>
                            <div class="mt-2 text-left">
                                <h5 class="text-black"><b>Monica stone</b></h5>
                                <p class="text-black">Some text for Card 1.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card px-5 py-5">
                        <div class="card-body">
                            <div class="mb-5 text-left">
                                <img src="images/5star.png" size="30">
                                <p class="text-black">Some text for Card 1.</p>
                            </div>
                            <div class="mt-2 text-left">
                                <h5 class="text-black"><b>Monica stone</b></h5>
                                <p class="text-black">Some text for Card 1.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card px-5 py-5">
                        <div class="card-body">
                            <div class="mb-5 text-left">
                                <img src="images/5star.png" size="30">
                                <p class="text-black">Some text for Card 1.</p>
                            </div>
                            <div class="mt-2 text-left">
                                <h5 class="text-black"><b>Monica stone</b></h5>
                                <p class="text-black">Some text for Card 1.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    /*
        <div class="mx-5 text-center">
            <h1 class="mx-3 my-5">instagram</h1>
            <div class="image-grid mt-5">
                <!-- Images at the top -->
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-1.jpg"
                        alt="Image 1" class="img-fluid square-image">
                </div>
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-2.jpg"
                        alt="Image 2" class="img-fluid square-image">
                </div>
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-3.jpg"
                        alt="Image 3" class="img-fluid square-image">
                </div>
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-4.jpg"
                        alt="Image 4" class="img-fluid square-image">
                </div>

                <!-- Images at the bottom -->
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-5.jpg"
                        alt="Image 5" class="img-fluid square-image">
                </div>
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-6.jpg"
                        alt="Image 6" class="img-fluid square-image">
                </div>
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-7.jpg"
                        alt="Image 7" class="img-fluid square-image">
                </div>
                <div class="col">
                    <img src="https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/instagram-gallery-img-8.jpg"
                        alt="Image 8" class="img-fluid square-image">
                </div>
            </div>
        </div>
    */
    ?>

    <?php include "footer.php" ?>

    <!-- Bootstrap JS and jQuery scripts (include at the end of the body for better performance) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function changeImage ( card, newImageSrc ) {
            const image = card.querySelector( 'img' );
            image.src = newImageSrc;
        }

        function restoreImage ( card, originalImageSrc ) {
            const image = card.querySelector( 'img' );
            image.src = originalImageSrc;
        }
    </script>

    <?php include_once "show-alert.php"; ?>
</body>

</html>