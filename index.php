<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Postcode Finder</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <style>
        html {
            height: 100%;
        }
        
        body {
            background: linear-gradient( cyan, transparent), linear-gradient( -45deg, magenta, transparent), linear-gradient( 45deg, yellow, transparent);
            background-repeat: no-repeat;
            background-blend-mode: multiply;
            height: 100%;
            min-height: 100%;
        }

    </style>
</head>

<body>

    <div class="container">
        <h1>Postcode Finder</h1>
        <p>enter a partial adress to get the postcode</p>
        <div id="message"></div>
        <form>
            <fieldset class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter partial address">
            </fieldset>

            <button id="find-postcode" class="btn btn-primary">Submit</button>
        </form>

    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $("#find-postcode").click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURIComponent($('#address').val()) + "&key=AIzaSyB888VqIW7nUfBSeeB6OtwGTyX4xMwTmyM",
                type: "GET",
                success: function(data) {

                    if (data.status == "OK") {

                        $.each(data["results"][0]["address_components"], function(key, value) {

                            if (value["types"][0] == "postal_code")

                                $("#message").html('<div class="alert alert-success" role="alert"><strong>Postcode Found: </strong> the postcode is ' + value['long_name'] + '</div>');

                        })

                    } else {
                        $("#message").html('<div class="alert alert-danger" role="alert"><strong>Postcode cannot be Found - </strong> please try again</div>');
                    }



                }
            });


        })

    </script>

</body>

</html>
