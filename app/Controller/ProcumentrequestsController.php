<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Procumentrequests Controller
 *
 * @property Procumentrequest $Procumentrequest
 * @property PaginatorComponent $Paginator
 */
class ProcumentrequestsController extends AppController
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

        $type = $this->Procumentrequest->Stocktype->find('list', array('conditions'=>array('Stocktype.unit_id'=>7),'fields' => array('id', 'name')));
        $this->set('stock_type',$type);

    }

    public function delete($id = null)
    {
        $this->Procumentrequest->id = $id;
        if (!$this->Procumentrequest->exists()) {
            throw new NotFoundException(__('Invalid member'));
        }
        $this->request->allowMethod('post', 'delete');


        if ($this->Procumentrequest->delete()) {

            $this->Session->setFlash(__('The Procumentrequest has been cancelled.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The Procumentrequest could not be cancelled. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }

        return $this->redirect(array('action' => 'index'));
    }



    public function ajax_list(){
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

        $this->Procumentrequest->Behaviors->load('Containable');

        $options['contain'] = array(
            'Unit',
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
                        $options['order'][] = array("Procumentrequest.name" => $order);
                    }else if($field == "valid"){
                        $options['order'][] = array("Procumentrequest.valid"=>$order);
                    }else if($field == "holder"){
                        $options['order'][] = array("Procumentrequest.holder_id"=>$order);
                    }else if($field == "type"){
                        $options['order'][] = array("Procumentrequest.type"=>$order);
                    }else if($field == "fix_asset_no"){
                        $options['order'][] = array("Procumentrequest.fix_asset_no"=>$order);
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
            $options['conditions']["Procumentrequest.name LIKE "] = '%' . $input['name'] . '%';
        }

        if(!empty($input['type'])){
            $options['conditions']["Procumentrequest.type"] = $input['type'];
        }



        $result = $this->Procumentrequest->find('all',$options);
        unset($options['limit']);
        unset($options['offset']);
        $result_count = $this->Procumentrequest->find('count',$options);
        $all_count = $this->Procumentrequest->find('count');

        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $all_count,
            "iTotalDisplayRecords" => $result_count,
            "aaData" => array(),
        );

        App::import('Helper','Form');
        $form = new FormHelper(new View());

        App::import('Helper', 'Html');
        $html = new HtmlHelper(new View());

        foreach ( $result as $doc ) {

            $doc['Procumentrequest']['select'] = $form->checkbox(array('class'=>'select'));
            $doc['Procumentrequest']['name'] = h($doc['Procumentrequest']['name']);
            $doc['Procumentrequest']['remark'] = h($doc['Procumentrequest']['remark']);
            $doc['Procumentrequest']['type'] = h($doc['Stocktype']['name']);




            if($doc['Procumentrequest']['valid']){
                $doc['Procumentrequest']['valid'] =  '<label for="switcher-basic" class="switcher switcher-blank" ><input class="valid-switcher" type="checkbox" data-id="'.$doc["Procumentrequest"]['id'].'" checked '.$disabled.'><div class="switcher-indicator"><div class="switcher-yes">YES</div><div class="switcher-no">NO</div></div></label>';
            } else{
                $doc['Procumentrequest']['valid'] =  '<label for="switcher-basic" class="switcher switcher-blank" ><input class="valid-switcher" type="checkbox" data-id="'.$doc["Procumentrequest"]['id'].'" '.$disabled.'><div class="switcher-indicator"><div class="switcher-yes">YES</div><div class="switcher-no">NO</div></div></label>';

            }


            $doc['Procumentrequest']['requester'] = $html->link('Superadmin', array('controller'=>'users','action' => 'view', 1, 'ajax' => true), array('escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modal')) . " ";
            $doc['Procumentrequest']['unit'] = "仁愛堂";

            $doc['Procumentrequest']['action'] = "";
            $doc['Procumentrequest']['action'] .= $form->input('批核', array('div'=>false, 'label'=>false, 'class'=>'form-control quickselect', 'options'=>array("批核", "拒絕", "跳過"), "empty"=>true));

//            $doc['Procumentrequest']['action'] .= $form->postLink('批核', array('action' => 'instant_reload', $doc['Procumentrequest']['id']), array('class' => 'btn btn-warning', 'escape' => false), __('確定續借嗎?'))." ";
//            $doc['Procumentrequest']['action'] .= $form->postLink('取消', array('action' => 'delete', $doc['Procumentrequest']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('確定取消嗎?'))." ";



            $output['aaData'][] = $doc['Procumentrequest'];

        }

        echo json_encode( $output );
    }


    public function beforeFilter()
    {

        parent::beforeFilter();
    }

}
