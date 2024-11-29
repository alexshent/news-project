<?php include $this->resolve("partials/_header.php"); ?>

<div class="row mt-5 mb-5">
    <form method="POST">

        <?php include $this->resolve('partials/_csrf.php'); ?>

        <div class="mb-3">
            <label for="input-email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="input-email" aria-describedby="emailHelp" value="<?php echo e($oldFormData['email'] ?? ''); ?>" placeholder="john@example.com">
            <?php if (array_key_exists('email', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['email'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="select-country" class="form-label">Country</label>
            <select name="country" class="form-control" id="select-country">
                <option value="USA">USA</option>
                <option value="Canada" <?php echo $oldFormData['country'] === 'Canada' ? 'selected' : ''; ?>>Canada</option>
                <option value="Ukraine" <?php echo $oldFormData['country'] === 'Ukraine' ? 'selected' : ''; ?>>Ukraine</option>
            </select>
            <?php if (array_key_exists('country', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['country'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="input-password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="input-password">
            <?php if (array_key_exists('password', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['password'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="input-password2" class="form-label">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control" id="input-password2">
            <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['confirmPassword'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="tos" class="form-check-input" id="input-tos" <?php echo $oldFormData['tos'] ?? false ? 'checked' : ''; ?>>
            <label class="form-check-label" for="input-tos">I accept the terms of service.</label>
            <?php if (array_key_exists('tos', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['tos'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>
