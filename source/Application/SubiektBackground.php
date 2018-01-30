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
