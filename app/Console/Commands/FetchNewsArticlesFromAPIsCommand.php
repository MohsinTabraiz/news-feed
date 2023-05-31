<?php

namespace App\Console\Commands;

use App\External\NewsAPIs\Contracts\INewsAPIClient;
use App\External\NewsAPIs\Contracts\INewsAPIDataFormatter;
use App\Services\Contracts\IDataAggregationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class FetchNewsArticlesFromAPIsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news-articles-from-apis-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(IDataAggregationService $dataAggregationService)
    {
        $clients = config('api.news_api_clients');

        foreach ($clients as $apiClient) {
            try{
                $clientClass = $apiClient['client'];
                $formatterClass = $apiClient['data_formatter'];

                $this->info($clientClass);
                $this->info($formatterClass);

                // Create an instance of the client
                $client = App::make($clientClass);
               
                // Call the getArticles method on the client
                $articles = $client->getArticles();
              
                // Create an instance of the formatter
                $formatter = App::make($formatterClass);
                
                // Format the articles using the formatter
                $formattedArticles = $formatter->formatData($articles);
               
                // Process the formatted articles as desired
                $dataAggregationService->processFetchedNewsArticles($formattedArticles);

                $this->info('Articles fetched and processed successfully.');
            }catch(\Exception $e){
                //You may like to integrate Bugsnug here or setting up a simple logging.
                $this->error($e->getMessage());
            }
        }
    }
}
