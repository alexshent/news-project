<?php include $this->resolve("partials/_header.php"); ?>

<div class="row mt-5">
<form method="post" class="d-flex" role="search">
    <?php include $this->resolve('partials/_csrf.php'); ?>

    <input type="datetime-local" name="datetime" id="input-datetime" />

    <input id="input-search" class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">

    <button class="btn btn-outline-success" type="submit">Search</button>

    <button type="reset" class="btn btn-outline-danger ms-3" id="reset-button">Reset</button>
</form>
</div>

<?php
$filterDatetime = '';
if (isset($_SESSION['filters']['datetime'])) {
    $filterDatetime = $_SESSION['filters']['datetime'];
}

$filterSearch = '';
if (isset($_SESSION['filters']['search'])) {
    $filterSearch = $_SESSION['filters']['search'];
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const filterDatetime = '<?php echo $filterDatetime ?>';
        const filterSearch = '<?php echo $filterSearch ?>';

        const filterDatetimeInput = document.getElementById('input-datetime');
        const filterSearchInput = document.getElementById('input-search');
        const resetButton = document.getElementById('reset-button');

        filterDatetimeInput.value = filterDatetime;
        filterSearchInput.value = filterSearch;

        resetButton.addEventListener('click', (event) => {
            filterDatetimeInput.value = '';
            filterSearchInput.value = '';
        });
    });
</script>

<div class="row mb-5 mt-5">

    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>short_description</th>
            <th>content</th>
            <th>created_at</th>
            <th>action</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo $item['id'] ?></td>
                <td><?php echo $item['title'] ?></td>
                <td><?php echo $item['short_description'] ?></td>
                <td><?php echo $item['content'] ?></td>
                <td><?php echo $item['created_at'] ?></td>
                <td>
                    <a href="/news/<?php echo $item['id'] ?>">View Details</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page - 1 > 0): ?>
                    <li class="page-item"><a class="page-link" href="/news/page/<?php echo $page-1 ?>">Previous</a></li>
                <?php endif; ?>

                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="/news/page/<?php echo $page ?>">
                        <?php echo $page; ?>
                    </a>
                </li>

                <?php if ($totalPages > $page): ?>
                    <li class="page-item"><a class="page-link" href="/news/page/<?php echo $page+1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

</div>

<?php include $this->resolve("partials/_footer.php"); ?>
