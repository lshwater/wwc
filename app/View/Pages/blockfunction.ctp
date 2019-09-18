<?
    $html_text = "";
    if(!empty($formurl)){
        $html_text .= "<p>".__('來源')."：".$this->Text->autoLink($formurl)."</p>";
    }
    if(!empty($errormsg)){
        $html_text .= "<p>".__('原因')."：".h($errormsg)."</p>";
    }

    $defaultmsg = strip_html_tags($html_text);

?>

<div class="panel panel-danger">
    <div class="panel-heading">
        <span class="panel-title"><?=h($title)?></span>
    </div>
    <div class="panel-body">
        <?=$html_text?>
        你可以：

        <div class="panel panel-transparent">
            <div class="list-group">
                <?=$this->Html->link('<i class="profile-list-icon fa fa-envelope"></i> '.__('聯絡管理員 / 監督員'), array("controller"=>"messages",'action'=>"sendmsg", "userids"=>$allsupervisorids, "title"=>$title, "defaultmsg"=>urlencode(base64_encode($defaultmsg))), array('escape' => false, 'class'=>"openasnew list-group-item"));?>
            </div>
        </div>

    </div>
</div>

<?
function strip_html_tags( $text )
{
// Remove invisible content
    $text = preg_replace(
        array(
            //ADD a (') before @<head ON NEXT LINE. Why? see below
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
            // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ),
        $text );
    return strip_tags( $text );
}
?>