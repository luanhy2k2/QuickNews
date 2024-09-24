<?php
namespace App\Services\Eloquent;

use App\Commons\BaseCommandResponse;
use App\Commons\BaseQueryResponse;
use App\Repositories\Contracts\ICommentRepository;
use App\Services\Contracts\ICommentService;

class CommentService extends GenericService implements ICommentService {
    protected $commentRepo;
    public function __construct(ICommentRepository $commentRepo) {
        parent::__construct($commentRepo);
        $this->commentRepo = $commentRepo;
    }
    public function get(int $pageIndex, int $pageSize, string $keyword){
        $condition = ['article_id' => $keyword];
        $order = ['created_at' =>'desc'];
        $data = $this->commentRepo->get($pageIndex, $pageSize, $condition,$order);
        return new BaseQueryResponse($pageIndex,$pageSize,$keyword,$data->items(), $data->total());
    }
    public function updateStatus($id, $approval)
    {
        $Comment = $this->commentRepo->find($id);
        if ($Comment == null) {
            return new BaseCommandResponse("Comment không tồn tại!", $Comment, false);
        }
        $Comment->approval = $approval;
        if ($this->update($Comment, ['approval' => $approval])) {
            return new BaseCommandResponse("Cập nhật trạng thái thành công!", $Comment);
        }

        return new BaseCommandResponse("Cập nhật trạng thái không thành công!", $Comment, false);
    }

}
