<?php

namespace App\Action\_ROUTE_;

use App\Domain\_ROUTE_\Service\_ROUTE_Deleter;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class _ROUTE_DeleteAction
{
    private _ROUTE_Deleter $deleter;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param _ROUTE_Deleter $deleter The service
     * @param Responder $responder The responder
     */
    public function __construct(_ROUTE_Deleter $deleter, Responder $responder)
    {
        $this->deleter = $deleter;
        $this->responder = $responder;
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
        return $this->responder->withJson($response);
    }
}
