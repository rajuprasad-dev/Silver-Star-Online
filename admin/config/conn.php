<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$whitelist = array(
    '127.0.0.1',
    '::1'
);

$is_localhost = in_array($_SERVER['REMOTE_ADDR'], $whitelist);

if ($is_localhost) {
    // localhost
    DEFINE("SERVER", "localhost");
    DEFINE("USERNAME", "root");
    DEFINE("PASSWORD", "");
    DEFINE("DB", "silverstaronline");
} else {
    // server 
    DEFINE("SERVER", "162.214.80.124");
    DEFINE("USERNAME", "incincme_rustabh");
    DEFINE("PASSWORD", "Rustabh@198");
    DEFINE("DB", "incincme_silverstar");
}

//Defaul time zone
date_default_timezone_set("Asia/Kolkata");
define('DOMAIN', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']);
//connection

class database
{

    private $conn = false;
    private $myconn;
    private $host = SERVER;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $db_name = DB;
    private $result = array();
    private $numrows = 0;

    //connectiong to database
    public function connect()
    {
        if (!$this->conn) {
            $this->myconn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->myconn) {
                $this->conn = true;
                return true;
            } else {
                return false;
            }
        } else {

            return true;
        }
    }

    //sql query
    public function sql($query)
    {
        if ($this->conn) {
            $this->myconn->query("SET NAMES utf8mb4");
            if ($data = $this->myconn->query($query)) {
                if (isset($data->num_rows) && $data->num_rows > 0) {
                    $this->numrows = $data->num_rows;

                    while ($row = $data->fetch_assoc()) {
                        array_push($this->result, $row);
                    }
                    return true;
                } else {

                    array_push($this->result, $data);
                    $this->numrows = 0;
                    return true;
                }
            } else {

                array_push($this->result, $this->myconn->error);
                return false;
            }
        } else {

            return false;
        }
    }

    public function result()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    //Getting numRows
    public function numrows()
    {
        $val = $this->numrows;
        return $val;
    }

    //xss clean
    public function clean($clean)
    {
        return $this->myconn->real_escape_string(strip_tags($clean));
    }

    public function escape($clean)
    {
        return $this->myconn->real_escape_string($clean);
    }

    // array_clean
    public function array_clean($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $data[$key] = $this->clean($value);
            }

            return $data;
        } else {
            return $this->clean($array);
        }
    }

    // clean email 
    public function sanitize($field)
    {

        $field = filter_var($field, FILTER_SANITIZE_EMAIL);
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    // Compress image function
    public function compressImage($image_name, $tmp_image, $image_type, $path)
    {
        // echo "true";
        // die();

        // getting data from params
        list($width, $height) = getimagesize($tmp_image);

        if ($width > 6000 || $height > 6000) {
            // setting new height and width
            $nwidth = $width / 9;
            $nheight = $height / 9;
        } elseif ($width > 4000 || $height > 4000) {
            // setting new height and width
            $nwidth = $width / 6;
            $nheight = $height / 6;
        } elseif ($width > 2000 || $height > 2000) {
            // setting new height and width
            $nwidth = $width / 4;
            $nheight = $height / 4;
        } elseif ($width > 1000 || $height > 1000) {
            // setting new height and width
            $nwidth = $width / 2;
            $nheight = $height / 2;
        } elseif ($width > 700 || $height > 700) {
            // setting new height and width
            $nwidth = $width / 2;
            $nheight = $height / 2;
        } else {
            // setting new height and width
            $nwidth = $width / 1;
            $nheight = $height / 1;
        }

        // setting new image params
        $newimage = imagecreatetruecolor($nwidth, $nheight);

        // checking image type and executing as per type
        if ($image_type == 'image/jpeg') {
            $source = imagecreatefromjpeg($tmp_image);
            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagejpeg($newimage, $path . $image_name);
        } elseif ($image_type == 'image/png') {
            $source = imagecreatefrompng($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));
            imagealphablending($newimage, false);
            imagesavealpha($newimage, true);

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagepng($newimage, $path . $image_name);
        } elseif ($image_type == 'image/gif') {
            $source = imagecreatefromgif($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagegif($newimage, $path . $image_name);
        }

    }

    // Create thumbnail image function
    public function create_thumbnail($image_name, $tmp_image, $path)
    {
        // echo "true";
        // die();
        $nwidth = 150;
        // $nheight = 250;

        // getting data from params
        list($width, $height, $type) = getimagesize($tmp_image);

        $nheight = ceil($height * ($nwidth / $width));

        // setting new image params
        $newimage = imagecreatetruecolor($nwidth, $nheight);

        // get image type
        $img_name = explode('.', strtolower($image_name));
        $image_type = end($img_name);

        // echo $type;
        // echo $type === IMG_JPEG ? "JPEG" : "";
        // echo $type === IMG_PNG ? "PNG" : "";
        // echo $type === IMG_JPG ? "JPG" : "";
        // echo $type === IMG_GIF ? "GIF" : "";
        // die($image_type);

        // echo image_type_to_mime_type($type) . "<br/>";
        // echo $type . "<br/>";
        // print_r(
        //     [
        //         IMG_PNG,
        //         IMG_JPEG,
        //         IMG_JPG,
        //         IMG_GIF,
        //         IMG_AVIF,
        //         IMG_WEBP,
        //         IMG_BMP,
        //         IMG_WBMP,
        //         IMG_WEBP_LOSSLESS
        //     ]
        // );
        // echo "<br/>";
        // echo $source . "<br/>";
        // die;

        $image_mime_type = image_type_to_mime_type($type);

        // checking image type and executing as per type
        if ($image_mime_type = "image/jpg" || $image_mime_type = "image/jpeg") {

            $firstBytes = bin2hex(file_get_contents($tmp_image, false, null, 0, 2));
            if ($firstBytes == 8950) {
                $source = imagecreatefrompng($tmp_image);

                imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));
                imagealphablending($newimage, false);
                imagesavealpha($newimage, true);

                imagecopyresampled($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

                imagepng($newimage, $path . $image_name);
            } else {
                $source = imagecreatefromjpeg($tmp_image);

                // echo $tmp_image;
                // print_r($source);
                // die;

                imagecopyresampled($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
                imagejpeg($newimage, $path . $image_name);
            }
        } elseif ($image_mime_type = "image/png") {
            $source = imagecreatefrompng($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));
            imagealphablending($newimage, false);
            imagesavealpha($newimage, true);

            imagecopyresampled($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagepng($newimage, $path . $image_name);
        } elseif ($image_mime_type = "image/gif") {
            $source = imagecreatefromgif($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));

            imagecopyresampled($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagegif($newimage, $path . $image_name);
        } else {
            $source = imagecreatefromjpeg($tmp_image);
            imagecopyresampled($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagejpeg($newimage, $path . $image_name);
        }

        // imagedestroy($newimage);
    }

    // Send OTP
    public function otp_sender($email)
    {
        $rand_otp = rand(111111, 999999);
        $otp_valid = time() + 5 * 60;

        if (!empty($email)) {
            $message = "Your OTP is " . $rand_otp;

            $email_data['username'] = "Welcome";
            $email_data['message'] = $message;

            // getting and storing contents of the email page in variable
            $email_layout = file_get_contents("./general_mail.html");

            // looping through the email page and replacing the key with the variable
            foreach ($email_data as $key => $data_value) {
                $email_layout = str_replace('{{ ' . $key . ' }}', $data_value, $email_layout);
            }

            if ($this->send_email($email, $email_layout)) {
                $data = ['otp' => $rand_otp, 'result' => 'Success'];
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function send_email($email, $subject, $body)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();
            $mail->Host = 'mail.silverstaronline.in';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@silverstaronline.in';
            $mail->Password = 'Silver@2024';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('no-reply@silverstaronline.in', 'Silver Star');
            $mail->addAddress($email);
            $mail->addReplyTo('no-reply@silverstaronline.in', 'Silver Star');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    // Send SMS & EMAIL NOTIFICATIONS
    public function send_order_notifications($phone_num = '', $email = '', $title, $message = '', $username = '')
    {
        $data = array();
        $output = array();

        if (!empty($email)) {
            // storing data in array
            $email_data = array();

            $email_data['update_title'] = $title;
            $email_data['username'] = $username;
            $email_data['message'] = $message;

            // getting and storing contents of the email page in variable
            $email_layout = file_get_contents("../class/order.html");

            // looping through the email page and replacing the key with the variable
            foreach ($email_data as $key => $data_value) {
                $email_layout = str_replace('{{' . $key . '}}', $data_value, $email_layout);
            }

            // setting mail environment and defining variables
            $to = $email;
            $subject = 'Order Notification From Silver Star Online';
            $body = $email_layout;

            if ($this->send_email($to, $subject, $body)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // disconnect to database 

    public function disconnect()
    {
        if ($this->conn) {
            $this->myconn->close();
            $this->conn = false;
            return true;
        } else {
            return true;
        }
    }

}
?>