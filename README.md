# yii2-ddltextswitcher

switch input between dropdownlist and textinput

example

use rsiripong\ddltextswitcher\DdlTextSwitcher;

    echo $form->field($model, 'PERSONTITLEID')
        ->widget(DdlTextSwitcher::classname(),[
            
            'items'=> ArrayHelper::map(\app\models\Empersontitle::find()->all(),'PERSONTITLEID','PERSONTITLENAME'),// dropdownselect list
            'prompt'=>$promptMsg ,
            'nameother'=>'PERSONTITLEOTHER' /// other text input
        ])
