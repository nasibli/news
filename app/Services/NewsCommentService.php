<?php

namespace App\Services;

use App\Models\News;
use App\Models\NewsComment;
use App\Models\User;
use App\Repositories\NewsCommentRepository;

class NewsCommentService
{
    /**
     * @var NewsCommentRepository
     */
    private $newsCommentRepository;

    public function __construct(NewsCommentRepository $newsCommentRepository)
    {
        $this->newsCommentRepository = $newsCommentRepository;
    }

    public function getList(News $news): array
    {
        $newsComments = $this->newsCommentRepository->getList($news);

        $result = ['newsComments' => [], 'subComments' => []];

        foreach ($newsComments as $newsComment) {
            if ($newsComment['parent_id'] === null) {
                $result['newsComments'][] = $newsComment;
            } else {
                $result['subComments'][$newsComment['parent_id']][] = $newsComment;
            }
        }

        return $result;
    }

    public function create(News $news, ?NewsComment $parentNewsComment, User $user, array $data): NewsComment
    {
        $newsComment = new NewsComment;
        $newsComment->user_id = $user->id;
        $newsComment->news_id = $news->id;
        $newsComment->fill($data);
        if ($parentNewsComment !== null) {
            if ($parentNewsComment->parent !== null) {
                throw new \LogicException('You can add subcomments only 1 level depth');
            }
            $parentNewsComment->children()->save($newsComment);
        }

        $newsComment->save();

        return $newsComment;
    }
}
