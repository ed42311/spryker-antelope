<?php
namespace Pyz\Zed\ExampleProductImport\Business\Importer;

interface DataImporterInterface
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function import(array $data): void;
}
