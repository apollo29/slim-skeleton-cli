<?php

namespace App\Action\_ROUTE_;

use App\Domain\_ROUTE_\Service\_ROUTE_Deleter;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class _ROUTE_DeleteAction
{
    private _ROUTE_Deleter $deleter;

    private JsonRenderer $renderer;

    /**
     * The constructor.
     *
     * @param _ROUTE_Deleter $deleter The service
     * @param JsonRenderer $renderer The responder
     */
    public function __construct(_ROUTE_Deleter $deleter, JsonRenderer $renderer)
    {
        $this->deleter = $deleter;
        $this->renderer = $renderer;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The routing arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $id = (int)$args['id'];

        // Invoke the domain (service class)
        $this->deleter->delete($id);

        // Render the json response
        return $this->renderer->json($response);
    }
}
