<?php

namespace Famousinteractive\ContentApi\Commands;

use Illuminate\Console\Command;


class Initialize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'famousContentApi:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the config file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info('Famous Content Api initialize ...');
        $this->info('We\'ll ask you a few question to initialize this package. You can edit these data in the famousContentApi.php file in your config directory');

        //Enable language
        $lang = $this->ask('Enter the language to activate. Use a coma to separate them', 'nl,fr');
        $lang = explode(',', $lang);

        $clientId = $this->ask('Enter your APi client Id');
        $apiKey   = $this->ask('Enter your Api key');
        $autoRegister = $this->confirm('Do you want to auto register new translation ? (You key need to have "readonly" unchecked) ');
        $useCache = $this->confirm('Do you want to use the cache ? (Enter No for dev environment) ');

        $apiUrl = $this->ask('Enter the Api url :', 'https://content.famousgrey.com/');
        $apiEndpoint = $this->ask('Enter the Api endpoint :', 'api/content');
        $apiEndpointDataset = $this->ask('Enter the Api Dataset endpoint:', 'api/content/dataset');

        $cacheDuraction = $this->ask('Enter the duration of the cache (in munite)', 120);

        $credentials = [
            'clientId'      => $clientId,
            'key'           => $apiKey,
            'lang'          => $lang,
            'useApi'        => true,
            'autoRegister'  => $autoRegister,
            'apiUrl'        => $apiUrl,
            'apiEndpoint'   => $apiEndpoint,
            'apiDatasetEndpoint'    => $apiEndpointDataset,
            'useCache'      => $useCache,
            'cacheDuration' => $cacheDuraction
        ];

        $fp = fopen(config_path('famousContentApi.php') , 'w');
        fwrite($fp, '<?php return ' . var_export( $credentials, true) . ';');
        fclose($fp);

        $this->warn('Add the config file famousContentApi.php in your gitignore !');
        $this->info('Good luck !');
    }
}
