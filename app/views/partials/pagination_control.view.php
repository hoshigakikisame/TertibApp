<?php
$pagesToShow = 2;

$firstPage = max(1, $currentPage - $pagesToShow);
$lastPage = min($pageCount, $currentPage + $pagesToShow);

$currentPath = explode('?', $_SERVER['REQUEST_URI'])[0];
?>

<nav aria-label="pagination" class="d-flex justify-content-end">
    <ul class="pagination ">
        <?php if ($currentPage > 1): ?>
            <li class="page-item"><a class="page-link" href="<?= $currentPath ?>?page=1">
                    << </a>
            </li>
        <?php endif; ?>
        <li class="page-item <?= $prevPage == null ? 'disabled' : '' ?>"><a id="prev_button" class="page-link" href="<?= $currentPath ?>?page=<?= $prevPage ?>">
                Prev
            </a></li>

        <?php for ($i = $firstPage; $i <= $lastPage; $i++): ?>
            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>"><a class="page-link"
                    href="<?= $currentPath ?>?page=<?= $i ?>">
                    <?= $i ?>
                </a></li>
        <?php endfor; ?>

        <li class="page-item <?= $nextPage == null ? 'disabled' : '' ?>"><a id="next_button" class="page-link"
                href="<?= $currentPath ?>?page=<?= $nextPage ?>">
                Next
            </a></li>
        <?php if ($currentPage < $pageCount): ?>
            <li class="page-item"><a class="page-link" href="<?= $currentPath ?>?page=<?= $pageCount ?>">
                    >>
                </a></li>
        <?php endif; ?>
    </ul>
</nav>