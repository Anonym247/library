<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\LibrarianService;
use Illuminate\Console\Command;

class CheckLibrarianHitsCommand extends Command
{
    /**
     * @var LibrarianService
     */
    private LibrarianService $librarian_service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:librarian_hits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Once a month, identify a librarian with the largest number of books issued.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LibrarianService $librarian_service)
    {
        parent::__construct();

        $this->librarian_service = $librarian_service;
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(): void
    {
        $librarians = $this->librarian_service->getLibrariansWithEfficient();

        $best = $librarians->first();

        if (!$best) {
            $this->info("Top Librarian not found for current month");
        }

        $this->librarian_service->setLibrarianAsHit($best->id);
    }
}
