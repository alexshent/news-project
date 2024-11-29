<?php include $this->resolve("partials/_header.php"); ?>

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
              <a href="/admin/news/<?php echo $item['id'] ?>">Edit</a>
              <a href="/admin/news/remove/<?php echo $item['id'] ?>">Remove</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page - 1 > 0): ?>
                    <li class="page-item"><a class="page-link" href="/admin/news/page/<?php echo $page-1 ?>">Previous</a></li>
                <?php endif; ?>

                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="/admin/news/page/<?php echo $page ?>">
                        <?php echo $page; ?>
                    </a>
                </li>

                <?php if ($totalPages > $page): ?>
                    <li class="page-item"><a class="page-link" href="/admin/news/page/<?php echo $page+1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

</div>

<?php include $this->resolve("partials/_footer.php"); ?>
