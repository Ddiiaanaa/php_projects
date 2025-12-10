<?php
declare(strict_types=1);

class WorldCityRepository {

    public function __construct(private PDO $pdo) {}

    private function arrayToModel(array $entry): WorldCityModel {
        return new WorldCityModel(
            $entry['id'],
            $entry['city'],
            $entry['country'],
            $entry['iso2'],
            $entry['capital'],
            $entry['population']
        );
    }

    public function fetchById(int $id): ?WorldCityModel {
        $stmt = $this->pdo->prepare('SELECT * FROM `cities` WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($entry)) {
            return $this->arrayToModel($entry);
        }
        else {
            return null;
        }
    }

    public function fetch(): array {
        $stmt = $this->pdo->prepare('SELECT * 
            FROM `cities` 
            ORDER BY `population`
            DESC LIMIT 10');

        $stmt->execute();

        $models = [];
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($entries AS $entry) {
            $models[] = $this->arrayToModel($entry);
        }

        return $models;
    }

    public function paginate(int $page, int $perPage = 15): array {
        $page = max(1, $page);

        $stmt = $this->pdo->prepare('SELECT * 
            FROM `cities` 
            ORDER BY `population` DESC
            LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
        $stmt->execute();

        $models = [];
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($entries AS $entry) {
            $models[] = $this->arrayToModel($entry);
        }

        return $models;
    }

    public function count(): int {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) AS `count` FROM `cities`');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function update(int $id, array $properties): WorldCityModel {
        $stmt = $this->pdo->prepare('UPDATE `cities` 
            SET 
                `city` = :city,
                `city_ascii` = :cityAscii,
                `country` = :country,
                `iso2` = :iso2, 
                `population` = :population
            WHERE `id` = :id');

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':city', $properties['city']);
        $stmt->bindValue(':cityAscii', $properties['cityAscii']);
        $stmt->bindValue(':country', $properties['country']);
        $stmt->bindValue(':iso2', $properties['iso2']);
        $stmt->bindValue(':population', $properties['population']);
        $stmt->execute();

        return $this->fetchById($id);
    }
}