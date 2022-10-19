<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license
$loc = array(
	'subtitle' => "Pembuat kode QR",
	'description' => "Membuat kode QR dengan bebas. Pilih konten, ukuran warna, ...",

	'label_content' => "Teks untuk dienkode",
	'label_redundancy' => "Tingkat redundansi",
	'label_margin' => "Ukuran tepi",
	'label_size' => "Ukuran gambar",
	'label_bgColor' => "Warna latar belakang",
	'label_fgColor' => "Warna latar depan",

	'placeholder' => "Masukkan teks untuk dienkode di kode QR",

	'help_content' => "
<p>Anda bisa mengenkode teks apa pun.</p>
<p>Perangkat lunak yang mendekodekan kode QR tersebut bisa memberikan pilihan untuk membuka dengan perangkat lunak tertentu, tergantung pada <a href='https://en.wikipedia.org/wiki/List_of_URI_schemes' hreflang='en' rel='help external noreferrer'>Skema URI</a> mereka.</p>
<p>Contohnya, untuk membuka halaman situs: <code>https://www.contoh.id/</code></p>
<p>Untuk mengirim surel: <code>mailto:contact@email.example</code></p>
<p>Untuk membagikan koordinat geografik: <code>geo:48.867564,2.364057</code></p>
",
	'help_redundancy' => "Redundansi adalah duplikasi informasi di kode QR untuk memperbaiki galat saat pendekodean. Tingkat lebih besar akan menghasilkan kode QR yang lebih besar, tetapi akan dapat hasil lebih baik untuk didekodekan dengan benar.",
	'help_margin' => "Jumlah piksel di tepi putih di sekitar kode QR.",
	'help_size' => "Tinggi dan lebar gambar dalam piksel, tanpa tepian.",

	'button_create' => "Buat",
	'button_download' => "Simpan kode QR ini",

	'title_showOnlyQR' => "Tampilkan kode QR ini saja",

	'alt_QR_before' => 'Arti kode QR "',
	'alt_QR_after' => '"',

	'metaText_qr' => "
		<h3>Apa itu Kode QR?</h3>
		Kode QR adalah kode batang 2 dimensi yang mana teks ditulis dalam biner. Bisa didekodekan dengan perangkat yang memiliki sensor foto dan perangkat lunak yang memadai.
		<a href='https://id.wikipedia.org/wiki/Kode_QR' hreflang='id' rel='help external noreferrer'>Kode QR di Wikipedia</a>.
	",
	'metaText_legal' => "LibreQR " . LIBREQR_VERSION . " adalah perangkat lunak bebas yang <a href='https://code.antopie.org/miraty/libreqr/' rel='external noreferrer'>kode sumber</a> tersedia di bawah ketentuan <abbr title='GNU Affero General Public License versi 3 atau selanjutnya version'><a href='LICENSE.html' hreflang='en' rel='license'>AGPLv3</a>+</abbr>.",

	'error_generation' => "Galat terjadi ketika membuat kode QR. Coba dengan parameter yang berbeda.",
);
