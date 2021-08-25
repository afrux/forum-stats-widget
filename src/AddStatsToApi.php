<?php

/*
 * This file is part of afrux/forum-stats-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\ForumStats;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Post\CommentPost;
use Flarum\User\User;
use Illuminate\Contracts\Cache\Factory;
use Symfony\Contracts\Translation\TranslatorInterface;
use function Afrux\ForumWidgets\Helper\pretty_number_format;

class AddStatsToApi
{
    /**
     * @var Factory
     */
    private $cache;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(Factory $cache, TranslatorInterface $translator)
    {
        $this->cache = $cache;
        $this->translator = $translator;
    }

    public function __invoke(ForumSerializer $serializer)
    {
        $interval = 600;

        $stats = $this->cache->remember('afrux-forum-stats-widget.stats', $interval, function (): array {
            return [
                'discussion_count' => Discussion::count(),
                'user_count' => User::count(),
                'comment_post_count' => CommentPost::count(),
            ];
        });

        return [
            'afrux-forum-stats-widget.stats' => [
                'discussionCount' => [
                    'label' => $this->translator->trans('afrux-forum-stats-widget.forum.widget.stats.discussion_count'),
                    'icon' => 'far fa-comments',
                    'value' => $stats['discussion_count'],
                    'prettyValue' => pretty_number_format($stats['discussion_count']),
                ],
                'userCount' => [
                    'label' => $this->translator->trans('afrux-forum-stats-widget.forum.widget.stats.user_count'),
                    'icon' => 'fas fa-users',
                    'value' => $stats['user_count'],
                    'prettyValue' => pretty_number_format($stats['user_count']),
                ],
                'commentPostCount' => [
                    'label' => $this->translator->trans('afrux-forum-stats-widget.forum.widget.stats.comment_post_count'),
                    'icon' => 'far fa-comment-dots',
                    'value' => $stats['comment_post_count'],
                    'prettyValue' => pretty_number_format($stats['comment_post_count']),
                ],
            ],
        ];
    }
}
