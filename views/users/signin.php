<?php include_once('models/user_authentication.php'); ?>

<div class="d-flex flex-column gap-4 justify-content-center align-items-center position-relative">
    <div class="signin-cont big p-5 d-flex flex-column align-items-center gap-4">
        <img class="logo" src="/img/logos/DockerEatsLogo.png" alt="DockerEats Logo">
        <h1>Sign in</h1>
        <p>We recommend signing into DockerEats with your personal email address, not your work one that you may already use on Docker.</p>
        <form class="d-flex flex-column gap-3" action="" method="POST">
            <div class="inputDiv position-relative">
                <input class="<?=$emailerror?>" type="email" name="email" id="email" required placeholder=" ">
                <label class="<?=$emailerror?>" for="email">Email address</label>
                <?php if ($emailerror != "") { ?>
                    <span class="errorpopup">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        No user has this email address associated
                    </span>
                <?php } ?>
            </div>

            <div class="inputDiv position-relative">
                <input class="<?=$passworderror?>" type="password" name="password" id="password" required placeholder=" ">
                <label class="<?=$passworderror?>" for="password">Password</label>
                <?php if ($passworderror != "") { ?>
                    <span class="errorpopup">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        Wrong password
                    </span>
                <?php } ?>
                <!-- If possible, add a toggleable "Show password" button here -->
            </div>

            <a href="#">Forgot password?</a>
            <input type="submit" value="Continue">
        </form>
    </div>
    <div class="signin-cont d-flex justify-content-center align-items-center p-3">
        <p>Don't have an account? <a href="#">Sign Up</a></p>
    </div>
    <footer class="mt-auto p-0">
        <ul class="d-flex align-items-center p-0 mt-4">
            <li><a href="/privacy/">Privacy Policy</a></li>
            <li><a href="/termsofservice/">Terms of Service</a></li>
        </ul>
    </footer>
</div>