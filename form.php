<?php
$labels = file_get_contents('storage/labels.json');
$labels = json_decode($labels, true);

$projects = file_get_contents('storage/projects.json');
$projects = json_decode($projects, true);
?>

<section id="new-task">
    <form action="create.php" id="new-task-form" method="POST">
        <div class="new-top">
            <input required name="task" type="text" placeholder="What needs to get done?">
        </div>
        <div class="new-bottom">
            <div class="new-meta">
                <i class="material-icons-sharp toggle-priority">outlined_flag</i>
                <input type="hidden" name="priority" value="no">

                <i class="material-icons-sharp toggle-due">insert_invitation</i>
                <input name="due" type="hidden">
                <div class="due-selector">
                    <div class="due-calendar"></div>
                </div>

                <i class="material-icons-sharp toggle-alert">alarm_add</i>
                <input type="hidden" name="alert" value="false">
                
                <i class="material-icons-sharp toggle-label" data-tooltip-content=".label-selector">local_offer</i>
                <div class="label-selector">
                    <?php foreach($labels as $label) { ?>
                    <div class="label-select">
                        <i class="material-icons-sharp color-<?php echo $label['color'] ?>">local_offer</i>
                        <label for="<?php echo $label['id']; ?>"><?php echo $label['name']; ?></label>
                        <input type="checkbox" name="label[]" id="<?php echo $label['id']; ?>" value="<?php $label['id']; ?>">
                    </div>
                    <?php } ?>
                </div>
                
                <i class="material-icons-sharp toggle-project">inbox</i>
                <div class="project-selector">
                    <div class="label-select">
                        <i class="material-icons-sharp" style="color:black;">inbox</i>
                        <label for="inbox">Inbox</label>
                        <input type="radio" name="project" id="inbox" value="inbox">
                    </div>
                    <?php foreach($projects as $project) { ?>
                    <div class="label-select">
                        <i class="material-icons-sharp color-<?php echo $label['color'] ?>">inbox</i>
                        <label for="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></label>
                        <input type="radio" name="project" id="<?php echo $project['id']; ?>" value="<?php $project['id']; ?>">
                    </div>
                    <?php } ?>
                </div>
                
                <i class="material-icons-sharp toggle-link">insert_link</i>
                <input type="hidden" name="link" value="null">
            </div>
            <button class="new-button">Add task</button>
        </div>
    </form>
</section>