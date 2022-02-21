<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Hire\GiveBackRequest;
use App\Http\Requests\Hire\StoreRequest;
use App\Services\BookService;
use App\Services\HireService;
use App\Services\ReaderService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class HireController extends Controller
{
    use ApiResponder;

    /**
     * @var HireService
     */
    private HireService $hire_service;

    /**
     * @var BookService
     */
    private BookService $book_service;

    /**
     * @var ReaderService
     */
    private ReaderService $reader_service;

    /**
     * @param HireService $hire_service
     * @param BookService $book_service
     * @param ReaderService $reader_service
     */
    public function __construct(HireService $hire_service, BookService $book_service, ReaderService $reader_service)
    {
        $this->hire_service = $hire_service;
        $this->book_service = $book_service;
        $this->reader_service = $reader_service;
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->book_service->isAvailable($request->get('book_id'))) {
            return $this->response(__('messages.book_is_not_in_stock'), [], ResponseAlias::HTTP_NOT_FOUND);
        }

        $reader = getAuthGuard()->user();

        if (!$this->reader_service->checkReaderAvailability()) {
            throw new NotFoundHttpException(__('messages.reader_has_omissions'));
        }

        $data = array_merge($request->validated(), ['reader_id' => $reader->getAuthIdentifier()]);

        $this->hire_service->store($data);

        return $this->response(__('messages.saved'));
    }

    /**
     * @param GiveBackRequest $request
     * @return JsonResponse
     */
    public function giveBack(GiveBackRequest $request): JsonResponse
    {
        if (!$this->book_service->isHiredByCurrentReader((int)$request->get('book_id'))) {
            return $this->response(__('messages.is_not_belongs_to_you'), [], ResponseAlias::HTTP_BAD_REQUEST);
        }

        $this->hire_service->giveBack((int)$request->get('book_id'));

        return $this->response(__('messages.successfully_returned'));
    }
}
