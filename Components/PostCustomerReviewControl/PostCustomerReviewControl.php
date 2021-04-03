<?php

namespace App\FrontModule\Components;

use App\Model\Entity\PostCustomerReview;
use App\Model\Repository\PostRepository;
use Nette\Application\UI\Control;

interface IPostCustomerReviewControlFactory
{
    /**
     * @return PostCustomerReviewControl
     */
    function create(PostRepository $postRepository);
}

class PostCustomerReviewControl extends Control
{

    /** @var PostRepository */
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function render(): void
    {
        $this->template->items = $this->postRepository->findBy(['type' => PostCustomerReview::POST_TYPE, 'publish' => true], ['position' => 'asc']);
        $this->template->setTranslator($this->presenter->multilang->getTranslator());
        $this->template->render(__DIR__ . '/template.latte');
    }
}
