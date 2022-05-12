<?php
/**
 * Created by PhpStorm.
 * User: jasser
 * Date: 09/05/22
 * Time: 15:40
 */

namespace App\Component\Food\src\Domain\Repository;

use App\Entity\Food;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\DeserializationContext;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenFoodApiRepository
{
    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(HttpClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function getOpenFoodData()
    {
        $api = new \OpenFoodFacts\Api('food','fr');
        $product = $api->getProduct('5449000000996');

        return $product;
    }

    public function execute(string $method='GET', string $uri='https://world.openfoodfacts.org/api/v0/product/737628064502.json', array $options = [], array $context = [], string $type = Food::class)
    {
        $response = $this->client->request($method, $uri, $options);

        $format = $this->getFormat($response->getHeaders()['content-type'][0]);
        $data = $response->getContent();

        $deserializeContext = new DeserializationContext();
        $deserializeContext->setAttribute('context', $context);

        return $this->serializer->deserialize($data, $type, $format, $deserializeContext);

        if (null !== $type) {
            $response = $this->handleResponse($response, $type, $context);
        }

        return $response;
    }
    private function getFormat(string $contentType)
    {
        $format = null;

        if (preg_match('#application/json#', $contentType)) {
            $format = 'json';
        } elseif (preg_match('#application/xml#', $contentType)) {
            $format = 'xml';
        }

        if (null === $format) {
            throw new \RuntimeException(sprintf('Unsupported Content-type "%s".', $contentType));
        }

        return $format;
    }


    public function handleResponse(ResponseInterface $response, string $type, array $context = [])
    {
        $format = $this->getFormat($response->getHeaderLine('Content-Type'));
        $data = $response->getBody()->getContents();

        $deserializeContext = new DeserializationContext();
        $deserializeContext->setAttribute('context', $context);

        return $this->serializer->deserialize($data, $type, $format, $deserializeContext);
    }
}