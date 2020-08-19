<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class Categories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert open market categories';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
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
        dump('['.date('Y-m-d H:i:s').'] local.INFO: Starting to import categories');

        $filename = "categoriesMLB.txt";
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);

        $i = 0;
        $objects = json_decode($contents);
        foreach ($objects as $obj) {
            $k = 0;
            $category = Category::where('code_category',$obj->id)->first();
            if ($category) {
                $category->name = $obj->name;
                $category->picture = $obj->picture;
                $category->code_category = $obj->id;
                $category->update();

                foreach (array_reverse($obj->path_from_root) as $tree) {
                    if ($k == 0) {
                        $k++;
                        continue;
                    } else if ($k == 1) {
                        $categoryParent = Category::where('code_category',$tree->id)->first();
                        if ($categoryParent) {
                            $category->category_id = $categoryParent->id;
                            $category->update();
                        } else {
                            $parent = new Category();
                            $parent->name = $tree->name;
                            $parent->code_category = $tree->id;
                            $parent->save();

                            $category->category_id = $parent->id;
                            $category->update();
                        }
                    }
                    $k++;
                }
            } else {
                $newCategory = new Category();
                $newCategory->name = $obj->name;
                $newCategory->picture = $obj->picture;
                $newCategory->code_category = $obj->id;
                $newCategory->save();

                foreach (array_reverse($obj->path_from_root) as $tree) {
                    if ($k == 0) {
                        $k++;
                        continue;
                    } else if ($k == 1) {
                        $categoryParent = Category::where('code_category',$tree->id)->first();
                        if ($categoryParent) {
                            $newCategory->category_id = $categoryParent->id;
                            $newCategory->update();
                        } else {
                            $parent = new Category();
                            $parent->name = $tree->name;
                            $parent->code_category = $tree->id;
                            $parent->save();
                            $newCategory->category_id = $parent->id;
                            $newCategory->update();
                            break;
                        }
                    }
                    $k++;
                }
                $i++;
                if ($i % 500 == 0) {
                    dump('Imported quantity: '.$i );
                }
            }
        }
        dump('['.date('Y-m-d H:i:s').'] local.INFO: Category import completed');
        dd("############################################################################################");
    }
}
