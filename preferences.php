<?php
include('template/header.php');

$completed = file_get_contents('storage/completed.json');
$completed = json_decode($completed, true);
if(empty($completed)) {
    $completed_count = 0;
} else {
    $completed_count = count($completed);
}

$prefs = file_get_contents('storage/settings.json');
$prefs = json_decode($prefs, true);
?>

<link href="static/preferences.css" rel="stylesheet">

<main id="settings">
    <div class="settings-inner">
        <form>
            <div>
                <label class="settings-label">Timezone</label>
                <select name="timezone">
                    <?php foreach(timezone_identifiers_list() as $timezone) { ?>
                    <option <?php if($prefs['timezone'] == $timezone) { echo 'selected'; } ?> value="<?php echo $timezone; ?>"><?php echo $timezone; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label class="settings-label">Color Theme</label>
                <select name="color_theme">
                    <option <?php if($prefs['color_theme'] == 'Light') { echo 'selected '; } ?>>Light</option>
                    <option <?php if($prefs['color_theme'] == 'Dark') { echo 'selected '; } ?>>Dark</option>
                </select>
            </div>
        </form>
    </div>
    <div class="settings-inner">
        <div class="action-buttons">
            <a class="download-completed" href="storage/completed.json" download="completed_tasks.json"><i class="material-icons-sharp">save_alt</i>Download Completed Tasks</a>
            <a class="download-uncompleted" href="storage/tasks.json" download="uncompleted_tasks.json"><i class="material-icons-sharp">save_alt</i>Download Uncompleted Tasks</a>
            <a class="delete-completed" href="delete_completed.php" onclick="return confirm('Are you sure you want to delete your completed tasks?')"><i class="material-icons-sharp">delete</i>Delete <?php echo $completed_count; ?> Completed Tasks</a>
        </div>
    </div>
    <?php if(!empty($completed)) { ?>
    <div class="settings-inner old-tasks">
        <table>
            <thead>
                <tr>
                    <th>Created</th>
                    <th>Task</th>
                    <th>Due</th>
                    <th>Project</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach(array_reverse($completed) as $task) {
                    if(empty($task['due'])) {
                        $due = 'No due date';
                    } else {
                        $due = $task['due'];
                    } ?>
                <tr>
                    <td><?php echo $task['created']; ?></td>
                    <td><?php echo $task['task']; ?></td>
                    <td><?php echo $due; ?></td>
                    <td><?php echo $task['project']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</main>