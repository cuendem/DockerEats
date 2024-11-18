<div class="d-flex flex-column gap-4 justify-content-center align-items-center">
    <div class="signin-cont big p-5 d-flex flex-column align-items-center gap-4">
        <img class="logo" src="/img/logos/DockerEatsLogo.png" alt="DockerEats Logo">
        <h1>Sign in</h1>
        <p>We recommend signing into DockerEats with your personal email address, not your work one that you may already use on Docker.</p>
        <form class="d-flex flex-column gap-3" action="" method="post">
            <div class="inputDiv position-relative">
                <input type="text" name="username" id="username" required placeholder=" ">
                <label for="username">Username or email address</label>
            </div>

            <div class="inputDiv position-relative">
                <input type="password" name="password" id="password" required placeholder=" ">
                <label for="password">Password</label>
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
        <ul class="d-flex align-items-center gap-2 p-0">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </ul>
    </footer>
</div>