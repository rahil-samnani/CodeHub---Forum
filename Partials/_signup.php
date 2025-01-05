<div class="modal fade " id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title text-black align-center" id="signupmodalLabel">Sign up to codeHub</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-black">
                <form action="Partials/_HandleSignup.php" method="POST">
                    <div class="mb-3">
                        <label for="Inputusername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="SignupUsername" name="SignupUsername" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="InputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="SignupEmail" name="SignupEmail" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="SignupPassword" name="SignupPassword">
                    </div>
                    <div class="mb-3">
                        <label for="InputcPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="SignupcPassword" name="SignupcPassword">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>