<?php

namespace Tests\Unit\Services;

use App\Models\Article;
use Tests\TestCase;
use App\Services\DataAggregationService;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SourceRepository;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class DataAggregationServiceTest extends TestCase
{
    use LazilyRefreshDatabase;
    public function testGetAllData()
    {
        $articleRepositoryMock = $this->createMock(ArticleRepository::class);
        $authorRepositoryMock = $this->createMock(AuthorRepository::class);
        $categoryRepositoryMock = $this->createMock(CategoryRepository::class);
        $sourceRepositoryMock = $this->createMock(SourceRepository::class);

        $service = new DataAggregationService(
            $articleRepositoryMock,
            $authorRepositoryMock,
            $categoryRepositoryMock,
            $sourceRepositoryMock
        );

        $query = ['keyword' => 'test'];
        $result = $service->getAllData($query);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('articles', $result);
        $this->assertArrayHasKey('authors', $result);
        $this->assertArrayHasKey('categories', $result);
        $this->assertArrayHasKey('sources', $result);
    }

    public function testProcessFetchedNewsArticles()
{
    $service = new DataAggregationService(
        $this->app->make(ArticleRepository::class),
        $this->app->make(AuthorRepository::class),
        $this->app->make(CategoryRepository::class),
        $this->app->make(SourceRepository::class)
    );

    $data = [
        // test data here
        [
            'author' => 'John Doe',
            'category' => 'Technology',
            'source' => 'Tech News',
            'title' => 'Test Article',
            'content' => 'This is a test article.',
            'published_at' => '2023-05-31 10:00:00',
        ],
    ];

    $service->processFetchedNewsArticles($data);

    // Assert the result
    $article = Article::where('title', 'Test Article')->first();

    $this->assertNotNull($article);
    $this->assertEquals('John Doe', $article->author->name);
    $this->assertEquals('Technology', $article->category->title);
    $this->assertEquals('Tech News', $article->source->title);
    $this->assertEquals('This is a test article.', $article->content);
    $this->assertEquals('2023-05-31 10:00:00', $article->published_at);
}

}
