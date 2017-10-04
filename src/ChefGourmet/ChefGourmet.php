<?php

namespace src\chefgourmet;

class Chefgourmet
{
	public $employee_id;
	public $menu_id = 21;
	public $chef_pass = 'e5c720cafc0eb5976128e674c2eac68e';

	private $curl;

    public function __construct(  ) {
      $this->employee_id = app('request')->headers['employeeid'];

        $this->curl = curl_init();
    }

    public function login() {

        $username = app('request')->body['username'];
        $password = app('request')->body['password'];

        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://admin.quilsoft.com/chef-gourmet/public/ws/login?username=" . $username . "&password=" . $password . "&company=CHMONKS&chef_pass=" . $this->chef_pass . "&_=1507039608422",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = json_decode(curl_exec($this->curl));
        $err = curl_error($this->curl);

        curl_close($this->curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $this->employee_id = $response->result->id;
            echo json_encode([ 'employee_id' => $this->employee_id ]);
        }
    }
    /**
     * @param $date
     * @param $order_id
     * @return mixed
     */
    public function getOrder($date, $order_id = false) {

        $curl = curl_init();

        if ( !$order_id ) {
            $url = "https://admin.quilsoft.com/chef-gourmet/public/ws/get-order?menu_id=" .$this->menu_id. "&chef_pass=e5c720cafc0eb5976128e674c2eac68e&employee_id=" .$this->employee_id. "&date=" .$date. "&_=1507039314678";
        }else{
            $url = "https://admin.quilsoft.com/chef-gourmet/public/ws/get-order?order_id=" . $order_id . "&menu_id=" .$this->menu_id. "&chef_pass=e5c720cafc0eb5976128e674c2eac68e&employee_id=" .$this->employee_id. "&date=" .$date. "&_=1507039314678";
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = json_decode(curl_exec($curl));
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo json_encode($this->parseFood($response));
        }
    }

    /**
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getOrders($from, $to) {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://admin.quilsoft.com/chef-gourmet/public/ws/get-orders?employee_id=" .$this->employee_id. "&chef_pass=" . $this->chef_pass . "&date_from=" . $from . "&date_to=" . $to . "&_=1507039201302",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 18fcb53c-d5d8-f47f-077d-34af075d1621"
            ),
        ));

        $response = json_decode(curl_exec($this->curl));
        $err = curl_error($this->curl);

        curl_close($this->curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo json_encode($response);
        }
    }

    /**
     * @param $from
     * @param $to
     */
    public function getOrdersList($from, $to) {

        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://admin.quilsoft.com/chef-gourmet/public/ws/get-orders-list?employee_id=" .$this->employee_id. "&chef_pass=" .$this->chef_pass. "&date_from=" .$from. "&date_to=" .$to. "&_=1507142420381",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = json_decode(curl_exec($this->curl));
        $err = curl_error($this->curl);

        curl_close($this->curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo json_encode($response);
        }
    }

    /**
     * @param $food_id
     * @param $dessert_id
     * @param $date
     * @param bool $absent
     */
    public function setOrder($food_id, $dessert_id, $date, $absent = false ) {

        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://admin.quilsoft.com/chef-gourmet/public/ws/make-order?plato_principal_id=" . $food_id . "&postre_id=" . $dessert_id . "&employee_id=" . $this->employee_id . "&menu_id=21&date=" . $date . "&chef_pass=" . $this->chef_pass . "&absent=" . $absent . "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = json_decode(curl_exec($this->curl));
        $err = curl_error($this->curl);

        curl_close($this->curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo json_encode($response);
        }
    }

    /**
     * @param $order_id
     */
    public function setCancelOrder($order_id) {

        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://admin.quilsoft.com/chef-gourmet/public/ws/cancel-order?order_id=" . $order_id . "&chef_pass=".$this->chef_pass."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = json_decode(curl_exec($this->curl));
        $err = curl_error($this->curl);

        curl_close($this->curl);
        curl_close($this->curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo json_encode($response);
        }
    }

    /**
     * @param $object
     * @return array
     */
    private function parseFood($object) {
        $newFoods = [];

        foreach ( $object->result->foods[0]->food_types->{1} as $foods ) {
            $newFoods['foods'][0][] = $foods;
        }
        foreach ( $object->result->foods[0]->food_types->{2} as $foods ) {
            $newFoods['foods'][1][] = $foods;
        }
        foreach ( $object->result->foods[0]->food_types->{3} as $foods ) {
            $newFoods['foods'][2][] = $foods;
        }
        foreach ( $object->result->foods[0]->food_types->{5} as $foods ) {
            $newFoods['foods'][3][] = $foods;
        }

        foreach ( $object->result->foods[1]->food_types->{1} as $foods ) {
            $newFoods['dessert'][0][] = $foods;
        }

        foreach ( $object->result->foods[1]->food_types->{2} as $foods ) {
            $newFoods['dessert'][1][] = $foods;
        }

        foreach ( $object->result->foods[1]->food_types->{3} as $foods ) {
            $newFoods['dessert'][1][] = $foods;
        }

        foreach ( $object->result->foods[1]->food_types->{4} as $foods ) {
            $newFoods['dessert'][2][] = $foods;
        }

        foreach ( $object->result->foods[1]->food_types->{7} as $foods ) {
            $newFoods['dessert'][3][] = $foods;
        }

        return $newFoods;
    }
}