<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pnl extends CI_Controller {

	/**
	 * Choirul Anam
	 * choirulanamm@gmail.com
	 */

	public $binance = 'https://api.binance.com/api/v3/ticker/bookTicker?symbols=%5B%22BNBBUSD%22,%22BTCBUSD%22,%22ETHBUSD%22,%22BUSDBIDR%22%5D';

	public function index()
	{
		if ($this->session->userdata("username")=="") {
			redirect("Login");
		}else{
			$data['title'] = ".::DASHBOARD APP PNL ::.";
			$this->load->view('pnl',$data);
		}
	}

	public function getPrice(){
		$data = $this->curl->simple_get($this->binance);
		$result = json_decode($data, true);
		if ($result==NULL) {
			// code...
			echo "null";
		}else{
			$res_price = array(
				'bnb' => floatval($result[0]["bidPrice"]),
				'btc' => floatval($result[1]["bidPrice"]),
				'eth' => floatval($result[2]["bidPrice"]),
				'idr' => floatval($result[3]["bidPrice"])
			);
			echo json_encode($res_price);
		}
	}

	public function getPnl(){
		$fec = $this->Coin_mod->GetData();
		$res_coin = array();
		foreach($fec->result() as $row){
			$curl_binance = $this->curl->simple_get('https://api3.binance.com/api/v3/ticker/bookTicker?symbol='.$row->symbol.'BUSD');

			$set_curl_binance = json_decode($curl_binance, true);

			$curl_inch = $this->curl->simple_get('https://api.1inch.exchange/v4.0/56/quote?fromTokenAddress=0xe9e7cea3dedca5984780bafc599bd69add087d56&toTokenAddress='.$row->token.'&amount=1500000000000000000000');
			$result = json_decode($curl_inch, true);
			$res_coin[] = array(
					'coin' => $result['toToken']['symbol'],
					'price' => round(floatval($result['toTokenAmount'])/floatval($row->decimal_price),2),
					'from' => $result['fromToken']['symbol'],
					'hasil' => ($set_curl_binance != NULL) ? round((floatval($set_curl_binance["bidPrice"])*round(floatval($result['toTokenAmount'])/floatval($row->decimal_price),2))):'error'
			);

		}
		echo '<pre>',print_r($res_coin,true),'</pre>';
	}

	public function getTest(){
		$this->curl->create('https://api3.binance.com/api/v3/ticker/bookTicker?symbol=BTCBUSD');
		$this->curl->simple_get('https://api3.binance.com/api/v3/ticker/bookTicker?symbol=BTCBUSD');
		$this->curl->option('buffersize', 10);
		//echo $this->curl->execute();

		// Debug data ------------------------------------------------

		// Errors
		echo $this->curl->error_code; // int
		echo $this->curl->error_string;

		// Information
		echo var_dump($this->curl->info); // array

	}
}
