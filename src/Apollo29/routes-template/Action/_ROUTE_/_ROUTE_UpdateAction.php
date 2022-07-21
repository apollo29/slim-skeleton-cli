<?php

namespace App\Action\_ROUTE_;

use App\Domain\_ROUTE_\Service\_ROUTE_Updater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class _ROUTE_UpdateAction
{
    private JsonRenderer $renderer;

    private _ROUTE_Updater $updater;

    /**
     * The constructor.
     *
     * @param JsonRenderer $renderer The responder
     * @param _ROUTE_Updater $eventUpdater The service
     */
    public function __construct(JsonRenderer $renderer, _ROUTE_Updater $updater)
    {
        $this->renderer = $renderer;
        $this->updater = $updater;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $id = (int)$args['id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $this->updater->update($id, $data);

        // Build the HTTP response
        return $this->renderer->json($response);
    }
}
