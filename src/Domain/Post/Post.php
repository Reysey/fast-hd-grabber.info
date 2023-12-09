<?php

declare(strict_types=1);

namespace App\Domain\Post;

use JsonSerializable;

class Post implements JsonSerializable
{
    private ?int $post_id;

    private string $post_title;
    private string $post_description;
    private int $post_type;
    private string $post_tags;
    private string $post_thumbnail_url;
    private string $post_link;
    // private string $post_;

    /**
     * @param string $post_title
     * @param string $post_description
     * @param int $post_type
     * @param string $post_tags
     * @param string $post_thumbnail_url
     * @param string $post_link
     */
    public function __construct(?int $post_id ,string $post_title, string $post_description, int $post_type, string $post_tags, string $post_thumbnail_url, string $post_link)
    {
        $this->post_id = $post_id;
        $this->post_title = $post_title;
        $this->post_description = $post_description;
        $this->post_type = $post_type;
        $this->post_tags = $post_tags;
        $this->post_thumbnail_url = $post_thumbnail_url;
        $this->post_link = $post_link;
    }
    public function getPostId(): ?int
    {
        return $this->post_id;
    }
    public function getPostTitle(): string
    {
        return $this->post_title;
    }
    public function setPostTitle(string $post_title): void
    {
        $this->post_title = $post_title;
    }
    public function getPostDescription(): string
    {
        return $this->post_description;
    }
    public function setPostDescription(string $post_description): void
    {
        $this->post_description = $post_description;
    }
    public function getPostType(): int
    {
        return $this->post_type;
    }
    public function setPostType(int $post_type): void
    {
        $this->post_type = $post_type;
    }
    public function getPostTags(): string
    {
        return $this->post_tags;
    }
    public function setPostTags(string $post_tags): void
    {
        $this->post_tags = $post_tags;
    }
    public function getPostThumbnailUrl(): string
    {
        return $this->post_thumbnail_url;
    }
    public function setPostThumbnailUrl(string $post_thumbnail_url): void
    {
        $this->post_thumbnail_url = $post_thumbnail_url;
    }
    public function getPostLink(): string
    {
        return $this->post_link;
    }
    public function setPostLink(string $post_link): void
    {
        $this->post_link = $post_link;
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'POST_ID'               => $this->post_id,
            'POST_TYPE_ID'          => $this->post_type,
            'POST_TITLE'            => $this->post_title,
            'POST_DESCRIPTION'      => $this->post_description,
            'POST_THUMBNAIL_URL'    => $this->post_thumbnail_url,
            'POST_WEB_URL'          => $this->post_link,
        ];
    }
}
