<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace rsiripong\ddltextswitcher;

use yii\helpers\Html,
    yii\widgets\InputWidget,
    yii\base\InvalidParamException,
    yii\web\JsExpression,
    yii\helpers\Json,
        yii\helpers\ArrayHelper,
    Yii;

class DdlTextSwitcher extends InputWidget
{
   // public $options = [];
    public $items = [];
    public $prompt = "";
    
    public $nameother = "";
    public $valueother = "";
    
    
    public function init()
    {
         parent::init();
    }
    
     public function run()
    {
         
$titleother = $this->nameother;
//$titledropdown = 'PERSONTITLEID';
$titledropdown = $this->attribute;
//$dropdowndata = ArrayHelper::map(\app\models\Empersontitle::find()->all(),'PERSONTITLEID','PERSONTITLENAME');
$dropdowndata = $this->items;
//$fieldoption = ['class'=>'form-group col-sm-4'];

    //if(!$fieldoption){$fieldoption=[];}
   
    
    
         
         
          $hasModel = $this->hasModel();
          
           
          /*
          if (array_key_exists('value', $this->options)) {
            $value = $this->options['value'];
        } elseif ($hasModel) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        } else {
            $value = $this->value;
        }
           * 
           */
          
          if ($hasModel) {
              
              $value =   Html::getAttributeValue($this->model, $titleother);
              //exit;
              
              if($value){
     $styleddl= 'display:none';
     $styletext= 'display:inline';
    }else{
        $styletext= 'display:none';
    $styleddl = 'display:inline';
    }
              
              $btn1 = "";
     $btn1 .= Html::activeTextInput($this->model,$titleother ,[
         'class'=>'form-control',
         //'style'=>'display:inline'
         'style'=>$styletext
         ]);
    $btn1 .="<span class=\"input-group-btn\">";
  
    
    $btn1 .= Html::a('<i class="glyphicon glyphicon-retweet"></i>','#'
            , [
                'class' => 'personaltitleplus btn btn-success',
                'ref-ddl'=>Html::getInputId($this->model, $titledropdown ),
                'ref-text' =>Html::getInputId($this->model, $titleother),
                 'title'=>'เปลี่ยนเป็นแบบกรอกข้อความ',
    'data-toggle'=>'tooltip',
                'data-placement'=>"right"
                ]
            );
    $btn1 .= "</span>";
   
    $output = Html::activeDropDownList($this->model, $titledropdown, $dropdowndata,[
        'class'=>'form-control' ,
                'prompt'=>$this->prompt ,
                    //'style'=>'display:none',
                   'style'=>$styleddl,
        //'template'=>'{label}<div class="input-group col-sm-6">{input}'.$btn1.'{error}{hint}</div>'
        
    ]).$btn1;
    /*
        return $form->field($model, $titledropdown ,[
        'template'=>'{label}<div class="input-group col-sm-6">{input}'.$btn1.'{error}{hint}</div>',
       'options'=>$fieldoption
        ])
            ->label(null,[ 'class'=>'control-label col-sm-6' ])
            ->dropDownList($dropdowndata ,
                [
                    'prompt'=>$promptMsg ,
                    //'style'=>'display:none',
                   'style'=>$styleddl,
                    'options'=>[
                        
            //'class'=>' col-sm-4'
        ]
                    ]
                    );
     * 
     */
              
          }else{
              
              
              $idreftext = 'id'.$this->nameother;
              $idrefddl = 'id'.$this->name;
              
              if($this->valueother){
     $styleddl= 'display:none';
     $styletext= 'display:inline';
    }else{
        $styletext= 'display:none';
    $styleddl = 'display:inline';
    }
    
    $btn1 = "";
     //$btn1 .= Html::activeTextInput($this->model,$titleother ,[
         $btn1 .= Html::textInput($this->nameother, $this->valueother,[
         'id'=>$idreftext,
         'class'=>'form-control',
         //'style'=>'display:inline'
         'style'=>$styletext
         ]);
    $btn1 .="<span class=\"input-group-btn\">";
  
    
    $btn1 .= Html::a('<i class="glyphicon glyphicon-retweet"></i>','#'
            , [
                'class' => 'personaltitleplus btn btn-success',
                'ref-ddl'=>$idrefddl,
                'ref-text' =>$idreftext,
                 'title'=>'เปลี่ยนเป็นแบบกรอกข้อความ',
    'data-toggle'=>'tooltip',
                'data-placement'=>"right"
                ]
            );
    $btn1 .= "</span>";
              
              //$name = $this->options['name'];
              
              $output =  "<div class=\"input-group \">".Html::dropDownList($this->name, $value, $dropdowndata,[
        'class'=>'form-control' ,
                'prompt'=>$this->prompt ,
                    //'style'=>'display:none',
                  'id'=>$idrefddl,
                   'style'=>$styleddl,]).$btn1."</div>";
          }
          $view = $this->getView();
          
          $script = "    
        
jQuery(\"[data-toggle='tooltip']\").tooltip();
jQuery(\".personaltitleplus\").click(function(){
            //alert(jQuery(this).attr('ref-ddl'));
            //alert(jQuery(this).attr('ref-text'));
           // alert(\"test\");
           var refdl = jQuery('#'+jQuery(this).attr('ref-ddl'));
           var reftext = jQuery('#'+jQuery(this).attr('ref-text'));
           
           if ( refdl.css('display') == 'none' ){
    // element is hidden
    refdl.show();
           reftext.hide();
}else{
refdl.hide();
           reftext.show();
}
           
return false;
        });
        "
            ;
          $view->registerJs($script);
         
         
         return $output;
    }
    
}