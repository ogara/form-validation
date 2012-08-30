<?php
require 'formValidatorMissing.php';

if (isset($_POST["f_submit"])) {
    $form = new OgaraValidator\formValidatorMissing($_POST, array(
            "expected" => array("f_text", "f_area", "f_checkbox", "f_radio", "f_option", "f_multiple_checkbox"),
            "required" => array("f_text", "f_checkbox", "f_radio", "f_multiple_checkbox"),
            ));
    
    if(!$form->haveMissed()){
        echo "it's work. Text from textarea: ".$form->f_area.
             ". Text from input: ".$form->f_text
             .". Value from option: ".$form->f_option
             .". Value from first checkbox: ".$form->f_checkbox;
        
        echo "<br/>Value from radio: ";
        print_r($form->f_radio);
        echo "<br/>Value from multiple checkbox:";
        print_r($form->f_multiple_checkbox);
    }
    
}

?>

<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Html validator</title>
        <style type="text/css">
            .warning{
                color: red;
                font-size: 0.8em;
                display: block;
            }
            label{
                display: block;
            }
        </style>
    </head>
    <body>
        <?php if(isset($form) && $form->haveMissed()):?>
        <div class="warning">
            Не все поля заполнены, проверьте правильность заполнения полей.
        </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <p>
                <label for="f_text">text field</label>
                <!--если не заполнили именно это поле-->
                <?php if(isset($form) && $form->isMissed("f_text")): ?>
                    <span class="warning">Не установлен тектовый блочек</span> 
                <?php endif;?>
                <input type="text" name="f_text" id="f_text" value="<?php
                    if(isset($form) && $form->haveMissed()){
                        echo htmlspecialchars($form->f_text);
                    }
                ?>"/>
            </p>

            <p>
                <!-- этот элемент формы не обязателен 
                     (это можно исправить внеся его в массив required и expected)
                     но он все равно хранит значение при неудаче-->
                <label for="f_area">textarea</label>
                <?php if(isset($form) && $form->isMissed("f_area")): ?>
                    <span class="warning">Не установлена тектовая арея</span> 
                <?php endif;?>
                <textarea name="f_area" id="f_area" rows="4" cols="20"><?php
                    if(isset($form) && $form->haveMissed()){
                        echo htmlspecialchars($form->f_area);
                    }
                ?></textarea>
            </p>

            <p>
                <!-- этот элемент формы также не обязателен но он все равно хранит 
                     значение при неудаче-->
                <label for="f_option">list</label>
                <?php if(isset($form) && $form->isMissed("f_option")): ?>
                    <span class="warning">Не выбрали из списка</span> 
                <?php endif;?>
                <select name="f_option">
                    <option value="">chose in list</option>
                    
                    <!-- Необходимо указывать чтобы устанавливать значения по 
                            умолчанию еслиесть ошибки-->
                    
                    <option value="1"
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->f_option == "1"){
                           echo 'selected';
                       }
                       ?>     
                    >first</option>
                    <option value="2"
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->f_option == "2"){
                           echo 'selected';
                       }
                       ?>
                    >second</option>
                </select>
            </p>

            <p>
                <label for="f_checkbox">checkbox</label>
                <?php if(isset($form) && $form->isMissed("f_checkbox")): ?>
                    <span class="warning">Не установлен флаг</span> 
                <?php endif;?>
                <input type="checkbox" name="f_checkbox" id="f_checkbox"
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->f_checkbox == "on"){
                           echo 'checked';
                       }
                       ?>
                />
            </p>

            <p>
                <label for="f_radio">radio button</label>
                <?php if(isset($form) && $form->isMissed("f_radio")): ?>
                    <span class="warning">Не выбрано радио</span> 
                <?php endif;?>
                <input type="radio" name="f_radio[]" value="hello" 
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->checkMultiple("f_radio", "hello")){
                           echo 'checked';
                       }
                       ?>
                />
                <input type="radio" name="f_radio[]" value="world" 
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->checkMultiple("f_radio", "world")){
                           echo 'checked';
                       }
                       ?>
                />
            </p>
            
            <p>
                <label for="">multipl checkbox</label>
                <?php if(isset($form) && $form->isMissed("f_multiple_checkbox")): ?>
                    <span class="warning">Не выбрано множественный флаг</span> 
                <?php endif;?>
                <input type="checkbox" name="f_multiple_checkbox[]" value="first" 
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->checkMultiple("f_multiple_checkbox", "first")){
                           echo 'checked';
                       }
                       ?>
                />
                <input type="checkbox" name="f_multiple_checkbox[]" value="second" 
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->checkMultiple("f_multiple_checkbox", "second")){
                           echo 'checked';
                       }
                       ?>
                />
                <input type="checkbox" name="f_multiple_checkbox[]" value="third" 
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->checkMultiple("f_multiple_checkbox", "third")){
                           echo 'checked';
                       }
                       ?>
                />
            </p>

            <p>
                <input type="submit" value="go" name="f_submit" id="f_submit" />
            </p>
        </form>
    </body>
</html>
