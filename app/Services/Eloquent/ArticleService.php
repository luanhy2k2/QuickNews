<?php

namespace App\Services\Eloquent;

use App\Commons\BaseCommandResponse;
use App\Commons\BaseQueryResponse;
use App\Models\ArticleTag;
use App\Models\FileArticle;
use App\Repositories\Contracts\IArticleFileRepository;
use App\Repositories\Contracts\IArticleRepository;
use App\Repositories\Contracts\IArticleTagRepository;
use App\Services\Contracts\IArticleFileService;
use App\Services\Contracts\IArticleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class ArticleService extends GenericService implements IArticleService
{
    private $articleRepo;
    private $articleTagRepo;
    public function __construct(IArticleRepository $articleRepo, IArticleTagRepository $articleTagRepo)
    {
        parent::__construct($articleRepo);
        $this->articleRepo = $articleRepo;
        $this->articleTagRepo = $articleTagRepo;
    }
    function getByCategoryId($id, $pageIndex, $pageSize)
    {
        $condition = ['category_id' => $id];
        $order = ['created_at' => 'desc'];
        $data = $this->articleRepo->get($pageIndex, $pageSize, $condition, $order);
        return new BaseQueryResponse($pageIndex, $pageSize, $id, $data->items(), $data->total());
    }
    function create($data)
    {
        try {
            $data['created_at'] = \Carbon\Carbon::now();
            $article = $this->articleRepo->create($data);
            if (!$article) {
                return new BaseCommandResponse("Thêm dữ liệu không thành công", $data, false);
            }
            foreach ($data['articleTags'] as $item) {
                $this->articleTagRepo->create([
                    'article_id' => $article->id,
                    'tag_id' => $item['id'] 
                ]);
            }

            return new BaseCommandResponse("Thêm dữ liệu thành công", $data);
        } catch (\Exception $ex) {
            return new BaseCommandResponse("Đã xảy ra lỗi: " . $ex->getMessage(), $data, false);
        }
    }

    function update($id, $data)
    {
        try {
            $article = $this->articleRepo->find($id);
            if (!$article) {
                return new BaseCommandResponse("Bài viết không tồn tại", null, false);
            }
            $this->articleRepo->update($id, $data);
            $currentTags = $this->articleTagRepo->getTagsByArticleId($article->id);
            $currentTagIds = $currentTags->pluck('tag_id')->toArray();
            $newTagIds = array_column($data['articleTags'], 'id');
            $tagsToDelete = array_diff($currentTagIds, $newTagIds);
            if (!empty($tagsToDelete)) {
                $this->articleTagRepo->deleteTagsByArticleIdAndTagIds($article->id, $tagsToDelete);
            }
            $tagsToAdd = array_diff($newTagIds, $currentTagIds);
            foreach ($tagsToAdd as $tagId) {
                $this->articleTagRepo->create([
                    'article_id' => $article->id,
                    'tag_id' => $tagId
                ]);
            }
            return new BaseCommandResponse("Cập nhật dữ liệu thành công", $data);
        } catch (\Exception $ex) {
            return new BaseCommandResponse("Đã xảy ra lỗi: " . $ex->getMessage(), $data, false);
        }
    }
    function uploadFile($request)
    {
        $file = $request['file'];
        $folder = 'articles';
        $filePath = "$folder/" . uniqid() . '-' . Carbon::now()->format('Y-m-d_H-i-s');
        Storage::disk('s3')->put($filePath, file_get_contents($file));
        $bucketName = env('AWS_BUCKET');
        $region = env('AWS_DEFAULT_REGION');
        $url = "https://{$bucketName}.s3.{$region}.amazonaws.com/{$filePath}";
        return new BaseCommandResponse("Upload file thành công", $url);
    }
    function deleteFile($fileUrl)
    {
        $bucketName = env('AWS_BUCKET');
        $region = env('AWS_DEFAULT_REGION');
        $filePath = str_replace("https://{$bucketName}.s3.{$region}.amazonaws.com/", '', $fileUrl['url']);
        if (Storage::disk('s3')->exists($filePath)) {
            Storage::disk('s3')->delete($filePath);
            return true;
        }
        return false;
    }
    function get(int $pageIndex, int $pageSize, string $keyword)
    {
        $query = $this->articleRepo->getQueryable()
            ->with([
                'category:id,name',
                'createdBy:id,name',
                'updatedBy:id,name'
            ]);
        if (!empty($keyword)) {
            $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhereHas('createdBy', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
        }
        $result = $query->paginate($pageSize, ['*'], 'page', $pageIndex);
        $articles = $result->map(function ($article) {
            return $this->mapArticle($article);
        });
        return new BaseQueryResponse($pageIndex, $pageSize, $keyword, $articles, $result->total());
    }
    function find($id)
    {
        $article = $this->articleRepo->find($id);
        if ($article) {
            return $this->mapArticle($article);
        }
        return null;
    }

    private function mapArticle($article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'content' => $article->content,
            'approval' => $article->approval,
            'created_by' => $article->createdBy->name,
            'updated_by' => $article->updatedBy->name ?? 'N/A',
            'summary' => $article->summary,
            'category_name' => $article->category->name,
            'category_id' => $article->category->id,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
            'articleTags' => $this->mapArticleTags($article->articleTags) // Gọi hàm mapArticleTags để xử lý
        ];
    }

    private function mapArticleTags($articleTags)
    {
        return $articleTags->map(function ($articleTag) {
            return [
                'id' => $articleTag->tag->id,
                'name' => $articleTag->tag->name
            ];
        })->toArray();
    }
}
