<?php

declare(strict_types = 1);

namespace Modules\ContactUs\Http\Controllers\API;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\ContactUs\Emails\NewMessageMail;
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
        $start = microtime(true);
        try {
           $message = $this->messageService->storeData($request->getData());
        } catch (Exception $exception) {
            return (new ApiResponse())->exeption();
        }

        Mail::to('admin@admin.com')->later(now()->addMinute(),new NewMessageMail($message));
        $finish = microtime(true)-$start;
        return (new ApiResponse())->success(['time'=>$finish]);
    }
}
