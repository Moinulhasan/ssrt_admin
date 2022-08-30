<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    //
    public function createUser(Request $request)
    {
        $content = new Customer();
        $content->first_name = $request->first_name;
        $content->email = $request->email;
        $content->surname = $request->surname ?? '';
        $content->company_name = $request->company ?? '';
        $content->password = Hash::make($request->password);
        $content->save();
        $output = $this->test($content, $request->password);
        return $output;
    }

    private function test($data, $password)
    {
        $new_db_name = "ssrt_" . $data->id;
        $new_mysql_username = $data->first_name;
        $new_mysql_password = $password;
        $connection = mysqli_connect('localhost', env('DB_USERNAME'), env('DB_PASSWORD'));
        mysqli_query($connection, "CREATE USER '$new_mysql_username'@'localhost' IDENTIFIED BY '$new_mysql_password';");
        mysqli_query($connection, "GRANT ALL ON $new_db_name.* TO '$new_mysql_username'@'localhost'");
        mysqli_query($connection, "CREATE DATABASE " . $new_db_name);

        $conn = mysqli_connect(config('database.connections.mysql.host'), $new_mysql_username, $new_mysql_password, $new_db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql_one = "CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(245) NOT NULL,
  `last_name` varchar(245) DEFAULT NULL,
  `card_number` varchar(45) DEFAULT NULL,
  `credit_limit` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `layBy_amount` int(11) DEFAULT NULL,
  `due_amount` int(11) DEFAULT NULL,
  `mobile_no` int(11) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `post_code` varchar(45) DEFAULT NULL,
  `suburb` varchar(45) DEFAULT NULL,
  `store_credit` double DEFAULT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_modified_by` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

       $sql_tow = "CREATE TABLE `advertisement` (
  `advertisement_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contents` varchar(500) NOT NULL,
  `terminal` varchar(100) NOT NULL,
  `display_effect` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `no_end_date` int(11) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(45) NOT NULL,
  `last_modified_by` varchar(45) NOT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
       $sql_three ="
CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `display_seq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
      $sql_four='CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
     $sql_five ="CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
     $sql_six ="CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `parent_department_id` int(11) DEFAULT NULL,
  `department_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$sql_seven ="CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
$sql_eight = "CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `number_of_units` double DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `plu_type_id` int(11) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `plu_no` int(11) DEFAULT NULL,
  `supplier_plu` int(11) DEFAULT NULL,
  `no_of_dockets` int(11) DEFAULT NULL,
  `list_price` double DEFAULT NULL,
  `bar_code` varchar(40) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL,
  `transmit_status` smallint(6) DEFAULT 0,
  `parent_item_id` int(11) DEFAULT NULL,
  `carton_cost` decimal(10,2) DEFAULT 0.00,
  `open_price` smallint(6) NOT NULL DEFAULT 0,
  `modifier_popup` smallint(6) NOT NULL DEFAULT 0,
  `kp_description` varchar(45) DEFAULT NULL,
  `inc_price_in_kp` smallint(6) DEFAULT NULL,
  `open_description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_nine = "CREATE TABLE `item_modifiers_category` (
  `item_modifiers_category_id` int(11) NOT NULL,
  `modifiers_category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";
$sql_ten ="CREATE TABLE `item_price_level_location` (
  `item_price_level_location_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `price_level_id` int(11) DEFAULT NULL,
  `x_tax` double DEFAULT 0,
  `inc_tax` double DEFAULT 0,
  `gp` double DEFAULT 0,
  `created_by` varchar(45) DEFAULT '',
  `created_date` datetime DEFAULT '2021-09-15 00:00:00',
  `last_modified_by` varchar(45) DEFAULT '',
  `last_modified_date` datetime DEFAULT '2021-09-15 00:00:00',
  `record_status` smallint(6) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_ele ="CREATE TABLE `item_printer` (
  `item_printer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_twe ="
CREATE TABLE `keyboard` (
  `keyboard_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql_ther ="CREATE TABLE `keyboard_department` (
  `keyboard_department_id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `keyboard_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `key_image` varchar(150) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT '',
  `created_date` datetime DEFAULT '2021-09-15 00:00:00',
  `last_modified_by` varchar(45) DEFAULT '',
  `last_modified_date` datetime DEFAULT '2021-09-15 00:00:00',
  `record_status` smallint(6) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_for ="CREATE TABLE `keyboard_item` (
  `keyboard_item_id` int(11) NOT NULL,
  `keyboard_sub_depatment_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `caption` varchar(45) DEFAULT NULL,
  `color` varchar(150) DEFAULT NULL,
  `key_image` varchar(150) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT '',
  `created_date` datetime DEFAULT '2021-09-15 00:00:00',
  `last_modified_by` varchar(45) DEFAULT '',
  `last_modified_date` datetime DEFAULT '2021-09-15 00:00:00',
  `record_status` smallint(6) DEFAULT 1,
  `modify_option` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_fif ="CREATE TABLE `keyboard_sub_department` (
  `keyboard_sub_department_id` int(11) NOT NULL,
  `keyboard_department_id` int(11) DEFAULT NULL,
  `sub_department_name` varchar(100) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `color` varchar(150) DEFAULT NULL,
  `key_image` varchar(150) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT '',
  `created_date` datetime DEFAULT '2021-09-15 00:00:00',
  `last_modified_by` varchar(45) DEFAULT '',
  `last_modified_date` datetime DEFAULT '2021-09-15 00:00:00',
  `record_status` smallint(6) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_sixs ="CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `number_of_tables` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_sev ="CREATE TABLE `location_table_details` (
  `location_table_detail_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `start_number` int(11) NOT NULL,
  `end_number` int(11) NOT NULL,
  `area` varchar(100) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_ei ="CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_n ="CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql_tw ="CREATE TABLE `modifier` (
  `modifier_id` int(11) NOT NULL,
  `modifiers_category_id` int(11) DEFAULT NULL,
  `description` varchar(45) NOT NULL,
  `price_x_tax` decimal(10,2) DEFAULT 0.00,
  `price_inc_tax` decimal(10,2) DEFAULT 0.00,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$sql_twon ="CREATE TABLE `modifiers_category` (
  `modifiers_category_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_twth ="
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql_twfo ="CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,4) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql_twf ="CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sqk_tws ="CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,4) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql_twse ="CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(45) NOT NULL DEFAULT '',
  `controller` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `record_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$sql_twei = "CREATE TABLE `plu_type` (
  `plu_type_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_twnin ="CREATE TABLE `price_level` (
  `price_level_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_ther ="CREATE TABLE `price_level_location` (
  `price_level_location_id` int(11) NOT NULL,
  `price_level_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_thron ="CREATE TABLE `printer` (
  `printer_id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `printer_group_id` int(11) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_thrtwo ="CREATE TABLE `printer_group` (
  `printer_group_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `client_print_order` int(11) DEFAULT 0,
  `type` smallint(6) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_therfo ="CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql_therfi ="CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT '',
  `display_seq` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `record_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$sql_thersix ="CREATE TABLE `role_permission` (
  `role_permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` timestamp NULL DEFAULT NULL,
  `record_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$sql_thersev ="
CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

$sql_therei ="CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `vender_id` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `suburb` varchar(100) DEFAULT NULL,
  `post_code` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `supply_of` varchar(45) DEFAULT NULL,
  `supplier_group` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `account_type` int(11) DEFAULT NULL,
  `terms` int(11) DEFAULT NULL,
  `price_num` int(11) DEFAULT NULL,
  `calculat_tax` tinyint(1) DEFAULT NULL,
  `add_tax` tinyint(1) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_therni ="CREATE TABLE `tax` (
  `tax_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `rate` double NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_fourt ="CREATE TABLE `terminal` (
  `terminal_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL,
  `has_updates` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_fouron ="CREATE TABLE `terminal_option` (
  `terminal_option_id` int(11) NOT NULL,
  `terminal_id` int(11) DEFAULT NULL,
  `terminal_option_detail_id` int(11) NOT NULL,
  `terminal_value` varchar(100) DEFAULT NULL,
  `terminal_purpose` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT '',
  `created_date` datetime DEFAULT '2021-09-15 00:00:00',
  `last_modified_by` varchar(45) DEFAULT '',
  `last_modified_date` datetime DEFAULT '2021-09-15 00:00:00',
  `record_status` smallint(6) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_fourttwo ="CREATE TABLE `terminal_option_detail` (
  `terminal_option_detail_id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT 0,
  `terminal_purpose` varchar(1000) NOT NULL,
  `created_by` varchar(45) DEFAULT '',
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT '',
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


$sql_fourtth ="CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql_fourtth ="CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `card_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql_fourtfo ="CREATE TABLE `user_cart` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql_fourtfi ="CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `voucher_type_id` int(11) DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL,
  `print_receipt` smallint(6) DEFAULT NULL,
  `unlimited` smallint(6) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$sql_fourtsi ="CREATE TABLE `voucher_terminal` (
  `voucher_terminal_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `terminal_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$sql_foutse ="CREATE TABLE `voucher_type` (
  `voucher_type_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL DEFAULT '',
  `created_by` varchar(45) DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `record_status` smallint(6) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `last_modified_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$full_sql = [$sql_foutse,$sql_fourtsi,$sql_fourtfi,$sql_fourtfo,$sql_fourtth,$sql_fourtth,$sql_fourttwo,$sql_fouron,
    $sql_fourt,$sql_therni,$sql_therei,$sql_thersev,$sql_thersix,$sql_therfi,$sql_therfo,$sql_thrtwo,$sql_thron,$sql_ther,
    $sql_twnin,$sql_twei,$sql_twse,$sqk_tws,$sql_twf,$sql_twfo,$sql_twth,$sql_twon,$sql_tw,$sql_n,$sql_ei,$sql_sev,$sql_sixs,$sql_fif,$sql_for,
    $sql_ther,$sql_twe,$sql_ele,$sql_ten,$sql_nine,$sql_eight,$sql_seven,$sql_six,$sql_five,$sql_four,$sql_three,$sql_tow,$sql_one
];
        foreach($full_sql as $k => $sql) {
            $query = $conn->query($sql);
        }
        return true;

    }

    private function createDatabase($data, $password)
    {
        try {
            $new_db_name = "ssrt_" . $data->id;
            $new_mysql_username = $data->first_name;
            $new_mysql_password = $password;

//            $conn = mysqli_connect(
//                config('database.connections.mysql.host'),
//                env('DB_USERNAME'),
//                env('DB_PASSWORD')
//            );
//            if(!$conn ) {
//                return false;
//            }
//            $sql = 'CREATE Database IF NOT EXISTS '.$new_db_name;
//
//
//            $exec_query = mysqli_query( $conn, $sql);
//            $db_result=mysqli_select_db($new_db_name);
            $connection = mysqli_connect(
                config('database.connections.mysql.host'),
                env('DB_USERNAME'),
                env('DB_PASSWORD')
            );
            $sql_1 = "CREATE USER ''.$new_mysql_username.''@'localhost' IDENTIFIED BY ''.$new_mysql_password.'';";
            mysqli_query($sql_1, $connection);
            mysqli_query("GRANT ALL ON ''.$new_db_name.''.* TO ''.$new_mysql_username.''@'localhost'", $connection);
            $th_con = mysqli_query("CREATE DATABASE '.$new_db_name.'", $connection);
//            $th_con   =  mysqli_connect(
//                config('database.connections.mysql.host'),
//                env('DB_USERNAME'),
//                env('DB_PASSWORD'),
//                $new_db_name
//            );
            dd($th_con);
            $test = 'CREATE TABLE employee( ' .
                'emp_id INT NOT NULL AUTO_INCREMENT, ' .
                'emp_name VARCHAR(20) NOT NULL, ' .
                'emp_address  VARCHAR(20) NOT NULL, ' .
                'emp_salary   INT NOT NULL, ' .
                'join_date    timestamp(14) NOT NULL, ' .
                'primary key ( emp_id ))';


            $retval = mysqli_query($th_con, $test);

            if (!$exec_query) {
                die('Could not create database: ' . mysqli_error($conn));
            }
            return 'Database created successfully with name ' . $new_db_name;
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }

}
