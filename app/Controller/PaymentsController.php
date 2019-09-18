<?php
App::uses('AppController', 'Controller');

class PaymentsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');

    public function index(){
        $this->set("paymentmethods", $this->Payment->Paymentmethod->find("list", array("conditions"=>array("active"=>1))));
    }

    public function edit($id = null){
        if(!$this->Payment->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->Payment->Behaviors->load('Containable');
        $payment = $this->Payment->find("first", array(
            "conditions"=>array(
                $this->Payment->alias.".id"=>$id
            ),
            "contain"=>array(
                "Paymentrecord",
                "Paymentmethod",
                "Membership.Member",
                "Unit"
            )
        ));

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Payment->save($this->request->data)) {
                $this->Session->setFlash("資料已成功更新", 'default', array('class'=>'alert alert-success'));
                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            } else {
                $this->Session->setFlash(__('資料更新失敗'), 'default', array('class'=>'alert alert-danger'));
            }
        } else {
            $this->request->data = $payment;
        }

        $this->set("payment", $payment);

        $this->set("paymentmethods", $this->Payment->Paymentmethod->find("list", array("conditions"=>array("active"=>1))));
    }


    public function newpayment(){
        $this->layout = "withoutmenu";

        $this->loadModel('Paymentitemcategory');
        $paymentitemcategories = $this->Paymentitemcategory->find("all", array(
           "conditions"=>array(
               "Paymentitemcategory.active"=>1
           )
        ));

        $this->set("paymentmethods", $this->Payment->Paymentmethod->find("all", array("conditions"=>array("active"=>1))));
        $this->set("paymentitemcategories", $paymentitemcategories);
    }

    public function ajax_checkout(){
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        $this->loadModel('Paymentcodenext');

        if ($this->request->is('post') || $this->request->is('put')) {
//            Configure::write('debug',2);
//            debug($this->request->data);
//            exit();

            $result = array();
            $result['success'] = 0;

            if(empty($this->request->data['Paymentrecord'])){
                throw new NotFoundException(__('Invalid action'));
            }
            $total_price = 0;
            foreach ($this->request->data['Paymentrecord'] as $rd){
                $total_price += $rd['price'];
            }
            $payment2save = array(
                'code'=>$this->Paymentcodenext->getnextcode(1),
                'paymentmethod_id'=>$this->request->data['Payment']['paymentmethod_id'],
                'membership_id'=>$this->request->data['Payment']['membership_id'],
                'unit_id'=>$this->Auth->user('unit_id'),
                'user_id'=>$this->Auth->user('id'),
                'payer'=>$this->request->data['Payment']['payer'],
                'markedprice'=>$total_price,
                'sellingprice'=>$total_price,
                'paymentdate'=>date('Y-m-d'),
                'discountamount'=>0,
                'remarks'=>$this->request->data['Payment']['remarks'],
                'title'=>"收據"
            );
            $this->Payment->begin();
            $this->Payment->create();
            if($this->Payment->save($payment2save)){
                foreach ($this->request->data['Paymentrecord'] as $rd){
                    $data2save = array(
                        'payment_id'=>$this->Payment->id,
                        'name'=>$rd['name'],
                        'quantity'=>$rd['quantity'],
                        'price'=>$rd['price']
                    );
                    $this->Payment->Paymentrecord->create();
                    $this->Payment->Paymentrecord->save($data2save);
                }

                $this->Payment->commit();
                $result['success'] = 1;
                $result['id'] = $this->Payment->id;

//                $this->redirect(array('controller'=>'payments', 'action' => 'printreceipt', $this->Payment->id));
            }
            echo json_encode($result);
        }
    }

    public function printreceipt($id = null){
        if(!$this->Payment->exists($id)){
            throw new NotFoundException(__('Invalid'));
        }
        $this->layout = "withoutmenu";

        $this->Payment->Behaviors->load('Containable');
        $payment = $this->Payment->find("first", array(
            "conditions"=>array(
                $this->Payment->alias.".id"=>$id
            ),
            "contain"=>array(
                "Paymentrecord",
                "Paymentmethod",
                "Membership.Member",
                "Unit.Agency",
                "User"
            )
        ));

        $this->Payment->id = $id;
        $this->Payment->saveField("printed", 1);

        $this->set("payment", $payment);
    }

    public function ajax_list()
    {
//        Configure::write('debug', 2);
        $this->autoRender = false;

        $options = array();

        $input =& $_GET;

        $iColumns = $input['iColumns'];

        $dataProps = array();
        for ($i = 0; $i < $iColumns; $i++) {
            $var = 'mDataProp_'.$i;
            if (!empty($input[$var]) && $input[$var] != 'null') {
                $dataProps[$i] = $input[$var];
//                $options['fields'][] = $input[$var];
            }
        }

        $this->Payment->Behaviors->load('Containable');

        $options['contain'] = array(
            "Paymentmethod",
            "Membership.Member",
        );


        /**
         * Ordering
         */
        if ( isset($input['iSortCol_0']) ) {
            $sort_fields = array();
            for ( $i=0 ; $i<intval( $input['iSortingCols'] ) ; $i++ ) {
                if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
                    $field = $dataProps[ intval( $input['iSortCol_'.$i] ) ];

                    $order = ( $input['sSortDir_'.$i]=='desc' ? "DESC" : "ASC" );
                    if($field == "Payment.code") {
                        $options['order'][] = array("Payment.code" => $order);

                    }else if($field == "Payment.payer"){
                        $options['order'][] = array("Payment.payer"=>$order);
                    }else if($field == "Payment.paymentdate"){
                        $options['order'][] = array("Payment.paymentdate"=>$order);
                    }else if($field == "Paymentmethod.name"){
                        $options['order'][] = array("Payment.paymentmethod_id"=>$order);
                    }else if($field == "Payment.sellingprice"){
                        $options['order'][] = array("sellingprice"=>$order);
                    }else if($field == "Payment.refunded"){
                        $options['order'][] = array("refunded"=>$order);
                    }else{
                        break;
                    }
                }
            }
        }

        /**
         * Paging
         */
        if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
            $options['limit'] = $input['iDisplayLength'];
            $options['offset'] = $input['iDisplayStart'];
        }

        //Filter

        if(!empty($input['code'])){
            $options['conditions']["Payment.code LIKE"] = '%' . $input['code'] . '%';
        }

        if(!empty($input['payer'])){
            $options['conditions']["Payment.payer LIKE"] = '%' . $input['payer'] . '%';
        }

        if(!empty($input['membercode'])){
            $listids = $this->Payment->Membership->find("list", array(
               "conditions"=>array(
                   "Membership.code LIKE"=>'%' . $input['membercode'] . '%'
               )
            ));

            $options['conditions']["Payment.membership_id"] = array_keys($listids);
        }

        if(!empty($input['startdate']) && !empty($input['enddate'])){
            $options['conditions']["Payment.paymentdate  BETWEEN ? AND ?"] = array(date('Y-m-d', strtotime($input['startdate'])), date('Y-m-d', strtotime($input['enddate'])));
        }

        if(!empty($input['paymentmethod'])){
            $options['conditions']["Payment.paymentmethod_id"] = $input['paymentmethod'];
        }

        if(!empty($input['valid'])){
            $options['conditions']["Payment.refunded"] =  $input['valid'];
        }

        $this->Payment->Behaviors->load('Containable');
        $result = $this->Payment->find('all',$options);

        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Payment->find('count', array("conditions"=>$options["conditions"]));
        $all_count = $this->Payment->find('count', array("recursive"=>-1));

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        App::import('Helper', 'Html');
        $html = new HtmlHelper(new View());

        foreach ( $result as $doc ) {
            $doc['Payment']['code'] = $html->link(h($doc['Payment']['code']), array("controller"=>"payments", "action"=>"printreceipt", $doc['Payment']['id']), array("class"=>"openasnew"));
            $doc['Payment']['payer'] = $doc['Payment']['payer']." <br /><small>".$doc['Membership']['code']."</small>";
            $doc['Payment']['sellingprice'] = "$".money_format("%i", $doc['Payment']['sellingprice']);
            $doc['Payment']['paymentdate'] = date("Y年m月d日", strtotime($doc['Payment']['paymentdate']));
            $doc['Payment']['refunded'] = ($doc['Payment']['refunded'])?"已退款":"";
            $doc['action'] = $html->link("修改", array("controller"=>"payments", "action"=>"edit", $doc['Payment']['id']), array("class"=>"btn btn-warning btn-sm"));
            $output['aaData'][] = $doc;
        }

        echo json_encode( $output );
    }

    public function checkout(){

    }

}