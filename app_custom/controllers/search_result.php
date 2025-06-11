<?php
use DataSource\TourDataSource,
	DataSource\SliderSearchDataSource,
	DataSource\DestinationDataSource,
	DataSource\CategoryDataSource,
	Domain\DestinationDomain,
	Domain\CategoryDomain;

class Search_result extends RootController
{
	private $tourDataSource;
	private $destinationDataSource;
	private $categoryDataSource;
	private $sliderSearchDataSource;

	protected function initialize()
	{
		$this->tourDataSource = new TourDataSource($this->mysqli);
		$this->destinationDataSource = new DestinationDataSource($this->mysqli);
		$this->categoryDataSource = new CategoryDataSource($this->mysqli);
		$this->sliderSearchDataSource = new SliderSearchDataSource($this->mysqli);
	}

	public function index()
	{
		$data['dataSearch'] = array(
							'category' => $this->request->getGet('category'),
							'destination' => $this->request->getGet('destination'),
							'pax' => $this->request->getGet('pax'),
							'tour_date' => $this->request->getGet('tour_date')
		);

		$data['destinationDomain'] = 'all';
		$data['categoryDomain'] = 'all';

		if ($data['dataSearch']['destination'] != 'all') {
			$destinationDomain = $this->destinationDataSource->getDestinationDomainByName($data['dataSearch']['destination']);

			if (!($destinationDomain instanceof DestinationDomain)) {
				$sessionMessage['type'] = 'warning';
				$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
				$this->session->set('sessionMessage', $sessionMessage);
				$this->redirect('','',FALSE);
				return;
			}

			$data['destinationDomain'] = $destinationDomain;
		}



		if ($data['dataSearch']['category'] != 'all') {
			$categoryDomain = $this->categoryDataSource->getCategoryDomainByName($data['dataSearch']['category']);
			if (!($categoryDomain instanceof CategoryDomain)) {
				$sessionMessage['type'] = 'warning';
				$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
				$this->session->set('sessionMessage', $sessionMessage);
				$this->redirect('','',FALSE);
				return;
			}
			$data['categoryDomain'] = $categoryDomain;
		}


		$this->renderSearchResult($data);
	}

	private function renderSearchResult($data)
	{
		$data['dataSearch'] = array(
						'category' => $this->request->getGet('category'),
						'destination' => $this->request->getGet('destination'),
						'pax' => $this->request->getGet('pax'),
						'tour_date' => $this->request->getGet('tour_date')
	);


		$this->htmlHeaderFooter->addJsCustomCode('
			$(".depart-date").datepicker({
				dateFormat: "dd-mm-yy",
                minDate: 0,
				maxDate: "16-07-2019",
                monthNames: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                dayNamesMin: ["Mi", "Se", "Se", "Ra", "Ka", "Ju", "Sa"],
                showButtonPanel: true,
                currentText: "Hari ini",
                closeText: "Tutup",
				beforeShow: function() {
					if (screen.width < 561) {
						$(this).datepicker("option","numberOfMonths",1);
					} else {
						$(this).datepicker("option","numberOfMonths",2);
					};
				},
            });
		');

		$this->htmlHeaderFooter->addCssAsset(array(
			
		));



		$this->htmlHeaderFooter->addJsAsset(array(
			'lib/datepicker/jquery-ui.min.js' => FALSE,
		));

		$this->htmlHeaderFooter->setDescription();
		$this->htmlHeaderFooter->setKeywords();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		$this->maxDataPerPage = 9;

		$currentPage = $this->request->getGet('p', 1 , 'page');
		$limit = ($currentPage - 1) * $this->maxDataPerPage;


		$destinationDomain = $data['destinationDomain'];
		$categoryDomain = $data['categoryDomain'];
		$idDestination = '';
		if ($destinationDomain != 'all') {
			$idDestination = $destinationDomain->getId();
		}

		$idCategory = '';
		if($categoryDomain != 'all'){
			$idCategory = $categoryDomain->getId();
		}
		$tourDomainArray = $this->tourDataSource->getAllTourDomainForHomeSearchByLimit($limit, $this->maxDataPerPage, $idDestination, $idCategory);


		$path = array('search-result');
		$sumData = $tourDomainArray['jumlahData'];

		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		//----data
		$sliderSearchDomainArray = $this->sliderSearchDataSource->getAllSliderSearchForHome();
		$destinationDomainArray = $this->destinationDataSource->getAllDestinationDomainForHome();
		$categoryDomainArray = $this->categoryDataSource->getAllCategoryDomainForHome();
		$random = rand(0,count($sliderSearchDomainArray)-1);
		//end of data

		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), ''),
		    array('Domestik', '', '')
		);

		$this->overideViewVariable(array(
				'tourDomainArray' => $tourDomainArray['tourDomainArray'],
				'destinationDomainArray' => $destinationDomainArray,
				'categoryDomainArray' => $categoryDomainArray,
				'sliderSearchDomain' => $sliderSearchDomainArray[$random],
				'jumlahData' => $tourDomainArray['jumlahData'],
				'pagination' => $pagination,
				'dataSearch' => $data['dataSearch']
		)
		);

		$this->load->view('search_result', $this->viewVariable);
	}
}