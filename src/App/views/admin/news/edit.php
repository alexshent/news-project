<?php include $this->resolve("partials/_header.php"); ?>

<div class="row mt-5 mb-5">
    <form method="POST" class="">

        <?php include $this->resolve("partials/_csrf.php"); ?>

        <div class="mb-3">
            <label for="input-title" class="form-label">Title</label>
            <input value="<?php echo e($news['title'] ?? ''); ?>" name="title" type="text" class="form-control" id="input-title" />
            <?php if (array_key_exists('title', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['title'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="ta-short-description" class="form-label">Short Description</label>
            <textarea name="short_description" id="ta-short-description" class="form-control"><?php echo e($news['short_description'] ?? ''); ?></textarea>
            <?php if (array_key_exists('short_description', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['short_description'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="ta-content" class="form-label">Content</label>
            <textarea name="content" id="ta-content" class="form-control"><?php echo e($news['content'] ?? ''); ?></textarea>
            <?php if (array_key_exists('content', $errors)) : ?>
                <div class="text-danger">
                    <?php echo e($errors['content'][0]); ?>
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>
