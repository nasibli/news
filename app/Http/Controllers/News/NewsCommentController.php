<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCommentRequest;
use App\Models\News;
use App\Models\NewsComment;
use App\Services\NewsCommentService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NewsCommentController extends Controller
{
    /**
     * @var NewsCommentService
     */
    private $newsCommentService;

    public function __construct(NewsCommentService $newsCommentService)
    {
        $this->newsCommentService = $newsCommentService;
    }

    public function index(News $news): JsonResponse
    {
        return new JsonResponse($this->newsCommentService->getList($news));
    }

    public function create(News $news, ?NewsComment $comment, NewsCommentRequest $request): JsonResponse
    {
        return new JsonResponse(
            $this->newsCommentService->create($news, $comment, $request->user(), $request->all()),
            Response::HTTP_CREATED
        );
    }
}
