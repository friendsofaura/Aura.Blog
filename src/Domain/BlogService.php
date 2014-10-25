<?php
namespace Aura\Blog\Domain;

use FOA\DomainPayload\PayloadFactory;
use Aura\Blog\Input\BlogForm;
use Exception;

class BlogService
{
    protected $gateway;
    protected $payload_factory;
    protected $factory;
    protected $form;

    public function __construct(
        BlogGateway $gateway,
        BlogFactory $factory,
        BlogForm $form,
        PayloadFactory $payload_factory
    ) {
        $this->gateway = $gateway;
        $this->factory = $factory;
        $this->payload_factory = $payload_factory;
        $this->form = $form;
    }

    public function fetchPage($page = 1, $paging = 10)
    {
        try {
            $rows = $this->gateway->fetchAllByPage($page, $paging);
            if ($rows) {
                $collection = $this->factory->newCollection($rows);

                return $this->payload_factory->found(array(
                    'collection' => $collection,
                    'total' => $this->gateway->getTotal(),
                    'page' => $page
                ));
            } else {
                return $this->payload_factory->notFound(array());
            }
        } catch (Exception $e) {
            return $this->payload_factory->error(array(
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
                return $this->payload_factory->found(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            }
            return $this->payload_factory->notFound(array(
                'id' => $id,
                'search' => 'Try searching'
            ));
        } catch (Exception $e) {
            return $this->payload_factory->error(array(
                'exception' => $e,
                'id' => $id,
            ));
        }
    }

    public function newPost(array $data)
    {
        return $this->payload_factory->newEntity(array(
            'blog' => $this->factory->newEntity($data),
            'blog_form' => $this->form
        ));
    }

    public function create(array $data)
    {
        try {
            $this->form->fill($data);
            if (! $this->form->filter()) {
                return $this->payload_factory->notValid(
                    array(
                        'blog' => $this->factory->newEntity($data),
                        'blog_form' => $this->form,
                    )
                );
            }
            $row = $this->gateway->create($data);
            if ($row) {
                $blog = $this->factory->newEntity($row);
                return $this->payload_factory->created(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            } else {
                return $this->payload_factory->notCreated(array(
                    'blog' => $data,
                    'blog_form' => $this->form,
                ));
            }
        } catch (Exception $e) {
            throw $e;
            return $this->payload_factory->error(array(
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
                return $this->payload_factory->notFound(array(
                    'id' => $id
                ));
            }
            $blog = $this->factory->newEntity($row);
            $this->form->fill($data);
            if (! $this->form->filter()) {
                return $this->payload_factory->notValid(
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
                return $this->payload_factory->updated(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            } else {
                return $this->payload_factory->notUpdated(array(
                    'blog' => $blog,
                    'blog_form' => $this->form,
                ));
            }

        } catch (Exception $e) {
            return $this->payload_factory->error(array(
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
                return $this->payload_factory->notFound(array(
                    'id' => $id
                ));
            }
            $blog = $this->factory->newEntity($row);

            $deleted = $this->gateway->delete($blog);
            if ($deleted) {
                return $this->payload_factory->deleted(array(
                    'blog' => $blog,
                ));
            } else {
                return $this->payload_factory->notDeleted(array(
                    'blog' => $blog,
                ));
            }
        } catch (Exception $e) {
            throw $e;
            return $this->payload_factory->error(array(
                'exception' => $e,
                'blog' => $blog,
            ));
        }
    }
}
