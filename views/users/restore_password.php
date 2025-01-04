<div class="d-flex flex-column gap-4 justify-content-center align-items-center position-relative sign">
    <div class="sign-cont big p-5 d-flex flex-column align-items-center gap-4">
        <img class="logo" src="/img/logos/DockerEatsLogo.png" alt="DockerEats Logo">
        <h1>Restore password</h1>
        <p>Forgot your password? No problem! Restore it using this page.</p>
        <form class="d-flex flex-column gap-3" action="" method="POST">
            <div class="inputDiv position-relative">
                <input class="<?=$emailerror?>" type="email" name="email" id="email" required placeholder=" " autocomplete="off">
                <label class="<?=$emailerror?>" for="email">Email address</label>
                <?php if ($emailerror != "") { ?>
                    <span class="popup error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        Email address already in use
                    </span>
                <?php } ?>
            </div>

            <div class="inputDiv position-relative">
                <input type="password" name="password" id="password" required placeholder=" " autocomplete="off">
                <label for="password">Password</label>
                <!-- If possible, add a toggleable "Show password" button here -->
            </div>

            <div class="inputDiv position-relative">
                <input class="<?=$passworderror?>" type="password" name="repeatpassword" id="repeatpassword" required placeholder=" " autocomplete="off">
                <label class="<?=$passworderror?>" for="repeatpassword">Repeat password</label>
                <?php if ($passworderror != "") { ?>
                    <span class="popup error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        The passwords don't match
                    </span>
                <?php } ?>
                <!-- If possible, add a toggleable "Show password" button here -->
            </div>

            <div class="inputDiv">
                <input type="submit" value="Continue">
            </div>
        </form>
    </div>
    <div class="sign-cont d-flex justify-content-center align-items-center p-3">
        <p>Suddenly remembered it? <a href="/account/signin">Sign In</a></p>
    </div>
    <footer class="mt-auto p-0">
        <ul class="d-flex align-items-center p-0 mt-4">
            <li><a href="/privacy/">Privacy Policy</a></li>
            <li><a href="/termsofservice/">Terms of Service</a></li>
        </ul>
    </footer>
</div>