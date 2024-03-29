<footer class="fdb-block footer-large px-5 py-5 mt-5" style="background-color:#f6f4f2;">
    <div class="row">
        <div class="col-sm-6 text-center">
            <div class="logo-part d-flex justify-content-center align-items-center mb-3">
                <img src="./assets/img/logo.png" alt="Logo" width="60px" class="mr-3 mb-3">
                <h4><b>Silver Star</b></h4>
            </div>
            <nav class="nav flex-row justify-content-center">
                <a class="mb-2 footer-custom-link mx-2"><i style="font-size:24px" class="fa fa-cc-visa"></i></a>
                <a class=" mb-2 footer-custom-link mx-2"><i style="font-size:24px" class="fa fa-cc-mastercard"></i></a>
                <a class=" mb-2 footer-custom-link mx-2"><i style="font-size:24px" class="fa fa-amazon"></i></a>
                <a class=" mb-2 footer-custom-link mx-2"><i style="font-size:24px" class="fa fa-cc-amex"></i></a>
            </nav>
        </div>

        <div class="col-12 col-sm-6">
            <div class="row align-items-top text-center">
                <div class="col-6 col-md-4 mt-5 mt-sm-0  text-sm-left">
                    <nav class="nav flex-column">
                        <a class="mb-2" href="./"><span class="footer-custom-link">Home</span></a>
                        <a class="mb-2" href="./shop"><span class="footer-custom-link">Shop</span></a>
                        <a class="mb-2" href="./about-us"><span class="footer-custom-link">About Us</span></a>
                        <a class="mb-2" href="./contact-us"><span class="footer-custom-link">Contact Us</span></a>
                    </nav>
                </div>

                <div class="col-6 col-md-4 mt-5 mt-sm-0 text-sm-left">
                    <nav class="nav flex-column">
                        <a class="mb-2 footer-custom-link" href="./privacy-policy">Privacy Policy</a>
                        <a class="mb-2 footer-custom-link" href="./refund-policy">Refund Policy</a>
                        <a class="mb-2 footer-custom-link" href="./terms-and-conditons">Terms & Conditions</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4">
    <div class="row mt-3 justify-content-around">
        <div class="col text-left">
            © Copyright 2023 | Silver Star
        </div>
        <div class="col text-right">
            Designed & Developed By
            <a style="color:inherit;" href="https://www.incincmedia.com">
                Incinc Media
            </a>
        </div>
    </div>
</footer>

<script type="text/javascript">
    function changeImage ( card, newImageSrc ) {
        const image = card.querySelector( 'img' );
        image.src = newImageSrc;
    }

    function restoreImage ( card, originalImageSrc ) {
        const image = card.querySelector( 'img' );
        image.src = originalImageSrc;
    }
</script>