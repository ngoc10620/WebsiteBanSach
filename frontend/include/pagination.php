<div id="pagination">
<?php
if ($current_page > 5) {
    $first_page = 1;
    ?>
    <a class="page-item" href="?<?=$param?>&page=<?= $first_page ?>">Trang đầu</a>
    <?php
}
if ($current_page > 1) {
    $prev_page = $current_page - 1;
    ?>
    <a class="page-item" href="?<?=$param?>&page=<?= $prev_page ?>">Trang trước</a>
<?php }
?>
<?php for ($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if ($num != $current_page) { ?>
        <?php if ($num > $current_page - 5 && $num < $current_page + 5) { ?>
            <a class="page-item" href="?<?=$param?>&page=<?= $num ?>"><?= $num ?></a>
        <?php } ?>
    <?php } else { ?>
        <strong class="current-page page-item"><?= $num ?></strong>
    <?php } ?>
<?php } ?>
<?php
if ($current_page < $totalPages - 1) {
    $next_page = $current_page + 1;
    ?>
    <a class="page-item" href="?<?=$param?>&page=<?= $next_page ?>">Trang sau</a>
<?php
}
if ($current_page < $totalPages - 5) {
    $end_page = $totalPages;
    ?>
    <a class="page-item" href="?<?=$param?>&page=<?= $end_page ?>">Trang cuối</a>
    <?php
}
?>
</div>