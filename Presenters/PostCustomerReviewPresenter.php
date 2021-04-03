<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Components\IPostControlFactory;
use App\AdminModule\Components\IPostsGridFactory;
use App\AdminModule\Components\PostControl;
use App\AdminModule\Components\PostsGridFactory;
use App\AdminModule\Components\TabControl;
use App\Model\Entity\Post;
use App\Model\Entity\PostCustomerReview;
use App\Model\Entity\PostData;
use App\Model\Repository\PostRepository;

use Doctrine\Common\Collections\Collection;

class PostCustomerReviewPresenter extends BasePresenter
{

    /** @var Post */
    private $post;

    /** @var Collection */
    private $posts;

    /** @var PostRepository */
    private $postRepository;

    /** @var IPostControlFactory @inject */
    public $postControlFactory;

    /** @var IPostsGridFactory @inject */
    public $postsGridFactory;

    public function beforeRender()
    {
        parent::beforeRender();
        $this->addNavigation('Klientské recenze');
    }

    public function createComponentTabControl()
    {
        $tabControl = new TabControl;
        //$tabControl->add('list', 'Přehled', $this->link('list'));
        //$tabControl->add('settings', 'Nastavení', $this->link('settings'));
        return $tabControl;
    }

    public function actionList()
    {
        $this->postRepository = $this->presenter->getEM()->getRepository(Post::class);

        $this->posts = $this->postRepository->findBy(['type' => PostCustomerReview::POST_TYPE]);
    }

    public function renderList()
    {
        $this->template->posts = $this->posts;
    }

    /**
     * @param int $id
     */
    public function actionForm($id)
    {
        /** @var PostRepository */
        $this->postRepository = $this->presenter->getEM()->getRepository(Post::class);

        if ($id) {
            $this->post = $this->postRepository->find($id);
        }

        if ($id && !$this->post) {
            $this->flashMessage(__('Recenze nenalezena.'));
            $this->redirect(':PostCustomerReview:list');
        }
    }

    public function renderForm()
    {
        $this->template->post = $this->post;
    }

    /**
     * @return PostControl
     */
    public function createComponentPostForm(): PostControl
    {
        return $this->postControlFactory->create(PostCustomerReview::POST_TYPE, $this->post, null, $this->presenter->getEM()->getRepository(PostData::class));
    }

    /**
     * @return PostsGridFactory
     */
    public function createComponentListGrid(): PostsGridFactory
    {
        return $this->postsGridFactory->create(PostCustomerReview::POST_TYPE);
    }
}
