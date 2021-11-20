<?php
namespace Apollo29\SlimSkeletonCli\Command;


use SimpleCli\Command;
use SimpleCli\Options\Help;
use SimpleCli\SimpleCli;

/**
 * Add new Route.
 */
class Add implements Command
{
    use Help;

    /**
     * @argument
     *
     * The first number
     *
     * @var float
     */
    public $number1 = 0;

    /**
     * @argument
     *
     * The second number
     *
     * @var float
     */
    public $number2 = 0;

    /**
     * @option
     *
     * Something the command can use.
     */
    public $foo;

    public function run(SimpleCli $cli): bool
    {
        if (!empty($this->foo)) {
            $cli->write($this->foo);
        }
        $cli->write($this->number1 + $this->number2);

        return true;
    }
}