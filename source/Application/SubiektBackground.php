<?php
/**
 * Namespace declaration
 */
namespace Zoondo\Sfera\Application;

/**
 * Used namespaces
 */
use Zoondo\Sfera\Application\Subiekt;

/**
 * This class represents Subiekt GT and allows
 * you to manage it
 * 
 * It starts Subiekt in ADJUST_OPERATOR mode
 * with invisible interface RUN_IN_BACKGROUND
 * 
 * You can use Subiekt class to make it work 
 * in normal mode (visible interface)
 * 
 * @author  Maciej Strączkowski <m.straczkowski@gmail.com>
 * @version 1.0.0
 */
class SubiektBackground extends Subiekt
{    
    /**
     * {@inheritdoc}
     */
    public function getRunningMode()
    {
        return self::RUN_IN_BACKGROUND;
    }
}
