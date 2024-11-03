<?php 

if ($auth->isLoggedIn() != null) {
    header("Location: /dashboard ");
    exit;
}


include_once PARTIALS . 'header.inc.php' ?>

<nav>
    <h2>Login</h2>
    <h2>Register</h2>
</nav>

<div class="wrapper">
    <div>
        <a href="google-login" class="google-btn">
            <img src="https://developers.google.com/identity/images/btn_google_signin_light_normal_web.png" alt="Google Sign-In Button">
        </a>
    </div>

    <p class="separator">Or</p>

    <div class="login-register">
        <form action="login" method="POST">

            <div>
                <em><?php echo $_SESSION["errors"]["login"]["all"] ?? ''; ?></em>
            </div>

            <div class="input-container">
                <em><?php echo $_SESSION["errors"]["login"]["email"] ?? ''; ?></em>

                <input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION["olds"]["login"]["email"] ?? ''; ?>">
            </div>
            
            <div class="input-container">
                <em><?php echo $_SESSION["errors"]["login"]["password"] ?? ''; ?></em>
                <input type="password" name="password" placeholder="Password" >
            </div>

            <div class="password-message">
                <a data-popup-form-button >Forgot password?</a>
            </div>
            
            <button type="submit">Login</button>
        </form>

        <div id="overlay" class="overlay"></div>
        
        <div class="popup-form" data-popup-form>
            <i class="fa-solid fa-xmark" data-popup-form-close></i>
            <h3>Reset your password</h3>
            <p>We will send you an email that will allow you to reset your password</p>
            <form action="reset-password" method="post">
                <div>
                    <em><?php echo $_SESSION["errors"]["reset-pass"]["email"] ?? ''; ?></em>
                    <input type="email" name="email" placeholder="Your email" value="<?php echo $_SESSION["olds"]["reset-pass"]["email"] ?? ''; ?>">
                </div>

                <button type="submit">Reset password</button>
            </form>
        </div>


        <form action="signup" method="POST">
            
            <div class="input-container">
                <em><?php echo $_SESSION["errors"]["signup"]["name"] ?? ''; ?></em>
                <input type="text" name="name" placeholder="Name" value="<?php echo $_SESSION["olds"]["signup"]["name"] ?? ''; ?>">
            </div>
            
            <div class="input-container">
                <em><?php echo $_SESSION["errors"]["signup"]["email"] ?? ''; ?></em>
                <input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION["olds"]["signup"]["email"] ?? ''; ?>">
            </div>
            
            <div class="input-container">
                <em><?php echo $_SESSION["errors"]["signup"]["password"] ?? ''; ?></em>
                <input type="password" name="password" placeholder="Password" >
            </div>


            <div class="input-container">
                <em><?php echo $_SESSION["errors"]["signup"]["confirm_password"] ?? ''; ?></em>
                <input type="password" name="confirm_password" placeholder="Confirm Password">
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</div>

<?php include_once PARTIALS . 'footer.inc.php' ?>
