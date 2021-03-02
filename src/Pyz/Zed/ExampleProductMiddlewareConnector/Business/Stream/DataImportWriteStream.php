<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ExampleProductMiddlewareConnector\Business\Stream;

use Pyz\Zed\ExampleProductMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException;

class DataImportWriteStream implements WriteStreamInterface
{
    /**
     * @var \Pyz\Zed\ExampleProductMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $dataImporterPlugin;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param \Pyz\Zed\ExampleProductMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterPlugin
     */
    public function __construct(DataImporterPluginInterface $dataImporterPlugin)
    {
        $this->dataImporterPlugin = $dataImporterPlugin;
    }

    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->data = [];

        return true;
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        return true;
    }

    /**
     * @param int $offset
     * @param int $whence
     *
     * @throws \SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException
     *
     * @return int
     */
    public function seek(int $offset, int $whence): int
    {
        throw new MethodNotSupportedException();
    }

    /**
     * @throws \SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException
     *
     * @return bool
     */
    public function eof(): bool
    {
        throw new MethodNotSupportedException();
    }

    /**
     * @param array $data
     *
     * @return int
     */
    public function write(array $data): int
    {
        $this->data = $data;

        return 1;
    }

    /**
     * @return bool
     */
    public function flush(): bool
    {
        $this->dataImporterPlugin->import($this->data);

        return true;
    }
}
