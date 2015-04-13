<?php
if ($row['status'] == 'Processed'){
    echo '<td><font color="red"><b>'.($row['status']).'</b></font></td>';
} elseif ($row['status'] == 'On-Delivery') {
    echo '<td><font color="blue"><b>'.($row['status']).'</b></font></td>';
} elseif ($row['status'] == 'Delivered') {
    echo '<td><font color="green"><b>'.($row['status']).'</b></font></td>';
} elseif ($row['status'] == 'Pending') {
    echo '<td><font color="orange"><b>'.($row['status']).'</b></font></td>';
}
?>