<?php
if ($row['processed'] == 'Processed'){
    echo '<td><font color="red"><b>'.($row['processed']).'</b></font></td>';
} elseif ($row['processed'] == 'On-Delivery') {
    echo '<td><font color="blue"><b>'.($row['processed']).'</b></font></td>';
} elseif ($row['processed'] == 'Delivered') {
    echo '<td><font color="green"><b>'.($row['processed']).'</b></font></td>';
} elseif ($row['processed'] == 'Pending') {
    echo '<td><font color="orange"><b>'.($row['processed']).'</b></font></td>';
}
?>