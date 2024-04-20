<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Mail Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        .gradient-custom {
            background-image: linear-gradient(to top right, #0c0958, #00228d, #07f);
            color: #FFFFFF;
        }
    </style>
</head>
<body>
<!-- OTP Form START ======================= -->
<section class="gradient-custom p-5">
    <div class="container" style="padding: 150px 0px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mx-2">
                <div style="border-radius: 15px;" class="card bg-white p-5">
                    <div class="card-body">

                        <form action="" method="get">

                            <h2 style="text-align: center; ">Your Verification Code</h2>

                            <p style="padding: 24px 0px;text-align: center;">Enter this verification code in field:</p>

                            <div style="text-align: center;margin-bottom: 40px;">
                                <strong style="background: #FFFFFF; padding: 15px 25px; color: #514CA1;border-radius: 15px;font-size: 29px;">
                                    {{$otp}}
                                </strong>
                            </div>


                            <p style="color: #FFFFFF;font-style: italic;text-align: center;">Verification code is valid only for 60 minutes</p>

                            <div style="text-align: center; padding-top: 90px;">
                                <p>thanks,</p>
                                <p>Our SHOP Team</p>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- OTP Form END ========================= -->

</body>
</html>
