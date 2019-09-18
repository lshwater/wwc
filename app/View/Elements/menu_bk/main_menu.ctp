<? if(!empty($mainmenus)){?>
    <div id="main-menu" role="navigation">
            <div id="main-menu-inner">
                <div class="menu-content top" id="menu-content-demo">
                    <div>
                        <div class="text-bg"><span class="text-slim">
                                <?
                                echo $this->Text->truncate(
                                    h($auth['name']),
                                    20,
                                    array(
                                        'ellipsis' => '...',
                                        'exact' => false
                                    )
                                );

                                ?>
                        </span></div>

                        <?=$this->Html->image("dummy-avatar.png")?>
                        <div class="btn-group">
                            <?=$this->Html->link('<i class="fa fa-envelope"></i>', array("controller"=>"Messages", "action"=>"inbox"), array("class"=>"btn btn-xs btn-primary btn-outline dark", "escape"=>false))?>
                            <?=$this->Html->link('<i class="fa fa-user"></i>', array("controller"=>"Users", "action"=>"myaccount"), array("class"=>"btn btn-xs btn-primary btn-outline dark", "escape"=>false))?>
                            <?=$this->Html->link('<i class="fa fa-signal"></i>', array("controller"=>"Users", "action"=>"insight"), array("class"=>"btn btn-xs btn-primary btn-outline dark", "escape"=>false))?>
                            <?=$this->Html->link('<i class="fa fa-sign-out"></i>', array("controller"=>"Users", "action"=>"logout"), array("class"=>"btn btn-xs btn-primary btn-outline dark", "escape"=>false))?>
                        </div>
                    </div>
                </div>

                <ul class="navigation">

                    <?
                    if(isset($mainmenus['Menu'])){
                        foreach ($mainmenus['Menu'] as $ctgid=>$top_menu):

                            if(!empty($top_menu)){
    //                                    debug($top_menu);
                                $icon = $mainmenus['Menucategory'][$ctgid]['icon'];
                                $ctgname = $mainmenus['Menucategory'][$ctgid]['name'];
                                if($mainmenus['Menucategory'][$ctgid]['dropdown']){
                                    echo '<li class="mm-dropdown">';
                                    echo $this->Html->link('<i class="menu-icon '.$icon.'"></i><span class="mm-text"> '.__($ctgname).'</span>','#', array('escape' => false));

                                    if(!empty($top_menu)){
                                        echo "<ul>";
                                        foreach($top_menu as $item){

                                            if(!empty($item['labelval'])){
                                                if(${$item['labelval']} > 0){
                                                    $lb = '<span class="'.h($item['labelclass']).'">'.h(${$item['labelval']}).'</span>';
                                                }else{
                                                    $lb = "";
                                                }
                                            }else{
                                                $lb = "";
                                            }

                                            echo "<li>";
                                            echo $this->Html->link('<span class="mm-text">'.__($item['name']).'</span>'.$lb ,$item['href'], array('tabindex'=>'-1', 'escape' => false, 'class'=>$item['class']));
                                            echo "</li>";
                                        }
                                        echo "</ul>";
                                    }



                                    echo "</li>";
                                }else{
                                    echo "<li>";
                                    echo $this->Html->link('<i class="menu-icon '.$icon.'"></i><span class="mm-text mmc-dropdown-delay animated fadeIn"> '.__($ctgname).'</span>',$top_menu[0]['href'], array('escape' => false));
                                    echo "</li>";

                                }
                            }

                        endforeach;
                    }
                    ?>
                </ul> <!-- / .navigation -->
            </div>
    </div> <!-- / #main-menu-inner -->
<?}?>