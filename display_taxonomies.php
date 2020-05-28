<?php
if(!empty($_POST)) {
    $data = $_POST;
}

$projects = file_get_contents('storage/projects.json');
$projects = json_decode($projects, true);

if(!empty($data['id']) && $data['type'] == 'projects') {
    foreach($projects as $key => $project) {
        if($project['id'] == $data['id']) {
            $projects = array(
                $projects[$key],
            );
            break;
        }
    }
}

$labels = file_get_contents('storage/labels.json');
$labels = json_decode($labels, true);

if(!empty($data['id']) && $data['type'] == 'labels') {
    foreach($labels as $key => $label) {
        if($label['id'] == $data['id']) {
            $labels = array(
                $labels[$key],
            );
            break;
        }
    }
}

if($data['type'] == 'labels' && !empty($labels)) {
    foreach($labels as $label) {
?>

<div <?php if(!empty($data['id'])){ echo 'style="display:none"'; } ?> data-label-id="<?php echo $label['id']; ?>" class="label <?php echo $label['color']; ?>">
    <i class="material-icons-sharp label-icon">local_offer</i>
    <span class="label-name"><?php echo $label['name']; ?></span>
    <i class="material-icons-sharp delete-label">delete</i>
</div>

<?php }} else if($data['type'] == 'projects' && !empty($projects)) {
    foreach($projects as $project) {
?>
    <div <?php if(!empty($data['id'])){ echo 'style="display:none"'; } ?> data-project-id="<?php echo $project['id']; ?>" class="project <?php echo $project['color']; ?>">
        <i class="material-icons-sharp project-icon">inbox</i>
        <span class="project-name"><?php echo $project['name'] ?></span>
        <i class="material-icons-sharp delete-project">delete</i>
    </div>

<?php }} ?>