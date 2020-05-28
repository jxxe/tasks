<?php include('template/header.php'); ?>
<main id="main">
    <div class="sidebar-outer">
        <div id="sidebar">
            <div class="sidebar-top">
                <div class="taxonomy-switcher">
                    <span class="projects-tab active-tab">Projects</span>
                    <span class="labels-tab">Labels</span>
                </div>
                <div class="projects-list">
                    <?php
                    $data = [
                        'type' => 'projects'
                    ]; // Specify the type of 'taxonomy'
                    include('display_taxonomies.php');
                    ?>
                </div>
                <div class="labels-list">
                    <?php
                    $data = [
                        'type' => 'labels'
                    ]; // Specify the type of 'taxonomy'
                    include('display_taxonomies.php');
                    ?>
                </div>
            </div>
            <div class="new-project">
                <form>
                    <i class="material-icons-sharp project-icon">inbox</i>
                    <input type="text" name="project-name" placeholder="New Project">
                    <input type="hidden" name="color" value="red">
                </form>
            </div>
            <div class="new-label">
                <form id="new-label-form">
                    <i class="material-icons-sharp label-icon">local_offer</i>
                    <input type="text" name="name" placeholder="New Label">
                    <input type="hidden" name="color" value="red">
                </form>
            </div>
        </div>
    </div>
    <div class="main-column">
        <?php include('form.php'); ?>
        <?php include('display_tasks.php'); ?>
    </div>
</main>
<?php include('template/footer.php'); ?>