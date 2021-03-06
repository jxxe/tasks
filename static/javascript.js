$(document).ready(function(){

// Enable alert
function enableAlert() {
	$(".toggle-alert").text("alarm_on");
	$(".toggle-alert").css("color", "black");
	$('[name="alert"]').val("true");
}

// Disable alert
function disableAlert() {
	$(".toggle-alert").text("alarm_add");
	$(".toggle-alert").css("color", "gray");
	$('[name="alert"]').val("false");
}

// Update Settings
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

// Replace Search with New Task
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

// Account Menu
tippy('.avatar', {
	content: $('.account-menu-outer').html(),
	trigger: 'click',
	duration: '250',
	allowHTML: true,
	animation: 'shift-away',
	interactive: true,
	placement: 'bottom-end',
	theme: 'custom',
	zIndex: 101
})

// Switch Between Projects & Labels
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

// Show/Hide Sidebar on Mobile
$(".logo.menu").click(function () {
	$(".sidebar-outer").toggleClass("sidebar-shown");
});

$(window).resize(function () {
	if ($(window).width() > 750) {
		$(".sidebar-outer").show();
	}
});

// Reorder Tasks
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
			console.log(tasks);
			// reindex order on client side to match server side so additional actions will be synced
			var i = 0; // Orders start at 0
			$("#tasks .task").each(function () {
				$(this).attr("data-order", i);
				i++;
			});
		});
	},
});

// Complete Task
$("#tasks").on("click", ".task .task-checkbox", function () {
	var parent = $(this).parent().parent();
	$.ajax({
		method: "POST",
		url: "complete.php",
		data: {
			id: parent.attr("data-id"),
		},
	});
	parent.slideUp("fast", function () { // Animate hide
		parent.remove(); // Remove from DOM
	});
});

/* NEW TASK FORM */

// Project Selector
tippy('.toggle-project', {
	content: $('.project-selector').html(),
	trigger: 'click',
	duration: '250',
	allowHTML: true,
	animation: 'shift-away',
	interactive: true,
	placement: 'bottom',
	theme: 'custom',
	zIndex: 10,
	onHide: function(){
		if($([name="project"]).val() !== 'inbox') {
			$('.toggle-project').css('color', 'black');
		} else {
			$('.toggle-project').css('color', 'gray');
		}
	}
});

// Show meta buttons
$('[name="task"]').click(function () {
	$("#new-task .new-bottom").addClass("shown");
});

$(".toggle-due").click(function () {
	if ($('[name="due"]').val()) {
		$(".toggle-due").css("color", "gray");
		$(".toggle-due").text("insert_invitation");
		$('[name="due"]').val("");
		disableAlert();
		$(".toggle-alert").hide();
		$('.tippy-content .due-calendar').datepicker('setDate', null);
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

// Priority Picker
$(".toggle-priority").click(function () {
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


/* // Label Selector
$(".toggle-label").click(function () {
	$(".label-selector").fadeToggle('fast');

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
}); */


// Tooltips
tippy('.toggle-label', {
	content: $('.label-selector')[0].innerHTML,
	trigger: 'click',
	duration: '250',
	allowHTML: true,
	animation: 'shift-away',
	interactive: true,
	placement: 'bottom',
	theme: 'custom',
	zIndex: 10,
	onHide: function(){
		if ($('[name="label"]:checkbox:checked').length > 0) {
			$(".toggle-label").css("color", "black");
		} else {
			$(".toggle-label").css("color", "gray");
		}
	}
})

tippy('.toggle-due', {
	content: $('.due-selector')[0].innerHTML,
	trigger: 'click',
	duration: '250',
	allowHTML: true,
	animation: 'shift-away',
	interactive: true,
	placement: 'bottom',
	theme: 'custom',
	zIndex: 10,
	onShown: function(){
		$('.tippy-content .due-calendar').datepicker({
			altField: '[name="due"]',
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
		$(document).scrollTop($(document).scrollTop() + 1);
		$(document).scrollTop($(document).scrollTop() - 1);
	},
	onHide: function(){
		if ($('[name="label"]:checkbox:checked').length > 0) {
			$(".toggle-label").css("color", "black");
		} else {
			$(".toggle-label").css("color", "gray");
		}
	}
})

// Create Label
$("#new-label-form").submit(function (e) {
	e.preventDefault();
	var form = $(this);
	$.ajax({
		type: "POST",
		url: "create_label.php",
		data: form.serialize(),
		success: function (msg) {
			var id = msg;
			$.ajax({
				method: "POST",
				data: {
					id: id,
					type: 'labels'
				},
				url: "display_taxonomies.php",
				success: function (response) {
					$(".labels-list").append(response);
					
					$("#new-label-form").trigger("reset");
					$('#new-label-form [name="color"]').val('gray');
					$('#new-label-form i').css('color', 'var(--gray)');
					
					$('[data-label-id="' + id + '"]').slideDown("fast");
				},
			});
		},
	});
});

const labelColorTooltip = tippy('.new-label .label-icon', {
	content: $('.new-label-color-outer')[0].innerHTML,
	trigger: 'click',
	duration: '250',
	allowHTML: true,
	animation: 'shift-away',
	interactive: true,
	placement: 'top-end',
	theme: 'custom',
	zIndex: 10,
	onHide: function(){
		$('.new-label .label-icon').css('color', 'var(--' + $('.new-label form [name="color"]').val() + ')');
	}
});

$('body').on('click', '.new-label-color i', function(){
	var labelColorValue = $(this).attr('data-color');
	$('.new-label form [name="color"]').val(labelColorValue);
	labelColorTooltip[0].hide();
});

// Create Project
$("#new-project-form").submit(function (e) {
	e.preventDefault();
	var form = $(this);
	$.ajax({
		type: "POST",
		url: "create_project.php",
		data: form.serialize(),
		success: function (msg) {
			var id = msg;
			$.ajax({
				method: "POST",
				data: {
					id: id,
					type: 'projects'
				},
				url: "display_taxonomies.php",
				success: function (response) {
					$(".projects-list").append(response);

					$("#new-project-form").trigger("reset");
					$('#new-project-form [name="color"]').val('gray');
					$('#new-project-form i').css('color', 'var(--gray)');
					
					$('[data-project-id="' + id + '"]').slideDown("fast");
				},
			});
		},
	});
});

const projectColorTooltip = tippy('.new-project .project-icon', {
	content: $('.new-project-color-outer')[0].innerHTML,
	trigger: 'click',
	duration: '250',
	allowHTML: true,
	animation: 'shift-away',
	interactive: true,
	placement: 'top-end',
	theme: 'custom',
	zIndex: 10,
	onHide: function(){
		$('.new-project .project-icon').css('color', 'var(--' + $('.new-project form [name="color"]').val() + ')');
	}
});

$('body').on('click', '.new-project-color i', function(){
	var projectColorValue = $(this).attr('data-color');
	$('.new-project form [name="color"]').val(projectColorValue);
	projectColorTooltip[0].hide();
});

// Delete Projects & Labels
$('body').on('click', '.delete-project', function(){
	var id = $(this).parent().attr('data-project-id');
	$.ajax({
		method: 'POST',
		url: 'delete_tax.php',
		data: {
			id: id,
			type: 'project'
		},
		success: function(){
			$('[data-project-id="' + id + '"]').slideUp('fast', function(){
				$(this).remove();
			})
		}
	})
})

$('body').on('click', '.delete-label', function(){
	var id = $(this).parent().attr('data-label-id');
	$.ajax({
		method: 'POST',
		url: 'delete_tax.php',
		data: {
			id: id,
			type: 'label'
		},
		success: function(){
			$('[data-label-id="' + id + '"]').slideUp('fast', function(){
				$(this).remove();
			})
		}
	})
})

})