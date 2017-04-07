<?php

/* (C) Copyright 2017 Heru Arief Wijaya (http://belajararief.com/) untuk Renbang Biro Kepegawaian BPKP.*/
/* Mapping of Menu and access group
	            Administrator (1)	Supervisor (2)	User Kanpus (3)	User Unit (4)
Parameter				
  Bidang/ Unitorg	1						1				1				0
  Kategori Data		1						0				0				0
  Peran PPM			1						0				0				0
  User				1						0				0				0
Transaksi				
  PPM				1						1				1				1
Laporan				
  Laporan Unit		0						0				0				1
  Laporan Kompilasi	1						1				1				0

*/

namespace app\widgets;

use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Widget;

/**
 * Widget for rendering main menu of app.
 *
 * @author Heru Arief Wijaya <heru@belajararief.com>
 */
class MainMenu extends Widget {

	protected function visibility($group_id){
		if(Yii::$app->user->identity->group_id <= $group_id){
			return true;
		}ELSE{
			return false;
		}
	}

	public function run() {
		NavBar::begin([
			'brandLabel' =>
							// Html::img('logo.png', [
							// 	'class'=>'img-thumbnail',
							// 	'width' => '100px',
							// 	'alt'=> 'BPKP', 
							// 	'title'=> 'BPKP',
							// ]).'<div class="pull-right">'.
								Yii::$app->name
								// .'</div>'
								,
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-default navbar-fixed-top',
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => $this->getItems(),
		]);
		NavBar::end();
	}

	
	protected function getItems() {
		$items = [
			['label' => 'Home', 'url' => ['/site/index']],
			// ['label' => 'About', 'url' => ['/site/about']],
			// ['label' => 'Contact', 'url' => ['/site/contact']],
		];

		if (Yii::$app->user->isGuest) {
			$items[] = ['label' => 'Login', 'url' => ['/site/login']];
		} else {
			$items[] = ['label' => 'Parameter', 
				'items' => [
					['label' => 'Bidang', 'url' => ['/parameter/bidang'], 'visible' => $this->visibility(3)],
					// ['label' => 'Kategori Data Bidang', 'url' => ['/parameter/kategori']],
					// ['label' => 'Pegawai', 'url' => ['/parameter/pegawai']],
					['label' => 'Kategori Data', 'url' => ['/parameter/puus'], 'visible' => $this->visibility(1)],
					['label' => 'Peran PPM', 'url' => ['/parameter/peran'], 'visible' => $this->visibility(1)],
					// ['label' => 'Location', 'url' => ['/location']],
					// ['label' => 'News and Articles', 'url' => ['/articles']],
					['label' => 'User', 'url' => ['/parameter/user'], 'visible' => $this->visibility(1) ],
				]
			];

			$items[] = ['label' => 'Transaksi', 
				'items' => [
					['label' => 'PPM', 'url' => ['/transaksi/ppm'], 'visible' => $this->visibility(4)],
				]
			];

			$items[] = ['label' => 'Laporan', 
				'items' => [
					['label' => 'Laporan Unit', 'url' => ['/laporan/pelaporanunit'], 'visible' => $this->visibility(4)],
					['label' => 'Laporan Kompilasi', 'url' => '#', 'visible' => $this->visibility(3)],
			]];	
			$items[] = ['label' => Html::encode(Yii::$app->user->identity->username), 
				'items' => [
					['label' => 'Profile', 'url' => ['/site/profile'], 'visible' => 1],
					Html::tag('li', $this->getLogoutButton()),
			]];				
			// $items[] = Html::tag('li', $this->getLogoutButton());					
		}

		return $items;
	}

	/**
	 * Generate logout button for menu.
	 * @return string
	 */
	protected function getLogoutButton() {
		$label = 'Logout (' . Html::encode(Yii::$app->user->identity->username) . ')';
		$output = Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form']);
		$output .= Html::submitButton($label, ['class' => 'btn btn-link']);
		$output .= Html::endForm();

		return $output;
	}

}
