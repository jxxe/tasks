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
                    <div class="label-select">
                        <i class="material-icons-sharp">local_offer</i>
                        <label for="2347" class="red">Label number one</label>
                        <input type="checkbox" name="label" id="2347">
                    </div>
                    <div class="label-select">
                        <i class="material-icons-sharp">local_offer</i>
                        <label for="1234" class="orange">Second label</label>
                        <input type="checkbox" name="label" id="1234">
                    </div>
                </div>
                
                <i class="material-icons-sharp toggle-project">inbox</i>
                <select name="project">
                    <option val="inbox" selected>Inbox</option>
                    <option val="82934">Testing project</option>
                    <option val="23454">Second project</option>
                </select>
                
                <i class="material-icons-sharp toggle-link">insert_link</i>
                <input type="hidden" name="link" value="null">
            </div>
            <button class="new-button">Add task</button>
        </div>
    </form>
</section>