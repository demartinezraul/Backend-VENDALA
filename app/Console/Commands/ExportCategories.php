<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports free market categories';

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
        dump("############################################################################################");
        dump('['.date('Y-m-d H:i:s').'] local.INFO: Starting to export categories');

        // Create a cURL handle.
        $curl = curl_init();
        // Set multiple options for a cURL transfer
        curl_setopt_array($curl,
            [
                CURLOPT_URL => "https://api.mercadolibre.com/sites/MLB/categories/all",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "cache-control: no-cache"
                ],
            ]
        );

        // Execute the given cURL session.
        $response = curl_exec($curl);
        // Checks whether a file or directory exists
        if (file_exists('categoriesMLB.txt')) {
            // Delete a file
            unlink('categoriesMLB.txt');
        }
        // Write a string to a file
        file_put_contents('categoriesMLB.txt', $response);
        // Close a cURL session
        curl_close($curl);
        dump('['.date('Y-m-d H:i:s').'] local.INFO: Category export completed');
        dd("############################################################################################");
    }
}
