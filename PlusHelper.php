<?php
namespace App\View\Helper;

use Cake\View\Helper;

class PlusHelper extends Helper
{
    public $helpers = ['Html','Form'];

    public function input($title,array $options = null){
      if(!isset($options)){
        $options = array();
      }
      $input = $this->Form->input($title,$options);
      $button = $this->Html->tag('button','',['type'=>'button','class'=>'glyphicon glyphicon-plus-sign btn-lg','data-toggle'=>'modal','data-target'=>"#".$title.'Modal']);
      $input .= $button;

      /* Header Modal */
      $spanCloseButton = $this->Html->tag('span','&times;',['aria-hidden'=>'true']);
      $modalCloseButton = $this->Html->tag('button',$spanCloseButton,['type'=>'button','class'=>"close",'data-dismiss'=>"modal",'aria-label'=>"Close"]);
      $modalHeaderTitle = $this->Html->tag('h4',__('Add '.$title),['class'=>'modal-title']);
      $modalHeader = $this->Html->tag('div',$modalCloseButton.$modalHeaderTitle,['class'=>'modal-header']);

      /* Content Modal*/
      $body = "";
      if(isset($options["modalBody"])){
        $body = $options["modalBody"];
      }
      $modalBody = $this->Html->tag("div",$body,['class'=>'modal-body']);

      /* Footer Modal */
      $optionsFooterButton = ['type'=>'button','class'=>'btn btn-primary'];
      if(isset($options["footerButton"])){
        $optionsFooterButton["onclick"] = $options["footerButton"];
      }
      $modalFooterCloseButton = $this->Html->tag("button",__("Close"),['type'=>'button','class'=>'btn btn-default','data-dismiss'=>'modal']);
      $modalFooterButton = $this->Html->tag("button",__("Save Changes"),$optionsFooterButton);
      $modalFooter = $this->Html->tag('div',$modalFooterCloseButton.$modalFooterButton,['class'=>'modal-footer']);

      $modalContent = $this->Html->tag('div',$modalHeader.$modalBody.$modalFooter,['class'=>'modal-content']);
      $modalDialog = $this->Html->tag('div',$modalContent,['class'=>'modal-dialog']);
      $modal = $this->Html->tag('div',$modalDialog,['class'=>'modal fade','id' => $title."Modal"]);

      return $input.$modal;
    }

}

?>
