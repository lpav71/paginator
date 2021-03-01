<?php

class Paginator
{
    public $qtyrec; //Количество записей
    public $table;  //Имя таблицы
    public $out;    //Выходной поток
    public $file;   //Текущее имя исполняемого файла. Нужно писать так - $paginator->file = basename(__FILE__);

    private $str_pag;

    public function prepare($pdo)
    {
        // Пагинация

        // Текущая страница
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else $page = 1;

        $this->qtyrec = 3;  //количество записей для вывода
        $art = ($page * $this->qtyrec) - $this->qtyrec;

        // Определяем все количество записей в таблице
        $query = "SELECT COUNT(*) FROM ". $this->table;
        $res = $pdo->query($query);
        $array = $res->fetch(PDO::FETCH_ASSOC);
        $total = $array['COUNT(*)']; // всего записей

        // Количество страниц для пагинации
        $this->str_pag = ceil($total / $this->qtyrec);


        // Запрос и вывод записей
        $query = 'SELECT * FROM '. $this->table . ' LIMIT '  . $art . ',' . $this->qtyrec;
        $stmt = $pdo->query($query);
        $this->out = $stmt->fetchAll();
    }

    public function viewPaginator()
    {
        $file = $this->file;
        for ($i = 1; $i <= $this->str_pag; $i++) {
            echo "<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">";
            echo "<a href=$file?page=".$i." class='btn btn-outline-primary'>".$i."</a>";
            echo "</div";
        }
    }
}