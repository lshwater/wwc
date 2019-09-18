<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Stocks Controller
 *
 * @property Stock $Stock
 * @property PaginatorComponent $Paginator
 */
class StocksController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Search.Prg');
    var $helpers = array('Barcode');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {

//        configure::write('debug',2);
        $this->Stock->recursive = 0;
        $this->Prg->commonProcess();

        //Test
//        $this->set('members', $this->Stock->find('all'));
        $units = $this->Stock->Unit->find('list', array('fields' => array('id', 'name')));
        $this->set('unit',$units);
        $this->set('location',$this->stock_location);

        $type = $this->Stock->Stocktype->find('list', array('conditions'=>array('Stocktype.unit_id'=>7),'fields' => array('id', 'name')));
        $this->set('stock_type',$type);

        if($this->request->query['voucher']){
            $this->set('voucher', $this->Stock->Voucher->find('list',array('conditions'=>array('Voucher.id'=>$this->request->query['voucher']),'fields'=>array('id', 'code'))));
        }

//        $option = $this->Stock->parseCriteria($this->Prg->parsedParams());
//        $this->paginate = array('conditions' => $option);
//
//        $this->set('members', $this->Paginator->paginate());
    }

    public function disposal()
    {
        $this->Stock->recursive = 0;
        $this->Prg->commonProcess();

        //Test
//        $this->set('members', $this->Stock->find('all'));
        $units = $this->Stock->Unit->find('list', array('fields' => array('id', 'name')));
        $this->set('unit',$units);
        $this->set('location',$this->stock_location);
        $this->set('reason',$this->fadeout_reason);

//        $option = $this->Stock->parseCriteria($this->Prg->parsedParams());
//        $this->paginate = array('conditions' => $option);
//
//        $this->set('members', $this->Paginator->paginate());
    }


    public function test(){

        configure::write('debug',2);

//        $all = $this->Stock->find('all',array(
//            'recursive'=>-1,
//            'conditions'=>array(
//                'Stock.type'=>array(1,2,20,21)
//            ),
//            'fields'=>array(
//                'id','fix_asset_no', 'unit_id'
//            )
//        ));
//
//        foreach($all as $stock){
//            $fix_asset_no = str_replace(array('/', '('), '_', $stock['Stock']['fix_asset_no']);
//            $fix_asset_no = rtrim($fix_asset_no, ')');
//            $image_name = $stock['Stock']['unit_id']."_".$fix_asset_no . '.' . 'jpg';
////            debug($stock);
//
//            $this->Stock->id = $stock['Stock']['id'];
//            $this->Stock->saveField('image_path',$image_name);
//        }


        exit();

    }

    function export(){

        $units = $this->Stock->Unit->find('list', array('conditions'=>array('Unit.id'=>$this->Auth->user('viewunits')),'fields' => array('id', 'name')));

        $this->set('unit',$units);

    }

    function export_label(){

        $this->layout = 'label';

        if ($this->request->is('post') || $this->request->is('put')) {
            ini_set('memory_limit', '51200M');
            ini_set('max_execution_time', 1000);
            $unit_id = $this->request->data['Stocks']['unit_id'];
            $stock = $this->request->data['Stocks']['stock'];

            if(!empty($unit_id)){
                $stocks = $this->Stock->find('all',array(
                    'conditions'=>array(
                        'Stock.unit_id'=>$unit_id
                    ),
                    'recursive'=>-1,
                    'fields'=>array(
                        'fix_asset_no'
                    )
                ));
            }else if(!empty($stock)){
                $stocks = $this->Stock->find('all',array(
                    'conditions'=>array(
                        'Stock.id'=>$stock
                    ),
                    'recursive'=>-1,
                    'fields'=>array(
                        'fix_asset_no'
                    )
                ));
            }


            $this->set('stocks', $stocks);

        }
    }

    public function checkin()
    {
        $this->layout = "withoutmenu";

        if($this->request->is('put') || $this->request->is('post')){

            $stockcard = trim($this->request->data['Stock']['stockcard']);

            if(!empty($stockcard)) {

                $stock = $this->Stock->find('first', array(
                    'conditions'=>array(
                        'Stock.fix_asset_no'=>$stockcard,
                        'Stock.unit_id'=>$this->Auth->user('viewunits')
                    )
                ));

                if(!$stock){
                    $errormsg = "找不到存貨";
                }else{
                    $this->set('user_id', $stock['Stock']['holder_id']);
                    $record = $this->Stock->Attendance->find('first',array(
                        'conditions'=>array(
                            'stock_id'=>$stock['Stock']['id'],
                            'OR'=>array(
                                array('in_time'=>null),
                                array('in_time'=>'')
                            )
                        ),
                        'order'=>array(
                            'out_time'=>'ASC'
                        )
                    ));


                    if($record){
                        $success = false;
                        $this->Stock->begin();
                        $this->Stock->Attendance->id = $record['Attendance']['id'];
                        if($this->Stock->Attendance->saveField('in_time',date('Y-m-d H:i:s'))){
                            $this->Stock->id = $stock['Stock']['id'];
                            if($this->Stock->saveField('holder_id', null)){
                                $this->Stock->commit();
                                $success = true;
                            }else{
                                $this->Stock->rollback();
                            }
                        }

                        if($success){
                            $this->set('showsuccess', 1);
                            $this->set('successmsg', "歸還物品成功！");
                        }else{
                            $errormsg = "未能歸還";
                        }
                    }else{
                        $errormsg = "未有借出記錄";
                    }
                }
            }
            $this->request->data['Stock'][''] = "";
            $this->set('errormsg', $errormsg);


            if(!empty($errormsg)){
                $this->set('showwarning',1);
            }
        }else{
            if($parentcard){
                $this->set('parentcard', $parentcard);
            }
        }
    }

    public function repurchase($id = null){

        if($this->request->is('put') || $this->request->is('post')){
//            configure::write('debug',2);
//            debug($this->request->data);exit();

            $stock = $this->Stock->read(null, $id);

            $this->loadModel('Procumentrequest');
            $data = array(
                'name'=>$stock['Stock']['name'],
                'quantity'=>$this->request->data['Stock']['quantity'],
                'remark'=>$this->request->data['Stock']['remark'],
                'type'=>$stock['Stock']['type'],
                'date'=>date('Y-m-d'),
                'unit_id'=>1,
                'requester_id'=>1
            );
            $this->Procumentrequest->create();
            $this->Procumentrequest->save($data);

            $this->Session->setFlash(__('已提出請求'), 'default', array('class' => 'alert alert-info'));
            $this->redirect(array('controller'=>'stocks','action' => 'index'));

        }else{
            $this->request->data['Stock']['id'] = $id;
        }
    }

    public function reload()
    {
        $this->layout = "withoutmenu";

        if($this->request->is('put') || $this->request->is('post')){

            $stockcard = trim($this->request->data['Stock']['stockcard']);

            if(!empty($stockcard)) {
                $stock = $this->Stock->find('first', array(
                    'conditions'=>array(
                        'Stock.fix_asset_no'=>$stockcard,
                        'Stock.unit_id'=>$this->Auth->user('viewunits')
                    )
                ));

                if(!$stock){
                    $errormsg = "找不到存貨";
                }else{
                    $this->set('user_id', $stock['Stock']['holder_id']);
                    $record = $this->Stock->Attendance->find('first',array(
                        'conditions'=>array(
                            'stock_id'=>$stock['Stock']['id'],
                            'OR'=>array(
                                array('in_time'=>null),
                                array('in_time'=>'')
                            )
                        ),
                        'order'=>array(
                            'out_time'=>'ASC'
                        )
                    ));

                    $this->loadModel('Duration');
                    $duration = $this->Duration->find('first',array(
                        'conditions'=>array(
                            'Duration.unit_id'=>$stock['Stock']['unit_id']
                        )
                    ));


                    if($record){
                        $success = false;
                        $this->Stock->begin();
                        $this->Stock->Attendance->id = $record['Attendance']['id'];
                        if($this->Stock->Attendance->saveField('expected_return_time',date('Y-m-d', strtotime("+ ".$duration['Duration']['name']." days"))." 23:59:59")){
                            $this->Stock->commit();
                            $success = true;
                        }else{
                            $this->Stock->rollback();
                        }


                        if($success){
                            $this->set('showsuccess', 1);
                            $this->set('successmsg', "續借成功！預期歸還日為 ".date('Y-m-d', strtotime("+ ".$duration['Duration']['name']." days")) );
                        }else{
                            $errormsg = "未能續借";
                        }
                    }else{
                        $errormsg = "未有借出記錄";
                    }
                }
            }
            $this->request->data['Stock'][''] = "";
            $this->set('errormsg', $errormsg);


            if(!empty($errormsg)){
                $this->set('showwarning',1);
            }
        }else{
            if($parentcard){
                $this->set('parentcard', $parentcard);
            }
        }
    }


    public function checkout($parentcard = null)
    {
        $this->layout = "withoutmenu";

        if($this->request->is('put') || $this->request->is('post')){

            $parentcard = trim($this->request->data['Stock']['parentcard']);
            $stockcard = trim($this->request->data['Stock']['stockcard']);

            if(empty($parentcard)){
                $errormsg = "請先拍卡";
            }else{

                $this->loadModel('User');
                $this->User->Behaviors->load('Containable');

                $list = $this->User->UsersUnit->find('list',array('conditions'=>array('unit_id'=>$this->Auth->user('viewunits')),'fields'=>array('user_id','user_id')));
                
                $teacher = $this->User->find('first',array(
                    'conditions'=>array(
                        'User.membercard'=>$parentcard,
                        'User.id'=>$list
                    ),
                    'contain'=>array(
                        'Unit'
                    )
                ));


                if(empty($teacher)){
                    $errormsg = "找不到職員";
                }else{
                    $this->set('parentcard', $parentcard);
                    $this->set('teacher',$teacher);

                    if(!empty($stockcard)) {
//                        configure::write('debug',2);
                        $stock = $this->Stock->find('first', array(
                            'conditions'=>array(
                                'Stock.fix_asset_no'=>$stockcard,
                                'Stock.unit_id'=>$teacher['Unit'][0]['id']
                            )
                        ));

                        if(!$stock){
                            $errormsg = "找不到存貨";
                        } else if(!$stock['Stock']['valid']){
                            $errormsg = "存貨未能借出";
                        }else if($stock['Stock']['current_count'] < 1 ){
                            $errormsg = "存貨不足";
                        }else{

                            $this->loadModel('Duration');
                            $duration = $this->Duration->find('first',array(
                                'conditions'=>array(
                                    'Duration.unit_id'=>$teacher['Unit'][0]['id']
                                )
                            ));
                            $new_record = array(
                                'stock_id'=>$stock['Stock']['id'],
                                'user_id'=>$teacher['User']['id'],
                                'count'=>1,
                                'out_time'=>date('Y-m-d H:i:s'),
                                'expected_return_time'=>date('Y-m-d', strtotime("+ ".$duration['Duration']['name']." days"))." 23:59:59",
                            );

//                            $success = false;
                            $this->Stock->begin();
                            $this->Stock->id = $stock['Stock']['id'];
                            $holder = $this->Stock->field('holder_id');
                            if(!$holder){
                                $this->Stock->Attendance->create();
                                if($this->Stock->Attendance->save($new_record)){
                                    if($this->Stock->saveField('holder_id', $teacher['User']['id'])){
//                                        $success = true;
                                        $this->Stock->commit();
                                        $this->set('showsuccess', 1);
                                        $this->set('successmsg', "借出成功！預期歸還日為 ".date('Y-m-d', strtotime("+ ".$duration['Duration']['name']." days")));
                                    }else{
                                        $this->Stock->rollback();
                                    }
                                }
                            }else{
                                $errormsg = "物品已借出";
                            }


                            $this->set('parentcard', $parentcard);
                            $this->set('record', $this->Stock->Attendance->read(null, $this->Stock->Attendance->id));
                        }
                    }
                }
            }
            $this->request->data['Stock'][''] = "";
            $this->set('errormsg', $errormsg);


            if(!empty($errormsg)){
                $this->set('showwarning',1);
            }
        }else{
            if($parentcard){
                $this->set('parentcard', $parentcard);
            }
        }
    }


    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {

        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->Stock->Behaviors->load('Containable');

        $options = array(
            'conditions' => array(
                'Stock.' . $this->Stock->primaryKey => $id
            ),
            'contain' => array(
                'Unit',
                'Holder',
                'Voucher'
            ),
        );

        $stock = $this->Stock->find('first', $options);

        $this->set('stock', $stock);

    }

    public function viewimage($id = null)
    {

        $this->viewClass = 'Media';
        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Not exist'));
        }
        $rs = $this->Stock->findByid($id);

        $path = $rs['Stock']['image_path'];

        if(!empty($path)){
            $temp = explode(".", $path);
            $extension = end($temp);


            $params = array(
                'id' => basename($path),
                'name' => basename($path, "." . $extension),
                'extension' => $extension,
                'path' => APP . dirname($path) . DS,
                'download' => false
            );
        }else{
            $params = array(
                'id' => "dummyprofile.png",
                'name' => "dummyprofile",
                'extension' => "png",
                'path' => APP."Files" . DS,
                'download' => false,
                "cache"=>false
            );
        }

        $this->set($params);
    }


    public function updatephoto(){

        if ($this->request->is('post')) {
//            configure::write('debug',2);
            $id = $this->request->data['Stock']['stock_id'];

            if (!$this->Stock->exists($id)) {
                throw new NotFoundException(__('Invalid stock'));
            }

            $this->Stock->id = $id;

            unlink( APP . 'webroot/img/'. $this->Stock->field('image_path') );

            $allowedExts = array("jpeg", "jpg", "png");
            $temp = explode(".", $this->request->data['Stock']['image']["name"]);
            $extension = strtolower(end($temp)) ;

            if(!empty($this->request->data['Stock']['image']['name'])){
                if ($this->request->data['Stock']['image']["size"] < 5000000
                    && in_array(strtolower($extension), $allowedExts)
                ) {
                } else {
                    $error = true;
                    $this->Session->setFlash(__('資料出錯，請檢查') . ' (1)', 'default', array('class' => 'alert alert-danger'));
                }

                if($this->request->data['Stock']['image']["error"] > 0){
                    $error = true;
                    $this->Session->setFlash(__('資料出錯，請檢查') . ' (2)', 'default', array('class' => 'alert alert-danger'));
                }
            }

            if (!empty($this->request->data['Stock']['image']['name']) && !$error) {

                App::import('Component', 'Image');

                $fix_asset_no = str_replace(array('/', '('), '_', $this->Stock->field('fix_asset_no'));
                $fix_asset_no = rtrim($fix_asset_no, ')');
                $image_name = $this->Stock->field('unit_id')."_".$fix_asset_no . '.' . $extension;

                $path = 'webroot/img/stock_img/' .  $image_name;

                move_uploaded_file($this->request->data['Stock']['image']["tmp_name"], APP . $path);
                list($width, $height) = getimagesize(APP.$path) ;

                $imagick = new Imagick(APP.$path);
                //check if the org image too large
                if($width > 1280 || $height > 1280){
                    if($height > $width){
                        $newHeight = 1280;
                        $newWidth = (1280 / $height) * $width;
                    }else{
                        $newWidth = 1280;
                        $newHeight = (1280 / $width) * $height;
                    }

                    $imagick->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 1);
                    $imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
                    $imagick->setImageCompressionQuality(80);
                    $imagick->setImageFormat("jpeg");
                    $imagick->writeimage(APP.$path);
                }

            } else {
                $image_name = "";
                $path = "";
            }
            if(!$error){
                if($this->Stock->saveField('image_path',$image_name)){
                    $this->Session->setFlash(__('相片己成功更新'), 'default', array('class' => 'alert alert-success'));
                }else{
                    $this->Session->setFlash(__('資料出錯，請檢查') , 'default', array('class' => 'alert alert-danger'));
                }
            }

            $this->redirect(array('controller'=>'stocks','action' => 'index'));
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {

        if ($this->request->is('post')) {
            $this->request->data['Stock']['fix_asset_no'] = trim($this->request->data['Stock']['fix_asset_no']);

            $error = false;
            $allowedExts = array("jpeg", "jpg", "png");
            $temp = explode(".", $this->request->data['Stock']['image']["name"]);
            $extension = end($temp);

            if(!empty($this->request->data['Stock']['image']['name'])){
                if ($this->request->data['Stock']['image']["size"] < 4000000
                    && in_array(strtolower($extension), $allowedExts)
                ) {
                } else {
                    $error = true;
                    $this->Session->setFlash(__('資料出錯，請檢查') . ' (1)', 'default', array('class' => 'alert alert-danger'));
                }

                if($this->request->data['Stock']['image']["error"] > 0){
                    $error = true;
                    $this->Session->setFlash(__('資料出錯，請檢查') . ' (2)', 'default', array('class' => 'alert alert-danger'));
                }
            }

            if (!empty($this->request->data['Stock']['image']['name']) && !$error) {
                App::import('Component', 'Image');

                $fix_asset_no = str_replace(array('/', '('), '_', $this->request->data['Stock']['fix_asset_no']);
                $fix_asset_no = rtrim($fix_asset_no, ')');
                $image_name = $this->request->data['Stock']['unit_id']."_".$fix_asset_no . '.' . $extension;
                $path = 'webroot/img/stock_img/' . $image_name;
                move_uploaded_file($this->request->data['Stock']['image']["tmp_name"], APP . $path);


                list($width, $height) = getimagesize(APP.$path) ;
                $imagick = new Imagick(APP.$path);
                //check if the org image too large
                if($width > 1280 || $height > 1280){
                    if($height > $width){
                        $newHeight = 1280;
                        $newWidth = (1280 / $height) * $width;
                    }else{
                        $newWidth = 1280;
                        $newHeight = (1280 / $width) * $height;
                    }

                    $imagick->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 1);
                    $imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
                    $imagick->setImageCompressionQuality(80);
                    $imagick->setImageFormat("jpeg");
                    $imagick->writeimage(APP.$path);
                }


            } else {
                $path = "";
                $image_name = "";
            }

            $this->request->data['Stock']['image_path'] = $image_name;
            $this->request->data['Stock']['current_stock'] = $this->request->data['Stock']['total_stock'];
            $this->Stock->begin();
            $this->Stock->create();
            if ($this->Stock->saveAssociated($this->request->data, array("deep" => true))) {

            } else {
                $error = true;
            }
            if ($error) {
                $this->Stock->rollback();
                $this->Session->setFlash(__('The stock could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            } else {
                $this->Stock->commit();
                $this->Session->setFlash(__('The stock has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }


        }else{

            if($this->request->query['voucher']){
                $this->Stock->Voucher->Behaviors->load('Containable');

                $voucher = $this->Stock->Voucher->find('first',array(
                    'conditions'=>array(
                        'Voucher.code'=>$this->request->query['voucher'],
                        'Voucher.unit_id'=>7
                    ),
                    'contain'=>array(
                        'Stock'
                    )
                ));
                if(!empty($voucher)){
                    $this->set('voucher',$voucher);
                }else{
                    $this->request->data['Voucher']['code'] = $this->request->query['voucher'];
                }
            }

        }


        $units = $this->Stock->Unit->find('list', array('conditions'=>array('Unit.id'=>7),'fields' => array('id', 'name')));
        $type = $this->Stock->Stocktype->find('list', array('conditions'=>array('Stocktype.unit_id'=>7),'fields' => array('id', 'name')));

//        $this->loadModel('Locationdetail');
//
//        foreach($this->Locationdetail->find('list', array('conditions'=>array('Locationdetail.unit_id'=>$this->Auth->user('viewunits')),'fields' => array('name', 'name'))) as $v){
//            $ld[] =array(
//                'id'=>$v,
//                'name'=>$v
//            );
//        }

        $this->set('ld',$this->Stock->getlocationjson(7));

        $levels = $this->Stock->level;

        $this->set(compact('units', 'levels', 'type'));
        $this->set('location', $this->stock_location);

    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Stock->id = $this->request->data['Stock']['id'];

            $voucher = $this->Stock->Voucher->find('first',array(
                'conditions'=>array(
                    'Voucher.id'=>$this->request->data['Stock']['voucher_id']
                )
            ));

            $new_voucher = "";
            if(empty($voucher)){
                $new_voucher = $this->request->data['Stock']['voucher_id'];
                $this->request->data['Stock']['voucher_id'] = $this->Stock->field('voucher_id');
            }

            if ($this->Stock->saveAssociated($this->request->data, array("deep" => true))) {
                $this->Session->setFlash(__('The stock has been saved.'), 'default', array('class' => 'alert alert-success'));

                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                if(!empty($new_voucher)){
                    return $this->redirect(array('controller'=>'vouchers', 'action'=>'add', '?'=>array('voucher'=>$new_voucher,'stock'=>$this->Stock->id)));
                }else{
                    return $this->redirect($redirecturl);
                }
            } else {
                $this->Session->setFlash(__('The Stock could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
            $this->request->data = $this->Stock->find('first', $options);
            $this->set('stock',$this->request->data);

            $this->set('voucher', $this->Stock->Voucher->find('list',array('conditions'=>array('Voucher.id'=>$this->request->data['Stock']['voucher_id']),'fields'=>array('id', 'code'))));
        }

        $units = $this->Stock->Unit->find('list', array('conditions'=>array('Unit.id'=>$this->Auth->user('viewunits')),'fields' => array('id', 'name')));
        $type = $this->Stock->Stocktype->find('list', array('conditions'=>array('Stocktype.unit_id'=>$this->Auth->user('viewunits')),'fields' => array('id', 'name')));

//        $this->loadModel('Locationdetail');
//
//        foreach($this->Locationdetail->find('list', array('conditions'=>array('Locationdetail.unit_id'=>$this->Auth->user('viewunits')),'fields' => array('name', 'name'))) as $v){
//            $ld[] =array(
//                'id'=>$v,
//                'name'=>$v
//            );
//        }
//
//
//        $this->set('ld',$ld);
        $this->set('ld',$this->Stock->getlocationjson($this->Auth->user('viewunits')));

        $this->set(compact('units', 'type'));
        $this->set('location', $this->stock_location);


    }

    public function select_voucher()
    {
        if ($this->request->is(array('post', 'put'))) {
            $voucher = $this->Stock->Voucher->find('first',array(
                'conditions'=>array(
                    'Voucher.id'=>$this->request->data['Stock']['voucher_id']
                )
            ));

            if(empty($voucher)){
                $this->Session->setFlash(__('The Voucher does not exit. Voucher will be created.'), 'default', array('class' => 'alert alert-info'));
                return $this->redirect(array('action'=>'add', '?'=>array('voucher'=>$this->request->data['Stock']['voucher_id'])));

            }else{
                return $this->redirect(array('action'=>'add', '?'=>array('voucher'=>$voucher['Voucher']['code'])));
            }
        }

        $this->set('voucher', $this->Stock->Voucher->find('list',array('conditions'=>array('unit_id'=>7),'fields'=>array('id','code'))));

    }


    public function trash($id = null)
    {
        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Stock->id = $this->request->data['Stock']['id'];
            if ($this->Stock->saveField('disposal', $this->request->data['Stock']['disposal'])) {
                $this->Stock->saveField('valid', 0);

                $this->Session->setFlash(__('The Stock has been saved.'), 'default', array('class' => 'alert alert-success'));
                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            } else {
                $this->Session->setFlash(__('The Stock could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
            $this->request->data = $this->Stock->find('first', $options);
            $this->set('stock',$this->request->data);
        }

        $this->set('fadeout_reason', $this->fadeout_reason);

    }

    public function edittrash($id = null)
    {
        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Stock->id = $this->request->data['Stock']['id'];
            $this->Stock->saveField('disposal', $this->request->data['Stock']['disposal']);
            $this->Stock->saveField('disposal_code', $this->request->data['Stock']['disposal_code']);
            $this->Stock->saveField('disposal_remark', $this->request->data['Stock']['disposal_remark']);

            $this->Session->setFlash(__('The Stock has been saved.'), 'default', array('class' => 'alert alert-success'));
            if ($this->request->params['named']['redirect']) {
                $redirecturl = urldecode($this->request->params['named']['redirect']);
            } else {
                $redirecturl = array('action' => 'disposal');
            }
            return $this->redirect($redirecturl);
        } else {
            $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
            $this->request->data = $this->Stock->find('first', $options);
            $this->set('stock',$this->request->data);
        }

        $this->loadModel('Disposalcode');

        foreach($this->Disposalcode->find('list', array('conditions'=>array('Disposalcode.unit_id'=>$this->Auth->user('viewunits')),'fields' => array('name', 'name'))) as $v){
            $disposal_code[] =array(
                'id'=>$v,
                'name'=>$v
            );
        }

        $this->set('disposal_code',$disposal_code);

        $this->set('fadeout_reason', $this->fadeout_reason);

    }


    public function advsearch()
    {
        if ($this->request->is(array('post', 'put'))) {
            $conds = array();
            if (!empty($this->request->data['Stock'])) {

                foreach ($this->request->data['Stock'] as $key => $val) {
                    if (strlen($val) != 0) {
                        $conds[$this->Stock->alias . '.' . $key] = trim($val);
                    }
                }
            }
            if (!empty($this->request->data['StockCustomField'])) {
                foreach ($this->request->data['StockCustomField'] as $key => $val) {
                    if (!empty($val['value'])) {
                        $this->Stock->bindModel(array('hasOne' => array('StocksStockinputfield')));
                        $conds['StocksStockinputfield.memberinputfield_id'] = $val['memberinputfield_id'];
                        $conds['StocksStockinputfield.value'] = trim($val['value']);
                    }
                }
            }
            if (!empty($this->request->data['Stocktype'])) {
                if (!empty($this->request->data['Stocktype']['Stocktype'])) {
                    $this->Stock->bindModel(array('hasOne' => array('StocksStocktype')));
                    $conds['StocksStocktype.membertype_id'] = 1;
                }

            }

            $rs = $this->Stock->find('all', array(
                    'conditions' => $conds
                )
            );
            $this->set('rs', $rs);
        }
        $this->Stock->StockCustomField->Stockinputfield->Behaviors->load('Containable');
        $customfields = $this->Stock->StockCustomField->Stockinputfield->find('all', array(
                'contain' => array(
                    'Inputtype' => array('fields' => array('htmltype', 'type')),
                    'Selectionlist',
                    'Selectionlist.Selectionitem'
                )
            )
        );
        $membertypes = $this->Stock->Stocktype->find('list');
        $this->set(compact('customfields', 'membertypes'));
    }

    public function sendconfirmmail($id)
    {
        if (configure::read("member_username") == "email") {
            $this->autoRender = false;
            $this->Stock->recursive = 0;
            $rs = $this->Stock->find('first', array(
                    'conditions' => array(
                        'Stock.id' => $id,
                        'Stock.active' => 0
                    )
                )
            );
            if (!empty($rs)) {
                $hashstring = uniqid() . $this->Stock->generatepassword(20);
                $this->Stock->id = $rs['Stock']['id'];
                if ($this->Stock->saveField('hashstring', $hashstring)) {
                    $Email = new CakeEmail('default');
                    $Email->template('sendconfirmmail', 'membermail');
                    $Email->emailFormat('html');
                    $Email->subject("TESTING");
                    $Email->to($rs['Stock']['username']);
                    $Email->helpers(array('Html'));
                    $Email->viewVars(array('hashstring' => $hashstring));
                    $Email->send();
                    echo "OK";
                }
            }
        }
    }

    public function sendresetpwdmail($id)
    {
        if (configure::read("member_username") == "email") {
            $this->autoRender = false;
            $this->Stock->recursive = 0;
            $rs = $this->Stock->find('first', array(
                    'conditions' => array(
                        'Stock.id' => $id,
                        'Stock.active' => 1
                    )
                )
            );
            if (!empty($rs)) {
                $this->Stock->id = $rs['Stock']['id'];
                $verifystring = md5(uniqid(rand()));
                $this->Stock->id = $rs['Stock']['id'];
                if ($this->Stock->saveField('resetpwd_hashstring', $verifystring)) {
                    $Email = new CakeEmail('default');
                    $Email->template('sendresetpwdmail', 'membermail');
                    $Email->emailFormat('html');
                    $Email->subject("TESTING");
                    $Email->to($rs['Stock']['username']);
                    $Email->helpers(array('Html'));
                    $Email->viewVars(array('hashstring' => $verifystring));
                    $Email->send();
                    echo "OK";
                }
            }
        }
    }

    public function in($id = null, $rein = false){
        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Stock->save($this->request->data)) {
                $this->Session->setFlash("學生已經成功入院", 'default', array('class' => 'alert alert-success'));

                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            } else {
                $this->Session->setFlash("資料不正確，請重新輸入", 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
            $this->request->data = $this->Stock->find('first', $options);
            if($rein){
                $this->request->data['Stock']['Level'] = 1;
            }
        }

        $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
        $this->set("member", $this->Stock->find('first', $options));

        $levels = $this->Stock->level;
        $this->set('levels', $levels);

        $this->set('rein', $rein);
    }

    public function out($id = null){
        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }
        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Stock']['last_checkin_time'] = date('Y-m-d H:i:s');
            $this->request->data['Stock']['status'] = 2;
            if ($this->Stock->save($this->request->data)) {
                $this->Session->setFlash("學生已經成功出院", 'default', array('class' => 'alert alert-success'));

                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            } else {
                $this->Session->setFlash("資料不正確，請重新輸入", 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
            $this->request->data = $this->Stock->find('first', $options);
        }
        $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
        $this->set("member", $this->Stock->find('first', $options));

        $levels = $this->Stock->level;
        $this->set('levels', $levels);
    }

    public function ajaxchangelastestindate(){
        $this->autoRender = false;
        $date = $this->request->data['value'];
        $pk = $this->request->data['pk'];
        if(!empty($pk)){
            $this->Stock->id = $pk;
            $this->Stock->saveField(
                "lastestindate",
                $date
            );
            $datetime1 = new DateTime($date);
            $datetime2 = new DateTime();
            $interval = $datetime1->diff($datetime2);
            echo $interval->format('%a days');
        }
    }

    public function sync(){

    }


    public function checkinfo($id = null){
        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Stock->save($this->request->data)) {
                $this->Session->setFlash("學生資料已經成功確認", 'default', array('class' => 'alert alert-success'));

                if ($this->request->params['named']['redirect']) {
                    $redirecturl = urldecode($this->request->params['named']['redirect']);
                } else {
                    $redirecturl = array('action' => 'index');
                }
                return $this->redirect($redirecturl);
            } else {
                $this->Session->setFlash("資料不正確，請重新輸入", 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
            $this->request->data = $this->Stock->find('first', $options);
        }

        $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
        $this->set("member", $this->Stock->find('first', $options));

        $levels = $this->Stock->level;
        $this->set('levels', $levels);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Stock->id = $id;
        if (!$this->Stock->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->request->allowMethod('post', 'delete');
        $check = $this->Stock->Attendance->find('all',array(
            'conditions'=>array(
                'Attendance.stock_id'=>$id
            )
        ));

        if(empty($check)){

            $image_path = $this->Stock->field('image_path');
            if ($this->Stock->delete()) {

                unlink( APP . 'webroot/img/'. $image_path );
                $this->Session->setFlash(__('The Stock has been deleted.'), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The Stock could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }else{
            $this->Session->setFlash(__('The Stock could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function instant_reload($id = null)
    {
        $this->Stock->id = $id;
        if (!$this->Stock->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }

        $record = $this->Stock->Attendance->find('first',array(
            'conditions'=>array(
                'stock_id'=>$id,
                'OR'=>array(
                    array('in_time'=>null),
                    array('in_time'=>'')
                )
            ),
            'order'=>array(
                'out_time'=>'ASC'
            )
        ));

        $this->loadModel('Duration');
        $duration = $this->Duration->find('first',array(
            'conditions'=>array(
                'Duration.unit_id'=>$this->Stock->field('unit_id')
            )
        ));


        if($record){
            $success = false;
            $this->Stock->begin();
            $this->Stock->Attendance->id = $record['Attendance']['id'];
            if($this->Stock->Attendance->saveField('expected_return_time',date('Y-m-d', strtotime("+ ".$duration['Duration']['name']." days"))." 23:59:59")){
                $this->Stock->commit();
                $success = true;
            }else{
                $this->Stock->rollback();
            }


            if($success){
                $this->Session->setFlash("續借成功！預期歸還日為 ".date('Y-m-d', strtotime("+ ".$duration['Duration']['name']." days")), 'default', array('class' => 'alert alert-success'));
            }else{
                $this->Session->setFlash(__('未能續借'), 'default', array('class' => 'alert alert-danger'));
            }
        }else{
            $this->Session->setFlash(__('未有借出記錄'), 'default', array('class' => 'alert alert-danger'));
        }


        return $this->redirect(array('action' => 'index'));
    }

    public function instant_checkin($id = null)
    {
        $this->Stock->id = $id;
        if (!$this->Stock->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }

        $record = $this->Stock->Attendance->find('first',array(
            'conditions'=>array(
                'stock_id'=>$id,
                'OR'=>array(
                    array('in_time'=>null),
                    array('in_time'=>'')
                )
            ),
            'order'=>array(
                'out_time'=>'ASC'
            )
        ));


        $this->loadModel('Duration');
        $duration = $this->Duration->find('first',array(
            'conditions'=>array(
                'Duration.unit_id'=>$this->Stock->field('unit_id')
            )
        ));

        if($record){
            $success = false;
            $this->Stock->begin();
            $this->Stock->Attendance->id = $record['Attendance']['id'];
            if($this->Stock->Attendance->saveField('expected_return_time',date('Y-m-d', strtotime("+ ".$duration['Duration']['name']." days"))." 23:59:59")){
                $this->Stock->commit();
                $success = true;
            }else{
                $this->Stock->rollback();
            }

            if($this->Stock->Attendance->saveField('in_time',date('Y-m-d H:i:s'))){
                $this->Stock->id = $id;
                if($this->Stock->saveField('holder_id', null)){
                    $this->Stock->commit();
                    $success = true;
                }else{
                    $this->Stock->rollback();
                }
            }


            if($success){
                $this->Session->setFlash("歸還物品成功", 'default', array('class' => 'alert alert-success'));
            }else{
                $this->Session->setFlash(__('未能歸還'), 'default', array('class' => 'alert alert-danger'));
            }
        }else{
            $this->Session->setFlash(__('未有借出記錄'), 'default', array('class' => 'alert alert-danger'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function undotrash($id = null)
    {
        $this->Stock->id = $id;
        if (!$this->Stock->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }

        $this->Stock->id = $id;

        if($this->Stock->saveField('disposal',0)){
            $this->Stock->saveField('disposal_code',null);
            $this->Stock->saveField('disposal_remark',null);
            $this->Stock->saveField('confirm_disposal',0);
            $this->Session->setFlash("更新成功！", 'default', array('class' => 'alert alert-success'));
        }else{
            $this->Session->setFlash(__('未能更新'), 'default', array('class' => 'alert alert-danger'));
        }

        return $this->redirect(array('action' => 'disposal'));
    }

    public function confirmdisposal($id = null)
    {
        $this->Stock->id = $id;
        if (!$this->Stock->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }

        $this->Stock->id = $id;

        if($this->Stock->saveField('confirm_disposal',1)){
            $this->Session->setFlash("更新成功！", 'default', array('class' => 'alert alert-success'));
        }else{
            $this->Session->setFlash(__('未能更新'), 'default', array('class' => 'alert alert-danger'));
        }

        return $this->redirect(array('action' => 'disposal'));
    }


    public function changeactive()
    {
        $this->autoRender = false;
        $msg = array('result' => false);
        if ($this->request->is('post') || $this->request->is('put')) {
            $id = $this->request->data['id'];
            $valid = $this->request->data['valid'];
            if (!$this->Stock->exists($id)) {
                throw new NotFoundException(__('Invalid user'));
            }
            $this->Stock->id = $id;
            if ($this->Stock->saveField('valid', 1-$valid)) {
                $msg = array('result' => true, 'valid' => 1-$valid, 'posted' => $this->request->data);
            }
        }

//        echo json_encode($this->request->data);
        echo json_encode($msg);
    }

    public function bookmark($id = null){

        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $member = $this->Stock->read(null, $id);
            $this->Stock->id = $id;


            if($member['Stock']['bookmark']){
                $this->Stock->saveField('bookmark',0);
            }else{
                $this->Stock->saveField('bookmark',1);
            }

            $this->Session->setFlash(__('The member has been bookmarked.'), 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'index'));
        }

    }


    public function reissuecard($id = null)
    {
        $this->layout = "withoutmenu";

        if (!$this->Stock->exists($id)) {
            throw new NotFoundException(__('Invalid member'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Stock->id = $id;
            $error = false;
            $this->Stock->begin();

            if(!empty($this->request->data['Stock']['membercard'])){
                if (!$this->Stock->saveField('membercard', $this->request->data['Stock']['membercard'])) {
                    $error = configure::read("error_prefix") . "00064";
                };
            }

            if ($error) {
                $this->Stock->rollback();
                $this->Session->setFlash(__('更新失敗，請再檢查後嘗試') . ' (' . $error . ')', 'default', array('class' => 'alert alert-danger'));
            } else {
                $this->Stock->commit();
                $this->Session->setFlash(__('更新成功'), 'default', array('class' => 'alert alert-success'));
                echo "<script>window.close();</script>";
            }
        } else {
            $options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
            $this->request->data = $this->Stock->find('first', $options);
        }
    }


    public function ajax_add(){
        $this->autoRender = false;
        $success = true;

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Stock->id = trim($this->request->data['id']);
            $this->Stock->saveField('current_count', (int)$this->Stock->field('current_count') +1);
            $this->Stock->saveField('total_count', (int)$this->Stock->field('total_count') +1);

            echo json_encode(
                array(
                    "success" => $success
                )
            );
        }

    }

    public function ajax_minus(){

        $this->autoRender = false;
        $success = true;

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Stock->id = trim($this->request->data['id']);
            $this->Stock->saveField('current_count', (int)$this->Stock->field('current_count') -1);
            $this->Stock->saveField('total_count', (int)$this->Stock->field('total_count') -1);

            echo json_encode(
                array(
                    "success" => $success
                )
            );
        }

    }
//
//    public function changeactive($id = null) {
////        $this->request->allowMethod('post', 'delete');
//
//        if (!$id) {
//            $this->redirect(array('action' => 'index'));
//        }
//
//        $act = $this->Stock->read(null, $id);
//
//        $valid = 0;
//        if($act['Activity']['active']){
//            $valid = 0;
//        }else{
//            $valid = 1;
//        }
//
//        $this->Stock->id = $id;
//
//        if ($this->Stock->saveField('active',$valid)) {
//            if($valid){
//                $this->Session->setFlash(__('The Stock has been changed to active.'), 'default', array('class'=>'alert alert-success'));
//            }else{
//                $this->Session->setFlash(__('The Stock has been changed to inactive.'), 'default', array('class'=>'alert alert-success'));
//            }
//            $this->redirect(array('action' => 'index'));
//        } else {
//            $this->Session->setFlash(__('The Stock could not be deleted. Please, try again.'),'default', array('class'=>'alert alert-danger'));
//            $this->redirect(array('action' => 'index'));
//        }
//    }


    public function ajax_list(){
//        configure::writE('debug',2);
        $this->autoRender = false;
        $output = array();

        $options = array();

        $input =& $_GET;

// Number of columns being displayed (useful for getting individual column search info)
        $iColumns = $input['iColumns'];

// Get mDataProp values assigned for each table column
        $dataProps = array();
        for ($i = 0; $i < $iColumns; $i++) {
            $var = 'mDataProp_'.$i;
            if (!empty($input[$var]) && $input[$var] != 'null') {
                $dataProps[$i] = $input[$var];
//                $options['fields'][] = $input[$var];
            }
        }


//		$options['fields'] = $dataProps;
//		array_push($options['fields'], 'Shippingitem.tracking');

        $this->Stock->Behaviors->load('Containable');

        $options['contain'] = array(
            'Unit',
            'Holder',
            'Stocktype'
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
                    if($field == "name") {
                        $options['order'][] = array("Stock.name" => $order);
                    }else if($field == "valid"){
                        $options['order'][] = array("Stock.valid"=>$order);
                    }else if($field == "holder"){
                        $options['order'][] = array("Stock.holder_id"=>$order);
                    }else if($field == "type"){
                        $options['order'][] = array("Stock.type"=>$order);
                    }else if($field == "fix_asset_no"){
                        $options['order'][] = array("Stock.fix_asset_no"=>$order);
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

        if(!empty($input['name'])){
            $options['conditions']['AND']['OR']["Stock.fix_asset_no LIKE "] = '%' . $input['name'] . '%';
            $options['conditions']['AND']['OR']["Stock.name LIKE "] = '%' . $input['name'] . '%';
        }


        if(!empty($input['unit'])){
            $options['conditions']["Stock.unit_id"] = $input['unit'];
        }

        $options['conditions']["Stock.unit_id"] = 7;
//        if(!isset($options['conditions']["Stock.unit_id"])){
//            $options['conditions']["Stock.unit_id"] = $this->Auth->user('viewunits');
//        }

        if(!empty($input['holder_id'])){
            $options['conditions']["Stock.holder_id"] = $input['holder_id'];
        }

        if(!empty($input['voucher_id'])){
            $options['conditions']["Stock.voucher_id"] = $input['voucher_id'];
        }

        if(!empty($input['type'])){
            $options['conditions']["Stock.type"] = $input['type'];
        }

        if(!empty($input['location'])){
            $options['conditions']["Stock.location"] = $input['location'];
        }

        if(!empty($input['status'])){
            if($input['status'] == 1){
                $options['conditions']["Stock.holder_id"] = NULL;
            }else if($input['status'] == 2){
                $options['conditions']['NOT']["Stock.holder_id"] = NULL;
            }else if($input['status'] == 3){

                $list = $this->Stock->Attendance->find('list',array(
                    'conditions'=>array(
                        'Attendance.in_time'=>null,
                        'Attendance.expected_return_time <'=> date('Y-m-d')." 23:59:59"
                    ),
                    'fields'=>array(
                        'stock_id'
                    )
                ));

                $options['conditions']['NOT']["Stock.holder_id"] = NULL;
                $options['conditions']["Stock.id"] = array_values($list);

            }
        }

        if(!$input['disposal']){
            $options['conditions']['Stock.disposal'] = 0;
        }else{
            $options['conditions']['NOT']['Stock.disposal'] = 0;
            if($input['reason']){
                $options['conditions']['Stock.disposal'] = $input['reason'];
            }
        }

        $this->Stock->Behaviors->load('Containable');
        $result = $this->Stock->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Stock->find('count',$options);
        $all_count = $this->Stock->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );


        foreach ( $result as $doc ) {


            $doc['Stock']['name'] = h($doc['Stock']['name']);
            $doc['Stock']['type'] = h($doc['Stocktype']['name']);

            if($doc['Stock']['bookmark']){
                $doc['Stock']['name'] .= " <span class='label label-warning label-tag'>需要評估</span>";
            }

//            $doc['Stock']['unit'] = $doc['Unit']['code']." - ".$doc['Stock']['class'];
            $doc['Stock']['unit'] = $doc['Unit']['name'];
            $doc['Stock']['level'] = $doc['Stock']['Level'];

            if($doc['Stock']['disposal']){
                $doc['Stock']['reason'] = $this->fadeout_reason[$doc['Stock']['disposal']];

                if(!empty($doc['Stock']['disposal_code'])){
                    $doc['Stock']['reason'] .= "<br>銷貨編碼: ".$doc['Stock']['disposal_code'];
                }
                if(!empty($doc['Stock']['disposal_remark'])){
                    $doc['Stock']['reason'] .= "<br>備注: ".$doc['Stock']['disposal_remark'];
                }
            }
//
//            $minus = "<span class='fa fa-minus text-danger minus' data-id='".$doc['Stock']['id']."'></span> ";
//            $add = " <span class='fa fa-plus text-info add' data-id='".$doc['Stock']['id']."'></span>";

//            if($doc['Stock']['current_count'] >0){
//                $doc['Stock']['count'] = $minus.$doc['Stock']['current_count'].'/'.$doc['Stock']['total_count'].$add;
//
//            }else{
//                $doc['Stock']['count'] = $doc['Stock']['current_count'].'/'.$doc['Stock']['total_count'].$add;
//            }


            if(!$doc['Stock']['location']) {
                $doc['Stock']['location'] = "沒有資料";
            }else{
                $doc['Stock']['location'] = $this->stock_location[$doc['Stock']['location']];
            }

            if($doc['Stock']['location_detail']){
                $doc['Stock']['location'] .= "(".$doc['Stock']['location_detail'].")";
            }

            $doc['Stock']['type'] = $doc['Stocktype']['name'];

            $disabled = "";
            $doc['Stock']['holder'] =  "未借出";

            if($doc['Holder']['name']){
                $doc['Stock']['holder'] = $doc['Holder']['name'];

                $record = $this->Stock->Attendance->find('first',array(
                    'conditions'=>array(
                        'Attendance.stock_id'=>$doc['Stock']['id'],
                        'Attendance.user_id'=>$doc['Holder']['id']
                    ),
                    'order'=>array(
                        'Attendance.out_time'=>'DESC'
                    )
                ));

                $period = date_diff(date_create($record['Attendance']['expected_return_time']), date_create(date('Y-m-d')." 23:59:59"));
                $doc['Stock']['holder'] .="<br>";
                if(!$doc['Stock']['disposal']){
                    if(date('Y-m-d H:i:s') < $record['Attendance']['expected_return_time']){
                        $doc['Stock']['holder'] .= "到期日:".date('Y-m-d',strtotime($record['Attendance']['expected_return_time']))." (".(($period->y > 1)?$period->y."年":"").(($period->m > 1)?$period->m."月":"").$period->d."日後)";
                    }else{
                        $doc['Stock']['holder'] .= "到期日:".date('Y-m-d',strtotime($record['Attendance']['expected_return_time']))." <br><strong class='text-danger'>(已過期".(($period->y > 1)?$period->y."年":"").(($period->m > 1)?$period->m."月":"").$period->d."日) </strong>";
                    }
                }

                $disabled = "disabled";
            }

            if($doc['Stock']['disposal']){
                $disabled = "disabled";
            }

            if(!$this->Auth->user('allow_action.stock.edit')){
                $disabled = "disabled";
            }

            App::import('Helper','Form');
            $form = new FormHelper(new View());

            if($doc['Stock']['valid']){
                $doc['Stock']['valid'] =  '<label for="switcher-basic" class="switcher switcher-blank" ><input class="valid-switcher" type="checkbox" data-id="'.$doc["Stock"]['id'].'" checked '.$disabled.'><div class="switcher-indicator"><div class="switcher-yes">YES</div><div class="switcher-no">NO</div></div></label>';
            } else{
                $doc['Stock']['valid'] =  '<label for="switcher-basic" class="switcher switcher-blank" ><input class="valid-switcher" type="checkbox" data-id="'.$doc["Stock"]['id'].'" '.$disabled.'><div class="switcher-indicator"><div class="switcher-yes">YES</div><div class="switcher-no">NO</div></div></label>';

            }


            App::import('Helper', 'Html');
            $html = new HtmlHelper(new View());

            if($doc['Stock']['image_path']){
                $doc['Stock']['image'] = "<img src='".$html->url('/img/stock_img/'. $doc['Stock']['image_path'])."' alt='images' height='100'>";
            }else{
                $doc['Stock']['image'] = "<img src='".$html->url('/img/dummy-avatar.png')."' alt='images' height='100'>";

            }
//            $doc['Stock']['image'] = "";
            $doc['Stock']['action'] = "";
            if(!$doc['Stock']['disposal']){
                if($doc['Stock']['holder_id']){
//                    if($this->Auth->user('allow_action.stock.instant_reload')){
                        $doc['Stock']['action'] .= $form->postLink('續借', array('action' => 'instant_reload', $doc['Stock']['id']), array('class' => 'btn btn-warning', 'escape' => false), __('確定續借嗎?'))." ";
//                    }

//                    if($this->Auth->user('allow_action.stock.instant_checkin')){
                        $doc['Stock']['action'] .= $form->postLink('歸還', array('action' => 'instant_checkin', $doc['Stock']['id']), array('class' => 'btn btn-warning', 'escape' => false), __('確定歸還嗎?'))." ";
//                    }
                }else{
//                    if($this->Auth->user('allow_action.stock.trash')) {
                        $doc['Stock']['action'] .= $html->link('銷貨', array('action' => 'trash', $doc['Stock']['id'], 'ajax' => true), array('class' => 'btn btn-warning', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modal')) . " ";
//                    }
                }
//                if($this->Auth->user('allow_action.stock.view')) {
                    $doc['Stock']['action'] .= $html->link('查看', array('action' => 'view', $doc['Stock']['id'], 'ajax' => true), array('class' => 'modalbtn btn-info btn', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modal')) . " ";
//                }
//                if($this->Auth->user('allow_action.stock.edit')){
                    $doc['Stock']['action'] .= $html->link('修改', array('action' => 'edit', $doc['Stock']['id'],'ajax'=>true), array('class' => 'modalbtn btn-warning btn', 'escape' => false, 'data-toggle'=>'modal', 'data-target'=>'#modal'))." ";
//                }

//                if($this->Auth->user('allow_action.stock.match')) {
                    $doc['Stock']['action'] .= $html->link('<button class="btn btn-success" ><i class="fa fa-wifi"></i></button>', array('action' => 'reissuecard', $doc['Stock']['id']), array("class" => 'openasnew', 'escape' => false)) . " ";
//                }
//                if($this->Auth->user('allow_action.stock.delete')) {
                    $doc['Stock']['action'] .= $form->postLink('刪除', array('action' => 'delete', $doc['Stock']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('確定刪除嗎?'))." ";
//                }

                $doc['Stock']['action'] .= "<hr class='no-space'>".$html->link('再採購', array('action' => 'repurchase', $doc['Stock']['id'], 'ajax' => true), array('class' => 'modalbtn btn-info btn', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modal')) . " ";
                $doc['Stock']['action'] .= $html->link('轉倉', array('action' => 'repurchase', $doc['Stock']['id'], 'ajax' => true), array('class' => 'modalbtn btn-success btn', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modal')) . " ";



            }else{

//                if($this->Auth->user('allow_action.stock.trash')){
                    $doc['Stock']['action'] .= $html->link('更新原因', array('action' => 'edittrash', $doc['Stock']['id'],'ajax'=>true), array('class' => 'modalbtn btn-info btn', 'escape' => false, 'data-toggle'=>'modal', 'data-target'=>'#modal'))." ";
//                }

//                if($this->Auth->user('allow_action.stock.confirmdisposal')) {
                    if(!$doc['Stock']['confirm_disposal']){
                        $doc['Stock']['action'] .= $form->postLink('確認銷貨', array('action' => 'confirmdisposal', $doc['Stock']['id']), array('class' => 'btn btn-warning', 'escape' => false), __('確定確認銷貨嗎?'))." ";
                    }
//                }

//                if($this->Auth->user('allow_action.stock.undotrash')) {
                    if(!$doc['Stock']['confirm_disposal'] || $this->Auth->user('superadmin')){
                        $doc['Stock']['action'] .= $form->postLink('還原', array('action' => 'undotrash', $doc['Stock']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('確定還原銷貨嗎?'))." ";
                    }
//                }


            }

            $output['aaData'][] = $doc['Stock'];

        }

        echo json_encode( $output );
    }

    public function checkexpire(){
//        configure::write('debug',2);
        $this->Stock->Attendance->Behaviors->load('Containable');
        $records = $this->Stock->Attendance->find('all',array(
            'conditions'=>array(
                'Attendance.in_time'=>null,
                'Attendance.expected_return_time <'=> date('Y-m-d',strtotime(' + 1 day'))." 23:59:59"
            ),
            'contain'=>array(
                'Stock',
                'User'
            )
        ));

        $list = array();
        foreach($records as $record){

            if(!$record['Stock']['disposal']){
                if($record['User']['email']){
                    $data = array(
                        'name'=>$record['Stock']['name'],
                        'expected_return_time'=>$record['Attendance']['expected_return_time'],
                    );
                    $list[$record['User']['id']]['username'] = $record['User']['name'];
                    $list[$record['User']['id']]['email'] = $record['User']['email'];
                    $list[$record['User']['id']]['detail'][] = $data;

                }
            }
        }

        $this->loadModel('Queue');
        foreach($list as $item){
            $this->Queue->push_back('Users', 'send_email', array('return_notice', 'zh_tw'), 'POST', date('Y-m-d G:i:s'), array($item['email'], $item['username'], $item['detail']));
        }

        exit();
    }

    public function ajax_select2_list(){
        $this->autoRender = FALSE;

        $name = empty($this->request->query['term'])?"":$this->request->query['term'];

        $option = array();
        if(!empty($name)){
            $option['OR']['Stock.name LIKE'] = "%".$name."%";
            $option['OR']['Stock.fix_asset_no LIKE'] = "%".$name."%";
        }

        $this->loadModel('UsersUnit');
        $units = $this->Stock->Unit->find('list', array('conditions'=>array('Unit.id'=>$this->Auth->user('viewunits')),'fields' => array('id', 'name')));

        $option['Stock.unit_id'] = array_keys($units);

        $students = $this->Stock->find('all',
            array(
                'conditions' => $option,
                'limit'=>10,
                'fields'=>array(
                    'id','long_name'
                )
            )
        );
        if(empty($students)){
            echo json_encode(array('empty'=>true));
        }
        else{
            $list = array();
            foreach($students as $k=>$student){
                $data = array();
                $data['id'] = $student['Stock']['id'];
                $data['text'] = $student['Stock']['long_name'];
                $list[] = $data;
            }
            echo json_encode($list);
        }
        exit();
    }


    public function beforeFilter()
    {


        $this->Auth->allow('ajax_add', 'checkexpire', 'checkout');
        if ($this->request['action'] == 'sendconfirmmail' || $this->request['action'] == 'sendresetpwdmail') {
            $this->allowtoken();
            $this->Security->unlockedActions[] = 'sendresetpwdmail';
            $this->Security->unlockedActions[] = 'sendconfirmmail';
        }

        if ($this->request['action'] == 'dosync') {
            $this->allowtoken();
        }

        $this->Security->unlockedActions[] = 'changeactive';
        $this->Security->unlockedActions[] = 'ajax_checkunique';
        $this->Security->unlockedActions[] = 'ajaxchangelastestindate';
        parent::beforeFilter();
    }

}
