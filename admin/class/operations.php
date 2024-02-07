<?php
session_start();
include("../config/conn.php");

class operations extends database
{
	// main variables
	private $date_time;
	private $session_user;

	// site setting variables
	private $setting_name;
	private $setting_data;

	// register admin user function
	public function add_admin_user($admin_profile_pic, $tmp_admin_profile_pic, $admin_profile_pic_type, $name, $email, $phone, $password)
	{
		// profile pic file
		$this->admin_profile_pic = $admin_profile_pic;
		$this->tmp_admin_profile_pic = $tmp_admin_profile_pic;
		$this->admin_profile_pic_type = $admin_profile_pic_type;

		// Valid extension
		$valid_ext = array('png', 'jpeg', 'jpg', 'gif');

		// checking extention validation
		$file_extension = pathinfo($this->admin_profile_pic, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);

		// exploding profile pic for renaming
		$admin_profile_pic_ext = explode(".", $this->admin_profile_pic);

		$new_admin_profile_pic = md5($name . $email . date("d-m-Y-h")) . '_admin_profile_pic' . '.' . end($admin_profile_pic_ext);

		$admin_profile_pic_path = "../assets/images/profile_pic/";

		$this->name = parent::clean($name);
		$this->email = parent::clean($email);
		$this->phone = parent::clean($phone);
		$this->password = sha1("salt_iyer_added553xcddd89" . parent::clean($password) . "bxfvf5vxv5x6553xcddd89");

		$this->date_time = date("d-m-Y h:i:s a");
		$unique_id = rand(time(), 100000000);

		$check_user = "SELECT * FROM admin WHERE email = '$this->email' OR phone = '$this->phone'";
		if (parent::sql($check_user)) {
			if (parent::numrows() == 0) {
				parent::result();
				if (in_array($file_extension, $valid_ext)) {
					$sql = "INSERT INTO `admin` (`unique_id`,`photo`, `name`, `email`, `phone`, `password`, `date_time`) VALUES ('$unique_id', '$new_admin_profile_pic', '$this->name', '$this->email', '$this->phone', '$this->password', '$this->date_time')";

					if (parent::sql($sql)) {
						parent::compressImage($new_admin_profile_pic, $this->tmp_admin_profile_pic, $this->admin_profile_pic_type, $admin_profile_pic_path);

						return "Registeration Successful Please Login !";
					} else {
						return "Failed To Register Please Try Again Later !";
					}
				} else {
					echo "Only Images Can Be Uploaded !";
				}
			} else {
				echo "Admin Already Exist !";
			}
		} else {
			return "Failed To Register Please Try Again Later !";
		}
	}

	// login admin user function
	public function login_admin_user($email, $password)
	{
		$this->email = parent::clean($email);
		$this->password = sha1("salt_iyer_added553xcddd89" . parent::clean($password) . "bxfvf5vxv5x6553xcddd89");

		$this->date_time = date("d-m-Y h:i:s a");

		$check_user = "SELECT * FROM admin WHERE email = '$this->email'";
		if (parent::sql($check_user)) {
			if (parent::numrows() == 1) {
				parent::result();
				$sql = "SELECT * FROM admin WHERE email = '$this->email' AND password = '$this->password'";

				if (parent::sql($sql)) {
					if (parent::numrows() == 1) {
						return $this->email;
					} else {
						return "Invalid Password Please Enter Correct Password !";
					}
				} else {
					return "Failed To Login Please Try Again Later !";
				}
			} else {
				echo "Seems Like User Does not Exist !";
			}
		} else {
			return "Failed To Login Please Try Again Later !";
		}
	}

	// starting user session function
	public function start_user_session($email)
	{
		$this->email = parent::clean($email);

		// creating sessions
		$_SESSION['admin_login'] = true;
		$_SESSION['admin_email'] = $email;

		// checking if session is created
		if ($_SESSION['admin_email'] == true) {
			return "Sessions Created";
		} else {
			return "Couldn't Create Sessions";
		}
	}

	// logout user function
	public function logout_user_profile($email)
	{
		unset($_SESSION['admin_login']);
		unset($_SESSION['admin_email']);
		return "Session Destroyed";
	}

	// update admin user profile function
	public function update_admin_user_profile($admin_profile_pic, $tmp_admin_profile_pic, $admin_profile_pic_type, $name, $email, $phone, $password)
	{
		if (!empty($admin_profile_pic) && !empty($tmp_admin_profile_pic) && !empty($admin_profile_pic_type)) {
			// profile pic file
			$this->admin_profile_pic = $admin_profile_pic;
			$this->tmp_admin_profile_pic = $tmp_admin_profile_pic;
			$this->admin_profile_pic_type = $admin_profile_pic_type;

			// Valid extension
			$valid_ext = array('png', 'jpeg', 'jpg', 'gif');

			// checking extention validation
			$file_extension = pathinfo($this->admin_profile_pic, PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);

			// exploding profile pic for renaming
			$admin_profile_pic_ext = explode(".", $this->admin_profile_pic);

			$new_admin_profile_pic = md5($name . $email . date("d-m-Y-h")) . '_admin_profile_pic' . '.' . end($admin_profile_pic_ext);

			$admin_profile_pic_path = "../assets/images/profile_pic/";
		}

		$this->name = parent::clean($name);
		$this->email = parent::clean($email);
		$this->phone = parent::clean($phone);

		if (!empty($password)) {
			$this->password = sha1("salt_iyer_added553xcddd89" . parent::clean($password) . "bxfvf5vxv5x6553xcddd89");
		}

		$this->date_time = date("d-m-Y h:i:s a");

		$check_user_email = "SELECT * FROM admin WHERE email = '$this->email'";
		parent::sql($check_user_email);
		parent::result();

		if (parent::numrows() <= 1) {
			$check_user_phone = "SELECT * FROM admin WHERE phone = '$this->phone'";
			parent::sql($check_user_phone);
			parent::result();

			if (parent::numrows() <= 1) {
				if (!empty($admin_profile_pic) && !empty($tmp_admin_profile_pic) && !empty($admin_profile_pic_type) && !empty($password)) {
					if (in_array($file_extension, $valid_ext)) {
						$previous_file = "SELECT * FROM admin WHERE email = '$this->email'";

						parent::sql($previous_file);
						$old_file = parent::result();
						$path = "../assets/images/profile_pic/";

						// if not empty remove the file
						if (!empty($old_file[0]['photo'])) {
							@unlink($path . $old_file[0]['photo']);
						}

						$sql = "UPDATE `admin` SET `photo` = '$new_admin_profile_pic', `name` = '$this->name', `email` = '$this->email', `phone` = '$this->phone', `password` = '$this->password' WHERE email = '$this->email'";

						if (parent::sql($sql)) {
							parent::compressImage($new_admin_profile_pic, $this->tmp_admin_profile_pic, $this->admin_profile_pic_type, $admin_profile_pic_path);

							// unset session and start fresh session
							unset($_SESSION['user_email']);
							$this->start_user_session($this->email);

							return "Profile Updated Successfully !";
						} else {
							return "Failed To Update Profile Please Try Again Later !";
						}
					} else {
						return "Only Images Can Be Uploaded !";
					}
				} elseif (!empty($admin_profile_pic) && !empty($tmp_admin_profile_pic) && !empty($admin_profile_pic_type) && empty($password)) {
					if (in_array($file_extension, $valid_ext)) {
						$previous_file = "SELECT * FROM admin WHERE email = '$this->email'";

						parent::sql($previous_file);
						$old_file = parent::result();

						// print_r($old_file);
						// die();
						$path = "../assets/images/profile_pic/";

						// if not empty remove the file
						if (!empty($old_file[0]['photo'])) {
							@unlink($path . $old_file[0]['photo']);
						}

						$sql = "UPDATE `admin` SET `photo` = '$new_admin_profile_pic', `name` = '$this->name', `email` = '$this->email', `phone` = '$this->phone' WHERE email = '$this->email'";

						if (parent::sql($sql)) {
							parent::compressImage($new_admin_profile_pic, $this->tmp_admin_profile_pic, $this->admin_profile_pic_type, $admin_profile_pic_path);

							// unset session and start fresh session
							unset($_SESSION['user_email']);
							$this->start_user_session($this->email);

							return "Profile Updated Successfully !";
						} else {
							return "Failed To Update Profile Please Try Again Later !";
						}
					} else {
						return "Only Images Can Be Uploaded !";
					}
				} elseif (!empty($password)) {
					$sql = "UPDATE `admin` SET `name` = '$this->name', `email` = '$this->email', `phone` = '$this->phone', `password` = '$this->password' WHERE email = '$this->email'";

					if (parent::sql($sql)) {
						// unset session and start fresh session
						unset($_SESSION['user_email']);
						$this->start_user_session($this->email);

						return "Profile Updated Successfully !";
					} else {
						return "Failed To Update Profile Please Try Again Later !";
					}
				} elseif (empty($admin_profile_pic) && empty($tmp_admin_profile_pic) && empty($admin_profile_pic_type) && empty($password)) {
					$sql = "UPDATE `admin` SET `name` = '$this->name', `email` = '$this->email', `phone` = '$this->phone' WHERE email = '$this->email'";

					if (parent::sql($sql)) {
						// unset session and start fresh session
						unset($_SESSION['user_email']);
						$this->start_user_session($this->email);

						return "Profile Updated Successfully !";
					} else {
						return "Failed To Update Profile Please Try Again Later !";
					}
				}
			} else {
				return "Provided Phone Number is Associated With Another Account !";
			}
		} else {
			return "Provided Email ID is Associated With Another Account !";
		}
	}

	// add category function
	public function add_category($category_name, $category_color, $category_icon, $tmp_category_icon)
	{
		// category file
		$this->category_icon = strtolower($category_icon);
		$this->tmp_category_icon = $tmp_category_icon;

		// exploding category file for renaming
		$category_ext = explode(".", $this->category_icon);
		$new_category_icon = md5(time()) . '_category_icon' . '.' . end($category_ext);
		$category_icon_path = "../../src/images/categories/" . $new_category_icon;
		$icon_thumbnail_path = "../../src/images/categories/thumbnails/";

		$this->category_name = parent::clean($category_name);
		$this->category_color = parent::clean($category_color);
		$this->date_time = date("d-m-Y h:i:s a");


		// echo $this->category_name;

		// echo $this->category_color;

		// echo $new_category_icon;

		// echo $new_category_image;

		// echo $this->date_time;
		// die();


		$sql = "INSERT INTO `categories`(`name`, `color`, `icon`, `date_time`) VALUES ('$this->category_name','$this->category_color','$new_category_icon', '$this->date_time')";

		if (parent::sql($sql)) {
			// move icon
			parent::create_thumbnail($new_category_icon, $this->tmp_category_icon, $icon_thumbnail_path);
			move_uploaded_file($this->tmp_category_icon, $category_icon_path);
			return "success";
		} else {
			return "failed";
		}
	}

	// edit category function
	public function edit_category($edit_category, $category_name, $category_color, $category_icon, $tmp_category_icon)
	{
		$icon_update = '';

		$this->id = parent::clean($edit_category);
		$this->category_name = parent::clean($category_name);
		$this->category_color = parent::clean($category_color);
		$this->date_time = date("d-m-Y h:i:s a");

		// get old data
		$old_data_sql = "SELECT * FROM categories WHERE id = '$this->id'";
		if (parent::sql($old_data_sql)) {

			$old_data = parent::result();

			if (!empty($category_icon) and !empty($tmp_category_icon)) {
				// removing old file
				if (!empty($old_data[0]['icon'])) {
					@unlink("../../src/images/categories/" . $old_data[0]['icon']);
					@unlink("../../src/images/categories/thumbnails/" . $old_data[0]['icon']);
				}

				// category file
				$this->category_icon = strtolower($category_icon);
				$this->tmp_category_icon = $tmp_category_icon;

				// exploding category file for renaming
				$category_ext = explode(".", $this->category_icon);
				$new_category_icon = md5(time()) . '_category_icon' . '.' . end($category_ext);
				$category_icon_path = "../../src/images/categories/" . $new_category_icon;
				$icon_thumbnail_path = "../../src/images/categories/thumbnails/";

				$icon_field_name = ", `icon`";
				$icon_value_name = ", '$new_category_icon'";

				$icon_update = ", `icon` = '$new_category_icon'";
			}

			$sql = "UPDATE `categories` SET `name` = '$this->category_name', `color` = '$this->category_color' $icon_update WHERE id = '$this->id'";

			// echo $sql;
			// die();

			if (parent::sql($sql)) {
				if (!empty($category_icon) and !empty($tmp_category_icon)) {
					// move icon
					parent::create_thumbnail($new_category_icon, $this->tmp_category_icon, $icon_thumbnail_path);
					move_uploaded_file($this->tmp_category_icon, $category_icon_path);
				}

				return "success";
			} else {
				return "failed";
			}
		} else {
			return "failed";
		}
	}

	// delete category function
	public function delete_category($category_id)
	{
		$this->id = parent::clean($category_id);

		if (!empty($category_id)) {
			// get old data
			$old_data_sql = "SELECT * FROM categories WHERE id = '$this->id'";
			if (parent::sql($old_data_sql)) {
				$old_data = parent::result();

				// removing old file
				if (!empty($old_data[0]['icon'])) {
					unlink("../../src/images/categories/" . $old_data[0]['icon']);
					unlink("../../src/images/categories/thumbnails/" . $old_data[0]['icon']);
				}

				$sql = "DELETE FROM `categories` WHERE id = '$this->id'";

				if (parent::sql($sql)) {
					return "success";
				} else {
					return "failed";
				}
			}
		}
	}

	// add subcategory function
	public function add_subcategory($category_name, $subcategory_name, $subcategory_icon, $tmp_subcategory_icon)
	{
		// subcategory file
		$this->subcategory_icon = $subcategory_icon;
		$this->tmp_subcategory_icon = $tmp_subcategory_icon;

		// exploding subcategory file for renaming
		$subcategory_ext = explode(".", $this->subcategory_icon);
		$new_subcategory_icon = md5(time()) . '_subcategory_icon' . '.' . end($subcategory_ext);
		$subcategory_icon_path = "../../src/images/subcategories/" . $new_subcategory_icon;
		$icon_thumbnail_path = "../../src/images/subcategories/thumbnails/";

		$this->category_name = parent::clean($category_name);
		$this->subcategory_name = parent::clean($subcategory_name);
		$this->date_time = date("d-m-Y h:i:s a");

		$sql = "INSERT INTO `subcategories`(`category`, `name`, `icon`, `date_time`) VALUES ('$this->category_name', '$this->subcategory_name', '$new_subcategory_icon', '$this->date_time')";

		if (parent::sql($sql)) {
			// move icon
			parent::create_thumbnail($new_subcategory_icon, $this->tmp_subcategory_icon, $icon_thumbnail_path);
			move_uploaded_file($this->tmp_subcategory_icon, $subcategory_icon_path);
			return "success";
		} else {
			return "failed";
		}
	}

	// edit subcategory function
	public function edit_subcategory($edit_subcategory, $category_name, $subcategory_name, $subcategory_icon, $tmp_subcategory_icon)
	{
		$icon_update = '';

		$this->id = parent::clean($edit_subcategory);
		$this->category_name = parent::clean($category_name);
		$this->subcategory_name = parent::clean($subcategory_name);
		$this->date_time = date("d-m-Y h:i:s a");

		// get old data
		$old_data_sql = "SELECT * FROM subcategories WHERE id = '$this->id'";
		if (parent::sql($old_data_sql)) {

			$old_data = parent::result();

			if (!empty($subcategory_icon) and !empty($tmp_subcategory_icon)) {
				// removing old file
				if (!empty($old_data[0]['icon'])) {
					unlink("../../src/images/subcategories/" . $old_data[0]['icon']);
					unlink("../../src/images/subcategories/thumbnails/" . $old_data[0]['icon']);
				}

				// subcategory file
				$this->subcategory_icon = $subcategory_icon;
				$this->tmp_subcategory_icon = $tmp_subcategory_icon;

				// exploding subcategory file for renaming
				$subcategory_ext = explode(".", $this->subcategory_icon);
				$new_subcategory_icon = md5(time()) . '_subcategory_icon' . '.' . end($subcategory_ext);
				$subcategory_icon_path = "../../src/images/subcategories/" . $new_subcategory_icon;
				$icon_thumbnail_path = "../../src/images/subcategories/thumbnails/";

				$icon_field_name = ", `icon`";
				$icon_value_name = ", '$new_subcategory_icon'";

				$icon_update = ", `icon` = '$new_subcategory_icon'";
			}

			$sql = "UPDATE `subcategories` SET `category` = '$this->category_name', `name` = '$this->subcategory_name' $icon_update WHERE id = '$this->id'";

			// echo $sql;
			// die();

			if (parent::sql($sql)) {
				if (!empty($subcategory_icon) and !empty($tmp_subcategory_icon)) {
					// move icon
					parent::create_thumbnail($new_subcategory_icon, $this->tmp_subcategory_icon, $icon_thumbnail_path);
					move_uploaded_file($this->tmp_subcategory_icon, $subcategory_icon_path);
				}

				return "success";
			} else {
				return "failed";
			}
		} else {
			return "failed";
		}
	}

	// delete subcategory function
	public function delete_subcategory($subcategory_id)
	{
		$this->id = parent::clean($subcategory_id);

		if (!empty($subcategory_id)) {
			// get old data
			$old_data_sql = "SELECT * FROM subcategories WHERE id = '$this->id'";
			if (parent::sql($old_data_sql)) {
				$old_data = parent::result();

				// removing old file
				if (!empty($old_data[0]['icon'])) {
					unlink("../../src/images/subcategories/" . $old_data[0]['icon']);
					unlink("../../src/images/subcategories/thumbnails/" . $old_data[0]['icon']);
				}

				$sql = "DELETE FROM `subcategories` WHERE id = '$this->id'";

				if (parent::sql($sql)) {
					return "success";
				} else {
					return "failed";
				}
			}
		}
	}

	// get subcategory based on category function
	public function get_subcategories_by_category($category_id)
	{
		$this->id = parent::clean($category_id);

		if (!empty($category_id)) {
			// get data
			$sql = "SELECT * FROM subcategories WHERE category = '$this->id'";

			// echo $sql;
			// die();

			if (parent::sql($sql)) {
				if (parent::numrows() > 0) {
					$result = parent::result();
					$data = ["message" => "success", "data" => $result];
					return $data;
				} else {
					$data = ["message" => "success", "data" => ''];
					return $data;
				}
			} else {
				$data = ["message" => "failed", "data" => ''];
				return $data;
			}
		}
	}

	// add products function
	public function add_products($product_image, $tmp_product_image, $category_name, $subcategory_name, $product_name, $product_details, $stock_quantity, $product_quantity, $quantity_unit, $original_price, $discount_price)
	{
		$prod_image = array();
		$prod_image_tmp = array();

		for ($i = 0; $i < count($product_image); $i++) {
			// subcategory file
			$this->product_image = $product_image[$i];
			$this->tmp_product_image = $tmp_product_image[$i];

			// exploding subcategory file for renaming
			$product_img_ext = explode(".", $this->product_image);
			$new_product_image = md5(microtime()) . '_product_image' . '.' . end($product_img_ext);

			array_push($prod_image, $new_product_image);
			array_push($prod_image_tmp, $this->tmp_product_image);
		}

		// echo "<pre>";
		// print_r($prod_image);
		// echo "</pre>";
		// die();

		$product_image_path = "../../src/images/products/";
		$product_image_thumbnails_path = "../../src/images/products/thumbnails/";

		$this->category_name = parent::clean($category_name);
		$this->subcategory_name = parent::clean($subcategory_name ?? "");
		$this->product_name = parent::clean($product_name);
		$this->product_details = parent::escape($product_details);
		$this->stock_quantity = parent::clean($stock_quantity);
		$this->product_quantity = parent::clean($product_quantity);
		$this->quantity_unit = parent::clean($quantity_unit);
		$this->original_price = parent::clean($original_price);
		$this->discount_price = parent::clean($discount_price);

		$sql = "INSERT INTO `products`(`category`, `subcategory`, `name`, `description`, `stock`, `quantity`, `quantity_unit`, `original_price`, `selling_price`) VALUES ('$this->category_name', '$this->subcategory_name', '$this->product_name', '$this->product_details', '$this->stock_quantity', '$this->product_quantity', '$this->quantity_unit', '$this->original_price', '$this->discount_price')";

		if (parent::sql($sql)) {
			// emptying the array
			parent::result();

			$get_id_sql = "SELECT * FROM `products` WHERE `category` = '$this->category_name' AND `subcategory` = '$this->subcategory_name' AND `name` = '$this->product_name' AND `description` = '$this->product_details' AND `original_price` = '$this->original_price'";

			if (parent::sql($get_id_sql)) {
				// emptying the array
				$prod_data = parent::result();

				$prod_id = $prod_data[0]['id'];

				$multiple_image_query_array = array();
				foreach ($prod_image as $key => $img) {
					array_push($multiple_image_query_array, "('$prod_id', '$img')");
				}

				$multiple_image_query = implode(", ", $multiple_image_query_array);

				// insert image
				$prod_image_sql = "INSERT INTO `product_images`(`product_id`, `image`) VALUES " . $multiple_image_query;

				if (parent::sql($prod_image_sql)) {
					// emptying the array
					$prod_data = parent::result();

					// move images
					for ($j = 0; $j < count($prod_image); $j++) {
						parent::create_thumbnail($prod_image[$j], $prod_image_tmp[$j], $product_image_thumbnails_path);
						move_uploaded_file($prod_image_tmp[$j], $product_image_path . $prod_image[$j]);
					}

					return "success";
				} else {
					return "failed";
				}
			} else {
				return "failed";
			}
		} else {
			return "failed";
		}
	}

	// update products function
	public function update_products($product_id, $product_image, $tmp_product_image, $category_name, $subcategory_name, $product_name, $product_details, $stock_quantity, $product_quantity, $quantity_unit, $original_price, $discount_price)
	{
		$prod_image = array();
		$prod_image_tmp = array();

		if (!empty($product_image) && !empty($tmp_product_image)) {
			for ($i = 0; $i < count($product_image); $i++) {
				// subcategory file
				$this->product_image = $product_image[$i];
				$this->tmp_product_image = $tmp_product_image[$i];

				// exploding subcategory file for renaming
				$product_img_ext = explode(".", $this->product_image);
				$new_product_image = md5(microtime()) . '_product_image' . '.' . end($product_img_ext);

				array_push($prod_image, $new_product_image);
				array_push($prod_image_tmp, $this->tmp_product_image);
			}
		}

		// echo "<pre>";
		// echo "PROD IMG - ";
		// print_r($product_image);
		// print_r($prod_image);
		// echo "</pre>";
		// die();

		$product_image_path = "../../src/images/products/";
		$product_image_thumbnails_path = "../../src/images/products/thumbnails/";

		$this->id = parent::clean($product_id);
		$this->category_name = parent::clean($category_name);
		$this->subcategory_name = parent::clean($subcategory_name ?? "");
		$this->product_name = parent::clean($product_name);
		$this->product_details = parent::escape($product_details);
		$this->stock_quantity = parent::clean($stock_quantity);
		$this->product_quantity = parent::clean($product_quantity);
		$this->quantity_unit = parent::clean($quantity_unit);
		$this->original_price = parent::clean($original_price);
		$this->discount_price = parent::clean($discount_price);

		$sql = "UPDATE `products` SET `category` = '$this->category_name', `subcategory` = '$this->subcategory_name', `name` = '$this->product_name', `description` = '$this->product_details', `stock` = '$this->stock_quantity', `quantity` = '$this->product_quantity', `quantity_unit` = '$this->quantity_unit', `original_price` = '$this->original_price', `selling_price` = '$this->discount_price' WHERE id = '$this->id'";

		if (parent::sql($sql)) {
			// emptying the array
			parent::result();

			// if image exist
			if (!empty($product_image) && !empty($tmp_product_image)) {
				// create multiple array query
				$multiple_image_query_array = array();
				foreach ($prod_image as $key => $img) {
					array_push($multiple_image_query_array, "('$this->id', '$img')");
				}

				$multiple_image_query = implode(", ", $multiple_image_query_array);

				// insert image
				$prod_image_sql = "INSERT INTO `product_images`(`product_id`, `image`) VALUES " . $multiple_image_query;

				if (parent::sql($prod_image_sql)) {
					// emptying the array
					$prod_data = parent::result();

					// move images
					for ($j = 0; $j < count($prod_image); $j++) {
						parent::create_thumbnail($prod_image[$j], $prod_image_tmp[$j], $product_image_thumbnails_path);
						move_uploaded_file($prod_image_tmp[$j], $product_image_path . $prod_image[$j]);
					}

					return "success";
				} else {
					return "failed";
				}
			} else {
				// if images not present update and return success 
				return "success";
			}
		} else {
			return "failed";
		}
	}

	// delete product images function
	public function delete_product_image($image_id)
	{
		$this->image_id = parent::clean($image_id);

		if (!empty($image_id)) {
			$previous_img = "SELECT * FROM product_images WHERE id = '$this->image_id'";

			if (parent::sql($previous_img)) {
				$old_img = parent::result();
				$path = "../../src/images/products/";
				$thumbnail_path = "../../src/images/products/thumbnails/";

				// if not empty remove the file
				if (!empty($old_img[0]['image'])) {
					@unlink($path . $old_img[0]['image']);
					@unlink($thumbnail_path . $old_img[0]['image']);
				}

				$sql = "DELETE FROM `product_images` WHERE id = '$this->image_id'";

				if (parent::sql($sql)) {
					return "success";
				} else {
					return "failed";
				}
			}
		}
	}

	// delete product function
	public function delete_product($product_id)
	{
		$this->product_id = parent::clean($product_id);

		if (!empty($product_id)) {
			$previous_img = "SELECT * FROM `product_images` WHERE product_id = '$this->product_id'";

			if (parent::sql($previous_img)) {
				$old_img = parent::result();
				$path = "../../src/images/products/";
				$thumbnail_path = "../../src/images/products/thumbnails/";

				for ($i = 0; $i < count($old_img); $i++) {
					// if not empty remove the file
					if (!empty($old_img[$i]['image'])) {
						@unlink($path . $old_img[$i]['image']);
						@unlink($thumbnail_path . $old_img[$i]['image']);
					}
				}

				$sql = "DELETE FROM `product_images` WHERE product_id = '$this->product_id'";

				if (parent::sql($sql)) {
					// empty result array
					parent::result();

					$del = "DELETE FROM `products` WHERE id = '$this->product_id'";

					if (parent::sql($del)) {
						// empty result array
						parent::result();

						return "success";
					} else {
						return "failed";
					}
				} else {
					return "failed";
				}
			}
		}
	}

	// add products to featured function
	public function add_featured_products($products_list, $product_type)
	{
		$this->products_list = parent::array_clean($products_list);
		$this->product_type = parent::clean($product_type);

		$insert_arr = array();

		foreach ($this->products_list as $key => $products) {
			array_push($insert_arr, "('" . $products . "', '" . $this->product_type . "')");
		}

		$insert_str = implode(", ", $insert_arr);


		$sql = "INSERT INTO `featured_hotdeals`(`product_id`, `type`) VALUES $insert_str";

		// echo $sql;
		// die();

		if (parent::sql($sql)) {

			return "success";
		} else {
			return "failed";
		}
	}

	// remove featured product function
	public function remove_trending_product($product_id)
	{
		$this->product_id = parent::clean($product_id);

		if (!empty($product_id)) {
			$del = "DELETE FROM featured_hotdeals WHERE id = '$this->product_id'";

			if (parent::sql($del)) {
				// empty result array
				parent::result();

				return "success";
			} else {
				return "failed";
			}
		}
	}

	// add slider images function
	public function add_slider_images($slider_images, $tmp_slider_images, $sequence)
	{
		$this->sequence = parent::clean($sequence);

		// file
		$this->slider_images = $slider_images;
		$this->tmp_slider_images = $tmp_slider_images;

		// Valid extension
		$valid_ext = array('png', 'jpeg', 'jpg', 'gif');

		// checking extention validation
		$file_extension = pathinfo($this->slider_images, PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);

		// exploding file for renaming
		$slider_images_ext = explode(".", $this->slider_images);

		$new_slider_images = md5(microtime(true)) . '_slider_image' . '.' . end($slider_images_ext);

		$slider_images_path = "../../src/images/slider/" . $new_slider_images;

		$this->date_time = date("d-m-Y h:i:s a");

		if (in_array($file_extension, $valid_ext)) {

			$check_sequence = "SELECT * FROM site_slider WHERE `sequence` >= $this->sequence ORDER BY id ASC";

			if (parent::sql($check_sequence)) {
				$seq_data = parent::result();
				$seq_numrows = parent::numrows();

				if ($seq_numrows > 0) {
					foreach ($seq_data as $k => $seq_lp_data) {
						$seq_sql = "UPDATE site_slider SET `sequence` = " . $seq_data[0]['sequence'] . "+$k+1 WHERE id = " . $seq_lp_data['id'] . "";

						parent::sql($seq_sql);
						parent::result();

						// echo $seq_numrows."<br><br>";
						// echo $seq_sql."<br><br>";
						// print_r($seq_data);
						// echo $check_sequence."<br><br>";
					}
					// die();
				}

				$sql = "INSERT INTO `site_slider`(`image`, `sequence`, `date_time`) VALUES ('$new_slider_images', '$this->sequence', '$this->date_time')";

				if (parent::sql($sql)) {
					move_uploaded_file($this->tmp_slider_images, $slider_images_path);
					return "success";
				} else {
					return "failed";
				}
			} else {
				return "failed";
			}
		} else {
			echo "invalid";
		}
	}

	// delete slider images function
	public function delete_slider_image($slider_id)
	{
		$this->slider_id = parent::clean($slider_id);

		if (!empty($slider_id)) {
			$previous_img = "SELECT * FROM site_slider WHERE id = '$this->slider_id'";

			if (parent::sql($previous_img)) {
				$old_img = parent::result();
				$path = "../../src/images/slider/";

				// if not empty remove the file
				if (!empty($old_img[0]['image'])) {
					@unlink($path . $old_img[0]['image']);
				}

				$sql = "DELETE FROM `site_slider` WHERE id = '$this->slider_id'";

				if (parent::sql($sql)) {
					return "success";
				} else {
					return "false";
				}
			}
		}
	}

	// mark as contacted enquiry data function
	public function mark_enquiry_as_contacted($enquiry_id)
	{
		$this->enquiry_id = parent::clean($enquiry_id);

		if (!empty($enquiry_id)) {
			$sql = "UPDATE `query` SET `status` = 1 WHERE id = '$this->enquiry_id'";

			if (parent::sql($sql)) {
				return "Marked as Contacted Successfully !";
			} else {
				return "Failed To Mark as Contacted Please Try Again Later !";
			}
		}
	}

	// delete enquiry data function
	public function delete_enquiry_data($enquiry_id)
	{
		$this->enquiry_id = parent::clean($enquiry_id);

		if (!empty($enquiry_id)) {
			$sql = "DELETE FROM `query` WHERE id = '$this->enquiry_id'";

			if (parent::sql($sql)) {
				return "Deleted Successfully !";
			} else {
				return "Failed To Delete Please Try Again Later !";
			}
		}
	}

	// add deliverable pincode function
	public function add_delivery_pincode($pincode, $delivery_charges, $expected_delivery_time)
	{
		$this->pincode = parent::clean($pincode);
		$this->delivery_charges = parent::clean($delivery_charges);
		$this->expected_delivery_time = parent::clean($expected_delivery_time);
		$this->date_time = date("d-m-Y h:i:s a");

		$check = "SELECT * FROM pincode WHERE pincode = '$this->pincode'";
		if (parent::sql($check)) {
			$numrows = parent::numrows();
			$res = parent::result();

			if ($numrows == 0) {
				if (!empty($pincode)) {
					$sql = "INSERT INTO `pincode`(`pincode`, `charges`, `expected_on`, `date_time`) VALUES ('$this->pincode','$this->delivery_charges','$this->expected_delivery_time','$this->date_time')";

					if (parent::sql($sql)) {
						return "success";
					} else {
						return "failed";
					}
				}
			} else {
				return "exist";
			}
		} else {
			return "failed";
		}
	}

	// delete deliverable pincode function
	public function delete_delivery_pincode($pincode_id)
	{
		$this->pincode_id = parent::clean($pincode_id);

		if (!empty($pincode_id)) {
			$sql = "DELETE FROM `pincode` WHERE id = '$this->pincode_id'";

			if (parent::sql($sql)) {
				return "success";
			} else {
				return "failed";
			}
		}
	}

	// add coupon function
	public function add_coupon($coupon_code, $discount_amount, $min_cart_value)
	{
		$this->coupon_code = parent::clean($coupon_code);
		$this->discount_amount = parent::clean($discount_amount);
		$this->min_cart_value = parent::clean($min_cart_value);

		$check = "SELECT * FROM `coupons` WHERE `coupon` = '$this->coupon_code'";
		if (parent::sql($check)) {
			$numrows = parent::numrows();
			$res = parent::result();

			if ($numrows == 0) {
				if (!empty($coupon_code)) {
					$sql = "INSERT INTO `coupons`(`coupon`, `discount`, `min_value`) VALUES ('$this->coupon_code','$this->discount_amount','$this->min_cart_value')";

					if (parent::sql($sql)) {
						return "success";
					} else {
						return "failed";
					}
				}
			} else {
				return "exist";
			}
		} else {
			return "failed";
		}
	}

	// delete coupon function
	public function delete_coupon($coupon_id)
	{
		$this->coupon_id = parent::clean($coupon_id);

		if (!empty($coupon_id)) {
			$sql = "DELETE FROM `coupons` WHERE id = '$this->coupon_id'";

			if (parent::sql($sql)) {
				return "success";
			} else {
				return "failed";
			}
		}
	}

	// update order status function
	public function update_order_status($order_id, $status)
	{
		$this->order_id = parent::clean($order_id);
		$this->status = parent::clean($status);

		$order_update = "UPDATE `orders` SET `order_status` = '$this->status' WHERE `id` = '$this->order_id'";
		if (parent::sql($order_update)) {
			$numrows = parent::numrows();
			$res = parent::result();

			if ($this->status == "Cancelled" || $this->status == "Delivered") {
				$check_sql = "SELECT * FROM deliveries WHERE order_id = '$this->order_id'";

				if (parent::sql($check_sql)) {
					$check_res = parent::result();
					$check_num = parent::numrows();

					if ($check_num > 0) {
						$update_sql = "UPDATE `deliveries` SET `status` = '$this->status' WHERE `order_id` = '$this->order_id'";

						if (parent::sql($update_sql)) {
							parent::numrows();
							parent::result();
						}
					}
				}
			}

			if ($this->status == "Shipped" || $this->status == "Out" || $this->status == "Delivered" || $this->status == "Cancelled") {
				$order_data = "SELECT * FROM `orders` WHERE id = '$this->order_id'";
				if (parent::sql($order_data)) {
					$order_data_res = parent::result();
					$order_data_num = parent::numrows();

					if ($order_data_num > 0) {
						$order_products = json_decode($order_data_res[0]['products'], true);

						$prods = "SELECT * FROM products WHERE id = '" . $order_products[0]['product_id'] . "'";

						if (parent::sql($prods)) {
							$prod_res = parent::result();
							$prod_num = parent::numrows();

							if ($prod_num > 0) {
								$customer_id = $order_data_res[0]['customer_id'];

								$cust = "SELECT * FROM customers WHERE id = '$customer_id'";
								if (parent::sql($cust)) {
									$cust_res = parent::result()[0];
									$cust_num = parent::numrows();

									if ($cust_num > 0) {

										$sms_products = count($order_products) > 1 ? $prod_res[0]['name'] . " + " . count($order_products) . " More" : $prod_res[0]['name'];

										if ($this->status == "Shipped") {

											$sms_message = "Order for " . $sms_products . " is shipped will be delivered by " . json_decode($order_data_res[0]['booking_address'], true)['expected_delivery'] . ". By Regards Saab Mall";

											$title = "Order Shipped Successfully";
											$template_id = "1707163939417308898";
										}

										if ($this->status == "Out") {

											$sms_message = "Order for " . $sms_products . " is out for delivery it will be delivered by 9 pm today you can contact the captain on 9123456789. By Regards Saab Mall";

											$title = "Order Out For Delivery";
											$template_id = "1707163939420987991";
										}

										if ($this->status == "Delivered") {

											$sms_message = "Order for " . $sms_products . " is delivered successfully on " . date("d M Y h:i:s a") . ". By Regards Saab Mall";

											$title = "Order Delivered Successfully";
											$template_id = "1707163939429057666";
										}

										if ($this->status == "Cancelled") {

											$sms_message = "Order for {#var#} is Cancelled successfully if paid already it will be refunded within 5-7 working days, Thank you. By Regards Saab Mall";

											$title = "Order Cancelled Successfully";
											$template_id = "1707163939410086907";
										}

										// send placed email
										parent::send_order_notifications($cust_res['phone'], $cust_res['email'], $title, $sms_message, $sms_products, $template_id);

									}
								} else {
									return 'Server Error';
								}
							}
						} else {
							return 'Server Error';
						}
					}
				}
			}

			return "success";
		} else {
			return "failed";
		}
	}

	// assign order to captain function
	public function assign_order_to_captain($order_id, $captain, $customer, $charges)
	{
		$this->customer = parent::clean($customer);
		$this->order_id = parent::clean($order_id);
		$this->captain = parent::clean($captain);
		$this->charges = parent::clean($charges);

		$assign_captain = "INSERT INTO `deliveries`(`customer_id`, `order_id`, `captain_id`, `charges`, `status`) VALUES ('$this->customer', '$this->order_id', '$this->captain', '$this->charges', 'Pending')";

		if (parent::sql($assign_captain)) {
			$numrows = parent::numrows();
			$res = parent::result();

			return "success";
		} else {
			return "failed";
		}
	}

	// add captain function
	public function add_delivery_boy($image, $name, $gender, $email, $phone, $dob, $doj, $aadhar, $pancard, $address, $city, $state, $pincode, $vaccination_status)
	{
		$this->unique_id = time();
		$this->image = parent::clean($image['name']);
		$this->tmp_image = parent::clean($image['tmp_name']);
		$this->image_type = parent::clean($image['type']);
		$this->name = parent::clean($name);
		$this->gender = parent::clean($gender);
		$this->email = parent::clean($email);
		$this->phone = parent::clean($phone);
		$this->dob = parent::clean($dob);
		$this->doj = parent::clean($doj);
		$this->aadhar = parent::clean($aadhar);
		$this->pancard = parent::clean($pancard);
		$this->address = parent::clean($address);
		$this->city = parent::clean($city);
		$this->state = parent::clean($state);
		$this->pincode = parent::clean($pincode);
		$this->vaccination = parent::clean($vaccination_status);

		$ext = explode(".", $this->image);
		$new_image_name = md5(microtime()) . "_profile_photo." . end($ext);
		$path = '../../captain/assets/images/profiles/';

		$check = "SELECT * FROM captain WHERE email = '$this->email' OR phone = '$this->phone'";

		if (parent::sql($check)) {
			parent::result();

			if (parent::numrows() == 0) {
				$assign_captain = "INSERT INTO `captain`(`unique_id`, `photo`, `name`, `gender`, `email`, `phone`, `dob`, `doj`, `aadhar`, `pancard`, `address`, `city`, `state`, `pincode`, `vaccination`) VALUES ('$this->unique_id', '$new_image_name', '$this->name', '$this->gender', '$this->email', '$this->phone', '$this->dob', '$this->doj', '$this->aadhar', '$this->pancard', '$this->address', '$this->city', '$this->state', '$this->pincode', '$this->vaccination')";

				if (parent::sql($assign_captain)) {
					$numrows = parent::numrows();
					$res = parent::result();

					parent::compressImage($new_image_name, $this->tmp_image, $this->image_type, $path);

					return "success";
				} else {
					return "failed";
				}
			} else {
				return "exist";
			}
		} else {
			return "failed";
		}
	}

	// update captain function
	public function update_delivery_boy($id, $image, $name, $gender, $email, $phone, $dob, $doj, $aadhar, $pancard, $address, $city, $state, $pincode, $vaccination_status)
	{
		$this->id = parent::clean($id);
		$this->name = parent::clean($name);
		$this->gender = parent::clean($gender);
		$this->email = parent::clean($email);
		$this->phone = parent::clean($phone);
		$this->dob = parent::clean($dob);
		$this->doj = parent::clean($doj);
		$this->aadhar = parent::clean($aadhar);
		$this->pancard = parent::clean($pancard);
		$this->address = parent::clean($address);
		$this->city = parent::clean($city);
		$this->state = parent::clean($state);
		$this->pincode = parent::clean($pincode);
		$this->vaccination = parent::clean($vaccination_status);

		$image_update = '';
		if (!empty($image)) {
			$this->image = parent::clean($image['name']);
			$this->tmp_image = parent::clean($image['tmp_name']);
			$this->image_type = parent::clean($image['type']);
			$ext = explode(".", $this->image);
			$new_image_name = md5(microtime()) . "_profile_photo." . end($ext);
			$path = '../../captain/assets/images/profiles/';

			$image_update = ", `photo` = '" . $new_image_name . "'";
		}

		$check = "SELECT * FROM captain WHERE email = '$this->email' OR phone = '$this->phone'";

		if (parent::sql($check)) {
			$old_data = parent::result();

			if (parent::numrows() == 1) {
				$update_sql = "UPDATE `captain` SET `name` = '$this->name', `gender` = '$this->gender', `email` = '$this->email', `phone` = '$this->phone', `dob` = '$this->dob', `doj` = '$this->doj', `aadhar` = '$this->aadhar', `pancard` = '$this->pancard', `address` = '$this->address', `city` = '$this->city', `state` = '$this->state', `pincode` = '$this->pincode', `vaccination` = '$this->vaccination' $image_update WHERE id = '$this->id'";

				if (parent::sql($update_sql)) {
					$numrows = parent::numrows();
					$res = parent::result();

					if (!empty($image)) {
						@unlink($path . $old_data[0]['photo']);

						parent::compressImage($new_image_name, $this->tmp_image, $this->image_type, $path);
					}

					return "success";
				} else {
					return "failed";
				}
			} else {
				return "exist";
			}
		} else {
			return "failed";
		}
	}

	// delete delivery boy function
	public function delete_delivery_boy($id)
	{
		$this->id = parent::clean($id);

		if (!empty($id)) {
			$previous_img = "SELECT * FROM `captain` WHERE `id` = '$this->id'";

			if (parent::sql($previous_img)) {
				$old_img = parent::result();
				$path = '../../captain/assets/images/profiles/';

				// if not empty remove the file
				if (!empty($old_img[0]['photo'])) {
					@unlink($path . $old_img[0]['photo']);
				}

				$sql = "DELETE FROM `captain` WHERE `id` = '$this->id'";

				if (parent::sql($sql)) {
					return "success";
				} else {
					return "false";
				}
			}
		}
	}

	// complete delivery boy payment function
	public function pay_delivery_boy_income($captain, $month, $total_delivery, $total_earning, $payment_mode)
	{
		$this->captain = parent::clean($captain);
		$this->month = parent::clean($month);
		$this->total_delivery = parent::clean($total_delivery);
		$this->total_earning = parent::clean($total_earning);
		$this->payment_mode = parent::clean($payment_mode);

		$sql = "INSERT INTO `captain_payments`(`captain_id`, `month`, `total_delivery`, `total_amount`, `payment_mode`) VALUES ('$this->captain', '$this->month', '$this->total_delivery', '$this->total_earning', '$this->payment_mode')";

		if (parent::sql($sql)) {
			return "success";
		} else {
			return "failed";
		}
	}

	// update stocks function
	public function update_stocks($id, $updated_stock)
	{
		$this->id = parent::clean($id);
		$this->updated_stock = parent::clean($updated_stock);

		if (!empty($id)) {
			$sql = "UPDATE `products` SET `stock` = '$this->updated_stock' WHERE `id` = '$this->id'";

			if (parent::sql($sql)) {
				return "success";
			} else {
				return "false";
			}
		}
	}

	// site setting function
	public function update_site($setting_name, $setting_data)
	{
		$this->setting_name = $setting_name;
		$this->setting_data = parent::escape($setting_data);
		$this->date_time = date("d-m-Y h:i:s a");

		$sql = "UPDATE `site_settings` SET `setting_data` = '$this->setting_data', `date_time` = '$this->date_time' WHERE `setting_name` = '$this->setting_name'";

		if (parent::sql($sql)) {
			return "success";
		} else {
			return "failed";
		}
	}

}


?>