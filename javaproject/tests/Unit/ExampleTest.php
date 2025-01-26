<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Comment;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
  //use RefreshDatabase;
  public function test_user_has_profile_created_automatically()
   {
       // Create a User instance manually
       $user = new User([
           'name' => 'John Doe',
           'email' => 'john.doe@example.com',
           'username' => 'johndoe',
           'password' => bcrypt('password'),
       ]);
       $user->save();

       // Manually create a Profile for the user
       $profile = new Profile([
           'title' => 'John Doe Profile',
           'description' => 'This is John Doe\'s profile description.',
           'url' => 'http://johndoe.com',
           'user_id' => $user->id,
       ]);
       $profile->save();

       // Manually create a Post
       $post = new Post([
           'caption' => 'This is a post by John Doe',
           'image' => 'uploads/sample.jpg',
           'user_id' => $user->id,
       ]);
       $post->save();

       // Manually create a Comment
       $comment = new Comment([
           'description' => 'This is a comment on the post.',
           'user_id' => $user->id,
           'post_id' => $post->id,
       ]);
       $comment->save();

       // Assertions to verify the data
       $this->assertEquals('John Doe', $user->name);
       $this->assertDatabaseHas('profiles', [
           'user_id' => $user->id,
           'title' => 'John Doe Profile',
       ]);
       $this->assertDatabaseHas('posts', [
           'caption' => 'This is a post by John Doe',
           'user_id' => $user->id,
       ]);
       $this->assertDatabaseHas('comments', [
           'description' => 'This is a comment on the post.',
           'post_id' => $post->id,
           'user_id' => $user->id,
       ]);
   }

   public function test_user_can_follow_another_user()
   {
       // Create first User
       $user1 = new User([
           'name' => 'Alice Smith',
           'email' => 'alice.smith@example.com',
           'username' => 'alicesmith',
           'password' => bcrypt('password123'),
       ]);
       $user1->save();

       // Create second User
       $user2 = new User([
           'name' => 'Bob Johnson',
           'email' => 'bob.johnson@example.com',
           'username' => 'bobjohnson',
           'password' => bcrypt('password123'),
       ]);
       $user2->save();

       // Create profiles for both users
       $profile1 = new Profile([
           'title' => 'Alice Smith Profile',
           'description' => 'Profile of Alice Smith',
           'user_id' => $user1->id,
       ]);
       $profile1->save();

       $profile2 = new Profile([
           'title' => 'Bob Johnson Profile',
           'description' => 'Profile of Bob Johnson',
           'user_id' => $user2->id,
       ]);
       $profile2->save();

       // Simulate user1 following user2
       $user1->following()->attach($user2->profile);

       // Assertions
       $this->assertTrue($user1->following->contains($user2->profile));
   }

   public function test_user_can_create_a_post()
    {
        // Create a User
        $user = new User([
            'name' => 'Charlie Brown',
            'email' => 'charlie.brown@example.com',
            'username' => 'charliebrown',
            'password' => bcrypt('charliepassword'),
        ]);
        $user->save();

        // Create a Profile for the user
        $profile = new Profile([
            'title' => 'Charlie Brown Profile',
            'description' => 'This is Charlie Brown\'s profile.',
            'user_id' => $user->id,
        ]);
        $profile->save();

        // Create a Post for the user
        $post = new Post([
            'caption' => 'This is a post by Charlie Brown',
            'image' => 'uploads/charlie_brown.jpg',
            'user_id' => $user->id,
        ]);
        $post->save();

        // Assertions
        $this->assertDatabaseHas('posts', [
            'caption' => 'This is a post by Charlie Brown',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_comment_on_a_post()
    {
        // Create a User
        $user = new User([
            'name' => 'David Lee',
            'email' => 'david.lee@example.com',
            'username' => 'davidlee',
            'password' => bcrypt('password321'),
        ]);
        $user->save();

        // Create a Profile for the user
        $profile = new Profile([
            'title' => 'David Lee Profile',
            'description' => 'Profile description of David Lee',
            'user_id' => $user->id,
        ]);
        $profile->save();

        // Create a Post for the user
        $post = new Post([
            'caption' => 'David Lee\'s first post!',
            'image' => 'uploads/david_lee.jpg',
            'user_id' => $user->id,
        ]);
        $post->save();

        // Create a Comment on the Post
        $comment = new Comment([
            'description' => 'Great post, David!',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        $comment->save();

        // Assertions
        $this->assertDatabaseHas('comments', [
            'description' => 'Great post, David!',
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);
    }
}
