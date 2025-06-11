<?php

namespace DataSource;

use DateTime,
	Driver\MySQLi,
	Driver\Exception\StatementException,
	Domain\RegisterDomain;

class RegisterDataSource extends RootDataSource
{
	public function insert(RegisterDomain $registerDomain)
	{
		try
		{
			$statement = $this->mysqli->buildStatement('
                INSERT INTO
                    agen_registrasi
                VALUES(
                    :id,
                    :createdDate,
                    :username,
                    :email,
                    :nama,
                    :noHp1,
                    :noHp2,
                    :alamat,
                    :provinsi,
                    :paket,
                    :kodePromo,
                    :catatan,
                    :status,
                    :adminUsername,
                    :namaUsaha,
                    :jamAktif,
                    :data
                )
            ');
            $statement->execute(array(
                ':id' => $registerDomain->getId(),
                ':createdDate' => $registerDomain->getCreatedDate(),
                ':username' => $registerDomain->getUsername(),
                ':email' => $registerDomain->getEmail(),
                ':nama' => $registerDomain->getNama(),
                ':noHp1' => $registerDomain->getNoHp1(),
                ':noHp2' => $registerDomain->getNoHp2(),
                ':alamat' => $registerDomain->getAlamat(),
                ':provinsi' => $registerDomain->getProvinsi(),
                ':paket' => $registerDomain->getPaket(),
                ':kodePromo' => $registerDomain->getKodePromo(),
                ':catatan' => $registerDomain->getCatatan(),
                ':status' => $registerDomain->getStatus(),
                ':adminUsername' => $registerDomain->getAdminUsername(),
                ':namaUsaha' => $registerDomain->getNamaUsaha(),
                ':jamAktif' => $registerDomain->getJamAktif(),
                ':data' => $registerDomain->getData()
            ));
            $statement->close();

			if ($withTransaction)
			{
				$this->mysqli->commit();
			}
			return TRUE;
		}
		catch (StatementException $exception)
		{
			if ($this->isInDevelopment())
			{
				echo '<pre>', var_dump($exception), '</pre>';exit;
			}
			else
			{
				$this->insertError($exception);
			}

			return FALSE;
		}
	}

	// public function getAllTransaksiItemDomainByLimit($limit, $offset, $keyword = "")
	// {
	// 	$statement = $this->mysqli->buildStatement('
	// 	    SELECT
	// 	        count(id) jumlahData
	// 	    FROM
	// 	        transaksi_item
	// 	    '.$where.'
	// 	');
	// 	$statement->execute(array(
	// 	    ':keyword1' => '%'.$keyword.'%',
	// 	    ':keyword2' => '%'.$keyword.'%'
	// 	));

	// 	$result['jumlahData'] = 0;
	// 	$result['transaksiItemDomainArray'] = array();
	// 	$row = $statement->fetchAssociativeArray();
	// 	$statement->close();

	// 	if ($row['jumlahData'] == 0)
	// 	{
	// 		return $result;
	// 	}

	// 	$result['jumlahData'] = $row['jumlahData'];

	// 	$statement = $this->mysqli->buildStatement('
	// 	    SELECT
	// 	        *
	// 	    FROM
	// 	        transaksi_item
	// 	    '.$where.'
	// 	    LIMIT
	// 	        :limit, :offset
	// 	');
	// 	$statement->execute(array(
	// 	    ':limit' => $limit,
	// 	    ':offset' => $offset,
	// 	    ':keyword1' => '%'.$keyword.'%',
	// 	));

	// 	$rows = $statement->fetchAllAssociative();
	// 	$statement->close();
	// 	foreach ($rows as $row)
	// 	{
	// 		$result['transaksiItemDomainArray'][] = $this->instantiateTransaksiItemDomain($row);
	// 	}

	// 	return $result;
	// }

	// public function getTransaksiDomainByIdTransaksi($idTransaksi)
	// {
	// 	$statement = $this->mysqli->buildStatement('
	// 	    SELECT
	// 	        *
	// 	    FROM
	// 	        transaksi_item
	// 	    WHERE
	// 	        id_transaksi = :idTransaksi
	// 	');
	// 	$statement->execute(array(
	// 	    ':idTransaksi' => $idTransaksi
	// 	));
	// 	$row = $statement->fetchAssociativeArray();

	// 	$statement->close();

	// 	if (!(is_array($row)))
	// 	{
	// 		return FALSE;
	// 	}

	// 	return $this->instantiateTransaksiItemDomain($row);
	// }


	// public function update(TransaksiDomain $transaksiDomain, $withTransaction = TRUE)
	// {
	// 	if ($withTransaction)
	// 	{
	// 		$this->mysqli->query('START TRANSACTION');
	// 	}

	// 	try
	// 	{
	// 		$statement = $this->mysqli->buildStatement('
	// 		    UPDATE transaksi_item SET
	// 		        id_transaksi = :idTransaksi,
	// 		        kontak_description = :kontakDescription,
	// 		        paket_description = :paketDescription,
	// 		        tanggal_mulai = :tanggalMulai,
	// 		        harga_description = :hargaDescription,
	// 		        total_harga = :totalHarga,
	// 		        total_nta = :totalNta,
	// 		        total_item = :totalItem,
	// 		        keterangan = :keterangan,
	// 		        tipe_item = :tipeItem
	// 		    WHERE
	// 		        id = :id

	// 		');
	// 		$statement->execute(array(
	// 			':id' => $transaksiItemDomain->getId(),
	// 			':idTransaksi' => $transaksiItemDomain->getIdTransaksi(),
	// 			':kontakDescription' => $transaksiItemDomain->getKontakDescription(),
	// 			':paketDescription' => $transaksiItemDomain->getPaketDescription(),
	// 			':tanggalMulai' => $transaksiItemDomain->getTanggalMulai() == NULL ? NULL : $transaksiItemDomain->getTanggalMulai()->format('Y-m-d H:i:s'),
	// 			':hargaDescription' => $transaksiItemDomain->getHargaDescription(),
	// 			':totalHarga' => $transaksiItemDomain->getTotalHarga(),
	// 			':totalNta' => $transaksiItemDomain->getTotalNta(),
	// 			':totalItem' => $transaksiItemDomain->getTotalItem(),
	// 			':keterangan' => $transaksiItemDomain->getKeterangan(),
	// 			':tipeItem' => $transaksiItemDomain->getTipeItem()
	// 		));
	// 		$statement->close();

	// 		if ($withTransaction)
	// 		{
	// 			$this->mysqli->commit();
	// 		}

	// 		return TRUE;
	// 	}
	// 	catch (StatementException $exception)
	// 	{
	// 		if ($this->isInDevelopment())
	// 		{
	// 			echo '<pre>', var_dump($exception), '</pre>';exit;
	// 		}
	// 		else
	// 		{
	// 			$this->insertError($exception);
	// 		}

	// 		return FALSE;
	// 	}
	// }


	private function instantiateRegisterDomain(array $row)
	{
		$registerDomain = new RegisterDomain(
            $row['id'],
            $row['created_date'],
            $row['username'],
            $row['email'],
            $row['nama'],
            $row['no_hp1'],
            $row['no_hp2'],
            $row['alamat'],
            $row['provinsi'],
            $row['paket'],
            $row['kode_promo'],
            $row['catatan'],
            $row['status'],
            $row['admin_username'],
            $row['nama_usaha'],
            $row['jam_aktif'],
            $row['data']
        );

		return $registerDomain;
	}
}
