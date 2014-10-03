<?php
namespace Aura\Blog\Domain;

use Aura\Blog\Domain\Result\ResultFactory;
use Aura\Blog\Input\BlogForm;
use Exception;

class BlogService
{
    protected $gateway;
    protected $result;
    protected $factory;
    protected $form;

    public function __construct(
        BlogGateway $gateway,
        BlogFactory $factory,
        BlogForm $form,
        ResultFactory $result
    ) {
        $this->gateway = $gateway;
        $this->factory = $factory;
        $this->result = $result;
        $this->form = $form;
    }

    public function fetchPage($page = 1, $paging = 10)
    {
        try {
            $rows = $this->gateway->fetchAllByPage($page, $paging);
            if ($rows) {
                $collection = $this->factory->newCollection($rows);

                return $this->result->found(array(
                    'collection' => $collection,
                    'total' => $this->gateway->getTotal(),
                    'page' => $page
                ));
            } else {
                return $this->result->notFound(array());
            }
        } catch (Exception $e) {
            return $this->result->error(array(
                'exception' => $e,
                'page' => $page,
                'paging' => $paging,
            ));
        }
    }

    public function fetchPost($id)
    {
        try {
            $row = $this->gateway->fetchOneById($id);
            if ($row) {
                $blog = $this->factory->newEntity($row);
                $this->form->fill((array) $blog);
                return $this->result->found(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            }
            return $this->result->notFound(array(
                'id' => $id,
                'search' => 'Try searching'
            ));
        } catch (Exception $e) {
            return $this->result->error(array(
                'exception' => $e,
                'id' => $id,
            ));
        }
    }

    public function newPost(array $data)
    {
        return $this->result->newEntity(array(
            'blog' => $this->factory->newEntity($data),
            'blog_form' => $this->form
        ));
    }

    public function create(array $data)
    {
        try {
            $this->form->fill($data);
            if (! $this->form->filter()) {
                return $this->result->notValid(
                    array(
                        'blog' => $this->factory->newEntity($data),
                        'blog_form' => $this->form,
                    )
                );
            }
            $row = $this->gateway->create($data);
            if ($row) {
                $blog = $this->factory->newEntity($row);
                return $this->result->created(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            } else {
                return $this->result->notCreated(array(
                    'blog' => $data,
                    'blog_form' => $this->form,
                ));
            }
        } catch (Exception $e) {
            throw $e;
            return $this->result->error(array(
                'exception' => $e,
                'data' => $data,
            ));
        }
    }

    public function update($id, array $data)
    {
        try {
            $row = $this->gateway->fetchOneById($id);
            if (! $row) {
                return $this->result->notFound(array(
                    'id' => $id
                ));
            }
            $blog = $this->factory->newEntity($row);
            $this->form->fill($data);
            if (! $this->form->filter()) {
                return $this->result->notValid(
                    array(
                        'blog' => $blog,
                        'blog_form' => $this->form,
                    )
                );
            }

            unset($data['id']);
            $blog->setData($data);
            $updated = $this->gateway->update($blog);

            if ($updated) {
                return $this->result->updated(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            } else {
                return $this->result->notUpdated(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            }

        } catch (Exception $e) {
            return $this->result->error(array(
                'exception' => $e,
                'id' => $id,
                'data' => $data,
            ));
        }
    }

    public function delete($id)
    {
        try {
            $row = $this->gateway->fetchOneById($id);
            if (! $row) {
                return $this->result->notFound(array(
                    'id' => $id
                ));
            }
            $blog = $this->factory->newEntity($row);

            $deleted = $this->gateway->delete($blog);
            if ($deleted) {
                return $this->result->deleted(array(
                    'blog' => $blog,
                ));
            } else {
                return $this->result->notDeleted(array(
                    'blog' => $blog,
                ));
            }
        } catch (Exception $e) {
            throw $e;
            return $this->result->error(array(
                'exception' => $e,
                'blog' => $blog,
            ));
        }
    }
}
