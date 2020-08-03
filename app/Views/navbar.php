<?php if ($page >1) : ?>

<a href="<?= route_to('view_page', $page - 1) ?>">Previous page</a>
<a href="<?= route_to('view_page', $page + 1) ?>">Next page</a>
<?php else : ?>
<a href="<?= route_to('view_page', $page + 1) ?>">Next page</a>
<?php endif ?>