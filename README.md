<h1 class="code-line" data-line-start=0 data-line-end=1 ><a id="_Aplikasi_Toko_Kasir_0"></a>📦 Aplikasi Toko Kasir</h1>
<p class="has-line-data" data-line-start="2" data-line-end="6"><img src="https://img.shields.io/badge/PHP-%5E8.1-blue" alt="PHP Version"><br>
<img src="https://img.shields.io/badge/Database-MySQL-yellow?logo=mysql" alt="MySQL"><br>
<img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&amp;logo=bootstrap&amp;logoColor=white" alt="Boostrap"><br>
<img src="https://shields.io/badge/JavaScript-F7DF1E?logo=JavaScript&amp;logoColor=000&amp;style=flat-square" alt="Javascript"></p>
<p class="has-line-data" data-line-start="8" data-line-end="9">Aplikasi ini adalah sistem kasir berbasis web yang dibuat menggunakan <strong>PHP Native</strong>, <strong>Bootstrap CSS</strong>, <strong>JavaScript murni</strong>, dan <strong>MySQL</strong> sebagai database. Aplikasi ini dirancang untuk memudahkan pengelolaan barang, transaksi penjualan, laporan, dan administrasi toko grosir sandal atau usaha retail lainnya.</p>
<hr>
<h2 class="code-line" data-line-start=12 data-line-end=13 ><a id="_Fitur_Utama_12"></a>🛠️ Fitur Utama</h2>
<ul>
<li class="has-line-data" data-line-start="14" data-line-end="15">✅ Manajemen Data Barang (Tambah, Edit, Hapus)</li>
<li class="has-line-data" data-line-start="15" data-line-end="16">✅ Transaksi Penjualan</li>
<li class="has-line-data" data-line-start="16" data-line-end="17">✅ Melacak Stok Otomatis saat Transaksi</li>
<li class="has-line-data" data-line-start="17" data-line-end="18">✅ Riwayat &amp; Laporan Penjualan Lengkap</li>
</ul>
<hr>
<h2 class="code-line" data-line-start=20 data-line-end=21 ><a id="_Instalasi_dan_Konfigurasi_20"></a>🚀 Instalasi dan Konfigurasi</h2>
<h3 class="code-line" data-line-start=23 data-line-end=24 ><a id="_1_Clone_atau_Download_Proyek_23"></a>🗂️ 1. Clone atau Download Proyek</h3>
<p class="has-line-data" data-line-start="24" data-line-end="25">Download atau clone repository ini ke dalam folder <code>htdocs</code> XAMPP kamu.</p>
<pre><code class="has-line-data" data-line-start="27" data-line-end="29" class="language-bash">git <span class="hljs-built_in">clone</span> https://github.com/username/aplikasi-kasir.git
</code></pre>
<p class="has-line-data" data-line-start="29" data-line-end="30">Atau ekstrak file zip ke:</p>
<pre><code class="has-line-data" data-line-start="31" data-line-end="33" class="language-bash">C:\xampp\htdocs\aplikasi-kasir
</code></pre>
<h3 class="code-line" data-line-start=34 data-line-end=35 ><a id="_2_Import_Database_34"></a>🛢️ 2. Import Database</h3>
<ul>
<li class="has-line-data" data-line-start="36" data-line-end="37">Buka phpMyAdmin melalui <a href="http://localhost/phpmyadmin">http://localhost/phpmyadmin</a></li>
<li class="has-line-data" data-line-start="37" data-line-end="38">Buat database baru dengan nama: toko</li>
<li class="has-line-data" data-line-start="38" data-line-end="39">Klik Import, lalu pilih file database.sql yang ada di folder proyek</li>
<li class="has-line-data" data-line-start="39" data-line-end="41">Klik Go untuk mengimpor struktur dan data awal</li>
</ul>
<h3 class="code-line" data-line-start=41 data-line-end=42 ><a id="_3__Konfigurasi_Koneksi_Database_41"></a>⚙️ 3.  Konfigurasi Koneksi Database</h3>
<p class="has-line-data" data-line-start="42" data-line-end="43">Buka file:</p>
<pre><code class="has-line-data" data-line-start="44" data-line-end="46" class="language-bash">/config.php
</code></pre>
<p class="has-line-data" data-line-start="46" data-line-end="47">Dan sesuaikan konfigurasi berikut jika perlu:</p>
<pre><code class="has-line-data" data-line-start="48" data-line-end="61" class="language-bash">&lt;?php
<span class="hljs-variable">$host</span> = <span class="hljs-string">'localhost'</span>;
<span class="hljs-variable">$user</span> = <span class="hljs-string">'root'</span>;
<span class="hljs-variable">$pass</span> = <span class="hljs-string">''</span>;
<span class="hljs-variable">$db</span>   = <span class="hljs-string">'toko'</span>;

<span class="hljs-variable">$conn</span> = mysqli_connect(<span class="hljs-variable">$host</span>, <span class="hljs-variable">$user</span>, <span class="hljs-variable">$pass</span>, <span class="hljs-variable">$db</span>);

<span class="hljs-keyword">if</span> (!<span class="hljs-variable">$conn</span>) {
    die(<span class="hljs-string">"Koneksi database gagal: "</span> . mysqli_connect_error());
}
?&gt;
</code></pre>
<h3 class="code-line" data-line-start=62 data-line-end=63 ><a id="_4_Jalankan_Aplikasi_62"></a>🧪️ 4. Jalankan Aplikasi</h3>
<pre><code class="has-line-data" data-line-start="64" data-line-end="66" class="language-bash">http://localhost/aplikasi-kasir
</code></pre>
<p class="has-line-data" data-line-start="67" data-line-end="68">Login menggunakan akun default (jika sudah disediakan dalam database.sql), misalnya:</p>
<p class="has-line-data" data-line-start="69" data-line-end="71">Username: <a href="mailto:kasir@mail.com">kasir@mail.com</a><br>
Password: kasir</p>
<p class="has-line-data" data-line-start="72" data-line-end="73">atau buat akun baru</p>
<hr>
<h1 class="code-line" data-line-start=76 data-line-end=77 ><a id="_Teknologi_yang_Digunakan_76"></a>📌 Teknologi yang Digunakan</h1>
<ul>
<li class="has-line-data" data-line-start="77" data-line-end="78">PHP Native</li>
<li class="has-line-data" data-line-start="78" data-line-end="79">Bootstrap 5</li>
<li class="has-line-data" data-line-start="79" data-line-end="80">JavaScript (Vanilla JS)</li>
<li class="has-line-data" data-line-start="80" data-line-end="81">MySQL</li>
<li class="has-line-data" data-line-start="81" data-line-end="83">Font Awesome (versi 5.15.3)</li>
</ul>
<h2 class="code-line" data-line-start=83 data-line-end=84 ><a id="Lisensi_83"></a>Lisensi</h2>
<p class="has-line-data" data-line-start="85" data-line-end="86">The Laravel framework is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT">MIT license</a>.</p>
<h2 class="code-line" data-line-start=87 data-line-end=88 ><a id="Kredit_87"></a>Kredit</h2>
<p class="has-line-data" data-line-start="88" data-line-end="89">Proyek ini dikembangkan oleh:</p>
<ul>
<li class="has-line-data" data-line-start="90" data-line-end="91">👤 Fadhil Rafi Fauzan</li>
<li class="has-line-data" data-line-start="91" data-line-end="92">📧 Email: <a href="mailto:fadhilrafifauzan.17@gmail.com">fadhilrafifauzan.17@gmail.com</a></li>
<li class="has-line-data" data-line-start="92" data-line-end="94">🐙 GitHub: <a href="http://github.com/fdhlrf.1">github.com/fdhlrf.1</a></li>
</ul>
<p class="has-line-data" data-line-start="94" data-line-end="96">© 2024 Toko Kasir — Hak Cipta Dilindungi Undang-Undang.<br>
Terima kasih telah menggunakan aplikasi ini! ⭐</p>
