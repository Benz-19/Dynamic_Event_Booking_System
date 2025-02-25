<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Validate if the user is logged in
if (isset($_SESSION['isLoggedIn'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=600, initial-scale=1">
    <title>Sign in || Sign up from</title>
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/style.css">
    <style>
        .container-main {
            position: relative;
            width: 850px;
            height: 500px;
            background-color: white;
            box-shadow: 25px 30px 55px #5557;
            border-radius: 13px;
            overflow: hidden;
        }

        @media only screen and (max-width: 1000px) {
            .container-main {
                width: 610px;
            }

            h1 {
                text-align: center;
            }

            .overlay {
                display: flex;
                justify-content: space-between;
                text-align: center;
            }

            .overlay-right {
                padding: 0;
            }

            .overlay-right h1 {
                width: 100%;
                margin-inline-start: 100px;
            }

            .overlay-right p {
                margin-inline-start: 100px;
            }

            .overlay-container .overlay .overlay-panel button {
                margin-inline-start: 100px;
            }

            /* overlay left */
            .overlay-left {
                padding: 0;
            }

            .overlay-left h1 {
                width: 100%;
                margin-inline-start: 100px;
                margin-inline-end: 50px;
                font-size: 17px;
            }

            .overlay-left p {
                margin-inline-start: 70px;
                margin-inline-end: 35px;
            }



            #overlayCon .overlay .overlay-left button {
                margin-inline-start: 140px;
                margin-inline-end: 100px;
                width: 100%;
                text-align: center;
            }
        }

        .social-button {
            background: none;
            border: none;
            padding: 10px;
            cursor: pointer;
            display: inline-block;
            font-size: inherit;
            color: inherit;
        }

        .social-button i {
            font-size: 24px;
            color: #3b5998;
        }

        .social-button[name="google-sign-in-btn"] i {
            color: #db4437;
        }

        .social-button[name="google-sign-up-btn"] i {
            color: #db4437;
        }

        .social-button[name="linkedin-sign-in-btn"] i {
            color: #0077b5;
        }

        .social-button:focus {
            outline: none;
        }

        .loader-dots {
            display: flex;
            justify-content: center;
        }

        .dot {
            animation: loading 0.6s infinite alternate;
        }

        @keyframes loading {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.5);
            }
        }
    </style>
</head>

<body>
    <div class="container-main" id="container-main">
        <div class="form-container sign-up-container">
            <form action="<?php echo 'admin.loginAuth.php'; ?>" method="POST">
                <h1>Create Account</h1>
                <div class="infield">
                    <input type="text" placeholder="Full Name" name="signUpFullName" autocomplete="off" />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="Email" name="signUpEmail" autocomplete="off" />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="signUpPassword" autocomplete="off" />
                    <label></label>
                </div>
                <button type="submit" name="sign-up-btn">Sign Up</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form action="" method="POST">
                <h1>Sign in</h1>
                <span>or use your account</span>
                <div class="infield">
                    <input type="email" placeholder="Email" name="signInEmail" autocomplete="off">
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="signInPassword">
                    <label></label>
                </div>
                <button type="submit" name="sign-in-btn">Sign In</button>
            </form>
        </div>

        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Kindly login below if you already have an account!</p>
                    <button>Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Register!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button>Sign Up</button>
                </div>
            </div>
            <button id="overlayBtn"></button>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>