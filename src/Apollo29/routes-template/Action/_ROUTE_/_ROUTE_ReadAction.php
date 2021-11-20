<?php

namespace App\Action\_ROUTE_;

use App\Domain\_ROUTE_\Data\_ROUTE_Data;
use App\Domain\_ROUTE_\Service\_ROUTE_Reader;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class _ROUTE_ReadAction
{
    private _ROUTE_Reader $reader;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param _ROUTE_Reader $viewer The service
     * @param Responder $responder The responder
     */
    public function __construct(_ROUTE_Reader $ciewer, Responder $responder)
    {
        $this->reader = $ciewer;
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
        $item = $this->reader->getById($id);

        // Transform result
        return $this->transform($response, $item);
    }

    /**
     * Transform result to response.
     *
     * @param ResponseInterface $response The response
     * @param _ROUTE_Data $item The item
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, _ROUTE_Data $item): ResponseInterface
    {
        // Turn that object into a structured array
        // todo
        $data = [
            'id' => $event->id,
            'location' => $event->location,
            'title' => $event->title,
            'date' => $event->date,
            'description' => $event->description,
            'email' => $event->email,
        ];

        // Turn all of that into a JSON string and put it into the response body
        return $this->responder->withJson($response, $data);
    }
}
