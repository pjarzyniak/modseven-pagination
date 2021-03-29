<?php
/*
	First Previous 1 2 3 ... 22 23 24 25 26 [27] 28 29 30 31 32 ... 48 49 50 Next Last
*/

use Modseven\Form;
use Modseven\HTML;
use Modseven\Pagination\Pagination;

/**
 * @var int $total_pages
 * @var int $current_page
 * @var Pagination $page
 * @var bool $first_page
 * @var bool $last_page
 */

// Number of page links in the begin and end of whole range
$count_out = ( ! empty($config['count_out'])) ? (int) $config['count_out'] : 3;
// Number of page links on each side of current page
$count_in = ( ! empty($config['count_in'])) ? (int) $config['count_in'] : 5;

// Beginning group of pages: $n1...$n2
$n1 = 1;
$n2 = min($count_out, $total_pages);

// Ending group of pages: $n7...$n8
$n7 = max(1, $total_pages - $count_out + 1);
$n8 = $total_pages;

// Middle group of pages: $n4...$n5
$n4 = max($n2 + 1, $current_page - $count_in);
$n5 = min($n7 - 1, $current_page + $count_in);
$use_middle = ($n5 >= $n4);

// Point $n3 between $n2 and $n4
$n3 = (int) (($n2 + $n4) / 2);
$use_n3 = ($use_middle && (($n4 - $n2) > 1));

// Point $n6 between $n5 and $n7
$n6 = (int) (($n5 + $n7) / 2);
$use_n6 = ($use_middle && (($n7 - $n5) > 1));

// Links to display as array(page => content)
$links = array();

// Generate links data in accordance with calculated numbers
for ($i = $n1; $i <= $n2; $i++)
{
    $links[$i] = $i;
}
if ($use_n3)
{
    $links[$n3] = '&hellip;';
}
for ($i = $n4; $i <= $n5; $i++)
{
    $links[$i] = $i;
}
if ($use_n6)
{
    $links[$n6] = '&hellip;';
}
for ($i = $n7; $i <= $n8; $i++)
{
    $links[$i] = $i;
}

?>


<div>
    <span style=" padding-top: 5px;"><?=__('Found:');?>
        <?php $page->total_items; ?>
  </span>
    <?php $options = array(10 => 10, 25 => 25, 50 => 50, 100 => 100, 500 => 500, 100000 => __('all')); ?>

    <span class="perpage" style="float: right; white-space: nowrap"><?=__('Per page: ');?>
        <?php echo Form::select('perpage', $options, $page->items_per_page, array('id'=>'per','class' => 'form-control', 'style' => 'max-width: 80px; display: block;')); ?>
</div>



<div class="c pagination-out">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="<?php echo strtolower(HTML::chars($page->url($first_page))) ?>">Previous</a></li>
            <?php foreach ($links as $number => $content): ?>
                <?php if ($number === $current_page): ?>
                    <li class="page-item active">
                        <a class="page-link" href="#"><?php echo $number; ?><span class="sr-only"></span></a>
                    </li>
                <?php else: ?>
                    <?php if ($number === 2): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo strtolower(HTML::chars($page->url($number))) ?>"><?php echo $number; ?></a></li>
                    <?php else: ?>
                        <?php if ($number === 2): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo strtolower(HTML::chars($page->url($number))) ?>"><?php echo $number; ?></a></li>
                        <?php endif ?>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>
            <?php if ($last_page !== FALSE): ?>
                <li class="page-item"><a class="page-link" href="<?php echo strtolower(HTML::chars($page->url($last_page))) ?>">Next</a></li>
            <?php else: ?>
                <li class="page-item"></li>
            <?php endif ?>
        </ul>
    </nav>
</div>