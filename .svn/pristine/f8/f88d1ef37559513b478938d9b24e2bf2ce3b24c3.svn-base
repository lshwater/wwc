<? if(!empty($mainmenus)){?>
    <nav class="px-nav px-nav-left">
        <button type="button" class="px-nav-toggle" data-toggle="px-nav">
            <span class="px-nav-toggle-arrow"></span>
            <span class="navbar-toggle-icon"></span>
            <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
        </button>

        <ul class="px-nav-content">
            <li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box">
<!--                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <span class="font-size-15 ">
                    <strong><i class="fa fa-user"> <?=$auth['name']?></i></strong><br />
                </span>
                <small class="font-size-11 font-weight-light"><?=$auth['ranking']?></small>
                <div class="btn-group" style="margin-top: 4px;">
                </div>
            </li>

            <?
            if(isset($mainmenus['Menu'])){
                foreach ($mainmenus['Menu'] as $ctgid=>$top_menu):

                    if(!empty($top_menu)){
                        $icon = $mainmenus['Menucategory'][$ctgid]['icon'];
                        $ctgname = $mainmenus['Menucategory'][$ctgid]['name'];
                        if($mainmenus['Menucategory'][$ctgid]['dropdown']){
                            echo '<li class="px-nav-item px-nav-dropdown">';
                            echo '<a href="#"><i class="px-nav-icon '.$icon.'"></i><span class="px-nav-label">'.__($ctgname).'</span></a>';

                            if(!empty($top_menu)){
                                echo '<ul class="px-nav-dropdown-menu">';
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

                                    echo ' <li class="px-nav-item">';
                                    echo '<a href="'.$this->Html->url($item['href'], true).'" class="'.$item['class'].'"><span class="px-nav-label">'.__($item['name']).'</span></a>';
//                                    echo $this->Html->link('<span class="px-nav-label">'.__($item['name']).'</span>'.$lb ,$item['href'], array('tabindex'=>'-1', 'escape' => false, 'class'=>$item['class']));
                                    echo "</li>";
                                }
                                echo "</ul>";
                            }



                            echo "</li>";
                        }else{
                            echo "<li class='px-nav-item'>";
                            echo '<a href="'.$this->Html->url($top_menu[0]['href'], true).'"><i class="px-nav-icon '.$icon.'"></i><span class="px-nav-label">'.__($ctgname).'</span></a>';

//                            echo $this->Html->link('<i class="px-nav-icon '.$icon.'"></i><span class="px-nav-label"> '.__($ctgname).'</span>',$top_menu[0]['href'], array('escape' => false));
                            echo "</li>";

                        }
                    }

                endforeach;
            }
            ?>


        </ul>
    </nav>
<?}?>
