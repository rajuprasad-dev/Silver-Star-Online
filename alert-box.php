<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <button id="showAlert" class="btn btn-primary">Show Alert</button>

    <!-- Bootstrap notification-like modal -->
    <div class="modal fade" id="alertModal" data-backdrop="false" style="top: 0px; transform: translateX(-50%); left: 50%;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    product Added to cart
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show the alert as a modal
        function showAlert() {
            $('#alertModal').modal('show');
            setTimeout(function() {
                $('#alertModal').modal('hide');
            }, 3000);
        }

        // Event listener for keypress
        document.addEventListener("keydown", function(event) {
            if (event.key === "a") {
                showAlert();
            }
        });

        // Event listener for button click
        document.getElementById("showAlert").addEventListener("click", showAlert);
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
