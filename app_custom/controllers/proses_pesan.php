<?php
use	Domain\TourDomain,
	Domain\TransaksiDomain,
	Domain\TransaksiItemDomain,
	Domain\HighSeasonDomain,
	DataSource\SliderSearchDataSource,
	DataSource\DestinationDataSource,
	DataSource\CategoryDataSource,
	DataSource\TourDataSource,
	DataSource\HighSeasonDataSource,
	DataSource\TransaksiDataSource,
	DataSource\TransaksiItemDataSource,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors,
	Utilities\Mailer,
	Services\TemplateEmailService,
	Validation\BookValidation;

class Proses_pesan extends RootController
{
	private $sliderSearchDataSource;
	private $destinationDataSource;
	private $categoryDataSource;
	private $tourDataSource;

	protected function initialize()
	{
		$this->sliderSearchDataSource = new SliderSearchDataSource($this->mysqli);
		$this->destinationDataSource = new DestinationDataSource($this->mysqli);
		$this->categoryDataSource = new CategoryDataSource($this->mysqli);
		$this->tourDataSource = new TourDataSource($this->mysqli);
		$this->highSeasonDataSource = new HighSeasonDataSource($this->mysqli);
		$this->transaksiDataSource = new TransaksiDataSource($this->mysqli);
		$this->transaksiItemDataSource = new TransaksiItemDataSource($this->mysqli);
	}

	public function index()
	{

		$namaTour = $this->request->getGet('id');

		$valueGet = array();
		if (!empty($this->request->getGet('pax'))) {
			$pax = $this->request->getGet('pax');
			$pax = explode("-", $pax);

			if (count($pax) == 2) {
				$pax = $pax[1];
			}else{
				$pax = $pax[0];
			}
			$valueGet = array('pax'=>$pax);
		}

		$tanggal = $this->request->getGet('tour_date');
		$valueGet['tanggal'] = $tanggal;


		$namaTour = str_replace('-',' ', $namaTour);
		$namaTour = ucwords($namaTour);


		$tourDataSource = $this->tourDataSource->getTourDomainByName($namaTour);

		if (!($tourDataSource instanceof TourDomain)) {
			$sessionMessage['type'] = 'warning';
			$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('');
			return;
		}

		if ($this->request->getPost('process') == "Book") {
			$this->addProcess($tourDataSource, $valueGet);
			return;
		}

		$this->renderProses($tourDataSource, $valueGet);
	}

	private function addProcess(TourDomain $tourDataSource, $valueGet){

		$dataPost = array(
				"namaKontak" => $this->request->getPost('nama_kontak'),
				"ntaPerPax" => $this->request->getPost('nta_per_pax'),
				"totalNta" => $this->request->getPost('total_Nta'),
				"tipeSession" => $this->request->getPost('tipe_session'),
				"email" => $this->request->getPost('email'),
				"noHandphone" => $this->request->getPost('no_handphone'),
				"jmlTamu" => $this->request->getPost('jml-tamu'),
				"jmlTamuMore" => $this->request->getPost('jml_tamu_more'),
				"totalHarga" => $this->request->getPost('total_harga'),
				"pricePerPax" => $this->request->getPost('price_per_pax'),
				"tanggalTour" => $this->request->getPost('tanggal_tour'),
				"namaPeserta" => $this->request->getPost('nama_peserta'),
				"permintaanKhusus" => $this->request->getPost('permintaan_khusus'),
				"infoFrom" => $this->request->getPost('info_from'),
		);


		$tanggalTour = DateTime::createFromFormat('d-m-Y', $dataPost['tanggalTour']);


		$now = new DateTime();

		$bookValidation = new BookValidation($this->lang);

		if ($bookValidation->validateForBookData($dataPost) == FALSE)
		{

			$this->renderProses($tourDataSource, $valueGet,$bookValidation->getValidationErrors());
			return;

		}


		// BEGIN CASE //
		$namaTour = strtolower($tourDataSource->getTitle());
		$namaTour = str_replace(' ','-', $namaTour);

		if ($valueGet['pax']) {
			$case ='pax='.$valueGet['pax'];
		}else{
			$case ='tanggal='.$valueGet['tanggal'];
		}
		// END CASE //

		$transaksiDomain = new TransaksiDomain(
			NULL,
			$now,
			$now,
			NULL,
			NULL,
			NULL,
			NULL,
			'request',
			$dataPost['namaKontak'],
			$dataPost['email'],
			$dataPost['noHandphone'],
			NULL,
			NULL
		);


		$transaksiDomain = $this->transaksiDataSource->insert($transaksiDomain);
		if($transaksiDomain == FALSE)
		{
			$sessionMessage['type'] = 'error';
			$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('paket-tour/proses/book', "id=".$namaTour."&".$case);
			return;
		}

		$jmlPeserta = $dataPost['jmlTamu'];
		if ($dataPost['jmlTamu'] == 'more') {
			$jmlPeserta = $dataPost['jmlTamuMore'];
		}

		$arrayKontakDesc = array(
								'namaKontak'=> $dataPost['namaKontak'],
								'peserta'=> $dataPost['namaPeserta'],
								'pax' =>$jmlPeserta
							);

		$arrayPaketDesc = array('id_tour'=> $tourDataSource->getId(),
								'nama_tour'=> $tourDataSource->getTitle(),
								'duration_day'=> $tourDataSource->getDurationDay(),
								'status_tour'=> $tourDataSource->getStatusTour(),
								'tanggal_tour'=> $tanggalTour->format("d-m-Y"),
								);

		$arrayHargaDesc = array(
								'harga_per_pax' => $dataPost['pricePerPax'],
								'total_harga' => $dataPost['totalHarga'],
								'nta_per_pax' => $dataPost['ntaPerPax'],
								'total_Nta' => $dataPost['totalNta'],
								'tipe_sesion' => $dataPost['tipeSession'],
							   );

		$arrayKeterangan = array(
							'permintaan_khusus' => $dataPost['permintaanKhusus'],
							'info_dari' => $dataPost['infoFrom'],
							);




		$transaksiItemDomain = new TransaksiItemDomain(
			NULL,
			$transaksiDomain->getId(),
			json_encode($arrayKontakDesc),
			json_encode($arrayPaketDesc),
			new DateTime($dataPost['tanggalTour']),
			json_encode($arrayHargaDesc),
			$dataPost['totalHarga'],
			$dataPost['totalNta'],
			"1",
			json_encode($arrayKeterangan),
			"wisata"
		);

	//	echo "<pre>",var_dump($transaksiItemDomain),"</pre>";exit();

		$transaksiItemDomain = $this->transaksiItemDataSource->insert($transaksiItemDomain);
		if($transaksiItemDomain == FALSE)
		{
			$sessionMessage['type'] = 'error';
			$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('paket-tour/proses/book', "id=".$namaTour."&".$case);
			return;
		}

		$transaksiDomain->setTotalHarga($dataPost['totalHarga']);
 		$transaksiDomain->setTotalNta($dataPost['totalNta']);

		if($this->transaksiDataSource->update($transaksiDomain) == FALSE)
		{
			$sessionMessage['type'] = 'error';
			$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('paket-tour/proses/book', "id=".$namaTour."&".$case);
			return;
		}


		// send email
		$serviceTemplateEmail = new TemplateEmailService($this->asset, $this->urlBuilder);

		$dataReplace = array(
				'*|createdDate|*'=> $transaksiDomain->getCreatedDate()->format("d F Y H:i"),
				'*|kontakNama|*'=> $transaksiDomain->getKontakNama(),
				'*|tour|*'=> $tourDataSource->getTitle(),
				'*|tanggalTour|*'=> $tanggalTour->format("d F Y"),
				'*|pax|*'=> $jmlPeserta,
				'*|statusProsesTransaksi|*'=> strtoupper($transaksiDomain->getStatusProses()),
				'*|kontakPhone|*'=> $transaksiDomain->getKontakPhone(),
				'*|kontakEmail|*'=> $transaksiDomain->getKontakEmail()
		);

		$html = $serviceTemplateEmail->getConfirmForAdmin($dataReplace, $dataPost);

		$mailer = new Mailer();

		$mailer->SetFrom('noreply@sukaliburan.com', 'SukaLiburan.com - Tour & Trip Partner');
		$mailer->AddAddress("tour@grahatour.com", 'Bpk/Ibu Admin');
		$mailer->Subject = 'Request Tour - '.$transaksiDomain->getKontakNama()." (".$transaksiDomain->getKontakPhone().")";
		$mailer->AltBody = 'Jangan membalas email ini!';
		$mailer->MsgHTML($html);
		$mailer->Send();
		// end kirim email

		$arrayParam = array(
								"id_tour"=>$tourDataSource->getId(),
								"id_transaksi" => $transaksiDomain->getId()
							);

		$arrayParam = json_encode($arrayParam);


		$this->redirect('paket-tour/proses/result', "id=".$this->convert->encrypt($arrayParam),"FALSE");
	}

	private function renderProses(TourDomain $tourDataSource, $valueGet, ValidationErrors $validationErrors = NULL )
	{
		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}

		$highSesionDomainArray = $this->highSeasonDataSource->getHighSeasonDomainByIdDestination($tourDataSource->getIdDestination());


		$textOpentrip = "";
		$statusOpenTrip = "FALSE";
		if ($tourDataSource->getTanggalOpenTrip() != NULL) {
			$textOpentrip =',
				beforeShowDay: function (date) {
					 $arrayTglOpenTrip = '.$tourDataSource->getTanggalOpenTrip().';
					 var months = ["01","02","03","04","05","06","07","08","09","10","11","12"];
					 var m = date.getMonth();
					 var d = ("0" + date.getDate()).slice(-2);
					 var y = date.getFullYear();

					 var currentdate = d + "-" + months[m] + "-" + y ;
					 var currentdate = currentdate.toString() ;

					 if ($arrayTglOpenTrip.indexOf(currentdate) != -1){
					 	return [true];
					 }

					 return [false];
		        }';
			$statusOpenTrip = "TRUE";
		}

		$arrayDateHighSession = array();
		if ($highSesionDomainArray instanceof HighSeasonDomain) {
			$arrayDateHighSession = $highSesionDomainArray->getDateSpesific();
		}else{
			$arrayDateHighSession = json_encode($arrayDateHighSession);
		}



		$this->htmlHeaderFooter->addJsCustomCode('
			awal();


			function priceByPax($val, $value, $valueNta)
			{
				var a = $value,
					b = $val * a,
					c = $valueNta,
					d = $val * c,
					hargaPaket = a.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."),
			   		totalHargaPaket = b.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."),
			   		totalHargaNta = d.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

				$("#harga-paket").html(hargaPaket);
				$("input[name=price_per_pax]").val(a);
				$("input[name=total_harga]").val(b);
				$("input[name=nta_per_pax]").val(c);
				$("input[name=total_Nta]").val(d);
				$("#total-harga-paket").html(totalHargaPaket);
			};

			function awal()
			{
				$("input[name=tipe_session]").val("low_session");
				$statusOpenTrip = "'.$statusOpenTrip.'";
				$val = $("select[name=jml-tamu]").val();
				$tanggal = $("#input-tgl-tour").val();
				$arrayTglHighSes = '.$arrayDateHighSession.';
				$arrayDetailHarga = '.$tourDataSource->getHargaDetail().'
				$("#jml-pax").html($val);
				$.each($arrayDetailHarga, function(i, item) {
						if($val <= parseInt(item.max_pax) && $val >= parseInt(item.min_pax)){
							if($arrayTglHighSes.indexOf($tanggal) != -1){
								$value = item.harga_high_ses;
								$valueNta = item.harga_nta_high_ses;
								$("input[name=tipe_session]").val("high_session");
								alert("Harga mengalami kenaikan, dikarenakan tanggal yang anda pilih merupakan tanggal high session")
							}else{
								$value = item.harga_low_ses;
								$valueNta = item.harga_nta_low_ses;
							}

							priceByPax($val, $value, $valueNta);
							return false;
						}else if($statusOpenTrip == "TRUE"){

							if($arrayTglHighSes.indexOf($tanggal) != -1 && $tanggal == item.date_open_trip){
								$value = item.harga_high_ses;
								$valueNta = item.harga_nta_high_ses;
								$("input[name=tipe_session]").val("high_session");
								alert("Harga mengalami kenaikan, dikarenakan tanggal yang anda pilih merupakan tanggal high session");
								priceByPax($val, $value, $valueNta);
								return false;
							}else if($tanggal == item.date_open_trip){
								$value = item.harga_low_ses;
								$valueNta = item.harga_nta_low_ses;
								priceByPax($val, $value, $valueNta);
								return false;
							}


						}
						;
				  });
			};


			$("#input-tgl-tour").change(function(e) {
				awal();
			});


			$("select[name=jml-tamu]").change(function(e) {
				e.preventDefault();
				$val = $(this).val();
				if ($val == "more"){
					$("#more-jumlah").show();
					$("#jml-pax").html(0);
				}else{
					$("#more-jumlah").hide();
					awal();
			  	}
			});

			$("#input-more-jumlah").keyup(function(){
			    $val = $(this).val();
			    $arrayDetailHarga = '.$tourDataSource->getHargaDetail().'
				$("#jml-pax").html($val);
				$flag = 0;
				$value2 = 0
				$.each($arrayDetailHarga, function(i, item) {
						if($val <= parseInt(item.max_pax) && $val >= parseInt(item.min_pax)){
							$flag = 1;
							$value = item.harga_low_ses;
							priceByPax($val, $value);
						};
					$value2 = item.harga_low_ses;
				});
				if($flag == 0 ){
					priceByPax($val, $value2);
				}
			});

			$(".allow_only_numbers").keydown(function(e) {

					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||

					    ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.ctrlKey === true || e.metaKey === true)) ||

					    (e.keyCode >= 35 && e.keyCode <= 40)) {

					    	return;
					}

					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
			});

			function DisableSpecificDates(date) {

				var weekdate = $.datepicker.noWeek(date);
 				return weekdate;
			}



			$("#input-tgl-tour").datepicker({
				minDate : "+1d",
				dateFormat : "dd-mm-yy"
				'.$textOpentrip.'
			});


			$("#syarat-setuju").click(function(){
				if ($(this).prop("checked")){
					$("#bookPaket").prop("disabled", false);
				} else {
					$("#bookPaket").prop("disabled", true);
				}
			});

		');

		$this->htmlHeaderFooter->addCssAsset(array(



		));


		$this->htmlHeaderFooter->addJsAsset(array(
			'lib/datepicker/bootstrap-datepicker.min.js' => FALSE,
			'lib/datepicker/jquery-ui.min.js' => FALSE

		));

		$this->htmlHeaderFooter->setDescription();
		$this->htmlHeaderFooter->setKeywords();
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();




		$sliderSearchDomainArray = $this->sliderSearchDataSource->getAllSliderSearchForHome();
		$random = rand(0,count($sliderSearchDomainArray)-1);
		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), ''),
		    array('Book', '', '')
		);



		$this->overideViewVariable(array(
				'valueGet' => $valueGet,
				'sliderSearchDomain' => $sliderSearchDomainArray[$random],
				'tourDataSource' => $tourDataSource
		));

		$this->load->view('proses_pesan', $this->viewVariable);
	}
}