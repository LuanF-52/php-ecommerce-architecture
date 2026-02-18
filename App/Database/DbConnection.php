<?php class DbConnection
{
    public function create(): PDO
    {
        return new PDO(
            'mysql:host=localhost;dbname=meu_banco;charset=utf8mb4',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
}
