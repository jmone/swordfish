<?php
switch ($type){
    case 'success':
        $class = 'alert-success';
        break;
    case 'error':
        $class = 'alert-error';
        break;
    default :
        $class = 'alert-info';
}
?>
            <div class="alert <?php echo $class;?>"><?php echo $message;?></div>
