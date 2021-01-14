<?php
/**
 * Namespace declaration
 */
namespace AsocialMedia\Sfera;

/**
 * Used namespaces
 */
use COM;
use RuntimeException;
use InvalidArgumentException;

/**
 * This class represents Navireo object using COM
 * extension
 * 
 * @author     ASOCIAL MEDIA Maciej Strączkowski <biuro@asocial.media>
 * @copyright  ASOCIAL MEDIA Maciej Strączkowski <biuro@asocial.media>
 * @version    2.1.0
 */
class Navireo
{
    /**
     * Path to iqa file to use
     *
     * @var string
     */
    protected $iqa = null;

    /**
     * Encoding which will be used
     * 
     * @var string
     */
    protected $encoding = CP_UTF8;
    
    /**
     * An instance of COM
     * 
     * @var COM
     */
    protected $app;
    
    /**
     * Connects to Sfera using given iqa file and
     * encoding
     *
     * @param   string   $iqaPath   Path to *.iqa file
     * @param   string   $encoding
     * @throws  RuntimeException
     */
    public function __construct($iqaPath, $encoding = CP_UTF8)
    {
        // We need to check if COM extension is available
        if (!extension_loaded('com_dotnet')) {
            
            // Throwing an exception if COM extension is unavailable
            throw new RuntimeException(
                'The "com_dotnet" extension is required'
            );
        }

        // Setting iqa path and encoding
        $this->setIqa($iqaPath)
            ->setEncoding($encoding);

        // Trying to connect using above data
        $this->reconnect();
    }
    
    /**
     * Tries to connect using stored iqa file
     * 
     * You should use it whenever you change your 
     * iqa file
     * 
     * @return  $this
     */
    public function reconnect()
    {
        // Creating an instance of COM
        $this->app = new COM($this->getIqa(), null, $this->getEncoding());

        // Returning an instance of itself
        return $this;
    }

    /**
     * Stores iqa path into class property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $iqaPath  Path to iqa file
     * @return  $this
     */
    public function setIqa($iqaPath)
    {
        // Checking if given file exists
        if (!is_file($iqaPath) || !is_readable($iqaPath)) {

            // Throwing an exception if COM extension is unavailable
            throw new InvalidArgumentException(
                'The ' . $iqaPath . ' file does not exist or is not readable'
            );
        }

        $this->iqa = $iqaPath;
        
        return $this;
    }
    
    /**
     * Returns current iqa path
     * 
     * @return  string  Current iqa path
     */
    public function getIqa()
    {
        return $this->iqa;
    }
    
    /**
     * Stores encoding into class property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $value  Encoding (i.e CP_UTF8)
     * @return  $this
     */
    public function setEncoding($value)
    {
        $this->encoding = $value;
        
        return $this;
    }
    
    /**
     * Returns current encoding
     * 
     * @return  string  Current encoding
     */
    public function getEncoding()
    {
        return $this->encoding;
    }
    
    /**
     * Returns current instance of COM
     * 
     * @return  COM  GT object
     */
    public function getApplication()
    {
        return $this->app;
    }
    
    /**
     * Magic method which calls COM
     * 
     * @param   string  $method
     * @param   array   $arguments
     * @return  mixed
     */
    public function __call($method, array $arguments)
    {
        return call_user_func_array(array(
            $this->getApplication(), $method
        ), $arguments);
    }
    
    /**
     * Magic method which allows you to change
     * COM class properties
     * 
     * @param   string  $name
     * @param   mixed   $value
     * @return  $this
     */
    public function __set($name, $value)
    {
        $this->getApplication()->$name = $value;
        
        return $this;
    }
    
    /**
     * Magic method which allows you to access
     * COM class properties
     * 
     * @param   string  $name
     * @return  mixed
     */
    public function __get($name)
    {
        return $this->getApplication()->$name;
    }

    /**
     * Tries to close current pplication
     * at script shutdown
     *
     * It was developed becasue PHP does
     * not close sfera automatically
     *
     * @return  void
     */
    public function __destruct()
    {
        // Getting application instance
        if (($app = $this->getApplication()) !== null) {

            // Closing application
            $app->Zakoncz();
        }
    }
}
