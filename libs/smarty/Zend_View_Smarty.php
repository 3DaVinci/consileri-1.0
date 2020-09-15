<?
/*
require_once 'Zend/View/Interface.php';
*/
require_once 'Smarty.class.php';

class Zend_View_Smarty /*implements Zend_View_Interface*/
{
    /**
     * Объект Smarty
     * @var Smarty
     */
    protected $_smarty;

    /**
     * Конструктор
     *
     * @param string $tmplPath
     * @param array $extraParams
     * @return void
     */
    public function __construct($tmplPath = null, $extraParams = array())
    {
        $this->_smarty = new Smarty;

        if (null !== $tmplPath) {
            $this->setScriptPath($tmplPath);
        }

        foreach ($extraParams as $key => $value) {
            $this->_smarty->$key = $value;
        }
    }

    /**
     * Возвращение объекта шаблонизатора
     *
     * @return Smarty
     */
    public function getEngine()
    {
        return $this->_smarty;
    }

    /**
     * Установка пути к шаблонам
     *
     * @param string $path Директория, устанавливаемая как путь к шаблонам
     * @return void
     */
    public function setScriptPath($path)
    {
        if (is_readable($path)) {
            $this->_smarty->template_dir = $path;
            return;
        }

        throw new Exception('Invalid path provided');
    }

	public function getScriptPath($path)
    {
		
    }

	public function setBasePath($path, $classPrefix = 'Zend_View')
    {
		
    }
	
	public function addBasePath($path, $classPrefix = 'Zend_View'){
		
	}
	public function getScriptPaths(){
		
	}
    /**
     * Присвоение значения переменной шаблона
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key, $val)
    {
        $this->_smarty->assign($key, $val);
    }

    /**
     * Получение значения переменной
     *
     * @param string $key The variable name.
     * @return mixed The variable value.
     */
    public function __get($key)
    {
        return $this->_smarty->get_template_vars($key);
    }

    /**
     * Позволяет проверять переменные через empty() и isset()
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return (null !== $this->_smarty->get_template_vars($key));
    }

    /**
     * Позволяет удалять свойства объекта через unset()
     *
     * @param string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->_smarty->clear_assign($key);
    }

    /**
     * Присвоение переменных шаблону
     *
     * Позволяет установить значение к определенному ключу или передать массив
     * пар ключ => значение
     *
     * @see __set()
     * @param string|array $spec Ключ или массив пар ключ => значение
     * @param mixed $value (необязательный) Если присваивается значение одной
     * переменной, то через него передается значение переменной
     * @return void
     */
    public function assign($spec, $value = null)
    {
        if (is_array($spec)) {
            $this->_smarty->assign($spec);
            return;
        }
		
		if (is_object($spec)) {			
			if ($value==null) $value = 'object';
			//$this->_smarty->register_object($value,$spec,null,false);
			$this->_smarty->assign_by_ref($value,$spec);
			return;
		}

        $this->_smarty->assign($spec, $value);
    }

    /**
     * Удаление всех переменных
     *
     * @return void
     */
    public function clearVars()
    {
        $this->_smarty->clear_all_assign();
    }

    /**
     * Обрабатывает шаблон и возвращает вывод
     *
     * @param string $name Шаблон для обработки
     * @return string Вывод
     */
    public function render($name)
    {        
        return $this->_smarty->fetch($name);
    }
}

?>