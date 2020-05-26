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
                        <i class="material-icons-sharp project-icon">list</i>
                        <span class="project-name">Testing project</span>
                    </div>
                    <div class="project orange">
                        <i class="material-icons-sharp project-icon">list</i>
                        <span class="project-name">Second project</span>
                    </div>
                </div>
                <div class="labels-list">
                    <div class="label red">
                        <i class="material-icons-sharp label-icon">label</i>
                        <span class="label-name">Label number one</span>
                    </div>
                    <div class="label orange">
                        <i class="material-icons-sharp label-icon">label</i>
                        <span class="label-name">Second label</span>
                    </div>
                </div>
            </div>
            <div class="new-project">
                <form>
                    <i class="material-icons-sharp project-icon">add_circle</i>
                    <input type="text" name="project-name" placeholder="New Project">
                </form>
            </div>
            <div class="new-label">
                <form>
                    <i class="material-icons-sharp label-icon">label</i>
                    <input type="text" name="label-name" placeholder="New Label">
                </form>
            </div>
        </div>
    </div>
    <div class="main-column">
        <section id="new-task">
            <form action="create.php" id="new-task-form" method="POST">
                <div class="new-top">
                    <input required name="task" type="text" placeholder="What needs to be done?">
                </div>
                <div class="new-bottom">
                    <div class="new-meta">
                        <i class="material-icons-sharp toggle-priority">outlined_flag</i>
                        <input type="hidden" name="priority" value="no">
                        <i class="material-icons-sharp toggle-due">insert_invitation</i>
                        <input name="due" type="hidden">
                        <i class="material-icons-sharp toggle-alert">alarm_add</i>
                        <input type="hidden" name="alert" value="false">
                        <i class="material-icons-sharp toggle-label">label</i>
                        <div class="label-selector">
                            <div>
                                <input type="checkbox" name="label" id="2347">
                                <label for="2347" class="red">Label number one</label>
                            </div>
                            <div>
                                <input type="checkbox" name="label" id="1234">
                                <label for="1234" class="orange">Second label</label>
                            </div>
                        </div>
                        <i class="material-icons-sharp toggle-project">list_alt</i>
                        <select name="project">
                            <option val="inbox" selected>Inbox</option>
                            <option val="82934">Testing project</option>
                            <option val="23454">Second project</option>
                        </select>
                    </div>
                    <button class="new-button">Add task (enter)</button>
                </div>
            </form>
        </section>
        <?php include('display_tasks.php'); ?>
    </div>
</main>
<?php include('template/footer.php'); ?>