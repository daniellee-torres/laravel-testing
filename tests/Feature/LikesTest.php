<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LikesTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     */
    public function a_user_can_like_a_post()
    {
        $post = Post::factory()->create();
        $user= User::factory()->create();
        $this->actingAs($user);

        $post->like();

        $this->assertTrue(DB::table('likes')->where([
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post),
        ])->exists());

        $this->assertTrue($post->isLiked());
    }

    /**
     * @test
     */
    public function a_user_can_unlike_a_post()
    {
        $post = Post::factory()->create();
        $user= User::factory()->create();
        $this->actingAs($user);

        $post->like();
        $post->unlike();

        $this->assertFalse(DB::table('likes')->where([
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post),
        ])->exists());

        $this->assertFalse($post->isLiked());
    }

    /**
     * @test
     */
    public function a_user_may_toggle_a_posts_like_status()
    {
        $post = Post::factory()->create();
        $user= User::factory()->create();
        $this->actingAs($user);

        $post->toggle();

        $this->assertTrue($post->isLiked());

        $post->toggle();

        $this->assertFalse($post->isLiked());
    }

    /**
     * @test
     */
    public function a_post_knows_how_many_likes_it_has()
    {
        $post = Post::factory()->create();
        $user= User::factory()->create();
        $this->actingAs($user);

        $post->toggle();

        $this->assertEquals(1, $post->getLikesCountAttribute());
    }
}
