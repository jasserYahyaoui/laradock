<?php
/**
 * Created by PhpStorm.
 * User: jasser
 * Date: 12/05/22
 * Time: 10:04
 */

namespace App\Serializer;


use App\Entity\Food;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class FoodDenormalizer implements DenormalizerInterface, CacheableSupportsMethodInterface
{
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        die('here');
        return [
            'name' => 'jjjj'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return Food::class === $type;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}