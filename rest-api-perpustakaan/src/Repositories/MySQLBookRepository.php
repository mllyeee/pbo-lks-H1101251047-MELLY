<?php

namespace App\Repositories;

use App\Contracts\BookRepositoryInterface;
use App\Models\Book;
use PDO;

class MySQLBookRepository implements BookRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM books");
        $books = [];

        while ($row = $stmt->fetch()) {
            $books[] = new Book(
                (int) $row['id'],
                $row['judul'],
                $row['penulis'],
                (int) $row['tahun'],
                (int) $row['stok']
            );
        }

        return $books;
    }

    public function findById(int $id): ?Book
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM books WHERE id = ?"
        );
        $stmt->execute([$id]);

        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Book(
            (int) $row['id'],
            $row['judul'],
            $row['penulis'],
            (int) $row['tahun'],
            (int) $row['stok']
        );
    }

    public function create(array $data): Book
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO books (judul, penulis, tahun, stok)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([
            $data['judul'],
            $data['penulis'],
            $data['tahun'],
            $data['stok']
        ]);

        return $this->findById(
            (int) $this->pdo->lastInsertId()
        );
    }

    public function update(int $id, array $data): ?Book
    {
        $stmt = $this->pdo->prepare(
            "UPDATE books
             SET judul = ?, penulis = ?, tahun = ?, stok = ?
             WHERE id = ?"
        );

        $stmt->execute([
            $data['judul'],
            $data['penulis'],
            $data['tahun'],
            $data['stok'],
            $id
        ]);

        return $this->findById($id);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM books WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}