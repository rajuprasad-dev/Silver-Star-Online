// ADD ADMIN USER
$("#admin_registration_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			var message = result;

			if (message == "Failed To Register Please Try Again Later !") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Register Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "Only Images Can Be Uploaded !") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Only Images Can Be Uploaded !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "Admin Already Exist !") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Admin Already Exist !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "Registeration Successful Please Login !") {
				window.location.href = "login";
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Registeration Successful Please Login !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
			}
		},
	});
});

// LOGIN ADMIN USER
$("#admin_login_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	var email = $(".login_email_id").val();

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			var message = result;

			if (message == "Failed To Login Please Try Again Later !") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Login Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "Invalid Password Please Enter Correct Password !") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Invalid Password Please Enter Correct Password !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "Seems Like User Does not Exist !") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Seems Like User Does not Exist !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == email) {
				$.ajax({
					url: "././class/processor.php",
					type: "POST",
					data: "start_user_session=true&email=" + email,
					cache: false,
					processData: false,
					success: function (output) {
						if (output == "Login Successful ! Welcome Admin.") {
							window.location.href = "./";
							var noti =
								"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Login Successful ! Welcome Admin.<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
							$("body").append(noti);
							$(".boot_notify_data").fadeOut(5000);
						}

						if (output == "Failed To Start Admin Session !") {
							var noti =
								"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Start Admin Session !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
							$("body").append(noti);
							$(".boot_notify_data").fadeOut(5000);
						}
					},
				});
			}
		},
	});
});

// UPDATE ADMIN USER
$("#admin_update_profile_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			var message = result;

			if (message == "Only Images Can Be Uploaded !") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Only Images Can Be Uploaded !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (
				message == "Failed To Update Profile Please Try Again Later !"
			) {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update Profile Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "Profile Updated Successfully !") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Profile Updated Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
				location.reload();
			}

			if (
				message ==
				"Provided Email ID is Associated With Another Account !"
			) {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Provided Email ID is Associated With Another Account !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (
				message ==
				"Provided Phone Number is Associated With Another Account !"
			) {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Provided Phone Number is Associated With Another Account !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
		},
	});
});

// LOGOUT USER
$(document).on("click", ".logout_user_btn", function () {
	var logout_id = $(this).attr("logout-id");

	if (confirm("Are You Sure You Want To Logout ?")) {
		$.ajax({
			url: "././class/processor.php",
			type: "POST",
			data: "logout_user_profile=true&logout_id=" + logout_id,
			cache: false,
			processData: false,
			success: function (result) {
				var message = result;

				if (message == "Failed To Logout Please Try Again !") {
					var noti =
						"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Logout Please Try Again !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(8000);
				}
				if (message == "Logout Successful !") {
					var noti =
						"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Logout Successful !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(5000);
					location.reload();
				}
			},
		});
	}
});

var ck_data = [];

// RICH EDITOR
if ($("#rich_editor").length > 0) {
	const watchdog = new CKSource.EditorWatchdog();

	window.watchdog = watchdog;

	watchdog.setCreator((element, config) => {
		return CKSource.Editor.create(element, config).then((editor) => {
			ck_data = editor;
		});
	});

	watchdog.setDestructor((editor) => {
		return editor.destroy();
	});

	watchdog.on("error", handleError);

	watchdog
		.create(document.querySelector("#rich_editor"), {
			toolbar: {
				items: [
					"heading",
					"|",
					"bold",
					"italic",
					"underline",
					"link",
					"alignment",
					"bulletedList",
					"numberedList",
					"strikethrough",
					"subscript",
					"superscript",
					"removeFormat",
					"|",
					"outdent",
					"indent",
					"|",
					"fontColor",
					"fontFamily",
					"fontBackgroundColor",
					"fontSize",
					"horizontalLine",
					"blockQuote",
					"insertTable",
					"mediaEmbed",
					"undo",
					"redo",
				],
			},
			language: "en",
			table: {
				contentToolbar: [
					"tableColumn",
					"tableRow",
					"mergeTableCells",
					"tableCellProperties",
					"tableProperties",
				],
			},
			licenseKey: "",
		})
		.catch(handleError);

	function handleError(error) {}
}

// ADD CATEGORY
$("#add_category_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("add_category", "true");

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Add New Category Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>New Category Added Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});

// EDIT CATEGORY
$("#edit_category_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("edit_category", $(this).data("id"));

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);
			var message = result;

			// $(".message").html(message);

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update Category Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Category Updated Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.replace("manage_categories");
			}
		},
	});
});

// DELETE CATEGORY
$(document).on("click", ".delete_category_btn", function () {
	var category_id = $(this).attr("categories-id");

	if (confirm("This Can't Be Undone Are You Sure You Want to Delete ?")) {
		$.ajax({
			url: "././class/processor.php",
			type: "POST",
			data: "delete_category=true&category_id=" + category_id,
			cache: false,
			processData: false,
			success: function (result) {
				var message = result;

				if (message == "failed") {
					var noti =
						"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Delete Category Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(8000);
				}
				if (message == "success") {
					var noti =
						"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Category Deleted Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(5000);
					location.reload();
				}
			},
		});
	}
});

// ADD SUB-CATEGORY
$("#add_subcategory_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("add_subcategory", "true");

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Add New Sub-Category Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>New Sub-Category Added Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});

// EDIT SUB-CATEGORY
$("#edit_subcategory_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("edit_subcategory", $(this).data("id"));

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);
			var message = result;

			// $(".message").html(message);

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update Sub-Category Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Sub-Category Updated Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.replace("manage_subcategories");
			}
		},
	});
});

// DELETE SUB-CATEGORY
$(document).on("click", ".delete_subcategory_btn", function () {
	var subcategory_id = $(this).attr("subcategories-id");

	if (confirm("This Can't Be Undone Are You Sure You Want to Delete ?")) {
		$.ajax({
			url: "././class/processor.php",
			type: "POST",
			data: "delete_subcategory=true&subcategory_id=" + subcategory_id,
			cache: false,
			processData: false,
			success: function (result) {
				var message = result;

				if (message == "failed") {
					var noti =
						"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Delete Sub-Category Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(8000);
				}
				if (message == "success") {
					var noti =
						"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Sub-Category Deleted Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(5000);
					location.reload();
				}
			},
		});
	}
});

// DISPLAY SUB-CATEGORY BASED ON CATEGORY
$("#product_select_category_name").change(function (e) {
	e.preventDefault();

	var category_id = $(this).val();

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: { category_id: category_id, get_subcategories: true },
		dataType: "JSON",
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);

			var message = result.message;
			var data = result.data;

			// $(".message").html(message);
			// console.log(data);

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update Sub-Category Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				if (data.length > 0) {
					// empty options and add new
					$("#product_select_subcategory_name").empty();
					$("#product_select_subcategory_name").append(
						'<option value="" disabled selected>Select Sub-Category</option>'
					);

					for (var i = 0; i < data.length; i++) {
						var options =
							'<option value="' +
							btoa(data[i].id) +
							'">' +
							data[i].name +
							"</option>";
						$("#product_select_subcategory_name").append(options);
					}
				} else {
					var options =
						'<option value="" disabled selected>No Sub-Category Available</option>';

					$("#product_select_subcategory_name").html(options);
				}
			}
		},
	});
});

// ADD PRODUCT
$("#add_products_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.set("product_details", ck_data.getData());
	formdata.append("add_products", "true");

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Add New Product Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>New Product Added Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});

// UPDATE PRODUCT
$("#update_subcategory_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.set("product_details", ck_data.getData());
	formdata.append("update_products", $(this).attr("data-id"));

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update Product Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Product Updated Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});

// DELETE PRODUCT IMAGES
$(document).on("click", ".delete_product_image_btn", function () {
	var data_id = $(this).attr("data-id");

	if (confirm("This Can't Be Undone Are You Sure You Want to Delete ?")) {
		$.ajax({
			url: "././class/processor.php",
			type: "POST",
			data: "delete_product_image=true&image_id=" + data_id,
			cache: false,
			processData: false,
			success: function (result) {
				var message = result;

				if (message == "failed") {
					var noti =
						"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Delete Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(8000);
				}
				if (message == "success") {
					var noti =
						"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Deleted Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(5000);
					location.reload();
				}
			},
		});
	}
});

// DELETE PRODUCTS
$(document).on("click", ".delete_product_btn", function () {
	var data_id = $(this).attr("product-id");

	if (confirm("This Can't Be Undone Are You Sure You Want to Delete ?")) {
		$.ajax({
			url: "././class/processor.php",
			type: "POST",
			data: "delete_product=true&product_id=" + data_id,
			cache: false,
			processData: false,
			success: function (result) {
				var message = result;

				if (message == "failed") {
					var noti =
						"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Delete Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(8000);
				}
				if (message == "success") {
					var noti =
						"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Deleted Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(5000);
					location.reload();
				}
			},
		});
	}
});

// ADD COUPONS
$("#add_coupon_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("add_coupon", true);

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Add Coupon Code Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "exist") {
				var noti =
					"<div class='boot_notify_data alert alert-warning alert-dismissible fade show' role='alert'>Coupon Code Already Exist !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Coupon Code Added Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});

// DELETE COUPONS
$(document).on("click", ".delete_coupon_btn", function () {
	var coupon_id = $(this).attr("coupon-id");

	if (confirm("This Can't Be Undone Are You Sure You Want to Delete ?")) {
		$.ajax({
			url: "././class/processor.php",
			type: "POST",
			data: "delete_coupon=true&coupon_id=" + coupon_id,
			cache: false,
			processData: false,
			success: function (result) {
				var message = result;

				if (message == "failed") {
					var noti =
						"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Delete Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(8000);
				}
				if (message == "success") {
					var noti =
						"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Deleted Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(5000);
					location.reload();
				}
			},
		});
	}
});

// ADD SLIDER IMAGES
$("#add_slider_images_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Add Slider Images Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "invalid") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Only Images Can Be Uploaded !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Slider Images Added Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});

// DELETE SLIDER IMAGES
$(document).on("click", ".delete_slider_btn", function () {
	var slider_id = $(this).attr("slider-id");

	if (confirm("This Can't Be Undone Are You Sure You Want to Delete ?")) {
		$.ajax({
			url: "././class/processor.php",
			type: "POST",
			data: "delete_slider_image=true&slider_id=" + slider_id,
			cache: false,
			processData: false,
			success: function (result) {
				var message = result;

				if (message == "Failed To Delete Please Try Again Later !") {
					var noti =
						"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Delete Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(8000);
				}
				if (message == "success") {
					var noti =
						"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Deleted Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
					$("body").append(noti);
					$(".boot_notify_data").fadeOut(5000);
					location.reload();
				}
			},
		});
	}
});

// UPDATE ORDER STATUS
const updateStatus = (order_id, status) => {
	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data:
			"update_order_status=true&order_id=" +
			order_id +
			"&status=" +
			status,
		cache: false,
		processData: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-tertiary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update Order Status, Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Order Status Updated Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
};

$(document).on("change", "#update_order_status_select", function () {
	var order_id = $(this).attr("data-id");
	var status = $(this).val();

	updateStatus(order_id, status);
});

$(document).on("click", "#update_order_status", function () {
	var order_id = $(this).attr("data-id");
	var status = $(".order_status_dropdown").val();

	updateStatus(order_id, status);
});

// DISPLAY STOCK
function update_stock_module_toggle(id, stock, product_name) {
	event.preventDefault();

	console.log(product_name);
	console.log(atob(id));
	console.log(atob(stock));

	$("#update_stocks_dataLabel").text(atob(product_name));
	$("#update_stocks_module").attr("data-id", id);
	$("#updated_stock").val(atob(stock));
}

// UPDATE STOCKS
$("#update_stocks_module").on("submit", function (e) {
	e.preventDefault();

	var formdata = new FormData(this);
	formdata.append("update_stocks", $(this).attr("data-id"));

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			var message = result;

			if (message == "failed") {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update Stocks Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}

			if (message == "success") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>Stocks Updated Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});

// UPDATE SITE SETTINGS
$("#update_site_setting").on("submit", function (e) {
	e.preventDefault();

	var setting_name = $(this).attr("data-id");

	var formdata = new FormData(this);
	formdata.append("update_site_setting", setting_name);

	if (setting_name == "Payment Gateway") {
		const payment_gateway_data = {
			test: {
				key: $("#test_api_key").val(),
				token: $("#test_api_token").val(),
			},
			live: {
				key: $("#live_api_key").val(),
				token: $("#live_api_token").val(),
			},
			isTest: $("#is_test_mode").is(":checked") ? true : false,
		};

		// console.log(payment_gateway_data);
		// return;

		formdata.set("site_setting_data", JSON.stringify(payment_gateway_data));
	} else {
		formdata.set("site_setting_data", ck_data.getData());
	}

	$.ajax({
		url: "././class/processor.php",
		type: "POST",
		cache: false,
		processData: false,
		contentType: false,
		data: formdata,
		beforeSend: function () {
			$(".submit_btn").hide();
			$(".btn_group_div_main").append(
				'<button class="status_loader_status btn btn-primary" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Please Wait...</button>'
			);
		},
		complete: function () {
			$(".submit_btn").show();
			$(".status_loader_status").remove();
		},
		success: function (result) {
			// console.log(result);
			// console.log(result['Message']);
			var message = result;

			if (
				message ==
				"Failed To Update " + setting_name + " Please Try Again Later !"
			) {
				var noti =
					"<div class='boot_notify_data alert alert-danger alert-dismissible fade show' role='alert'>Failed To Update " +
					setting_name +
					" Please Try Again Later !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(8000);
			}
			if (message == setting_name + " Updated Successfully !") {
				var noti =
					"<div class='boot_notify_data alert alert-success alert-dismissible fade show' role='alert'>" +
					setting_name +
					" Updated Successfully !<button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button></div>";
				$("body").append(noti);
				$(".boot_notify_data").fadeOut(5000);
				location.reload();
			}
		},
	});
});
