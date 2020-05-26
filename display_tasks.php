<?php
$timezone = file_get_contents('storage/settings.json');
$timezone = json_decode($timezone, true);
$timezone = $timezone['timezone'];
date_default_timezone_set($timezone);

$tasks = file_get_contents('storage/tasks.json');
$tasks = json_decode($tasks, true);

if(!empty($_POST['id'])) {
    foreach($tasks as $key => $task) {
        if($task['id'] == $_POST['id']) {
            $tasks = $tasks[$key];
        }
    }
}
?>

<?php if(empty($_POST['id'])) { ?>
<section id="tasks">
<?php } ?>

    <?php if(!empty($tasks)) {
        foreach($tasks as $item) {
            if(empty($_POST['id'])) {
                $task = $item;
            } else {
                $task = $tasks;
            } ?>
    <div <?php if(!empty($_POST['id'])) { echo 'style="display:none;"'; } ?> data-id="<?php echo $task['id']; ?>" data-order="<?php echo $task['order']; ?>" class="task <?php echo $task['priority'] ?>-priority">
        <div class="task-checkbox-outer">
            <i class="material-icons-sharp sort-handle">drag_indicator</i>
            <button class="task-checkbox"></button>
        </div>
        <h2 class="task-title"><?php echo $task['task']; ?></h2>
        <?php if($task['due'] !== null || $task['labels'] !== null) { ?>
        <div class="task-meta">
            <?php if(!empty($task['due'])) { ?>
            <?php
            $now = new DateTime('now');
            $date = new DateTime($task['due']);
            $time = $now->diff($date);
            if(date('Ymd', strtotime($task['due'])) < date('Ymd')) {
                if($time->days == 1) {
                    $due = $time->days . ' day ago';
                } else {
                    $due = $time->days . ' days ago';
                }
            } else if($time->days <= 7 && $time->days > 1) {
                $due = date('l', strtotime($task['due']));
            } else if($time->y >= 1) {
                $due = date('M j, Y', strtotime($task['due']));
            } else if($time->days = 1) {
                $due = 'Today';
            } else {
                $due = date('M j', strtotime($task['due']));
            }
            ?>
            <span class="task-date<?php if(date('Ymd', strtotime($task['due'])) < date('Ymd')) { echo ' late-task'; } else if($time->days = 1) { echo ' today-task'; } ?>"><?php echo $due; ?></span>
            <?php if($task['alert'] == 'true') { ?>
            <i class="material-icons-sharp">alarm</i>
            <?php } ?>
            <?php } ?>
            <?php if(!empty($task['labels'])) { ?>
            <div class="task-labels">
                <?php foreach($task['labels'] as $label) { ?>
                <span class="task-label"><?php echo $label ?></span>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
    <?php if(!empty($_POST['id'])) {
        break;
     } ?>
    <?php } ?>
    <?php } ?>
<?php if(empty($_POST['id'])) { ?>
</section>
<?php } ?>