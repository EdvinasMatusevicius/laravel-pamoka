<?php

declare(strict_types = 1);

namespace Modules\ContactUs\Http\Controllers\API;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\ContactUs\Http\Requests\API\ContactMessageRequest;
use Modules\ContactUs\Services\ContactMessageService;

class ContactMessageController extends Controller
{
    /**
     * @var ContactMessageService
     */
    private $messageService;

    /**
     * ContactMessageController constructor.
     * @param ContactMessageService $messageService
     */
    public function __construct(ContactMessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Store a newly created resource in storage.
     * @param ContactMessageRequest $request
     * @return JsonResponse
     */
    public function store(ContactMessageRequest $request): JsonResponse
    {
        try {
            $this->messageService->storeData($request->getData());
        } catch (Exception $exception) {
            return (new ApiResponse())->exception();
        }

        return (new ApiResponse())->success();
    }
}
