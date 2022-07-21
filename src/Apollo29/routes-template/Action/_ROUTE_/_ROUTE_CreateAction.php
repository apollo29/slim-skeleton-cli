<?php

namespace App\Action\_ROUTE_;

use App\Domain\_ROUTE_\Service\_ROUTE_Creator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class _ROUTE_CreateAction
{
    private JsonRenderer $renderer;

    private _ROUTE_Creator $creator;

    /**
     * The constructor.
     *
     * @param JsonRenderer $renderer The responder
     * @param _ROUTE_Creator $creator The service
     */
    public function __construct(JsonRenderer $renderer, _ROUTE_Creator $creator)
    {
        $this->jsonRenderer = $renderer;
        $this->creator = $creator;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $id = $this->creator->create($data);

        // Build the HTTP response
        return $this->jsonRenderer
            ->withJson($response, ['id' => $id])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
