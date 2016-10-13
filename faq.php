<?php
$lock = false;
$faqMenu = true;
include_once(__DIR__.'/header.php');
?>
    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <h1>Frequently Asked Questions</h1>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <div class="content-md margin-bottom-30" id="eventWrapper">
        <div class="container" id="bookContainer">
            <h2>Questions</h2>
            <br>
            <h4>Peminjam</h4>
            <ol class="faq-ol">
                <li><a href="#1">Bagaimana cara meminjam buku?</a></li>
                <li><a href="#2">Apakah arti status pada buku?</a></li>
                <li><a href="#3">Berapa banyak buku yang bisa dipinjam?</a></li>
                <li><a href="#4">Apakah ada syarat tertentu untuk dapat meminjam buku?</a></li>
                <li><a href="#5">Apakah sistem Book Sharing ini gratis?</a></li>
                <li><a href="#6">Apa yang harus saya lakukan apabila saya merusakkan buku yang dipinjam?</a></li>
                <li><a href="#7">Saya tidak sengaja mengklik permohonan peminjaman buku - apakah bisa dibatalkan?</a></li>
                <li><a href="#8">Siapa saja yang boleh meminjam buku?</a></li>
                <li><a href="#9">Mengapa yang ada di sini hanya buku-buku rohani Kristen?</a></li>
                <li><a href="#10">Kemana saya dapat menujukan kritik/apresiasi/saran?</a></li>
            </ol>
            <br>
            <h4>Pemilik buku</h4>
            <ol class="faq-ol">
                <li><a href="#1">Apakah sistem Book Sharing ini gratis?</a></li>
                <li><a href="#2">Siapa saja yang boleh meminjamkan buku?</a></li>
                <li><a href="#3">Berapa banyak buku yang bisa saya pinjamkan?</a></li>
                <li><a href="#4">Apakah buku yang saya pinjamkan harus saya berikan ke admin?</a></li>
                <li><a href="#5">Mengapa buku yang saya daftarkan untuk dipinjamkan belum dapat dipinjam?</a></li>
                <li><a href="#6">Apakah buku yang saya pinjamkan akan dijaga dengan baik oleh peminjam?</a></li>
            </ol>
            <br><br>
            <h2>Answers</h2>
            <br>
            <h4>Peminjam</h4>
            <ol class="faq-ol">
                <li><a name="1">Bagaimana cara meminjam buku?</a></li>
                <div>Untuk meminjam buku anda harus login atau register terlebih dahulu. Pilih buku yang mau dipinjam, lalu klik "Borrow". Setelah itu pemilik buku akan mendapat notifikasi. Bila dia mau meminjamkan pada anda, anda akan mendapat notifikasi dan kemudian bisa membuat janji untuk mengambil buku tersebut. Tetapi apabila ada suatu alasan yang membuat buku tersebut tidak dapat dipinjamkan, dia akan memberikan alasannya pada anda.</div>
                <li><a name="2">Apakah arti status pada buku?</a></li>
                <div>Available - dapat dipinjam. Reserved - buku sudah direservasi namun belum diberikan ke peminjam. Pending Admin Approval - buku sedang menunggu persetujuan Admin untuk dapat dipinjamkan. Borrowed - buku sedang dipinjam. Private - buku sedang digunakan oleh pemilik buku sendiri atau sedang dipinjamkan di luar sistem Book Sharing.</div>
                <li><a name="3">Berapa banyak buku yang bisa dipinjam?</a></li>
                <div>Saat ini setiap orang hanya dapat meminjam 1 buku. Ketika jumlah buku yang terdaftar sudah lebih banyak, maka admin akan mempertimbangkan untuk mengijinkan peminjaman lebih dari satu buku.</div>
                <li><a name="4">Apakah ada syarat tertentu untuk dapat meminjam buku?</a></li>
                <div>Tidak. Tetapi anda wajib menjaga keadaan buku yang dipinjam tetap dalam keadaan baik (halaman buku TIDAK boleh dilipat atau ditandai) dan dikembalikan pada waktunya.</div>
                <li><a name="5">Apakah sistem Book Sharing ini gratis?</a></li>
                <div>Ya. Anda sebagai pemilik dan peminjam buku tidak perlu membayar apa-apa.</div>
                <li><a name="6">Apa yang harus saya lakukan apabila saya merusak buku yang saya pinjam?</a></li>
                <div>Beritahukan tentang kerusakkan pada admin dan pemilik buku. Tanyakan pada pemilik buku apa yang dia kehendaki sebagai bentuk kompensasi.</div>
                <li><a name="7">Saya tidak sengaja mengklik permohonan peminjaman buku - apakah bisa dibatalkan?</a></li>
                <div>Bisa. Di halaman setelah anda menekan tombol pinjam (borrow), anda dapat membatalkan permohonan peminjaman (cancel). Apabila anda sudah terlanjur menutup halaman tersebut, anda juga dapat membatalkan dari halaman My Books.</div>
                <li><a name="8">Siapa saja yang boleh meminjam buku?</a></li>
                <div>Setiap orang yang sudah mendaftarkan diri di Book Sharing ini.</div>
                <li><a name="9">Mengapa yang ada di sini hanya buku-buku rohani Kristen?</a></li>
                <div>Karena platform ini bernaung dibawah gereja Freie evangelische Gemeinde Immanuel Berlin dan dibuat dengan tujuan untuk memenuhi kebutuhan rohani jemaat.</div>
                <li><a name="10">Kemana saya dapat menujukan pertanyaan/kritik/apresiasi/saran?</a></li>
                <div>Silakan layangkan email ke <a href="mailto:komisiperpustakaan@immanuel-berlin.de">komisiperpustakaan@immanuel-berlin.de</a>.</div>
            </ol>
            <br>
            <h4>Pemilik buku</h4>
            <ol class="faq-ol">
                <li><a name="1">Apakah sistem Book Sharing ini gratis?</a></li>
                <div>Ya. Anda sebagai pemilik dan peminjam buku tidak perlu membayar apa-apa.</div>
                <li><a name="2">Siapa saja yang boleh meminjamkan buku?</a></li>
                <div>Setiap orang yang telah mendaftarkan diri di Book Sharing ini.</div>
                <li><a name="3">Berapa banyak buku yang bisa saya pinjamkan?</a></li>
                <div>Sebanyak yang anda kehendaki/relakan.</div>
                <li><a name="4">Apakah buku yang saya pinjamkan harus saya berikan ke admin?</a></li>
                <div>Tidak. Buku tersebut tetap berada di pemilik buku. Pemilik buku akan diberi tahu kalau ada yg berminat meminjam buku tersebut.</div>
                <li><a name="5">Mengapa buku yang saya daftarkan untuk dipinjamkan belum dapat dipinjam?</a></li>
                <div>Karena admin perlu memeriksa dahulu kelayakan buku tersebut untuk dapat dimasukkan ke dalam sistem.</div>
                <li><a name="6">Apakah buku yang saya pinjamkan akan dijaga dengan baik oleh peminjam?</a></li>
                <div>Peminjam wajib menjaga keadaan buku agar tetap baik. Jika buku tersebut rusak (sengaja atau tidak), pemilik berhak menentukan kompensasi yang pantas dan admin akan membantu menyelesaikan prosesnya.</div>
            </ol>
            <div style="margin-bottom:50px" class="row">

            </div>
        </div>
    </div>
    <!--=== End Shop Suvbscribe ===-->

<?php include_once(__DIR__.'/footer.php'); ?>

</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Get the data -->
<script src="assets/js/jsrender.js"></script>
<script src="assets/js/app/header.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<script src="assets/plugins/smoothScroll.js"></script>
<script src="assets/plugins/jquery-steps/build/jquery.steps.js"></script>
<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->
<!--[if lt IE 10]>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->

</body>
</html>
