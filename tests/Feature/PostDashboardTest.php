<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Post;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Run the role and permission seeder before each test
    $this->seed(\Database\Seeders\RolePermissionSeeder::class);
});

test('admin can access admin dashboard and see post/user statistics', function () {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $author = User::factory()->create();
    $author->assignRole('Author');

    // Create some posts using relationship
    $author->posts()->create(['title' => 'Post 1', 'body' => 'Content 1', 'published' => true]);
    $author->posts()->create(['title' => 'Post 2', 'body' => 'Content 2', 'published' => false]);

    $response = $this->actingAs($admin)->get('/dashboard');

    $response->assertOk()
        ->assertViewIs('dashboard')
        ->assertSee('Admin Dashboard')
        ->assertSee('Total Posts')
        ->assertSee('Total Users')
        ->assertSee('Post 1')
        ->assertSee('Post 2');
});

test('author can access author dashboard and see only their own posts', function () {
    $author1 = User::factory()->create();
    $author1->assignRole('Author');

    $author2 = User::factory()->create();
    $author2->assignRole('Author');

    // Author 1 post
    $author1->posts()->create(['title' => 'Author 1 Post', 'body' => 'Content 1', 'published' => true]);
    // Author 2 post
    $author2->posts()->create(['title' => 'Author 2 Post', 'body' => 'Content 2', 'published' => true]);

    $response = $this->actingAs($author1)->get('/dashboard');

    $response->assertOk()
        ->assertViewIs('dashboard')
        ->assertSee('Author 1 Post')
        ->assertDontSee('Author 2 Post');
});

test('reader can access reader dashboard and see only published posts', function () {
    $reader = User::factory()->create();
    $reader->assignRole('Reader');

    $author = User::factory()->create();
    $author->assignRole('Author');

    $author->posts()->create(['title' => 'Published Post', 'body' => 'Content 1', 'published' => true]);
    $author->posts()->create(['title' => 'Draft Post', 'body' => 'Content 2', 'published' => false]);

    $response = $this->actingAs($reader)->get('/dashboard');

    $response->assertOk()
        ->assertViewIs('dashboard')
        ->assertSee('Published Post')
        ->assertDontSee('Draft Post');
});

test('author can create a post as draft but cannot publish directly', function () {
    $author = User::factory()->create();
    $author->assignRole('Author');

    $response = $this->actingAs($author)->post('/posts', [
        'title' => 'My New Article',
        'body' => 'My body content.'
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('posts', [
        'title' => 'My New Article',
        'user_id' => $author->id,
        'published' => false
    ]);
});

test('non-admin cannot toggle published status of a post', function () {
    $author = User::factory()->create();
    $author->assignRole('Author');

    $post = $author->posts()->create(['title' => 'Sample Post', 'body' => 'Content', 'published' => false]);

    $response = $this->actingAs($author)->patch("/posts/{$post->id}", [
        'toggle_publish' => 1
    ]);

    $response->assertForbidden();
    $this->assertFalse($post->fresh()->published);
});

test('admin can toggle published status of a post', function () {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $author = User::factory()->create();
    $author->assignRole('Author');

    $post = $author->posts()->create(['title' => 'Sample Post', 'body' => 'Content', 'published' => false]);

    $response = $this->actingAs($admin)->patch("/posts/{$post->id}", [
        'toggle_publish' => 1
    ]);

    $response->assertRedirect();
    $this->assertTrue($post->fresh()->published);
});
