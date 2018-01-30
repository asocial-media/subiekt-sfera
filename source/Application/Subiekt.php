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
