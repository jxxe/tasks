<?php include('template/header.php'); ?>
<main id="main">
    <div class="sidebar-outer">
        <div id="sidebar">
            <div class="sidebar-top">
                <div class="inbox-button">
                    <i class="material-icons-sharp">inbox</i>
                    <p>Inbox</p>
                </div>
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
                <form id="new-project-form">
                    <i class="material-icons-sharp project-icon">inbox</i>
                    <input type="text" name="name" placeholder="New Project">
                    <input type="hidden" name="color" value="gray">
                </form>
                <div class="new-project-color-outer">
                    <ul class="new-project-color">
                        <li><i class="material-icons-sharp color-dark-gray" data-color="gray">inbox</i></li>
                        <li><i class="material-icons-sharp color-red" data-color="red">inbox</i></li>
                        <li><i class="material-icons-sharp color-orange" data-color="orange">inbox</i></li>
                        <li><i class="material-icons-sharp color-yellow" data-color="yellow">inbox</i></li>
                        <li><i class="material-icons-sharp color-green" data-color="green">inbox</i></li>
                        <li><i class="material-icons-sharp color-blue" data-color="blue">inbox</i></li>
                        <li><i class="material-icons-sharp color-purple" data-color="purple">inbox</i></li>
                    </ul>
                </div>
            </div>
            <div class="new-label">
                <form id="new-label-form">
                    <i class="material-icons-sharp label-icon">local_offer</i>
                    <input type="text" name="name" placeholder="New Label">
                    <input type="hidden" name="color" value="gray">
                </form>
                <div class="new-label-color-outer">
                    <ul class="new-label-color">
                        <li><i class="material-icons-sharp color-dark-gray" data-color="gray">local_offer</i></li>
                        <li><i class="material-icons-sharp color-red" data-color="red">local_offer</i></li>
                        <li><i class="material-icons-sharp color-orange" data-color="orange">local_offer</i></li>
                        <li><i class="material-icons-sharp color-yellow" data-color="yellow">local_offer</i></li>
                        <li><i class="material-icons-sharp color-green" data-color="green">local_offer</i></li>
                        <li><i class="material-icons-sharp color-blue" data-color="blue">local_offer</i></li>
                        <li><i class="material-icons-sharp color-purple" data-color="purple">local_offer</i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-column">
        <?php include('form.php'); ?>
        <?php include('display_tasks.php'); ?>
    </div>
</main>
<?php include('template/footer.php'); ?>