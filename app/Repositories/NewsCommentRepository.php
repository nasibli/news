<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\NewsComment;

class NewsCommentRepository
{
    public function getList(News $news): ?object
    {
        return NewsComment::where('news_comments.news_id', $news->id)
            ->join('users', 'users.id', '=', 'news_comments.user_id')
            ->select('news_comments.*', 'users.name as user_name')
            ->orderBy('news_comments.id', 'ASC')
            ->orderBy('news_comments.parent_id', 'ASC')
            ->get();
    }
}
