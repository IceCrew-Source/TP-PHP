<?php

class TaskRepository
{
    const TABLE = "tasks";

    public function Initialize()
    {
        return Database::getInstance()
            ->exec(<<<SQL
                create table $table 
                (
                    id INTEGER
                        constraint tasks_pk
                            primary key autoincrement,
                    name TEXT,
                    checked INTEGER default 0
                );
            SQL);
    }

    public function getAll()
    {
        return Database::getInstance()
            ->prepare("SELECT * FROM ".self::TABLE)
            ->fetchAll();
    }

    public function update($id, $checked = false)
    {
        return Database::getInstance()
            ->prepare('UPDATE FROM ' . self::TABLE . " SET checked = :checked WHERE id = :id")
            ->execute([
                'checked' => $checked,
                'id' => $id
            ]);
    }

    public function add($id, $name, $checked = false)
    {
        return Database::getInstance()
            ->prepare('INSERT INTO ' . self::TABLE . "(id, name, checked) VALUES (1, 'Task to be done', 0)")
            ->execute([
                'checked' => $checked,
                'id' => $id,
                'name' => $name
            ]);
    }

    public function delete($id)
    {
        return Database::getInstance()
            ->prepare('DELETE FROM ' . self::TABLE . " WHERE id = :id")
            ->execute([
                'id' => $id
            ]);
    }
}