<?php

namespace Apollo29\SlimSkeletonCli\Command;


use SimpleCli\Command;
use SimpleCli\Options\Help;
use SimpleCli\Options\Verbose;
use SimpleCli\SimpleCli;

/**
 * Add new Route.
 */
class Add implements Command
{
    use Help;
    use Verbose;

    private static string $ROUTE = "_ROUTE_";
    private static string $ROUTE_NAME = "_ROUTENAME_";
    private static string $TABLE_NAME = "_TABLENAME_";

    /**
     * @argument
     *
     * The Route Object Name (camelcase)
     *
     * @var string
     */
    public string $routeObject;

    /**
     * @argument
     *
     * The Route Name (lowercase), if Empty uses lowercase Route Object Name
     *
     * @var string
     */
    public string $routeName;

    /**
     * @option
     *
     * Optional: The Module Name (snake case)
     */
    public string $tableName = "";

    /**
     * @option
     *
     * Optional: The destination path, default = src
     */
    public string $slimPath = "src";

    public function run(SimpleCli $cli): bool
    {
        if (empty($this->routeObject)) {
            return $this->error($cli, "Please enter a Route name");
        }

        if (empty($this->routeName)) {
            $routeName = strtolower($this->routeObject);
            $this->routeName = $routeName;
            $this->info($cli, "Use lowercase Route Object Name: ${routeName}");
        }

        if (empty($this->tableName)) {
            $this->tableName = $this->routeName;
        }

        if (!$this->ensureSlimAppDirectoryExists()) {
            $path = $this->slimPath;
            return $this->error($cli, "Unable to find the Slim/App directory (${path})");
        }

        // RUN

        if ($this->verbose) {
            $this->info($cli, "Generating Route $this->routeObject with Name $this->routeName");
        }

        $this->copyTemplate($cli);

        // endregion

        return true;
    }

    protected function copyTemplate(SimpleCli $cli): void
    {
        $routesTemplate = __DIR__ . '/../../routes-template';

        $this->info($cli, "Template: ${routesTemplate}");

        foreach (scandir($routesTemplate) ?: [] as $file) {
            if (substr($file, 0, 1) !== '.') {
                $originPath = $routesTemplate . '/' . $file;
                $targetPath = $this->slimPath . '/' . $file;
                $this->copyAndRename($cli, $originPath, $targetPath);
            }
        }
    }

    private function copyAndRename(SimpleCli $cli, string $originPath, string $targetPath): void
    {
        $path = strtr($targetPath, [
            $this::$ROUTE => $this->routeObject,
            $this::$ROUTE_NAME => $this->routeName,
            $this::$TABLE_NAME => $this->tableName]);

        if ($this->verbose) {
            $cli->writeLine("Creating ${path}");
        }

        if (is_dir($originPath)) {
            @mkdir($targetPath);
            foreach (scandir($originPath) ?: [] as $file) {
                if ($file != "." && $file != "..") {
                    $this->copyAndRename($cli, "$originPath/$file", strtr("$targetPath/$file", [
                        $this::$ROUTE => $this->routeObject,
                        $this::$ROUTE_NAME => $this->routeName,
                        $this::$TABLE_NAME => $this->tableName
                    ]));
                }
            }
        } else if (is_file($originPath)) {
            file_put_contents(
                $path,
                strtr(
                    (string)file_get_contents("$originPath"),
                    [
                        $this::$ROUTE => $this->routeObject,
                        $this::$ROUTE_NAME => $this->routeName,
                        $this::$TABLE_NAME => $this->tableName
                    ]
                )
            );
        }
    }

    /**
     * @SuppressWarnings(PHPMD.ErrorControlOperator)
     *
     * @return bool
     */
    protected function ensureSlimAppDirectoryExists(): bool
    {
        return is_dir($this->slimPath);
    }


    /**
     * @param SimpleCli $cli
     * @param string $text
     *
     * @return bool
     */
    protected function error(SimpleCli $cli, string $text): bool
    {
        $cli->writeLine($text, 'red');
        return false;
    }

    /**
     * @param SimpleCli $cli
     * @param string $text
     */
    protected function info(SimpleCli $cli, string $text): void
    {
        $cli->writeLine($text, 'light_cyan');
    }
}