<?php
namespace Aura\Blog\Domain;

use Aura\Sql\ExtendedPdo;

class BlogGateway
{
    public function __construct(ExtendedPdo $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchOneById($id)
    {
        $row = $this->pdo->fetchOne(
            'SELECT * FROM blog WHERE id = :id',
            array('id' => (int) $id)
        );

        return $row;
    }

    public function fetchAllByPage($page = 1, $paging = 10)
    {
        $limit = (int) $paging;
        $offset = (int) (($page - 1) * $limit);
        $rows = $this->pdo->fetchAll(
            "SELECT * FROM blog ORDER BY id DESC LIMIT $limit OFFSET $offset"
        );
        return $rows;
    }

    public function create(array $data)
    {
        $affected = $this->pdo->perform(
            'INSERT INTO blog (
                author,
                title,
                intro,
                body
            ) VALUES (
                :author,
                :title,
                :intro,
                :body
            )',
            $data
        );

        if ($affected) {
            $id = $this->pdo->lastInsertId();
            return $this->fetchOneById($id);
        }
    }

    public function update(BlogEntity $entity)
    {
        $data = $entity->getData();
        $affected = $this->pdo->perform(
            'UPDATE blog
            SET
                author = :author,
                title = :title,
                intro = :intro,
                body = :body
            WHERE id = :id',
            $data
        );
        return (bool) $affected;
    }

    public function delete(BlogEntity $entity)
    {
        $affected = $this->pdo->perform(
            'DELETE FROM blog WHERE id = :id',
            array('id' => $entity->id)
        );
        return (bool) $affected;
    }

    public function getTotal()
    {
        $row = $this->pdo->fetchValue(
            'SELECT COUNT(*) as count FROM blog'
        );

        return $row;
    }
}
