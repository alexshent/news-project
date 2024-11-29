<?php include $this->resolve("partials/_header.php"); ?>

<div class="row mt-5 mb-5 text-center fw-bold">
    <p>
    <?php echo e($item['title']) ?>
    </p>
</div>

<div class="row">
    <?php echo e($item['content']) ?>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>
