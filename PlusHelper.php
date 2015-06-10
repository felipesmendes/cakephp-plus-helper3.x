<?php
namespace App\View\Helper;

use Cake\View\Helper\FormHelper;

class PlusHelper extends FormHelper
{
    public $helpers = ['Html'];

    public function selectDinamic($title,array $options = null,$optionsPlus = null){
      $options += [
          'type' => null,
          'label' => null,
          'error' => null,
          'required' => null,
          'options' => null,
          'templates' => [],
      ];
      if(isset($options["label"])){
        $label = $this->_getLabel($title, compact('input', 'label', 'error', 'nestedInput') + $options);
        $options["label"] = false;
      }
      $html = "";
      $input = $this->input($title,$options);
      $button = $this->Html->tag('button','',['type'=>'button','class'=>'btn btn-default glyphicon glyphicon-plus-sign','data-toggle'=>'modal','data-target'=>"#".$title.'Modal']);
      $spanGroup = $this->Html->tag("span",$button,['class'=>'input-group-btn']);
      $divInputGroup = $this->Html->tag("div",$input.$spanGroup,['class'=>'input-group']);

      /* Header Modal */
      $spanCloseButton = $this->Html->tag('span','&times;',['aria-hidden'=>'true']);
      $modalCloseButton = $this->Html->tag('button',$spanCloseButton,['type'=>'button','class'=>"close",'data-dismiss'=>"modal",'aria-label'=>"Close"]);
      $modalHeaderTitle = $this->Html->tag('h4',__('Add '.$title),['class'=>'modal-title']);
      $modalHeader = $this->Html->tag('div',$modalCloseButton.$modalHeaderTitle,['class'=>'modal-header']);

      /* Content Modal*/
      $body = "";
      if(isset($optionsPlus["modalBody"])){
        $body = $optionsPlus["modalBody"];
      }
      $modalBody = $this->Html->tag("div",$body,['class'=>'modal-body']);

      /* Footer Modal */
      $optionsFooterButton = ['type'=>'button','class'=>'btn btn-primary','data-dismiss'=>"modal"];
      if(isset($optionsPlus["footerButton"])){
        $optionsFooterButton["onclick"] = $optionsPlus["footerButton"];
      }
      $modalFooterCloseButton = $this->Html->tag("button",__("Close"),['type'=>'button','class'=>'btn btn-default','data-dismiss'=>'modal']);
      $modalFooterButton = $this->Html->tag("button",__("Save Changes"),$optionsFooterButton);
      $modalFooter = $this->Html->tag('div',$modalFooterCloseButton.$modalFooterButton,['class'=>'modal-footer']);

      $modalContent = $this->Html->tag('div',$modalHeader.$modalBody.$modalFooter,['class'=>'modal-content']);
      $modalDialog = $this->Html->tag('div',$modalContent,['class'=>'modal-dialog']);
      $modal = $this->Html->tag('div',$modalDialog,['class'=>'modal fade','id' => $title."Modal"]);
      if(isset($label)){
        $html .= $label;
      }
      if(isset($divInputGroup)){
        $html .= $divInputGroup;
      }
      if(isset($modal)){
        $html .= $modal;
      }
      return $html;
    }


}

?>

