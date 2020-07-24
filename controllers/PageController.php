<?php


class PageController

{
    public $page;
    public $countPageTotal;
    public $pageName;

    public function pagination()
    {
        $pagination = '<nav aria-label="Page navigation">';
        if ($this->countPageTotal > 1) {
            switch (true) {
                case $this->countPageTotal <= 1 && $this->page >= $this->countPageTotal:
                    $prev = 1;
                    $next = $this->countPageTotal;
                    break;
                default:
                    $prev = $this->page - 1;
                    $next = $this->page + 1;
                    break;
            }

            if ($this->page == 1) {
                $pagination .= "<ul class='pagination justify-content-end'><li class='page-item active'><a class='page-link'  href=\"/$this->pageName/1\">1</a></li>";
            } else {
                $pagination .= "<ul class='pagination  justify-content-end'><li class='page-item'><a class='page-link' href='/$this->pageName/" . $prev . "'>Назад </a></li><li class='page-item'><a class='page-link ' href=\"/$this->pageName/1\">1</a></li>";
            }
            $i = max(2, $this->page - 1);
            $this->page < 4 ?: $pagination .= "<li class='page-item'> <span class='page-link'>...</span></li>";
            for ($i; $i < min($this->page + 2, $this->countPageTotal); $i++) {
                if ($i == $this->page) {
                    $pagination .= "<li class='page-item active'><a class='page-link'  href=\"/$this->pageName/{$i}\" >{$i}</a></li>";

                } else {
                    $pagination .= "<li class='page-item'><a class='page-link' href=\"/$this->pageName/{$i}\">{$i}</a></li>";
                }
            }
            $i > $this->countPageTotal - 1 ?: $pagination .= "<li class='page-item'> <span class='page-link'>...</span></li>";
            if ($this->countPageTotal == $this->page) {
                $pagination .= "<li class='page-item active'><a class='page-link'  href=\"/$this->pageName/$this->countPageTotal\">$this->countPageTotal</a></li></ul>";
            } else {
                $pagination .= "<li class='page-item'><a class='page-link' href=\"/$this->pageName/$this->countPageTotal\">$this->countPageTotal</a></li><li class='page-item'><a class='page-link' href='/$this->pageName/" . $next . "'> Вперед</a></li></ul>";
            }

        }
        return $pagination . '</nav>';
    }

}