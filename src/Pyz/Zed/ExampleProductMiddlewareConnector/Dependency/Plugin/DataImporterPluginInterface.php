<?php

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Dependency\Plugin;

interface DataImporterPluginInterface
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function import(array $data): void;
}
