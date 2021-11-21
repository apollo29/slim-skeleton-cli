<?php
namespace Apollo29\SlimSkeletonCli;

use Apollo29\SlimSkeletonCli\Command\Add;
use SimpleCli\SimpleCli;

class SlimCli extends SimpleCli
{
    public function getCommands() : array
    {
        return [
            'add' => Add::class,
        ];
    }

    public function getVersion(): string
    {
        return '1.0.1';
    }
}