<?php

require_once '../common/dbmysql.php';
require_once '../common/constvariable.php';

/**
 * Description of OrderReport
 *
 * @author fedora
 */
class OrderReport {

    //put your code here
    private $db;
    private $enableTax = false;

    //put your code here
    public function __construct($db, $enableTax) {
        $this->enableTax = $enableTax;
        if ($db == null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }

    /**
     *
     * @param <type> $startdate
     * @param <type> $enddate
     * @param <type> $status  0 for all , 1 for paid, 2 for unpaid
     */
    public function getWonAuctionReport($startdate, $enddate, $status) {
        $keys = array(
            'username' => 'User Name',
            'realname' => 'Name',
            'address' => 'Address',
            'postalcode' => 'Postal Code',
            'phonenumber' => 'Phone Number',
            'country' => 'Contry',
            'auctionid' => 'Auction ID(#)',
            'itemwon' => 'Product Name',
            'wondate' => 'Won Date',
            'amount' => 'Amount',
            'shippingamount' => 'Shipping Amount',
            'status' => 'Status'
        );

        $datas = array();
        if ($status == 0 || $status == 2) {

            $sql = "select w.id, r.firstname,r.lastname,r.username,r.addressline1,r.addressline2,r.city,r.postcode,r.phone,a.auctionID,w.won_date,a.auc_final_price,
a.auc_fixed_price,a.fixedpriceauction,a.offauction,a.tax1,a.tax2,p.name,s.shippingcharge,c.printable_name from won_auctions w
left join registration r on r.id=w.userid
join auction a on a.auctionID=w.auction_id
left join products p on p.productID=a.productID
left join countries c on r.country=c.countryId
left join shipping s on a.shipping_id=s.id 
where (payment_date='0000-00-00 00:00:00' and accept_date>='$startdate' and accept_date<='$enddate') or (payment_date!='0000-00-00 00:00:00' and payment_date>='$startdate' and payment_date<='$enddate') order by w.accept_date";


            $result = db_query($sql) or die(db_error());
            if (db_num_rows($result) > 0) {

                while ($item = db_fetch_array($result)) {
                    if ($item["fixedpriceauction"] == "1") {
                        $amount = $item["auc_fixed_price"];
                    } elseif ($item["offauction"] == "1") {
                        $amount = "0.00";
                    } else {
                        $amount = $item["auc_final_price"];
                    }

                    if ($this->enableTax) {
                        if ($item['tax1'] != 0) {
                            $amount+=$amount * $item['tax1'] / 100;
                        }
                        if ($item['tax2'] != 0) {
                            $amount+=$amount * $item['tax2'] / 100;
                        }
                    }

                    $dataitem = array(
                        'username' => $item['username'],
                        'realname' => $item['firstname'] . ' ' . $item['lastname'],
                        'address' => $item['addressline1'] . " " . $item['addressline2'],
                        'postalcode' => $item['postcode'],
                        'phonenumber' => $item['phone'],
                        'country' => $item['printable_name'],
                        'itemwon' => $item['name'],
                        'wondate' => $item['won_date'],
                        'auctionid' => $item['auctionID'],
                        'shippingamount' => $item['shippingcharge'],
                        'amount' => number_format($amount, 2),
                        'status' => 'UNPAID'
                    );

                    array_push($datas, $dataitem);
                }
            }
        }
        if ($status == 0 || $status == 1) {

            $sql = "select itemid,itemname,datetime,username,firstname,lastname,addressline1,addressline2,city,postcode,phone,printable_name,amount,shippingcharge
from payment_order_history p 
left join registration r on r.id=p.userid
left join countries c on r.country=c.countryId
            where datetime>='$startdate' and datetime<='$enddate' and payfor='" . PAYFOR_WONAUCTION . "' order by datetime";
            $result = db_query($sql);
            while ($item = db_fetch_array($result)) {
                $dataitem = array(
                    'username' => $item['username'],
                    'realname' => $item['firstname'] . ' ' . $item['lastname'],
                    'address' => $item['addressline1'] . ' ' . $item['addressline2'],
                    'postalcode' => $item['postcode'],
                    'phonenumber' => $item['phone'],
                    'country' => $item['printable_name'],
                    'itemwon' => $item['itemname'],
                    'wondate' => $item['datetime'],
                    'auctionid' => $item['itemid'],
                    'shippingamount' => $item['shippingcharge'],
                    'amount' => $item['amount'],
                    'status' => 'PAID'
                );
                array_push($datas, $dataitem);
            }
        }

        $result = new ReportResult();


        $result->keys = $keys;
        $result->datas = $datas;
        
        return $result;
    }

    public function getBuyItNowReport($startdate, $enddate) {
        $keys = array(
            'username' => 'User Name',
            'realname' => 'Name',
            'address' => 'Address',
            'postalcode' => 'Postal Code',
            'phonenumber' => 'Phone Number',
            'country' => 'Contry',
            'auctionid' => 'Auction ID(#)',
            'itemwon' => 'Product Name',
            'buydate' => 'Buy Date',
            'amount' => 'Amount',
            'status' => 'Status'
        );

        $datas = array();

        $sql = "select itemid,itemname,datetime,username,firstname,lastname,addressline1,addressline2,city,postcode,phone,printable_name,amount,shippingcharge
from payment_order_history p
left join registration r on r.id=p.userid
left join countries c on r.country=c.countryId
            where datetime>='$startdate 00:00:00' and datetime<='$enddate 00:00:00' and payfor='" . PAYFOR_BUYITNOW . "' order by datetime";

   
        $result = db_query($sql);
        while ($item = db_fetch_array($result)) {
            $dataitem = array(
                'username' => $item['username'],
                'realname' => $item['firstname'] . ' ' . $item['lastname'],
                'address' => $item['addressline1'] . ' ' . $item['addressline2'],
                'postalcode' => $item['postcode'],
                'phonenumber' => $item['phone'],
                'country' => $item['printable_name'],
                'itemwon' => $item['itemname'],
                'buydate' => $item['datetime'],
                'auctionid' => $item['itemid'],
                'amount' => $item['amount'],
                'status' => 'PAID'
            );
            array_push($datas, $dataitem);
        }

         $result = new ReportResult();


        $result->keys = $keys;
        $result->datas = $datas;
        return $result;
    }

}

class ReportResult {

    public $keys;
    public $datas;

}

?>
