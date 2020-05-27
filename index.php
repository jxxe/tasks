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
                    <div class="project red">
                        <i class="material-icons-sharp project-icon">inbox</i>
                        <span class="project-name">Testing project</span>
                    </div>
                    <div class="project orange">
                        <i class="material-icons-sharp project-icon">inbox</i>
                        <span class="project-name">Second project</span>
                    </div>
                </div>
                <div class="labels-list">
                    <div class="label red">
                        <i class="material-icons-sharp label-icon">local_offer</i>
                        <span class="label-name">Label number one</span>
                    </div>
                    <div class="label orange">
                        <i class="material-icons-sharp label-icon">local_offer</i>
                        <span class="label-name">Second label</span>
                    </div>
                </div>
            </div>
            <div class="new-project">
                <form>
                    <i class="material-icons-sharp project-icon">inbox</i>
                    <input type="text" name="project-name" placeholder="New Project">
                </form>
            </div>
            <div class="new-label">
                <form>
                    <i class="material-icons-sharp label-icon">local_offer</i>
                    <input type="text" name="label-name" placeholder="New Label">
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