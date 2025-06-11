<?php

namespace Presentation;

use Utilities\UrlBuilder;

class Pagination extends RootPresentation
{
    private $space;

	private $maxPage;

	private $itemPerPage;

	private $currentPage;

	private $sumData;

	private $path;

	private $queryData;

	private $renderPage;

    /**
     * @var
     */
    private $paramGet;

	public function __construct(
		$itemPerPage,
		$sumData,
		$currentPage,
		array $path = array(),
		array $queryData = array(),
		UrlBuilder $urlBuilder,
	    $paramGet,
	    $space
	)
	{
		$this->itemPerPage = $itemPerPage;
		if($this->itemPerPage < 1)
		{
			$this->itemPerPage = 1;
		}
		$this->sumData = $sumData;
		if($this->sumData < 1)
		{
			$this->sumData = 1;
		}
		$this->currentPage = $currentPage;
		if($this->currentPage < 1)
		{
			$this->currentPage = 1;
		}

	    $this->maxPage = ceil($this->sumData / $this->itemPerPage);

		if($this->currentPage > $this->maxPage)
		{
			$this->currentPage = $this->maxPage;
		}
		$this->path = $path;
		$this->queryData = $queryData;
		$this->urlBuilder = $urlBuilder;
	    $this->space = $space;
	    $this->paramGet = $paramGet;
	}

	private function editQueryData($page)
	{
		$url = '';
		$queryData = $this->queryData;
	    $queryData[$this->getParamGet()] = $page;
	    $url = $this->urlBuilder->build($this->path, $queryData);

		return $url;
	}

    public function renderAdminPage()
    {
        if ($this->maxPage == 1)
        {
            return;
        }

        $space = $this->space;
        $this->renderPage .= '<ul class="pagination pull-right">';
        $start = ($this->currentPage - $space);
        $end = ($this->currentPage + $space);

        if($this->currentPage > ($space + 1))
        {
            $url = $this->editQueryData('1');
            $this->renderPage .= '<li><a href="'.urldecode($url).'">&lt;</a></li>';
        	//$this->renderPage .= '<li class="prev"><a href="'.urldecode($url).'"><i class="icon-double-angle-left"></i></a></li>';
        }

        if($start < 1)
        {
            $start = 1;
        }

        if($end > $this->maxPage)
        {
            $end = $this->maxPage;
        }
        for($i = $start ; $i < $this->currentPage; $i++)
        {
            $url = urldecode($this->editQueryData(''.$i));
            $this->renderPage .= '<li><a href="'.urldecode($url).'">'.$i.'</a><li>';
        }
        $this->renderPage .= '<li class="active"><a>'.$i.'</a></li>';
        for($i = ($this->currentPage+1) ; $i <= $end ; $i++ )
        {
            $url = $this->editQueryData(''.$i);
            $this->renderPage .= '<li><a href="'.urldecode($url).'">'.$i.'</a></li>';
        }

        if($this->currentPage < ($this->maxPage - $space) )
        {
            $url = $this->editQueryData(''.$this->maxPage);
            $this->renderPage .= '<li><a href="'.urldecode($url).'">&gt;</a></li>';
        	//$this->renderPage .= '<li class="next"><a href="'.urldecode($url).'"><i class="icon-double-angle-right"></i></a></li>';
        }

        $this->renderPage .= '</ul>';
        return $this->renderPage;
    }

	public function renderPage()
	{
	    if ($this->maxPage == 1)
	    {
	        return;
	    }


	    $space = $this->space;
		$this->renderPage .= '<div class="row">
								<div class="col-md-12">
									<div class="pagination-content">
										<div class="pagination-button">
											<ul class="pagination">';
	    $start = ($this->currentPage - $space);
	    $end = ($this->currentPage + $space);

		if($this->currentPage > ($space + 1))
		{
			$url = $this->editQueryData('1');
		    $url = $this->editQueryData(''.($this->currentPage-1));
		    $this->renderPage .= '<li><a  href="'.urldecode($url).'"><i class="fa fa-angle-left"></i></a></li>';
		}

		if($start < 1)
		{
			$start = 1;
		}

		if($end > $this->maxPage)
		{
			$end = $this->maxPage;
		}
		for($i = $start ; $i < $this->currentPage; $i++)
		{
			$url = urldecode($this->editQueryData(''.$i));
			$this->renderPage .= '<li><a href="'.urldecode($url).'">'.$i.'</a></li>';
		}
	    $this->renderPage .= '<li class="current"><a href="#">'.$i.'</a></li>';
		for($i = ($this->currentPage+1) ; $i <= $end ; $i++ )
		{
			$url = $this->editQueryData(''.$i);
			$this->renderPage .= '<li><a href="'.urldecode($url).'">'.$i.'</a></li>';
		}

		if($this->currentPage < ($this->maxPage - $space) )
		{
			$url = $this->editQueryData(''.($this->currentPage+1));
			$this->renderPage .= '<li><a href="'.urldecode($url).'"><i class="fa fa-angle-right"></i></a></li>';
		}

		$this->renderPage .= '</ul>
                            </div>
                        </div>
                    </div>
                </div>';
		return $this->renderPage;
	}

	public function setSumData($sumData)
	{
		$this->sumData = $sumData;
		$this->setMaxPage((int)ceil($sumData/$this->itemPerPage));
	}

	public function getSumData()
	{
		return $this->sumData;
	}

	public function setQueryData($queryData)
	{
		$this->queryData = $queryData;
	}

	public function getQueryData()
	{
		return $this->queryData;
	}

	public function setCurrentPage($currentPage)
	{
		$this->currentPage = $currentPage;
	}

	public function getCurrentPage()
	{
		return $this->currentPage;
	}

	public function setItemPerPAge($itemPerPage)
	{
		$this->itemPerPage = $itemPerPage;
	}

	public function getItemPerPage()
	{
		return $this->itemPerPage;
	}

	private function setMaxPage($maxPage)
	{
		$this->maxPage = $maxPage;
	}

	public function getMaxPage()
	{
		return $this->maxPage;
	}

    private function getParamGet()
    {
        return $this->paramGet;
    }
}
?>