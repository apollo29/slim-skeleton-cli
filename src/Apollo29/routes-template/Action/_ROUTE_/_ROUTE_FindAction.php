<?php

namespace App\Action\_ROUTE_;

use App\Domain\_ROUTE_\Service\_ROUTE_Finder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class _ROUTE_FindAction
{
    private _ROUTE_Finder $finder;

    private Responder $responder;

    /**
     * The constructor.
     *
     * @param _ROUTE_Finder $finder The event index list viewer
     * @param Responder $responder The responder
     */
    public function __construct(_ROUTE_Finder $finder, Responder $responder)
    {
        $this->finder = $finder;
        $this->responder = $responder;
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
        // Optional: Pass parameters from the request to the findUsers method
        $users = $this->finder->find();

        return $this->transform($response, $users);
    }

    /**
     * Transform to json response.
     * This could also be done within a specific Responder class.
     *
     * @param ResponseInterface $response The response
     * @param array $data The data
     *
     * @return ResponseInterface The response
     */
    private function transform(ResponseInterface $response, array $data): ResponseInterface
    {
        $list = [];

        // todo
        foreach ($date as $item) {
            $list[] = [
                'id' => $event->id,
                'event' => $event->event,
                'location' => $event->location,
                'title' => $event->title,
                'date' => $event->date,
                'description' => $event->description,
                'email' => $event->email,
            ];
        }

        return $this->responder->withJson(
            $response,
            [
                'data' => $list,
            ]
        );
    }
}
