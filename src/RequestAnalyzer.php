<?php

namespace Codevia\RequestAnalyzer;

use Psr\Http\Message\ServerRequestInterface;

class RequestAnalizer
{
    /**
     * Get pagination query params from the request
     * 
     * @param ServerRequestInterface $request 
     * @return array Pagination params
     */
    public static function getPagination(
        ServerRequestInterface $request,
        int $defaultPage = 1,
        int $defaultLimit = 20
    ): array
    {
        $page = (int) ($request->getQueryParams()['page'] ?? $defaultPage);
        $limit = (int) ($request->getQueryParams()['limit'] ?? $defaultLimit);

        return [
            'limit' => $limit,
            'page' => $page,
        ];
    }

    /**
     * Verify if the request contains all the required parameters
     * 
     * @param ServerRequestInterface $request The request object
     * @param array                  $fields  The required fields
     * @return bool `true` if all the required parameters are present, `false` otherwise
     */
    public static function parsedBody(ServerRequestInterface $request, array $fields): bool
    {
        $isValid = true;

        foreach ($fields as $field) {
            if (!array_key_exists($field, $request->getParsedBody())) {
                $isValid = false;
            }
        }

        return $isValid;
    }
}
