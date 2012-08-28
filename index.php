<?php
require 'formValidator.php';

if (isset($_POST["f_submit"])) {
    $form = new formValidator($_POST, array(
            "expected" => array("f_text", "f_area"),
            "required" => array("f_text"),
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
        <title></title>
    </head>
    <body>
        <form method="POST" action="">
            <p>
                <label for="f_text">text field</label>
                <?php if(isset($form) && $form->isMissed("f_text")): ?>
                    <span clss="warning">Не установлен тектовый блочек</span> 
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
                    <span clss="warning">Не установлена тектовая арея</span> 
                <?php endif;?>
                <textarea name="f_area" id="f_area" rows="4" cols="20"><?php
                    if(isset($form) && $form->haveMissed()){
                        echo htmlspecialchars($form->f_area);
                    }
                ?></textarea>
            </p>

            <p>
                <label for="f_option">list</label>
                <select name="f_option">
                    <option value="1">first</option>
                    <option value="2">second</option>
                </select>
            </p>

            <p>
                <label for="f_checkbox">checkbox</label>
                <input type="checkbox" name="f_checkbox" id="f_checkbox"/>
            </p>

            <p>
                <label for="f_radio">radio button</label>
                <input type="radio" name="f_radio[]" value="hello" />
                <input type="radio" name="f_radio[]" value="world" />
            </p>

            <p>
                <input type="submit" value="go" name="f_submit" id="f_submit" />
            </p>
        </form>
    </body>
</html>
