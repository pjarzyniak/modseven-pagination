<?php
/*
	Show more
*/

use Modseven\HTML;
use Modseven\Pagination\Pagination;

/**
 * @var int|bool $next_page;
 * @var Pagination $page;
 */

?>



<div class="c pagination-out">
    <?php if($next_page): ?>
        <?php
            $id = uniqid();
            echo HTML::anchor(strtolower($page->url($next_page)), __('Pokaż więcej'), ['class'=> 'show-more', 'id' => $id]);
        ?>
        <script>
            $('a#<?=$id;?>').click(function(e) {
                e.preventDefault();
                console.log('show more');
                const $this = $(this);
                $.ajax({
                    url: $this.attr('href')
                }).success(function(data) {
                    $this.parents('.pagination-out').replaceWith(data);
                });
                return false;
            });
        </script>
    <?php endif; ?>
</div>
<!-- .pagination -->