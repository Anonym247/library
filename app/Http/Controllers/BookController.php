<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    use ApiResponder;

    /**
     * @var BookService
     */
    private BookService $book_service;

    /**
     * @param BookService $book_service
     */
    public function __construct(BookService $book_service)
    {
        $this->book_service = $book_service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $available_books = $this->book_service->getAvailableBooks();

        return $this->response(__('messages.list'), $available_books);
    }

    /**
     * @return JsonResponse
     */
    public function getHired(): JsonResponse
    {
        $hired_books = $this->book_service->getHiredBooks();

        return $this->response(__('messages.list'), $hired_books);
    }
}
