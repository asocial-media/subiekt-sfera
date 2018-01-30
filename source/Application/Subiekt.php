<?php
/**
 * Namespace declaration
 */
namespace Zoondo\Sfera\Application;

/**
 * Used namespaces
 */
use Zoondo\Sfera\Application\AbstractApplication;

/**
 * This class represents Subiekt GT and allows
 * you to manage it
 * 
 * It starts Subiekt in ADJUST_OPERATOR mode
 * with visible interface RUN_NORMAL
 * 
 * You can use SubiektBackground class to make
 * it work in background (hidden interface)
 * 
 * @author  Maciej Strączkowski <m.straczkowski@gmail.com>
 * @version 1.0.0
 */
class Subiekt extends AbstractApplication
{    
    /**
     * {@inheritdoc}
     */
    public function getProductId()
    {
        return self::SUBIEKT_GT;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAdjustMode()
    {
        return self::ADJUT_OPERATOR;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRunningMode()
    {
        return self::RUN_NORMAL;
    }
}
