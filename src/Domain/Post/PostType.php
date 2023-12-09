<?php

namespace App\Domain\Post;

class PostType implements \JsonSerializable
{
    private string $post_type_id;
    private string $post_type_label;

    /**
     * @param string $post_type_id
     * @param string $post_type_label
     */
    public function __construct(string $post_type_id, string $post_type_label)
    {
        $this->post_type_id = $post_type_id;
        $this->post_type_label = $post_type_label;
    }

    public function getPostId(): string
    {
        return $this->post_type_id;
    }

    public function setPostId(string $post_type_id): void
    {
        $this->post_type_id = $post_type_id;
    }

    public function getPostLabel(): string
    {
        return $this->post_type_label;
    }

    public function setPostLabel(string $post_type_label): void
    {
        $this->post_type_label = $post_type_label;
    }

    public function jsonSerialize(): array
    {
        return [
            'POST_TYPE_ID'      => $this->post_type_id,
            'POST_TYPE_LABEL'   => $this->post_type_label,
        ];
    }
}