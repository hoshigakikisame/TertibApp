<?php 

class PaginationUtil {
    
    public static function paginationHandler()
	{
		$page = 1;

		if (isset($_GET['page']) && $_GET['page'] != '') {
			$page = $_GET['page'];
		}

		return $page;
	}

	public static function getPrevPage(int $page): int|null
	{
		if ($page == 1) {
			return null;
		}

		return $page - 1;
	}

	public static function getNextPage(array $data, int $page): int|null
	{
		/**
		 * @var array $config
		 */
		$config = App::get('config');
		$paginationLimit = $config['database']['pagination_limit'];
		if (count($data) < $paginationLimit) {
			return null;
		}

		return $page + 1;
	}

    public static function getPageCount(int $count): int
    {
        /**
         * @var array $config
         */
        $config = App::get('config');
        $paginationLimit = $config['database']['pagination_limit'];
        $pageCount = ceil($count / $paginationLimit);
        return $pageCount;
    }
}