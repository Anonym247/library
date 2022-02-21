<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Hire\HireRepository;
use App\Repositories\Hire\HireRepositoryInterface;
use App\Repositories\Librarian\LibrarianRepository;
use App\Repositories\Librarian\LibrarianRepositoryInterface;
use App\Repositories\Reader\ReaderRepository;
use App\Repositories\Reader\ReaderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HireRepositoryInterface::class, HireRepository::class);
        $this->app->bind(LibrarianRepositoryInterface::class, LibrarianRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(ReaderRepositoryInterface::class, ReaderRepository::class);
    }
}
