<div class="modal fade " id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title text-black align-center" id="loginmodalLabel">Login to codeHub</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-black">
                <form action="Partials/_HandleLogin.php" method="POST">
                    <div class="mb-3"> 
                        <label for="Inputusername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="SignupUsername" name="LoginUsername" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="LoginPassword">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>