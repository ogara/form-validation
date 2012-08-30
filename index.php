<?php
require 'formValidator.php';

if (isset($_POST["f_submit"])) {
    $form = new formValidator($_POST, array(
            "expected" => array("f_text", "f_area", "f_checkbox", "f_radio", "f_option"),
            "required" => array("f_text", "f_checkbox", "f_radio"),
            ));
    
    if(!$form->haveMissed()){
        echo "it's work ".$form->f_area;
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
        <form method="POST" action="">
            <p>
                <label for="f_text">text field</label>
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
                <label for="f_option">list</label>
                <?php if(isset($form) && $form->isMissed("f_option")): ?>
                    <span class="warning">Не выбрали из списка</span> 
                <?php endif;?>
                <select name="f_option">
                    <option value="">chose in list</option>
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
                       if(isset($form) && $form->haveMissed() && $form->checkRadio("f_radio", "hello")){
                           echo 'checked';
                       }
                       ?>
                />
                <input type="radio" name="f_radio[]" value="world" 
                       <?php 
                       if(isset($form) && $form->haveMissed() && $form->checkRadio("f_radio", "world")){
                           echo 'checked';
                       }
                       ?>
                />
            </p>
            
            <p>
                <label for="">multipl checkbox</label>
                <input type="checkbox" name="f_multiple_checkbox[]" value="first" />
                <input type="checkbox" name="f_multiple_checkbox[]" value="second" />
                <input type="checkbox" name="f_multiple_checkbox[]" value="third" />
            </p>

            <p>
                <input type="submit" value="go" name="f_submit" id="f_submit" />
            </p>
        </form>
    </body>
</html>
