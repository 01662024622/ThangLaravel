<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Post;
class crawlerDantri extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crape:dantri';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    protected $category=[
        'su-kien.htm',
       'xa-hoi.htm',
        'the-gioi.htm',
        'the-thao.htm',
        'giao-duc-khuyen-hoc.htm',
        'tam-long-nhan-ai.htm',
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        foreach ($this->category as $category) {
            # code...
            $crawler = Goutte::request('GET', env('DAN_TRI').$category);
            $titles=$crawler->filter('a.fon6')->each(function ($node) {
            return $node->attr("href");
            });
            foreach ($titles as $key => $title) {
                if (isset($title)) {
                    # code...
                self::crawlerPost($title);
                }
            }
        }
    }
    public static function crawlerPost($url){
        /*
        *
        *title and slug
        *@param  
        *@param  
        *@return 
        */
        $crawler = Goutte::request('GET',env('DAN_TRI').$url);
        $title=$crawler->filter('h1.fon31.mgb15')->each(function ($node) {
         return $node->text();
        });
        if (isset($title[0])) {
            $title=$title[0];
        }else{
            $title='errors';
        }
        $slug=str_slug($title);
        /*
        *
        *description
        *@param  
        *@param  
        *@return 
        */
        $description=$crawler->filter('h2.fon33.mt1.sapo')->each(function ($node) {
         return $node->text();
        });
        if (isset($description[0])) {
            $description=$description[0];
        }else{
            $description='errors';
        }
        $description=str_replace('Dân trí','', $description);
        /*
        *
        *content
        *@param  
        *@param  
        *@return 
        */
        $content=$crawler->filter('div#divNewsContent>p')->each(function ($node) {
         return $node->text();
        });
         $allOfContent="";
       for ($i=0; $i <5; $i++) {
            if (isset($content[$i])) {
                # code...
            $allOfContent=$allOfContent.$content[$i];
            }
        }
        /*
        *
        *image
        *@param  
        *@param  
        *@return 
        */
        $image=$crawler->filter('div#divNewsContent>div.VCSortableInPreviewMode>div>img')->each(function ($node) {
         return $node->attr('src');
        });
        if (isset($image[0])) {
            $image=$image[0];
        }else{
            $image='errors';
        }
        $category_id=rand(10,100);
        $user_id=rand(1,20);
        $status=rand(0,2);
        if ($content!=="errors"&&$title!=="errors"&&$slug!=="errors"&&$description!=="errors"&&$image!=="errors") {
            $data=[
            'title'=>$title,
            'description'=>$description,
            'content'=>$allOfContent,
            'image'=>$image,
            'category_id'=>$category_id,
            'user_id'=>$user_id,
            'slug'=>$slug,
            'status'=>$status,
            ];
        Post::create($data);
        print('successfull \n');
        }

    }
}

