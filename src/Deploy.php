<?php namespace Olssonm\Deploy;

use Carbon\Carbon;
use File;

use \Exception;

class Deploy
{
    protected $path;

    protected $exists = false;

    /**
     * @param string $file
     */
    function __construct(string $file = 'app/deploy.txt')
    {
        $this->path = storage_path($file);
        $this->exists = file_exists($this->path);
    }

    /**
     * "Make" a new deploy
     * @param  string $message
     * @return bool
     */
    public function make(string $message = null): bool
    {
        if (!$message) {
            $message = 'Deployed @ ' . Carbon::now()->format('Y-m-d H:i:s') . PHP_EOL;
        }

        return $this->exists = File::append($this->path, $message);
    }

    /**
     * Returns when the last deploy occured
     * @return \Carbon\Carbon
     */
    public function when(): Carbon
    {
        if (!$this->exists) {
            throw new Exception("Deploy file doesn't exist. Please run php artisan deploy:make first.", 1);
        }

        return Carbon::createFromTimestamp(filemtime($this->path));
    }
}
