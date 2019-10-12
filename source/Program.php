<?php
/**
 * Namespace declaration
 */
namespace AsocialMedia\Sfera;

/**
 * This class is object representation of GT program
 * 
 * You must provide an instance of GT as constructor
 * parameter to make it work
 * 
 * You can define adjust mode, running mode and program 
 * to use (subiekt / rewizor / gestor etc)
 * 
 * You should use this class to get an instance of
 * specified GT program in specified mode
 * 
 * @author     ASOCIAL MEDIA Maciej Strączkowski <biuro@asocial.media>
 * @copyright  ASOCIAL MEDIA Maciej Strączkowski <biuro@asocial.media>
 * @version    2.0.0
 */
class Program
{
    /**
     * An instance of current program
     * 
     * @var object
     */
    protected $app = null;
    
    /**
     * Product id number for Subiekt GT
     */
    const SUBIEKT_GT = 1;
    
    /**
     * Product id number for Rachmistrz GT
     */
    const RACHMISTRZ_GT = 2;
    
    /**
     * Product id number for Rewizor GT
     */
    const REWIZOR_GT = 3;
    
    /**
     * Product id number for Gratyfikant GT
     */
    const GRATYFIKANT_GT = 4;
    
    /**
     * Product id number for Mikro Gratyfikant GT
     */
    const MIKRO_GRATYFIKANT_GT = 5;
    
    /**
     * Product id number for Gestor GT
     */
    const GESTOR_GT = 6;
    
    /**
     * Adjust mode:
     * 
     * Oznacza dopasowanie pierwszej znalezionej aplikacji zadanego typu, 
     * która jest podłączona do wskazanego serwera i podanej bazy danych
     */
    const ADJUST_NORMAL = 0;
    
    /**
     * Adjust mode:
     * 
     * Oznacza dopasowanie pierwszej znalezionej aplikacji zadanego typu, 
     * która jest podłączona do wskazanego serwera z wykorzystaniem 
     * podanego użytkownika SQL Servera i podanej bazy danych.
     */
    const ADJUST_USERNAME = 1;
    
    /**
     * Adust mode:
     * 
     * Oznacza dopasowanie pierwszej znalezionej aplikacji zadanego typu, 
     * która jest podłączona do wskazanego serwera, bazy danych oraz 
     * zalogowana na podanego użytkownika InsERT GT (operatora).
     */
    const ADJUST_OPERATOR = 2;
    
    /**
     * Running mode:
     * 
     * Oznacza uruchomienie zadanej aplikacji o ile nie zostanie 
     * znaleziona działająca, do której można się podłączyć.
     */
    const RUN_NORMAL = 0;
    
    /**
     * Running mode:
     * 
     * Oznacza uruchomienie zadanej aplikacji o ile nie zostanie 
     * znaleziona działająca aplikacja danego typu w stanie nie 
     * zablokowanym do której można się podłączyć. 
     * 
     * Tryb zablokowania ustawiany jest np. podczas uruchamiania aplikacji, 
     * kiedy inicjowane są połączenia, sprawdzane licencje, także wówczas
     * gdy zmieniany jest użytkownik (Ctrl+F2).
     * 
     * Proces programu Insert GT już istnieje w systemie, ale jeszcze nie 
     * jest gotowy do normalnej pracy. 
     */
    const RUN_IF_NOT_BLOCKED = 1;
    
    /**
     * Running mode:
     * 
     * Oznacza zawsze uruchomienie nowej instancji aplikacji.
     */
    const RUN_NEW_INSTANCE = 2;
    
    /**
     * Running mode
     * 
     * Oznacza uruchomienie/podłączenie do zadanej aplikacji bez 
     * wykorzystywania interfejsu użytkownika. 
     * 
     * Aplikacja podłączona w ten sposób działa w tle.
     */
    const RUN_IN_BACKGROUND = 4;
   
    /**
     * Builds an instance of program which you
     * currently need
     * 
     * It uses specified product id, adjust mode
     * and running mode
     * 
     * @param   GT       $gt       An instance of GT
     * @param   integer  $program  Product id number
     * @param   integer  $adjust   Adjust mode
     * @param   integer  $running  Running mode
     * @return  void
     */
    public function __construct(GT $gt, $program, $adjust = self::ADJUST_OPERATOR, $running = self::ADJUST_NORMAL)
    {
        // Setting application id number
        $gt->Produkt = $program;
        
        // Executing above application
        $this->app = $gt->Uruchom($adjust, $running);
    }
    
    /**
     * Returns currently stored object in class
     * property
     * 
     * You should use it to get access to current
     * application
     * 
     * @return  object  Application object
     */
    public function getApplication()
    {
        return $this->app;
    }
    
    /**
     * Magic method which calls COM (APP)
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
     * COM (APP) class properties
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
     * COM (APP) class properties
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
     * not close subiekt automatically
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
