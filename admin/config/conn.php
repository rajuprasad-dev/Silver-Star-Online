<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Defaul time zone

date_default_timezone_set("Asia/Kolkata");
define('DOMAIN', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']);
//connection

class database
{

    // private $conn=false;
// private $myconn;
// private $host="localhost";
// private $username="saabma4m_saabmall";
// private $password="saabmall@2021";
// private $db_name="saabma4m_saabmall";
// private $result=array();
// private $numrows=0;

    private $conn = false;
    private $myconn;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "silverstaronline";
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
        list($width, $height) = getimagesize($tmp_image);

        $nheight = ceil($height * ($nwidth / $width));

        // setting new image params
        $newimage = imagecreatetruecolor($nwidth, $nheight);

        // get image type
        $img_name = explode('.', strtolower($image_name));
        $image_type = end($img_name);

        // checking image type and executing as per type
        if ($image_type == 'jpeg' || $image_type == 'jpg') {
            $source = imagecreatefromjpeg($tmp_image);
            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagejpeg($newimage, $path . $image_name);
        } elseif ($image_type == 'png') {
            $source = imagecreatefrompng($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));
            imagealphablending($newimage, false);
            imagesavealpha($newimage, true);

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagepng($newimage, $path . $image_name);
        } elseif ($image_type == 'gif') {
            $source = imagecreatefromgif($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagegif($newimage, $path . $image_name);
        } else {
            $source = imagecreatefromjpeg($tmp_image);
            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

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

    public function send_email($email, $body)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();
            $mail->Host = 'mail.santoshsir.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'support@santoshsir.com';
            $mail->Password = 'santosh@2021';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('no-reply@santoshsir.com', 'Santosh Sir');
            $mail->addAddress($email);
            $mail->addReplyTo('no-reply@santoshsir.com', 'No-Reply');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Notification From Santosh Sir';
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
    public function send_order_notifications($phone_num = '', $email = '', $type = '', $message = '', $product = '', $template_id = '')
    {
        $data = array();
        $output = array();

        if (!empty($phone_num)) {
            $api_key = '561B348230F2B7';
            $from = 'SABMLL';
            $sms_text = urlencode($message);

            //Submit to server

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://sms.saabmall.com/app/smsapi/index.php");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "key=" . $api_key . "&campaign=1&routeid=46&type=text&contacts=" . $phone_num . "&senderid=" . $from . "&msg=" . $sms_text . "&template_id=" . $template_id);
            $response = curl_exec($ch);
            curl_close($ch);

            $data['phone'] = 'success';
        }

        if (!empty($email)) {
            // storing data in array
            $email_data = array();

            $email_data['type'] = $type;
            $email_data['message'] = $message;
            $email_data['product'] = $product;

            // getting and storing contents of the email page in variable
            $email_layout = file_get_contents("../class/order.html");

            // looping through the email page and replacing the key with the variable
            foreach ($email_data as $key => $data_value) {
                $email_layout = str_replace('{{ ' . $key . ' }}', $data_value, $email_layout);
            }

            // setting mail environment and defining variables
            $to = $email;
            $subject = 'Notification From Saabmall';
            $body = $email_layout;

            if ($this->send_email($to, $subject, $body)) {
                $data['email'] = "success";
            } else {
                $data['email'] = 'failed';
            }
        }

        if ($data['phone'] = 'success' && $data['email'] == 'success') {
            $output = ["message" => "success"];
        } elseif ($data['phone'] = 'success' && $data['email'] == 'failed') {
            $output = ["message" => "sms success but email failed"];
        } elseif ($data['phone'] = 'failed' && $data['email'] == 'success') {
            $output = ["message" => "email success but sms failed"];
        } elseif ($data['phone'] = 'failed' && $data['email'] == 'failed') {
            $output = ["message" => "failed"];
        }

        return $output;
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