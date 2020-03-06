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

/**
 * This class represents GT object using COM
 * extension
 * 
 * It requires connection data in constructor
 * 
 * You can change connection data anytime using
 * implemented setter method
 * 
 * Whenever you change connection data you need
 * to call reconnect() method to make it work
 * 
 * You can use object of this class the same as
 * you use Sfera GT object
 * 
 * @author     ASOCIAL MEDIA Maciej Strączkowski <biuro@asocial.media>
 * @copyright  ASOCIAL MEDIA Maciej Strączkowski <biuro@asocial.media>
 * @version    2.0.1
 */
class GT
{
    /**
     * Subiekt database hostname [in example: (local)\INSERTGT]
     * 
     * @var string
     */
    protected $hostname;
    
    /**
     * Name of subiekt database
     * 
     * @var string
     */
    protected $database;
    
    /**
     * Database username
     * 
     * @var string
     */
    protected $username;
    
    /**
     * Database password
     * 
     * @var string
     */
    protected $password;
    
    /**
     * Subiekt operator account (in example: Boss)
     * 
     * @var string
     */
    protected $operator;
    
    /**
     * Subiekt operator password
     * 
     * @var string
     */
    protected $operatorPassword;
    
    /**
     * Do we use Windows Authentication? (0 or 1)
     * 
     * @var integer
     */
    protected $windowsAuthentication = 0;
    
    /**
     * Encoding which will be used
     * 
     * @var string
     */
    protected $encoding = CP_UTF8;
    
    /**
     * An instance of GT (COM)
     * 
     * @var COM
     */
    protected $gt;
    
    /**
     * Connects to Subiekt Sfera using given credentials
     *
     * @param   string   $hostname           Database hostname
     * @param   string   $database           Database name
     * @param   string   $username           Database username
     * @param   string   $password           Database password
     * @param   string   $operator           Operator username
     * @param   string   $operatorPassword   Operator password
     * @param   string   $encoding
     * @throws  RuntimeException
     */
    public function __construct($hostname, $database, $username, $password, $operator, $operatorPassword, $windowsAuth = 0, $encoding = CP_UTF8)
    {
        // We need to check if COM extension is available
        if (!extension_loaded('com_dotnet')) {
            
            // Throwing an exception if COM extension is unavailable
            throw new RuntimeException(
                'The "com_dotnet" extension is required'
            );
        }
        
        // Setting GT configuration
        $this
           ->setHostname($hostname)
           ->setDatabase($database)
           ->setUsername($username)
           ->setPassword($password)
           ->setOperator($operator)
           ->setOperatorPassword($operatorPassword)
           ->setWindowsAuthentication($windowsAuth)
           ->setEncoding($encoding);
        
        // Trying to connect using above data
        $this->reconnect();
    }
    
    /**
     * Tries to connect using stored parameters
     * 
     * You should use it whenever you change your 
     * login creditionals
     * 
     * For example call it right after changing
     * operator to proceed it
     * 
     * @return  $this
     */
    public function reconnect()
    {
        // Creating an instance of COM
        $this->gt = new COM('InSERT.GT', null, $this->getEncoding());
        
        // Setting parameters
        $this->gt->Autentykacja    = $this->getWindowsAuthentication();
        $this->gt->Serwer          = $this->getHostname();
        $this->gt->Baza            = $this->getDatabase();
        $this->gt->Uzytkownik      = $this->getUsername();
        $this->gt->UzytkownikHaslo = $this->getPassword();
        $this->gt->Operator        = $this->getOperator();
        $this->gt->OperatorHaslo   = $this->getOperatorPassword();
        
        // Returning an instance of itself
        return $this;
    }
    
    /**
     * Stores database hostname into class
     * property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $value  Hostname
     * @return  $this
     */
    public function setHostname($value)
    {
        $this->hostname = $value;
        
        return $this;
    }
    
    /**
     * Returns current database hostname
     * 
     * @return  string  Current hostname
     */
    public function getHostname()
    {
        return $this->hostname;
    }
    
    /**
     * Stores database name into property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $value  Database
     * @return  $this
     */
    public function setDatabase($value)
    {
        $this->database = $value;
        
        return $this;
    }
    
    /**
     * Returns current database name
     * 
     * @return  string  Current database
     */
    public function getDatabase()
    {
        return $this->database;
    }
    
    /**
     * Stores database username into class
     * property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $value  Username
     * @return  $this
     */
    public function setUsername($value)
    {
        $this->username = $value;
        
        return $this;
    }
    
    /**
     * Returns current database username
     * 
     * @return  string  Current username
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Stores database password into class
     * property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $value  Password
     * @return  $this
     */
    public function setPassword($value)
    {
        $this->password = $value;
        
        return $this;
    }
    
    /**
     * Returns current database password
     * 
     * @return  string  Current password
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Stores operator into class property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $value  Operator
     * @return  $this
     */
    public function setOperator($value)
    {
        $this->operator = $value;
        
        return $this;
    }
    
    /**
     * Returns current operator
     * 
     * @return  string  Current operator
     */
    public function getOperator()
    {
        return $this->operator;
    }
    
    /**
     * Stores operator password into class 
     * property
     * 
     * It returns an instance of class so 
     * you can use it in method chaining
     * 
     * @param   string  $value  Operator password
     * @return  $this
     */
    public function setOperatorPassword($value)
    {
        $this->operatorPassword = $value;
        
        return $this;
    }
    
    /**
     * Returns current operator password
     * 
     * @return  string  Current operator password
     */
    public function getOperatorPassword()
    {
        return $this->operatorPassword;
    }
    
    /**
     * Stores windows authentication flag into 
     * class property
     * 
     * Given value will be converted to integer 
     * so you can use even boolean
     * 
     * It returns an instance of class so you can
     * use it in method chaining
     * 
     * @param   integer  $value 0 or 1
     * @return  $this
     */
    public function setWindowsAuthentication($value)
    {
        $this->windowsAuthentication = (int)$value ? 1 : 0;
        
        return $this;
    }
    
    /**
     * Returns current windows authentication
     * 
     * @return  integer  0 or 1
     */
    public function getWindowsAuthentication()
    {
        return $this->windowsAuthentication;
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
     * Returns current instance of GT object
     * 
     * @return  COM  GT object
     */
    public function getGT()
    {
        return $this->gt;
    }
    
    /**
     * Magic method which calls COM (GT)
     * 
     * @param   string  $method
     * @param   array   $arguments
     * @return  mixed
     */
    public function __call($method, array $arguments)
    {
        return call_user_func_array(array(
            $this->getGT(), $method
        ), $arguments);
    }
    
    /**
     * Magic method which allows you to change
     * COM (GT) class properties
     * 
     * @param   string  $name
     * @param   mixed   $value
     * @return  $this
     */
    public function __set($name, $value)
    {
        $this->getGT()->$name = $value;
        
        return $this;
    }
    
    /**
     * Magic method which allows you to access
     * COM (GT) class properties
     * 
     * @param   string  $name
     * @return  mixed
     */
    public function __get($name)
    {
        return $this->getGT()->$name;
    }
}
