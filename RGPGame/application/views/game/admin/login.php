        <ol class="breadcrumb">
            <li><a href="/game">Home</a></li>
            <li class="active">Admin</li>
        </ol>

        <form class="form-signin" action="/game/admin_login" method="post">
            <?php if(isset($message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message ?>
                </div>
            <?php endif ?>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Insert your password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>