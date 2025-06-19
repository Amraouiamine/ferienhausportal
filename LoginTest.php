<?php
use PHPUnit\Framework\TestCase;

class PlainLoginTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("
            CREATE TABLE users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT,
                password TEXT
            );
        ");
    }

    public function testLoginSuccessWithPlainPassword()
    {
        $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)")
            ->execute(['max', 'geheim']);

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute(['max']);
        $user = $stmt->fetch();

        $this->assertTrue($user && 'geheim' === $user['password']);
    }

    public function testLoginFailsWithWrongPassword()
    {
        $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)")
            ->execute(['anna', 'richtigePass']);

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute(['anna']);
        $user = $stmt->fetch();

        $this->assertFalse('falsch' === $user['password']);
    }

    public function testLoginFailsWithUnknownUser()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute(['unbekannt']);
        $user = $stmt->fetch();

        $this->assertFalse($user); 
    }
}
