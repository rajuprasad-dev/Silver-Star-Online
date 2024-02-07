<?php
// print_r($_POST);
// die();

/* including operations class file and security file*/
include('../config/security.php');
include('./operations.php');

// creating instance
$db = new operations();
$db->connect();

// Method of Request
$method = $_SERVER['REQUEST_METHOD'];

// Only post method allowed
if ($method == "POST") {
	// add admin
	if (isset($_POST['add_admin_user_profile']) && isset($_FILES['admin_profile_pic']['name']) && isset($_POST['phone']) && isset($_POST['name']) && isset($_POST['email'])) {
		$admin_profile_pic = $_FILES['admin_profile_pic']['name'];
		$tmp_admin_profile_pic = $_FILES['admin_profile_pic']['tmp_name'];
		$admin_profile_pic_type = $_FILES['admin_profile_pic']['type'];

		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];

		$result = $db->add_admin_user($admin_profile_pic, $tmp_admin_profile_pic, $admin_profile_pic_type, $name, $email, $phone, $password);

		if ($result == "Registeration Successful Please Login !") {
			echo "Registeration Successful Please Login !";
		} elseif ($result == "Only Images Can Be Uploaded !") {
			echo "Only Images Can Be Uploaded !";
		} elseif ($result == "Admin Already Exist !") {
			echo "Admin Already Exist !";
		} elseif ($result == "Failed To Register Please Try Again Later !") {
			echo "Failed To Register Please Try Again Later !";
		}
	}

	// login admin
	if (isset($_POST['login_admin']) && isset($_POST['email']) && isset($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$result = $db->login_admin_user($email, $password);

		if ($result == $email) {
			echo $email;
		} elseif ($result == "Invalid Password Please Enter Correct Password !") {
			echo "Invalid Password Please Enter Correct Password !";
		} elseif ($result == "Seems Like User Does not Exist !") {
			echo "Seems Like User Does not Exist !";
		} elseif ($result == "Failed To Login Please Try Again Later !") {
			echo "Failed To Login Please Try Again Later !";
		}
	}

	// start admin session
	if (isset($_POST['start_user_session']) && isset($_POST['email'])) {
		$email = $_POST['email'];

		$result = $db->start_user_session($email);

		if ($result == "Sessions Created") {
			echo "Login Successful ! Welcome Admin.";
		} elseif ($result == "Couldn't Create Sessions") {
			echo "Failed To Start Admin Session !";
		}
	}

	// edit admin profile
	if (isset($_POST['update_admin_user_profile'])) {
		$admin_profile_pic = !empty($_FILES['admin_profile_pic']['name']) ? $_FILES['admin_profile_pic']['name'] : null;
		$tmp_admin_profile_pic = !empty($_FILES['admin_profile_pic']['tmp_name']) ? $_FILES['admin_profile_pic']['tmp_name'] : null;
		$admin_profile_pic_type = !empty($_FILES['admin_profile_pic']['type']) ? $_FILES['admin_profile_pic']['type'] : null;

		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = !empty($_POST['password']) ? $_POST['password'] : null;

		$result = $db->update_admin_user_profile($admin_profile_pic, $tmp_admin_profile_pic, $admin_profile_pic_type, $name, $email, $phone, $password);

		if ($result == "Profile Updated Successfully !") {
			echo "Profile Updated Successfully !";
		} elseif ($result == "Only Images Can Be Uploaded !") {
			echo "Only Images Can Be Uploaded !";
		} elseif ($result == "Provided Email ID is Associated With Another Account !") {
			echo "Provided Email ID is Associated With Another Account !";
		} elseif ($result == "Provided Phone Number is Associated With Another Account !") {
			echo "Provided Phone Number is Associated With Another Account !";
		} else {
			echo "Failed To Update Profile Please Try Again Later !";
		}
	}

	// logout user
	if (isset($_POST['logout_user_profile']) && isset($_POST['logout_id'])) {
		$logout_id = base64_decode($_POST['logout_id']);

		$result = $db->logout_user_profile($logout_id);

		if ($result == "Session Destroyed") {
			echo "Logout Successful !";
		} else {
			echo "Failed To Logout Please Try Again !";
		}
	}

	// add catetgory
	if (isset($_POST['add_category']) && isset($_POST['category_name']) && isset($_POST['category_bg_color'])) {
		$category_icon = $_FILES['category_icon']['name'];
		$tmp_category_icon = $_FILES['category_icon']['tmp_name'];

		$category_name = $_POST['category_name'];
		$category_color = $_POST['category_bg_color'];

		$result = $db->add_category($category_name, $category_color, $category_icon, $tmp_category_icon);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// edit catetgory
	if (isset($_POST['edit_category']) && isset($_POST['category_name']) && isset($_POST['category_bg_color'])) {
		$category_icon = !empty($_FILES['category_icon']['name']) ? $_FILES['category_icon']['name'] : null;
		$tmp_category_icon = !empty($_FILES['category_icon']['tmp_name']) ? $_FILES['category_icon']['tmp_name'] : null;

		$edit_category = base64_decode($_POST['edit_category']);
		$category_name = $_POST['category_name'];
		$category_color = $_POST['category_bg_color'];

		$result = $db->edit_category($edit_category, $category_name, $category_color, $category_icon, $tmp_category_icon);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// delete catetgory
	if (isset($_POST['delete_category']) && isset($_POST['category_id'])) {
		$category_id = base64_decode($_POST['category_id']);

		$result = $db->delete_category($category_id);

		if ($result == "failed") {
			echo "failed";
		}
		if ($result == "success") {
			echo "success";
		}
	}

	// add subcatetgory
	if (isset($_POST['add_subcategory']) && isset($_POST['category_name']) && isset($_POST['subcategory_name'])) {
		$subcategory_icon = $_FILES['subcategory_icon']['name'];
		$tmp_subcategory_icon = $_FILES['subcategory_icon']['tmp_name'];

		$category_name = $_POST['category_name'];
		$subcategory_name = $_POST['subcategory_name'];

		$result = $db->add_subcategory($category_name, $subcategory_name, $subcategory_icon, $tmp_subcategory_icon);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// edit subcatetgory
	if (isset($_POST['edit_subcategory']) && isset($_POST['category_name']) && isset($_POST['subcategory_name'])) {
		$subcategory_icon = !empty($_FILES['subcategory_icon']['name']) ? $_FILES['subcategory_icon']['name'] : null;
		$tmp_subcategory_icon = !empty($_FILES['subcategory_icon']['tmp_name']) ? $_FILES['subcategory_icon']['tmp_name'] : null;

		$edit_subcategory = base64_decode($_POST['edit_subcategory']);
		$category_name = $_POST['category_name'];
		$subcategory_name = $_POST['subcategory_name'];

		$result = $db->edit_subcategory($edit_subcategory, $category_name, $subcategory_name, $subcategory_icon, $tmp_subcategory_icon);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// delete subcatetgory
	if (isset($_POST['delete_subcategory']) && isset($_POST['subcategory_id'])) {
		$subcategory_id = base64_decode($_POST['subcategory_id']);

		$result = $db->delete_subcategory($subcategory_id);

		if ($result == "failed") {
			echo "failed";
		}
		if ($result == "success") {
			echo "success";
		}
	}

	// get subcatetgory based on category
	if (isset($_POST['get_subcategories']) && isset($_POST['category_id'])) {
		$category_id = base64_decode($_POST['category_id']);

		$result = $db->get_subcategories_by_category($category_id);

		$data = json_encode($result);
		echo $data;
	}

	// add products
	if (isset($_POST['add_products']) && isset($_POST['category_name'])) {
		$product_image = $_FILES['product_image']['name'];
		$tmp_product_image = $_FILES['product_image']['tmp_name'];

		$category_name = base64_decode($_POST['category_name']);
		$subcategory_name = base64_decode($_POST['subcategory_name'] ?? base64_encode("0"));
		$product_name = $_POST['product_name'];
		$product_details = $_POST['product_details'];
		$stock_quantity = $_POST['product_stock_quantity'];
		$product_quantity = $_POST['product_quantity'];
		$quantity_unit = $_POST['product_quantity_unit'];
		$original_price = $_POST['product_original_price'];
		$discount_price = $_POST['product_discount_price'];

		$result = $db->add_products($product_image, $tmp_product_image, $category_name, $subcategory_name, $product_name, $product_details, $stock_quantity, $product_quantity, $quantity_unit, $original_price, $discount_price);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// update products
	if (isset($_POST['update_products']) && isset($_POST['category_name'])) {
		$product_image = !empty(array_filter($_FILES['product_image']['name'])) ? $_FILES['product_image']['name'] : null;
		$tmp_product_image = !empty(array_filter($_FILES['product_image']['tmp_name'])) ? $_FILES['product_image']['tmp_name'] : null;

		$product_id = base64_decode($_POST['update_products']);
		$category_name = base64_decode($_POST['category_name']);
		$subcategory_name = base64_decode($_POST['subcategory_name'] ?? base64_encode("0"));
		$product_name = $_POST['product_name'];
		$product_details = $_POST['product_details'];
		$stock_quantity = $_POST['product_stock_quantity'];
		$product_quantity = $_POST['product_quantity'];
		$quantity_unit = $_POST['product_quantity_unit'];
		$original_price = $_POST['product_original_price'];
		$discount_price = $_POST['product_discount_price'];

		$result = $db->update_products($product_id, $product_image, $tmp_product_image, $category_name, $subcategory_name, $product_name, $product_details, $stock_quantity, $product_quantity, $quantity_unit, $original_price, $discount_price);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
		if ($result == "invalid") {
			echo "invalid";
		}
	}

	// delete product images
	if (isset($_POST['delete_product_image']) && isset($_POST['image_id'])) {
		$image_id = base64_decode($_POST['image_id']);

		$result = $db->delete_product_image($image_id);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// delete product
	if (isset($_POST['delete_product']) && isset($_POST['product_id'])) {
		$product_id = base64_decode($_POST['product_id']);

		$result = $db->delete_product($product_id);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// add products to featured
	if (isset($_POST['add_featured_product']) && isset($_POST['product_type']) && isset($_POST['products_list'])) {
		$products_list = $_POST['products_list'];
		$product_type = $_POST['product_type'];

		$result = $db->add_featured_products($products_list, $product_type);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// remove featured product
	if (isset($_POST['remove_trending_product']) && isset($_POST['product_id'])) {
		$product_id = base64_decode($_POST['product_id']);

		$result = $db->remove_trending_product($product_id);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// add slider images
	if (isset($_FILES['slider_images']['name']) && isset($_POST['add_slider_image'])) {
		$slider_images = $_FILES['slider_images']['name'];
		$tmp_slider_images = $_FILES['slider_images']['tmp_name'];

		$sequence = $_POST['sequence'];

		$result = $db->add_slider_images($slider_images, $tmp_slider_images, $sequence);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
		if ($result == "invalid") {
			echo "invalid";
		}
	}

	// delete slider images
	if (isset($_POST['delete_slider_image']) && isset($_POST['slider_id'])) {
		$slider_id = base64_decode($_POST['slider_id']);

		$result = $db->delete_slider_image($slider_id);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// mark as contacted enquiry data
	if (isset($_POST['mark_enquiry_as_contacted_data']) && isset($_POST['enquiry_id'])) {
		$enquiry_id = base64_decode($_POST['enquiry_id']);

		$result = $db->mark_enquiry_as_contacted($enquiry_id);

		if ($result == "Marked as Contacted Successfully !") {
			echo "Marked as Contacted Successfully !";
		}
		if ($result == "Failed To Mark as Contacted Please Try Again Later !") {
			echo "Failed To Mark as Contacted Please Try Again Later !";
		}
	}

	// delete enquiry data
	if (isset($_POST['delete_enquiry_data']) && isset($_POST['enquiry_id'])) {
		$enquiry_id = base64_decode($_POST['enquiry_id']);

		$result = $db->delete_enquiry_data($enquiry_id);

		if ($result == "Deleted Successfully !") {
			echo "Deleted Successfully !";
		}
		if ($result == "Failed To Delete Please Try Again Later !") {
			echo "Failed To Delete Please Try Again Later !";
		}
	}

	// add deliverable pincode
	if (isset($_POST['add_delivery_pincode']) && isset($_POST['pincode'])) {
		$pincode = $_POST['pincode'];
		$delivery_charges = $_POST['delivery_charges'];
		$expected_delivery_time = $_POST['expected_delivery_time'];

		$result = $db->add_delivery_pincode($pincode, $delivery_charges, $expected_delivery_time);

		if ($result == "exist") {
			echo "exist";
		}
		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// delete deliverable pincode
	if (isset($_POST['delete_delivery_pincode']) && isset($_POST['pincode_id'])) {
		$pincode_id = base64_decode($_POST['pincode_id']);

		$result = $db->delete_delivery_pincode($pincode_id);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// add coupon
	if (isset($_POST['add_coupon']) && isset($_POST['coupon_code']) && isset($_POST['discount_amount']) && isset($_POST['min_cart_value'])) {
		$coupon_code = $_POST['coupon_code'];
		$discount_amount = $_POST['discount_amount'];
		$min_cart_value = $_POST['min_cart_value'];

		$result = $db->add_coupon($coupon_code, $discount_amount, $min_cart_value);

		if ($result == "exist") {
			echo "exist";
		}
		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// delete coupons
	if (isset($_POST['delete_coupon']) && isset($_POST['coupon_id'])) {
		$coupon_id = base64_decode($_POST['coupon_id']);

		$result = $db->delete_coupon($coupon_id);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// update order status
	if (isset($_POST['update_order_status']) && isset($_POST['order_id']) && isset($_POST['status'])) {
		$order_id = base64_decode($_POST['order_id']);
		$status = $_POST['status'];

		$result = $db->update_order_status($order_id, $status);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// assign captain to order
	if (isset($_POST['assign_order_to_captain']) && isset($_POST['order_id']) && isset($_POST['captain']) && isset($_POST['customer']) && isset($_POST['charges'])) {
		$order_id = base64_decode($_POST['order_id']);
		$captain = base64_decode($_POST['captain']);
		$customer = base64_decode($_POST['customer']);
		$charges = $_POST['charges'];

		$result = $db->assign_order_to_captain($order_id, $captain, $customer, $charges);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// add captain
	if (isset($_POST['add_delivery_boy']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['dob']) && isset($_POST['doj']) && isset($_POST['aadhar']) && isset($_POST['pancard']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pincode']) && isset($_POST['vaccination_status']) && isset($_FILES['delivery_boy_image']['name'])) {
		$image = $_FILES['delivery_boy_image'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$dob = $_POST['dob'];
		$doj = $_POST['doj'];
		$aadhar = $_POST['aadhar'];
		$pancard = $_POST['pancard'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$pincode = $_POST['pincode'];
		$vaccination_status = $_POST['vaccination_status'];

		$result = $db->add_delivery_boy($image, $name, $gender, $email, $phone, $dob, $doj, $aadhar, $pancard, $address, $city, $state, $pincode, $vaccination_status);

		if (!in_array($_FILES['delivery_boy_image']['type'], array("image/jpeg", "image/gif", "image/png"))) {
			echo "invalid";
		}

		if ($result == "success") {
			echo "success";
		}

		if ($result == "exist") {
			echo "exist";
		}

		if ($result == "failed") {
			echo "failed";
		}
	}

	// edit captain
	if (isset($_POST['update_delivery_boy']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['dob']) && isset($_POST['doj']) && isset($_POST['aadhar']) && isset($_POST['pancard']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pincode']) && isset($_POST['vaccination_status'])) {
		$id = base64_decode($_POST['update_delivery_boy']);
		$image = !empty($_FILES['delivery_boy_image']['name']) ? $_FILES['delivery_boy_image'] : null;
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$dob = $_POST['dob'];
		$doj = $_POST['doj'];
		$aadhar = $_POST['aadhar'];
		$pancard = $_POST['pancard'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$pincode = $_POST['pincode'];
		$vaccination_status = $_POST['vaccination_status'];

		$result = $db->update_delivery_boy($id, $image, $name, $gender, $email, $phone, $dob, $doj, $aadhar, $pancard, $address, $city, $state, $pincode, $vaccination_status);

		if (!empty($_FILES['delivery_boy_image']['name']) && (!in_array($_FILES['delivery_boy_image']['type'], array("image/jpeg", "image/gif", "image/png")))) {
			echo "invalid";
		}

		if ($result == "success") {
			echo "success";
		}

		if ($result == "exist") {
			echo "exist";
		}

		if ($result == "failed") {
			echo "failed";
		}
	}

	// delete captain
	if (isset($_POST['delete_delivery_boy']) && isset($_POST['id'])) {
		$id = base64_decode($_POST['id']);

		$result = $db->delete_delivery_boy($id);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// complete captain payment
	if (isset($_POST['pay_delivery_boy_income']) && isset($_POST['captain']) && isset($_POST['month']) && isset($_POST['total_delivery']) && isset($_POST['total_earning']) && isset($_POST['payment_mode'])) {
		$captain = base64_decode($_POST['captain']);
		$month = base64_decode($_POST['month']);
		$total_delivery = base64_decode($_POST['total_delivery']);
		$total_earning = base64_decode($_POST['total_earning']);
		$payment_mode = base64_decode($_POST['payment_mode']);

		$result = $db->pay_delivery_boy_income($captain, $month, $total_delivery, $total_earning, $payment_mode);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// update stocks
	if (isset($_POST['update_stocks']) && isset($_POST['updated_stock'])) {
		$id = base64_decode($_POST['update_stocks']);
		$updated_stock = $_POST['updated_stock'];

		$result = $db->update_stocks($id, $updated_stock);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// Update Site Settings
	if (isset($_POST['update_site_setting'])) {
		$setting_name = $_POST['update_site_setting'];
		$setting_data = $_POST['site_setting_data'];

		$result = $db->update_site($setting_name, $setting_data);

		if ($result == "success") {
			echo $setting_name . " Updated Successfully !";
		}
		if ($result == "failed") {
			echo "Failed To Update " . $setting_name . " Please Try Again Later !";
		}
	}

	// Update Payment Methods
	if (isset($_POST['update_payment_method'])) {
		$setting_name = $_POST['update_payment_method'];
		$setting_data = implode(",", $_POST['site_setting_data']);

		$result = $db->update_site($setting_name, $setting_data);

		if ($result == "success") {
			echo $setting_name . " Updated Successfully !";
		}
		if ($result == "failed") {
			echo "Failed To Update " . $setting_name . " Please Try Again Later !";
		}
	}

	// Update app version
	if (isset($_POST['update_app_version'])) {
		$setting_name = $_POST['update_app_version'];
		$setting_data = $_POST['app_version'];

		$result = $db->update_site($setting_name, $setting_data);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

	// Update store status
	if (isset($_POST['update_store_status'])) {
		$setting_name = $_POST['update_store_status'];
		$setting_data = isset($_POST['store_status']) ? 1 : 0;

		$result = $db->update_site($setting_name, $setting_data);

		if ($result == "success") {
			echo "success";
		}
		if ($result == "failed") {
			echo "failed";
		}
	}

} else {
	echo "Method Not Allowed !";
}
$db->disconnect();