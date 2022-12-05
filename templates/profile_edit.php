<?php
session_start();

if (!isset($_SESSION["profile"])) {?>
<script>
window.location.href = './profile_edit/profile_edit_handle.php';
</script>
<?php }
$_SESSION['last_url'] = "{$_SERVER['PHP_SELF']}";
?>

<script>
var exports = {};
</script>

<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>WannaGo &raquo; Profile &raquo; Edit</title>

    <link href="../static/images/icon/icon.svg" rel="icon" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script src="../scripts/index_nav.html.js"></script>
    <script src="../scripts/include_HTML.js"></script>
    <script src="../scripts/croppie.js"></script>

    <link href="../static/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        <div include-html="index/navbar.php">
        </div>

        <div include-html="profile_edit/topic.php">
        </div>
    </header>

    <main>
        <div include-html="profile_edit/content.php">
        </div>
    </main>

    <footer>
        <div include-html="index/footer.html">
        </div>
    </footer>
</body>

</html>

<script>
includeHTML();

// image crop jquery from https://youtu.be/pVatkCgU-Rg
$(document).ready(function() {
    $('#modal-show-message').modal('show');

    $image_crop = $('#icon-upload').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload-image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#modal-upload-icon').modal('show');
    });

    $('.crop_image').click(function(event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            $.ajax({
                url: "./profile_edit/icon_edit/icon_form_handle.php",
                type: "POST",
                data: {
                    "image": response
                },
                success: function(data) {
                    $('#modal-upload-icon').modal('hide');
                    $('#uploaded-image').html(data);
                }
            });
        })
    });
});
</script>

<?php
include './profile_edit/icon_edit/icon_form.php';
include './profile_edit/icon_edit/icon_form_crop.php';