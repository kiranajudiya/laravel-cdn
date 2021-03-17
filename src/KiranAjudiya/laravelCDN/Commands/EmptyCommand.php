<?php

namespace KiranAjudiya\laravelCDN\Commands;

use Illuminate\Console\Command;
use KiranAjudiya\laravelCDN\Cdn;
use KiranAjudiya\laravelCDN\Contracts\CdnInterface;

/**
 * Class PushCommand.
 *
 * @category Command
 *
 * @author   Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
class EmptyCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'cdn:empty --all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Empty all assets from CDN';

    /**
     * an instance of the main Cdn class.
     *
     * @var Cdn
     */
    protected $cdn;

    /**
     * @param CdnInterface $cdn
     */
    public function __construct(CdnInterface $cdn)
    {
        $this->cdn = $cdn;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->cdn->emptyBucket();
    }
}
