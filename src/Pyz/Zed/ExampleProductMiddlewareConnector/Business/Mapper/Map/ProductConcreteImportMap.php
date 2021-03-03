<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business\Mapper\Map;

use Pyz\Zed\DataImport\Business\Model\Product\AttributesExtractorStep;
use Pyz\Zed\DataImport\Business\Model\ProductConcrete\ProductConcreteHydratorStep;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class ProductConcreteImportMap extends AbstractMap
{
    public const ROOT_PRODUCT_CONCRETE_KEY = 'products_concrete';

    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            static::ROOT_PRODUCT_CONCRETE_KEY => [
                'item',
                'itemMap' => [
                    ProductConcreteHydratorStep::COLUMN_CONCRETE_SKU => '@sku',
                    ProductConcreteHydratorStep::COLUMN_ABSTRACT_SKU => 'productSKU',
                    ProductConcreteHydratorStep::COLUMN_NAME => 'name',
                    AttributesExtractorStep::KEY_ATTRIBUTES => function ($payload) {
                        return $this->getProductConcreteAttributes($payload);
                    },
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return MapInterface::MAPPER_STRATEGY_SKIP_UNKNOWN;
    }

    /**
     * @param array $payload
     *
     * @return array
     */
    protected function getProductConcreteAttributes(array $payload): array
    {
        $result = [];

        if (!isset($payload['attributes']['attribute'])) {
            return $result;
        }

        $attributes = $payload['attributes']['attribute'];

        if (isset($attributes['name']) && isset($attributes['value'])) {
            $result[$attributes['name']] = $attributes['value'];

            return $result;
        }

        foreach ($attributes as $attribute) {
            if (isset($attribute['name']) && isset($attribute['value'])) {
                $result[$attribute['name']] = $attribute['value'];
            }
        }

        return $result;
    }
}