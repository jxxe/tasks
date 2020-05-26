$(document).ready(function () {
	$('#settings .settings-inner form').change(function(){
		$.ajax({
			url: 'update_preferences.php',
			method: 'POST',
			data: $('#settings .settings-inner form').serialize(),
			success: function(){
				$('.settings-inner:first-child form').fadeOut(150).fadeIn(150);
			}
		})
	})

    $(".search").click(function () {
        if ($(document).scrollTop() > 100) {
            $("html, body").animate({ scrollTop: 0 }, "fast");
            $('[name="task"]').click();
            $('[name="task"]').focus();
        }
    });
    $(document).scroll(function () {
        if ($(document).scrollTop() > 100) {
            $(".search").attr("placeholder", "What needs to be done?");
        } else {
            $(".search").attr("placeholder", "Search...");
        }

        if ($(document).scrollTop() == 0) {
            $("#header").css("box-shadow", "none");
            $("#header").css("border-bottom", "solid 1px var(--border)");
        } else {
            $("#header").css("box-shadow", "0px 0px 5px 0px rgba(0,0,0,0.25)");
            $("#header").css("border-bottom", "solid 1px white");
        }
    });

    $(".avatar").click(function () {
        $("#account-menu").toggle();
    });

    $(".projects-tab").click(function () {
        $(this).addClass("active-tab");
        $(".labels-tab").removeClass("active-tab");

        $(".labels-list").hide();
        $(".projects-list").show();

        $(".new-label").hide();
        $(".new-project").show();
    });
    $(".labels-tab").click(function () {
        $(this).addClass("active-tab");
        $(".projects-tab").removeClass("active-tab");

        $(".projects-list").hide();
        $(".labels-list").show();

        $(".new-project").hide();
        $(".new-label").show();
    });

    $(".logo.menu").click(function () {
        $(".sidebar-outer").toggleClass("sidebar-shown");
    });

    $("#tasks").click(function () {
        $(".sidebar-outer").toggleClass("sidebar-shown");
    });

    $('[name="task"]').click(function () {
        $("#new-task .new-bottom").addClass("shown");
    });

    $(window).resize(function () {
        if ($(window).width() > 750) {
            $(".sidebar-outer").show();
        }
    });

    $("#tasks").sortable({
        // Make task list draggable
        handle: $(".sort-handle"), // Only drag by handle
        placeholder: "sort-placeholder", // Class for placeholder
        start: function (e, ui) {
            ui.placeholder.height(ui.item.height()); // Height of placeholder equals dragging element
        },
        stop: function () {
            var tasks = $("#tasks").sortable("toArray", {
                attribute: "data-order", // Returns list of attribute 'data-order'
            });
            $.ajax({
                method: "POST",
                url: "order.php",
                data: {
                    order: tasks, // Post orders to order.php
                },
            }).done(function (msg) {
                console.log(msg);
                // reindex order on client side to match server side so additional actions will be synced
                var i = 0; // Orders start at 0
                $("#tasks .task").each(function () {
                    $(this).attr("data-order", i);
                    i++;
                });
            });
        },
    });

    $("#tasks").on("click", ".task .task-checkbox", function () {
        // AJAX complete task
        var parent = $(this).parent().parent();
        $.ajax({
            method: "POST",
            url: "complete.php",
            data: {
                id: parent.attr("data-id"),
            },
        });
        parent.slideUp("fast", function () {
            parent.remove();
        });
    });

    $(".toggle-label").click(function () {
        $(".label-selector").toggle();

        if ($('[name="label"]:checkbox:checked').length > 0) {
            $(".toggle-label").css("color", "black");
        } else {
            $(".toggle-label").css("color", "gray");
        }

        $(".toggle-project").show();
        if ($('[name="project"]').val() !== "Inbox") {
            $(".toggle-project").css("color", "black");
        } else {
            $(".toggle-project").css("color", "gray");
        }
        $(".toggle-due").show();
        if ($('[name="due"]').val()) {
            $(".toggle-due").css("color", "black");
        } else {
            $(".toggle-due").css("color", "gray");
        }
        $('[name="due"]').hide();
        $('[name="project"]').hide();
    });

    $(".toggle-project").click(function () {
        $(this).hide();
        $('[name="project"]').show();

        $(".toggle-due").show();
        if ($('[name="due"]').val()) {
            $(".toggle-due").css("color", "black");
        } else {
            $(".toggle-due").css("color", "gray");
        }
        if ($('[name="label"]:checkbox:checked').length > 0) {
            $(".toggle-label").css("color", "black");
        } else {
            $(".toggle-label").css("color", "gray");
        }
        $('[name="due"]').hide();

        $(".label-selector").hide();
    });

    function enableAlert() {
        $(".toggle-alert").text("alarm_on");
        $(".toggle-alert").css("color", "black");
        $('[name="alert"]').val("true");
    }

    function disableAlert() {
        $(".toggle-alert").text("alarm_add");
        $(".toggle-alert").css("color", "gray");
        $('[name="alert"]').val("false");
    }

    $('[name="due"]').datepicker({
        onSelect: function () {
            if ($('[name="due"]').val()) {
                $(".toggle-due").css("color", "black");
                $(".toggle-due").text("event_busy");
                $(".toggle-alert").show();
                enableAlert();
            } else {
                $(".toggle-due").css("color", "gray");
                $(".toggle-due").text("insert_invitation");
            }
        },
    });

    $(".toggle-due").click(function () {
        if ($('[name="due"]').val()) {
            $(".toggle-due").css("color", "gray");
            $(".toggle-due").text("insert_invitation");
            $('[name="due"]').val("");
            disableAlert();
            $(".toggle-alert").hide();
        } else {
            $('[name="due"]').show().focus().hide();
            $(".toggle-due").click();
        }
    });

    $(".toggle-alert").click(function () {
        if ($('[name="alert"]').val() == "true") {
            disableAlert();
        } else {
            enableAlert();
        }
    });

    $(".toggle-priority").click(function () {
        // Cycle through priorities with flag icon
        var priority = $('[name="priority"]').val();
        if (priority == "no") {
            // If hidden input is no (default), change to next level
            $('[name="priority"]').val("low");
            $(".toggle-priority").css("color", "var(--yellow)");
            $(".toggle-priority").text("flag");
        } else if (priority == "low") {
            // Next priority level
            $('[name="priority"]').val("medium");
            $(".toggle-priority").css("color", "var(--orange)");
            $(".toggle-priority").text("flag");
        } else if (priority == "medium") {
            // Next priority level
            $('[name="priority"]').val("high");
            $(".toggle-priority").css("color", "var(--red)");
            $(".toggle-priority").text("flag");
        } else if (priority == "high") {
            // Reset to first priority level
            $('[name="priority"]').val("no");
            $(".toggle-priority").css("color", "gray");
            $(".toggle-priority").text("outlined_flag");
        }
    });
});

$(document).ready(function () {
    // AJAX new task
    $("#new-task-form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "create.php",
            data: form.serialize(),
            success: function (msg) {
                var id = msg;
                $.ajax({
                    method: "POST",
                    data: {
                        id: id,
                    },
                    url: "display_tasks.php",
                    success: function (response) {
                        $("#tasks").prepend(response);
                        $("#new-task-form").trigger("reset");
                        $('[data-id="' + id + '"]').slideDown("fast");
                        var i = 0;
                        $("#tasks .task").each(function () {
                            $(this).attr("data-order", i);
                            i++;
                        });
                    },
                });
            },
        });
    });
});
