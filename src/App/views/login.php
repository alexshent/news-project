<?php include $this->resolve("partials/_header.php"); ?>

<div class="row mt-5 mb-5">

    <form method="POST">

        <?php include $this->resolve('partials/_csrf.php'); ?>

        <div class="mb-3">
            <label for="input-email" class="form-label">Email address</label>
            <input type="email" name="email" placeholder="john@example.com" class="form-control" id="input-email" aria-describedby="emailHelp" value="<?php echo e($oldFormData['email'] ?? ''); ?>">
            <?php if (array_key_exists('email', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['email'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="input-password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="input-password" aria-describedby="passwordHelp">
            <?php if (array_key_exists('password', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['password'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?php include $this->resolve("partials/_footer.php"); ?>
