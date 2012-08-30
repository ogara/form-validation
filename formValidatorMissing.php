<?php
namespace OgaraValidator;

class formValidatorMissing
{
    //ожидаемые переменные
    private $expected = array();
    
    //обязательные к заполнению
    private $required = array();
    
    //пропущенные переменные
    private $missing = array();
    
    //значение которые пришли из формы
    private $form_values = array();
    
    //проверенные и почищенные значения формы
    private $form_clean_value = array();
    
    /**
     * заполняет массивы обязательных и ожидаемыз значений
     * @param array $form_values GET or Post data
     * @param array $parameters 
     */
    public function __construct(&$form_values, $parameters)
    {
        $this->form_values = $form_values;
        
        foreach ($parameters as $parameters_name => $parameters_val){
           $method_name = "set".ucfirst($parameters_name);
           $this->$method_name($parameters_val); 
        }
        
        $this->validateRequired();
    }
    
    /**
     * проверяет пропущен ли элемент формы
     * @param string $form_name
     * @return boolean 
     */
    public function isMissed($form_name)
    {
        return in_array($form_name, $this->missing);
    }
    
    /**
     * check missed array on missed form elements
     * @return boolean 
     */
    public function haveMissed()
    {
        if($this->missing){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * проверяет элементы множественного выбора на ошибки
     * @param string $name имя элемента множественного выбора
     * @param string $value ожидаемое значение элемента
     * @return type boolean
     */
    public function checkMultiple($name, $value)
    {
        return in_array($value, (array)$this->$name);
    }
    
    public function __set($name, $value)
    {
        $this->form_clean_value[$name] = $value;
    }
    
    public function __get($name)
    {
        if(isset($this->form_clean_value[$name])){
            return $this->form_clean_value[$name];
        } else {
            return "";
        }
    }
    
    private function setExpected(&$expected)
    {
        $this->expected = $expected;
    }
    
    private function setRequired(&$required)
    {
        $this->required = $required;
    }
    
    
    /**
     * проверяет заполненны ли все обязательные поля и если какие-то поля не заполнены
     * закидывает из название в массив missed 
     */
    private function validateRequired()
    {
        foreach ($this->form_values as $form_key => $form_value) {
            $temp = is_array($form_value) ? $form_value : trim($form_value);
            
            if(empty($temp) && in_array($form_key, $this->required)){
                $this->missing[] = $form_key;
            } elseif (in_array($form_key, $this->expected)) {
                $this->$form_key = $temp;
            }
            
            $form_name_elements[] = $form_key;           
        }
        
        $other_missing = array_diff($this->required, $form_name_elements);
        if($other_missing){
            $this->missing = array_merge($this->missing, $other_missing);
        }
    }
}

