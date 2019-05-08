<?php

namespace Tests\Feature;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
           
         //  testing for view create Post 
            $response = $this->get('/CreatePost');
            $response->assertStatus(302);
    
    
        //   testing for view home and HomePostController 
          
           
          // creating a blog post 
           $post = Post::create([
           'image' => 'image.jpg',
           'body' => 'A Simple',
           'user_id' => '5',
           ]); 
    
           // Action 
           // Visiting the route 
           $response = $this->get('/home');
          
          //Assert 
          // assert status code 302 
          $response->assertStatus(302);
          // assert we that see post tilte 
          $response->assertSee($post->title);
          // assert We that See Post date 
        
          /*
         $response->assertSee($post->created_at->toFormattedDateString()); 
          //assert We that see Post Image
          $response->assertSee($post->image);  */      
    }
    /**
     * @group post-not-found
     *
     * @return 
     */
    public function testview404pagewhenPostIsNotFound(){

        //action 
        $response = $this->get('post/INVALID_ID');
        
        //assert

        $response->assertStatus(404); 

        $response->assertSee("Not Found "); 
    }
}
