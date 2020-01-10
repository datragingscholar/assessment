<?php

namespace App\Application\Commands;

use Illuminate\Console\Command;
use App\Persistance\iStringPersistance;
use App\Domain\Services\iStringManipulator;
use App\Domain\Entities\StringFactory;

class ConvertString extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'string:convert
        {--U|only-to-upper-case : Only convert string to all upper case. Specify no flag to perform all conversions.}
        {--A|only-to-alternate-case : Only convert string to alternate case. Specify no flag to perform all conversions.}
        {--D|do-not-save : Do not save to file}
        {string}
    ';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command processes input string and converts them into output specified.';

    protected $manipulator;
    protected $persistance;
    protected $factory;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(iStringManipulator $manipulator, iStringPersistance $persistance, StringFactory $factory)
    {
        parent::__construct();

        $this->manipulator = $manipulator;
        $this->persistance = $persistance;
        $this->factory = $factory;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('only-to-upper-case') && $this->option('only-to-alternate-case')) {
            $this->error('[-U|--only-to-upper-case] and [-A|--only-to-alternate-case] should not both be present');

            exit(-1);
        }

        $this->convertToAllUpperCaseIfRequired();
        $this->convertToAlternateCaseIfRequired();
        $this->persistIfRequired();
    }

    protected function convertToAllUpperCaseIfRequired()
    {
        if ($this->option('only-to-alternate-case')) return;

        $stringEntity = $this->factory->makeFromString($this->argument('string'));
        $this->manipulator->toAllUpperCase($stringEntity);

        $this->line($stringEntity->get());
    }

    protected function convertToAlternateCaseIfRequired()
    {
        if ($this->option('only-to-upper-case')) return;

        $stringEntity = $this->factory->makeFromString($this->argument('string'));
        $this->manipulator->toAlternateCase($stringEntity);

        $this->line($stringEntity->get());
    }

    protected function persistIfRequired()
    {
        if ($this->option('do-not-save')) return;

        $stringEntity = $this->factory->makeFromString($this->argument('string'));
        $this->persistance->persist($stringEntity);

        $this->line('File Created!');
    }
}
